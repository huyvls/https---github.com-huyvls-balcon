export class ErrorHandler {
    constructor() {
        this.errorBox = null;
    }

    show(message) {
        console.log('Ошибка:', message);
        if (!this.errorBox) {
            this.errorBox = document.createElement('div');
            this.errorBox.id = 'error-box';
            this.errorBox.className = 'rectangle';
            document.body.appendChild(this.errorBox);
        }

        this.errorBox.textContent = message;
        this.errorBox.classList.remove('fade-out');

        setTimeout(() => {
            this.errorBox.classList.add('fade-out');
        }, 3000);

    }
}