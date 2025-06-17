class ProfileManager {
    constructor() {
        this.initElements();
        this.initEventListeners();
        this.loadTheme();
    }

    initElements() {
        this.saveButton = document.getElementById('save');
        this.emailInput = document.getElementById('email');
        this.usernameInput = document.getElementById('username');
        this.passwordInput = document.getElementById('password');
        this.repasswordInput = document.getElementById('repassword');
        this.wrapperInput = document.getElementById('cb5');
        this.themeSwitch = document.getElementById('theme');
        this.notification = null;
    }

    initEventListeners() {
        if (this.saveButton) {
            this.saveButton.addEventListener('click', () => this.handleSave());
        }

        if (this.themeSwitch) {
            this.themeSwitch.addEventListener('change', () => this.handleThemeChange());
        }
    }

    async handleSave() {
        if (!this.wrapperInput.checked) {
            this.showErrorMessage('Проверь еще раз');
            return;
        }

        try {
            const response = await fetch('/editRequest', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: this.emailInput.value,
                    username: this.usernameInput.value,
                    password: this.passwordInput.value,
                    repassword: this.repasswordInput.value
                })
            });

            const data = await response.json();
            if (data) {
                this.showErrorMessage(data.message);
            }
        } catch (error) {
            console.error('Ошибка:', error);
            this.showErrorMessage('Произошла ошибка');
        }
    }

    async handleThemeChange() {
        const themeValue = this.themeSwitch.checked ? 'dark' : 'light';

        
        if (themeValue === 'dark') {
            document.body.classList.add('dark-theme');
            localStorage.setItem('theme', 'dark');
        } else {
            document.body.classList.remove('dark-theme');
            localStorage.removeItem('theme');
        }

        
        try {
            await fetch('/profile/swapThemeRequest', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ theme: themeValue })
            });
        } catch (error) {
            console.error('Ошибка сохранения темы:', error);
        }
    }

    async loadTheme() {
        try {
            const response = await fetch('/profile/getThemeRequest', {
                method: 'GET',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await response.json();
            if (data?.theme && this.themeSwitch) {
                this.themeSwitch.checked = (data.theme === 'dark');
                if (data.theme === 'dark') {
                    document.body.classList.add('dark-theme');
                }
            }
        } catch (error) {
            console.error('Ошибка загрузки темы:', error);
        }
    }

    showErrorMessage(message) {
        if (!this.notification) {
            this.notification = document.createElement('div');
            this.notification.id = 'rectangle';
            this.notification.className = 'rectangle';
            document.body.appendChild(this.notification);
        }

        this.notification.textContent = message;
        this.notification.classList.remove('fade-out');

        setTimeout(() => {
            this.notification.classList.add('fade-out');
        }, 3000);
    }
}


document.addEventListener('DOMContentLoaded', () => {
    new ProfileManager();
});