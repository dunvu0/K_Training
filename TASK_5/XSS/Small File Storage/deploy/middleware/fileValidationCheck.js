const multer = require('multer');
const path = require('path');
const FileValidationError = require('../errors/FileValidationError');


const UPLOAD_DIR = path.join(__dirname, '../upload');

const storage = multer.diskStorage({
    destination: (req, file, cb) => {
        cb(null, UPLOAD_DIR);
    },
    filename: (req, file, cb) => {
        const ext = path.extname(file.originalname);
        const base_name = path.basename(file.originalname, ext);
        const safe_base_name = Buffer.from(base_name, 'latin1').toString('utf8') + '-' + Date.now();
        const file_name = safe_base_name + ext;
        cb(null, file_name);
    }
});

const fileFilter = (req, file, cb) => {
    const file_name = Buffer.from(file.originalname, 'latin1').toString('utf8');
    if (/[!@#$%^&*()\-\+\?\[\]\\:;\"'\|,\/]/g.test(file_name)){
        return cb(new FileValidationError('Special characters are not allowed.'), false);
    }
    cb(null, true)
}

const upload = multer({ 
    storage: storage, 
    limits: {fileSize: 2 * 1024 * 1024}, 
    fileFilter: fileFilter 
});

const FileValidationCheck = (req, res, next) => {
    upload.single('file')(req, res, (err) => {
        if (err) {
            if(err instanceof FileValidationError){
                console.log(`File filter error: ${err.message}`);
                return res.status(400).render('upload', {uploadStatus: 'fail'});
            }
            if (err instanceof multer.MulterError) {
                console.log(`Multer error: ${err.message}`);
                return res.status(400).render('upload', {uploadStatus: 'fail'});
                
            }
            console.log('An unexpected error occurred.');
            return res.status(500).render('upload', {uploadStatus: 'fail'});
            
        }
        if (!req.file){
            console.log('File wasn\'t uploaded.');
            return res.status(400).render('upload', {uploadStatus: 'fail'});

        }
        next();
    });

}

module.exports = {
    FileValidationCheck
}