const fs = require('fs');
const path = require('path');

const viewsDir = __dirname;
const files = fs.readdirSync(viewsDir).filter(f => f.endsWith('.html'));

const scriptToInject = `
<script>
document.addEventListener('DOMContentLoaded', function() {
    const role = localStorage.getItem('role');
    const navLinksContainer = document.querySelector('.hidden.sm\\\\:-my-px.sm\\\\:ms-10.sm\\\\:flex');
    const settingsDropdown = document.querySelector('.hidden.sm\\\\:flex.sm\\\\:items-center.sm\\\\:ms-6');
    const isLoginOrRegister = window.location.pathname.includes('login.html') || window.location.pathname.includes('register.html');

    if (!isLoginOrRegister && role && settingsDropdown) {
        if (role === 'admin') {
            if(navLinksContainer) {
                navLinksContainer.innerHTML = '<a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-white transition duration-150 ease-in-out" href="admin-dashboard.html">Admin Dashboard</a>';
            }
            settingsDropdown.innerHTML = '<span class="text-sm text-[#00FF66] mr-4 font-bold">Admin (Demo)</span><a href="index.html" onclick="localStorage.removeItem(\\'role\\')" class="text-sm bg-red-600 text-white px-4 py-2 rounded font-bold hover:bg-red-500 transition">Logout</a>';
        } else if (role === 'user') {
            if(navLinksContainer) {
                navLinksContainer.innerHTML = '<a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-white transition duration-150 ease-in-out mr-4" href="index.html">Katalog</a><a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-white transition duration-150 ease-in-out mr-4" href="cart.html">Keranjang</a><a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-white transition duration-150 ease-in-out" href="rentals.html">Sewa Saya</a>';
            }
            settingsDropdown.innerHTML = '<span class="text-sm text-gray-300 mr-4 font-semibold">User (Demo)</span><a href="index.html" onclick="localStorage.removeItem(\\'role\\')" class="text-sm bg-red-600 text-white px-4 py-2 rounded font-bold hover:bg-red-500 transition">Logout</a>';
        }
    } else if (!isLoginOrRegister && !role && settingsDropdown) {
        if(navLinksContainer) {
            navLinksContainer.innerHTML = '<a class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-white transition duration-150 ease-in-out" href="index.html">Katalog</a>';
        }
        settingsDropdown.innerHTML = '<a href="login.html" class="text-sm text-gray-300 hover:text-white font-bold mr-4">Log in</a><a href="register.html" class="text-sm bg-[#6600FF] text-white px-4 py-2 rounded font-bold hover:bg-[#5500DD]">Register</a>';
    }
});
</script>
</body>
`;

