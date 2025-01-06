document.getElementById('accept').addEventListener('click', () => {
    const usernameInput = document.getElementById('username');  
    const passwordInput = document.getElementById('password');
    const namevalue = usernameInput.value;
    const passvalue = passwordInput.value;

    console.log('Введённый логин:', namevalue, 'Введенный пароль: ', passvalue); 

    // Отправка данных на сервер через fetch
    fetch('/', {
        method: 'POST', // Используем метод POST
        headers: {
            'Content-Type': 'application/json', // Указываем, что отправляем JSON
        },
        body: JSON.stringify({
            username: namevalue,
            password: passvalue
        }) // Преобразуем объект в JSON
    })

    .then(response => response.json()) // Обрабатываем ответ сервера
    .then(data => {
        console.log('Ответ сервера:', data);
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
});
