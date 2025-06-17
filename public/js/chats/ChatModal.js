export class ChatModal {
    constructor(modalId, inputId) {
        this.modal = document.getElementById(modalId);
        this.input = document.getElementById(inputId);
    }

    open() {
        this.modal.style.display = 'flex';
        this.input.value = '';
        this.input.focus();
    }

    close() {
        this.modal.style.display = 'none';
    }

    getInputValue() {
        return this.input.value.trim();
    }
}