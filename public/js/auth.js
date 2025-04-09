
document.getElementById('accept').addEventListener('click', () => { 
    const usernameInput = document.getElementById('username');  
    const passwordInput = document.getElementById('password');
    const namevalue = usernameInput.value;
    const passvalue = passwordInput.value;

    fetch('/', {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json', 
        },
        body: JSON.stringify({
            username: namevalue,
            password: passvalue
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
    }else{
        localStorage.setItem('theme', data.theme);
        console.log('Tema:', data.theme);
    }
        
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});


