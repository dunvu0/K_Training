const fs = require('fs');
const path = require('path');
const router = require('express').Router();
const { customUrlEncode } = require('../utils/encode');
const { sanitizeContent } = require('../utils/sanitizer')
const { FileValidationCheck } = require('../middleware/fileValidationCheck');

let list = [];
const BASE_DIR = path.join(__dirname, '../upload');

router.get('/download', (req, res) => {
    const file = req.query.file;
    const file_path = path.join(__dirname,'../upload', file);
    const  normalized_path = path.normalize(file_path);

    if (!normalized_path.startsWith(BASE_DIR)){
        return res.status(400).send('Do not attempt to hack.');
    }

    try {
        fs.accessSync(normalized_path, fs.constants.F_OK);
    } catch (err) {
        console.log(err);
        return res.status(404).send('File not found.');
    }
    
    try {
        res.setHeader('Content-Disposition', `attachment; filename="${file}"`);
        res.sendFile(normalized_path, (err)=>{
            if (err){
                res.status(500).send('Internal Sever Error');
            }
        });
        
    } catch (error) {
        fs.readFile( normalized_path, 'utf8', (err, data) => {
            if (err) {
                console.log(err);
            }
            const title = Buffer.from(path.basename(normalized_path), 'utf8').toString();
            const ip = req.socket.remoteAddress;
            if(ip === '127.0.0.1' || ip === '::1' || ip === '::ffff:127.0.0.1'){
                return res.redirect(`/file/error?title=${customUrlEncode(title)}&content=${customUrlEncode(data)}&safe=true`);
            }
            return res.redirect(`/file/error?title=${customUrlEncode(title)}&content=${customUrlEncode(data)}&safe=false`);
        })
    }
});

router.get('/upload', (req,res)=>{
    return res.render('upload', { uploadStatus: null, err: null });
})

router.post('/upload', FileValidationCheck, (req, res) => {
    try {
        list.push(req.file.path.split('/upload/')[1])
        return res.render('upload', { uploadStatus: 'success'});
    } catch (err) {
        return res.render('upload', { uploadStatus: 'success'});
    }
})

router.get('/error', (req,res)=>{
    const title = req.query.title;
    const content = req.query.content;
    let safe = req.query.safe || 'true';

    if (typeof title !== 'string' || title.trim() === "" || typeof content !== 'string' || content.trim() === ""){
        res.write('Title or content is missing');
        return res.end();
    }

    if (typeof safe !== 'string'){
        safe = true;
    }
    else{
        safe = safe === 'true';    
    }

    if (safe){
        res.setHeader('X-Content-Type-Options','nosniff');
    }
    
    res.write(`${sanitizeContent(decodeURIComponent(title))}`);
    res.write('======================================================================');
    res.write('<br>');
    res.write('<br>');
    res.write('<br>');
    res.write(`<textarea>${sanitizeContent(decodeURIComponent(content))}</textarea>`);
    res.write('<br>');
    res.write('<br>');
    res.write('<br>');
    res.write('======================================================================');
    res.write('<br>');
    res.write('<br>');
    res.write('<br>');
    res.write('Unexpected Error Occured!<br>');
    res.write('Please copy the contents of the file directly!<br>');
    res.write('We sincerely apologize for the inconvenience.');
    res.end();
})

router.get('/lists', (req,res)=>{

    res.render('list', {files:list})
})

module.exports = router