files.forEach(file => {
    const filePath = path.join(viewsDir, file);
    let content = fs.readFileSync(filePath, 'utf-8');
    
    // Links fixes
    content = content.replace(/http:\/\/localhost\/build\/assets\//g, 'assets/');
    content = content.replace(/http:\/\/localhost\/admin\/products\/create/g, 'admin-products-create.html');
    content = content.replace(/http:\/\/localhost\/admin\/products\/\d+\/edit/g, 'admin-products-edit.html');
    content = content.replace(/http:\/\/localhost\/admin\/products/g, 'admin-products.html');
    content = content.replace(/http:\/\/localhost\/admin\/transactions/g, 'admin-transactions.html');
    content = content.replace(/http:\/\/localhost\/admin\/dashboard/g, 'admin-dashboard.html');
    content = content.replace(/http:\/\/localhost\/cart/g, 'cart.html');
    content = content.replace(/http:\/\/localhost\/checkout/g, 'checkout.html');
    content = content.replace(/http:\/\/localhost\/my-rentals/g, 'rentals.html');
    content = content.replace(/http:\/\/localhost\/login/g, 'login.html');
    content = content.replace(/http:\/\/localhost\/register/g, 'register.html');
    content = content.replace(/http:\/\/localhost\/dashboard/g, 'dashboard.html');
    content = content.replace(/http:\/\/localhost"/g, 'index.html"');

    // Method DELETE workaround since static github pages doesn't support forms
    content = content.replace(/<form[^>]+action="([^"]+)"[^>]*>[\s\S]*?@method\('DELETE'\)[\s\S]*?<\/form>/g, '<button onclick="alert(\\\'Demo: Action disabled\\\')" class="text-red-500 hover:text-red-700">Delete</button>');

    // Make buttons in index.html (welcome) navigate properly based on login dummy
    if (file === 'index.html') {
        content = content.replace(/<div class="flex items-center space-x-6">[\s\S]*?<\/div>/, `<div class="flex items-center space-x-6" id="welcome-nav">
                    <script>
                        const roleWelcome = localStorage.getItem('role');
                        if (roleWelcome === 'admin') {
                            document.write('<a href="admin-dashboard.html" class="text-gray-300 hover:text-white font-medium transition">Admin Dashboard</a><a href="index.html" onclick="localStorage.removeItem(\\'role\\')" class="text-red-400 hover:text-red-300 font-medium transition ml-4">Logout</a>');
                        } else if (roleWelcome === 'user') {
                            document.write('<a href="cart.html" class="text-gray-300 hover:text-[#00FF66] font-medium transition">Keranjang</a><a href="rentals.html" class="text-gray-300 hover:text-[#00FF66] font-medium transition ml-4">Sewa Saya</a><a href="index.html" onclick="localStorage.removeItem(\\'role\\')" class="text-red-400 hover:text-red-300 font-medium transition ml-4">Logout</a>');
                        } else {
                            document.write('<a href="login.html" class="text-gray-300 hover:text-white font-medium transition">Log in</a><a href="register.html" class="bg-[#6600FF] hover:bg-[#5500DD] text-white px-5 py-2 rounded-md font-bold transition shadow-[0_0_15px_rgba(102,0,255,0.4)] ml-4">Register</a>');
                        }
                    </script>
                </div>`);
                
        // Also fix the "Tambah ke Keranjang" and "Login" buttons on products list
        content = content.replace(/<div class="flex justify-between items-center pt-4 border-t border-\[#2A2B3D\]">([\s\S]*?)<\/div>/g, (match, inner) => {
            return `<div class="flex justify-between items-center pt-4 border-t border-[#2A2B3D] product-actions">
                ${inner}
                <script>
                    (function() {
                        const role = localStorage.getItem('role');
                        const scripts = document.querySelectorAll('script');
                        const currentScript = scripts[scripts.length - 1];
                        const container = currentScript.parentElement;
                        
                        if (role === 'user') {
                            container.insertAdjacentHTML('beforeend', '<a href="cart.html" class="bg-[#00FF66] hover:bg-[#00CC52] text-[#0D0D12] p-3 rounded-lg font-bold shadow-[0_0_15px_rgba(0,255,102,0.3)] transition-transform transform hover:scale-105 ml-auto" title="Tambah ke Keranjang"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></a>');
                        } else if (!role) {
                            container.insertAdjacentHTML('beforeend', '<a href="login.html" class="bg-[#2A2B3D] text-gray-300 px-4 py-2 text-sm rounded-lg hover:bg-[#3F4059] transition-colors border border-[#3F4059] ml-auto">Login</a>');
                        }
                    })();
                </script>
            </div>`;
        });
        // Remove the hardcoded Login/cart buttons since we added dynamic script above
        content = content.replace(/<a href="login\.html" class="bg-\[#2A2B3D\][^>]+>Login<\/a>/g, '');
    }

    if (file === 'login.html') {
        content = content.replace(/<button type="submit"[^>]*>[\s\S]*?<\/button>/, '');
        if(!content.includes('Login as Admin (Demo)')) {
            content = content.replace(/<div class="flex items-center justify-between mt-4 border-t border-\[#2A2B3D\] pt-6">/, `<div class="flex flex-col space-y-4 mt-6 border-t border-[#2A2B3D] pt-6">
                <a href="admin-dashboard.html" onclick="localStorage.setItem('role', 'admin')" class="w-full text-center bg-[#6600FF] text-white font-bold py-3 px-6 rounded-md hover:bg-[#5500DD] transition shadow-[0_0_15px_rgba(102,0,255,0.4)]">
                    🚀 Login as Admin (Demo)
                </a>
                <a href="dashboard.html" onclick="localStorage.setItem('role', 'user')" class="w-full text-center bg-[#00FF66] text-[#0D0D12] font-bold py-3 px-6 rounded-md hover:bg-[#00CC52] transition shadow-[0_0_15px_rgba(0,255,102,0.3)]">
                    👤 Login as User (Demo)
                </a>
            </div><div class="hidden">`);
        } else {
             // add onclick to existing buttons
             content = content.replace(/<a href="admin-dashboard.html"/g, `<a href="admin-dashboard.html" onclick="localStorage.setItem('role', 'admin')"`);
             content = content.replace(/<a href="dashboard.html"/g, `<a href="dashboard.html" onclick="localStorage.setItem('role', 'user')"`);
        }
    }

    // Inject dynamic script to handle navbars for all files except welcome
    if (file !== 'index.html' && file !== 'login.html') {
        if (!content.includes('localStorage.getItem(\'role\')')) {
            content = content.replace(/<\/body>/i, scriptToInject);
        }
    }
    
    fs.writeFileSync(filePath, content);
    console.log('Fixed', file);
});
