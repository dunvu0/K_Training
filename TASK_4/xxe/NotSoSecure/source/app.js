const express = require('express');
const cookieSession = require('cookie-session');
const fileUpload = require('express-fileupload');
const cookieParser = require('cookie-parser');
const elliptic = require('elliptic');
const EC = elliptic.ec;
const CryptoJS = require('crypto-js');
const BN = require('bn.js');
const libxmljs = require('libxmljs');
const AdmZip = require('adm-zip');
const path = require('path');
const fs = require('fs');

const app = express();

// Configure Express app
app.set('view engine', 'ejs');
app.use(cookieSession({ keys: ['taiwhis!@#^%&^$$'] }));
app.use(cookieParser());
app.use('/public/', express.static(path.join(__dirname, 'public')));
app.use(express.urlencoded({ extended: false }));
app.use(fileUpload());

const ec = new EC('p256');
const privateKeyHex = process.env.PRIVATE_KEY_HEX;
const K = process.env.K;

// Helper functions
const base64urlEncode = str => Buffer.from(str).toString('base64')
    .replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');

const base64urlToBuffer = base64url => {
    const base64 = base64url
        .replace(/-/g, '+')
        .replace(/_/g, '/')
        .padEnd(base64url.length + (4 - (base64url.length % 4)) % 4, '=');
    return Buffer.from(base64, 'base64');
};

const signMessageWithFixedK = (message, privateKeyHex, K) => {
    const e = CryptoJS.SHA256(message).toString(CryptoJS.enc.Hex);
    const z = new BN(e, 16);
    const d = ec.keyFromPrivate(privateKeyHex, 'hex').getPrivate();
    const k = new BN(K, 10);

    const point = ec.g.mul(k);
    const r = point.getX().umod(ec.n);

    if (r.isZero()) throw new Error('Invalid k: results in r = 0');

    const kInv = k.invm(ec.n);
    const s = kInv.mul(z.add(r.mul(d)).umod(ec.n)).umod(ec.n);

    if (s.isZero()) throw new Error('Invalid k: results in s = 0');

    // console.log(r.toString(10),s.toString(10));

    return Buffer.concat([Buffer.from(r.toString(16).padStart(64, '0'), 'hex'), Buffer.from(s.toString(16).padStart(64, '0'), 'hex')]);
};

const createJWT = (header, payload, privateKeyHex, K) => {
    const encodedHeader = base64urlEncode(JSON.stringify(header));
    const encodedPayload = base64urlEncode(JSON.stringify(payload));
    const message = `${encodedHeader}.${encodedPayload}`;
    const signature = signMessageWithFixedK(message, privateKeyHex, K);

    // console.log(base64urlEncode(signature));

    return `${message}.${base64urlEncode(signature)}`;
};

const verifyJWT = (token) => {
    // Split the JWT into its components
    const [encodedHeader, encodedPayload, signatureBase64] = token.split('.');
    if (!encodedHeader || !encodedPayload || !signatureBase64) return false;

    const message = `${encodedHeader}.${encodedPayload}`;
    const signature = signMessageWithFixedK(message, privateKeyHex, K);

    // console.log(base64urlEncode(signature));

    return signatureBase64 === base64urlEncode(signature);
};

const decodeJWT = (token) => {
    const [encodedHeader, encodedPayload, signature] = token.split('.');

    if (!encodedHeader || !encodedPayload || !signature) {
        throw new Error('Invalid JWT token');
    }

    const header = base64urlToBuffer(encodedHeader).toString('utf8');
    const payload = base64urlToBuffer(encodedPayload).toString('utf8');

    return {
        header: JSON.parse(header),
        payload: JSON.parse(payload),
        signature: signature
    };
};

// Routes
app.get('/robots.txt', (req, res) => {
    res.type('text/plain');
    res.send("Since the algorithm as described in the header is ES256, the curve is P-256 (see: https://en.wikipedia.org/wiki/Elliptic_Curve_Digital_Signature_Algorithm#Signature_generation_algorithm). \nLogging in with different usernames gives a signature with the same prefix, so there's likely a resuse of k-values. The last 32 bytes of the signature is a SHA256 hash is of the token header and payload.");
});

app.get('/', (req, res) => {
    res.render('index.ejs');
});

app.post('/login', (req, res) => {
    const { username, password } = req.body;
    if (username && password) {
        const header = { alg: 'ES256', typ: 'JWT' };
        const payload = { username, quirk: 'civilian' };
        const token = createJWT(header, payload, privateKeyHex, K);
        console.log("[+] New token: ",token);
        res.cookie('token', token, { maxAge: 900000, httpOnly: true });
        res.redirect('/dashboard');
    } else {
        res.redirect('/');
    }
});

app.get('/dashboard', (req, res) => {
    const { token } = req.cookies;
    if (verifyJWT(token)) {
        const decoded = decodeJWT(token);
        res.render(decoded.payload.quirk === 'HACKING' ? 'admin.ejs' : 'guest.ejs', { info: req.session.info });
    } else {
        res.sendStatus(403);
    }
}); 

app.post('/upload', (req, res) => {
    if (!req.files || Object.keys(req.files).length === 0) {
        return res.status(400).send('No files were uploaded.');
    }

    let file = req.files.file;
    if (file.size > 2000000) {
        return res.render('admin', { err_msg: 'File size exceeded...', info: req.session.info });
    }

    let uploadPath = path.join(__dirname, 'uploads', file.md5);
    file.mv(uploadPath, err => {
        if (err) {
            return res.status(500).send('Error uploading file.');
        }

        try {
            const zip = new AdmZip(uploadPath);
            const zipEntries = zip.getEntries();
            let info = {};

            zipEntries.forEach(zipEntry => {
                if (zipEntry.entryName === "docProps/app.xml") {
                    const xmlData = zipEntry.getData().toString("utf8");
                    const docXML = libxmljs.parseXml(xmlData, { noent: true, noblanks: true });
                    const root = docXML.root().namespace().href();
                    const txt = docXML.get('xmlns:Words', root);
                    info.words = txt.text() || "0";
                }
            });

            req.session.info = info;
            res.redirect('/dashboard');
        } catch (err) {
            res.render('admin', { err_msg: 'Use docx file only...', info: req.session.info });
        }
    });
});

app.listen(9999, () => console.log('[+] Server Started'));
