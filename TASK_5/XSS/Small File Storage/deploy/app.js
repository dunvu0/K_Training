const express =require('express');
const app = express();
const fs = require('fs');
const path = require('path');
const routeFile = require('./routes/file');
const routeReport = require('./routes/report');

app.use(express.static(path.join(__dirname, 'static')));
app.use(express.urlencoded({ extended: false }));
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));
app.use('/file', routeFile);
app.use('/report', routeReport);

app.get('/', (req, res)=>{
  res.redirect('/file/upload');
}) 

  app.listen(3000, () => {
    console.log('Server is running on port 3000');
})