const express = require('express');
const app = express();
const puppeteer = require('puppeteer');

app.get('/api/formacao-front-end', async (req, res) => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.goto('https://pt.aliexpress.com/item/1005003950006195');

 const pageData = await page.evaluate(() => {
    return {
      title: document.querySelector('.product-title-text').innerText,
      subtitle: document.querySelector('.product-selling-tags').innerHTML,
    };
  });

  await browser.close();

  res.send({
    "title": pageData.title,
    "subtitle": pageData.subtitle
  })
});

app.listen(3000); 