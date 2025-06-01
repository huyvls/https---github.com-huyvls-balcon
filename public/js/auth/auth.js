

document.addEventListener('DOMContentLoaded', () => {
    const acceptButton = document.getElementById('accept');
    if (!acceptButton) return;

    acceptButton.addEventListener('click', handleLogin);
});

async function handleLogin() {
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');

    if (!usernameInput || !passwordInput) {
        showError('Форма не найдена');
        return;
    }

    const username = usernameInput.value.trim();
    const password = passwordInput.value;

    if (!username || !password) {
        showError('Пожалуйста, заполните все поля');
        return;
    }

    try {
        const response =  await fetch('/auth', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username,
                password
            })
        });

        if (!response.ok) {
            throw new Error('HTTP error! status: ' + response.status);
        }

        const data =  await response.json();

        if (data.success === false) {
            showError(data.message || 'Неверные учетные данные');
        } else {
            console.log("nubla");
            console.log(data.theme);
            handleSuccess(data);
        }
    } catch (error) {
        console.error('Ошибка:', error);
        showError('Произошла ошибка при отправке данных');
    }
}

function showError(message) {

    console.log('Attempting to show error:', message);
    let errorBox = document.getElementById('error-box');


    if (!errorBox) {
        errorBox = document.createElement('div');
        errorBox.id = 'error-box';
        errorBox.className = 'rectangle';
        document.body.appendChild(errorBox);
    }


    errorBox.textContent = message;
    errorBox.classList.remove('fade-out');


    setTimeout(() => {
        errorBox.classList.add('fade-out');
    }, 3000);
}

function handleSuccess(data) {
    if (data.theme) {
        localStorage.setItem('theme', data.theme);
        console.log('Тема установлена:', data.theme);
        window.location.href = '/chat';
    }
}