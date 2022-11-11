const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch({
    headless: false,
    devtools: false,
    defaultViewport: null,
    ignoreHTTPSErrors: true,
    args: [
        '--start-maximized'
        // '--window-size=1920,1040',
        // '--no-sandbox'
    ]
  });

    var page = await browser.newPage();
    await page.goto('http://localhost/sj-solutions/concard/');

    // register page auto testing
    setTimeout(async() => {
        var page = await browser.newPage();
        await page.goto('http://localhost/sj-solutions/concard/register');
    
        var nameField = await page.$("#name");
        var username = Math.random().toString(36).substring(2, 11);
        await nameField.type(username);
        
        var nameField = await page.$("#email");
        var email = username + '@gmail.com';
        await nameField.type(email);
    
        var nameField = await page.$("#password");
        await nameField.type("123456789");
    
        var nameField = await page.$("#password-confirm");
        await nameField.type("123456789");
    
        var btn = await page.$("#register-btn");
        await btn.click();
    }, 200);

    // login page auto testing
    setTimeout(async() => {
        var page = await browser.newPage();
        await page.goto('http://localhost/sj-solutions/concard/login');
    
        var nameField = await page.$("#email");
        await nameField.type("raza1234@gmail.com");
    
        var nameField = await page.$("#password");
        await nameField.type("123456789");
    
        var checkbox = await page.$("#remember");
        await checkbox.click();
    
        var btn = await page.$("#login-btn");
        await btn.click();
    }, 5000);

    
  await page.waitForNavigation()
  await page.waitForTimeout(2000);

})();
