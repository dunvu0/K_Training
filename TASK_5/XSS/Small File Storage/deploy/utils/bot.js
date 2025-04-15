const fs = require('fs');
const puppeteer = require('puppeteer');


const FLAG = fs.readFileSync('/flag', 'utf8').trim();

const sleep = (time) => {
    return new Promise(resolve => {
    setTimeout(resolve, time);
    });
  }

const bot = async (file) => {
    const browser = await puppeteer.launch({
        executablePath: "/usr/bin/google-chrome-stable",
        headless: "new",
        args: ["--no-sandbox", "--disable-gpu"],
    });
    
    try {
        const page = await browser.newPage();
        await page.setCookie({
            name: "FLAG",
            value: FLAG,
            domain: '127.0.0.1',
            path: "/",
        });
            await page.goto('http://127.0.0.1:3000/file/download?file=' + file, {waitUntil: 'networkidle0'});
            await sleep(2 * 1000);

            await page.close();
            await browser.close();
    
            return {
                result: true,
                statusCode: 'success'
            };

    }catch (e){
        console.log(`Bot Error: ${e}`);
        await page.close();
        await browser.close();
        return {
            result: false,
            statusCode: 'fail',
            error: e.toString()
        };
    }
}

module.exports = {
    bot
}