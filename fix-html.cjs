const fs = require('fs');
const path = require('path');

const viewsDir = path.join(__dirname, 'views');
const files = fs.readdirSync(viewsDir).filter(f => f.endsWith('.html'));

files.forEach(file => {
    const filePath = path.join(viewsDir, file);
    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Replace absolute links with relative ones
    content = content.replace(/http:\/\/localhost\/build\/assets\//g, 'assets/');
    content = content.replace(/http:\/\/localhost\/login/g, 'login.html');
    content = content.replace(/http:\/\/localhost\/register/g, 'register.html');
    content = content.replace(/http:\/\/localhost\/dashboard/g, 'dashboard.html');
    content = content.replace(/http:\/\/localhost"/g, 'index.html"');
    
    fs.writeFileSync(filePath, content);
    console.log('Fixed', file);
});

// Copy assets
const srcAssets = path.join(__dirname, 'public', 'build', 'assets');
const destAssets = path.join(viewsDir, 'assets');

if (!fs.existsSync(destAssets)) {
    fs.mkdirSync(destAssets, { recursive: true });
}

if (fs.existsSync(srcAssets)) {
    const assetFiles = fs.readdirSync(srcAssets);
    assetFiles.forEach(file => {
        fs.copyFileSync(path.join(srcAssets, file), path.join(destAssets, file));
    });
    console.log('Copied assets');
}
