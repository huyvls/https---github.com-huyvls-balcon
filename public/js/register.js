class RegistrationForm {
    constructor() {
      this.formElements = {
        username: document.getElementById('username'),
        password: document.getElementById('password'),
        repassword: document.getElementById('repassword'),
        email: document.getElementById('email'),
        acceptButton: document.getElementById('accept')
      };
  
      this.notification = null;
      this.initEventListeners();
    }
  
    initEventListeners() {
      this.formElements.acceptButton?.addEventListener('click', () => this.handleRegistration());
    }
  
    async handleRegistration() {
      const { username, password, repassword, email } = this.formElements;
      const userData = {
        username: username.value,
        password: password.value,
        repassword: repassword.value,
        email: email.value
      };
  
      console.log('Введённый логин:', userData.username, 'Введенный пароль:', userData.password);
  
      try {
        const response = await fetch('/register', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(userData)
        });
  
        const data = await response.json();
        this.handleResponse(data);
      } catch (error) {
        console.error('Ошибка:', error);
        this.showNotification('Произошла ошибка при регистрации');
      }
    }
  
    handleResponse(data) {
      if (data?.success === false) {
        this.showNotification(data.message, 3000);
      } else if (data?.success === true) {
        window.location.href = '/';
      }
    }
  
    showNotification(message, duration = 3000) {
      if (!this.notification) {
        this.notification = document.createElement('div');
        this.notification.id = 'rectangle';
        this.notification.className = 'rectangle';
        document.body.appendChild(this.notification);
      }
  
      this.notification.textContent = message;
      this.notification.classList.remove('fade-out');
  
      setTimeout(() => {
        this.notification?.classList.add('fade-out');
      }, duration);
    }
  }
  
  // Инициализация при загрузке страницы
  document.addEventListener('DOMContentLoaded', () => {
    new RegistrationForm();
  });