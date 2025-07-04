export class AuthView {
    constructor() {
        this.usernameInput = document.getElementById('username');
        this.usernameInput = document.getElementById('password');
        this.acceptButton = document.getElementById('accept');
    }

    getCredentials() {
        return {
            username: this.usernameInput.value,
            password: this.usernameInput.value
        }
    }

    bindLogin(handler) {
        this.acceptButton.addEventListener('click', handler);
    }

    redirectToChat(theme, userId){
        if(userId){
            localStorage.setItem('theme', theme);
            localStorage.setItem('userId', userId);
            window.location.href = '/chat';
        }
    }

}