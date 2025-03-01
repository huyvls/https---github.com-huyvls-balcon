
document.getElementById('save').addEventListener('click', () => {
    const emailInput = document.getElementById('email');  
    const usernameInput = document.getElementById('username');  
    const passwordInput = document.getElementById('password');
    const repasswordInput = document.getElementById('repassword');
    const emailvalue = emailInput.value;
    const namevalue = usernameInput.value;
    const passvalue = passwordInput.value;
    const repassvalue = repasswordInput.value;






    
    fetch('/profile', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json', 
        },
        body: JSON.stringify({
            email: emailvalue,
            username: namevalue,
            password: passvalue,
            repassword: repassvalue
        }) 
    })

    .then(response => response.json()) 
    .then(data => {
        console.log('Ответ сервера:', data);
        
        if (data && data.success === false){
            
        let rectangle = document.getElementById('rectangle');
        

        if (!rectangle) {
           
            rectangle = document.createElement('div');
            rectangle.id = 'rectangle';
            rectangle.className = 'rectangle';
            rectangle.textContent = data.message;
            document.body.appendChild(rectangle); 
        }

        if (rectangle) {
        setTimeout(() => {
            rectangle.classList.add('fade-out');
        }, 3000);
    }

        rectangle.classList.remove('fade-out');
        }
        
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});


document.getElementById('theme').addEventListener('change', function ()  {

    const themeValue = this.checked ? 'dark' : 'light';

    fetch('/profile/swapThemeRequest', {
        method: 'POST', 
        headers: {'Content-Type': 'application/json', },
        body: JSON.stringify({theme: themeValue }) 
    })
});

document.addEventListener("DOMContentLoaded", function(){
    
    fetch('/profile/swapThemeRequest',{
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json()) 
    .then(data => {
        
        const themeSwitch = document.getElementById('theme'); 
        if (themeSwitch && data.theme) {
            themeSwitch.checked = (data.theme === 'dark');
        }
    })
    .catch(error => console.log('Ошибка загрузки темы:', error));
});


document.getElementById('theme').addEventListener('change', function ()  {

    const themeValue = this.checked ? 'dark' : 'light';
    
    if (themeValue === 'dark') { 
        document.body.classList.add('dark-theme'); 
    } else {
        document.body.classList.remove('dark-theme'); 
    }
    
});
