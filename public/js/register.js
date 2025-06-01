document.getElementById('accept').addEventListener('click', () => {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const repasswordInput = document.getElementById('repassword');
    const emailInput = document.getElementById('email');
    const namevalue = usernameInput.value;
    const passvalue = passwordInput.value;
    const repassvalue = repasswordInput.value;
    const emailvalue = emailInput.value;

    console.log('Введённый логин:', namevalue, 'Введенный пароль: ', passvalue);


    fetch('/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            username: namevalue,
            password: passvalue,
            repassword: repassvalue,
            email: emailvalue
        })
    })

        .then(response => response.json())
        .then(data => {

            if (data && data.success === false) {

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
            else if (data && data.success === true) {
                window.location.href = '/';
            }

        })
        .catch(error => {
            console.error('Ошибка:', error);
        });
});


