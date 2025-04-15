const { bot } =require('../utils/bot');
const router = require('express').Router();

router.get('/', (req, res)=>{
    return res.render('report', {reportStatus: null});
})

router.post('/', async (req, res) => {
    const file = req.body.file;
    const result = await bot(file);
    if (result) {
        return res.render('report', {reportStatus: result.statusCode});
    }else{
        return res.render('report', {reportStatus: result.statusCode});
    }
})

module.exports = router