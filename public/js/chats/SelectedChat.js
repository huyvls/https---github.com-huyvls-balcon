export class SelectedChat {
    constructor() {
        this.initElements();
        this.bindEvents();
    }

    initElements() {
        this.elements = {
            chatItems: document.querySelectorAll('.chat-item'),
            chatWindow: document.querySelector('.chat-window'),
            chatTitle: document.querySelector('.chat-title'),
            messageHistory: document.querySelector('.message-history'),
            messageInput: document.querySelector('.message-input textarea'),
            sendButton: document.querySelector('.send-button')
        };
    }

    bindEvents() {
        this.elements.chatItems.forEach(item => {
            item.addEventListener('click', () => this.selectChat(item));
        });
        this.elements.sendButton.addEventListener('click', () => this.sendMessage());
        this.elements.messageInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });
    }

    selectChat(chatElement) {
        const chatId = chatElement.getAttribute('data-chat-id');
        const chatName = chatElement.textContent;


        this.elements.chatWindow.style.display = 'flex';
        this.elements.chatTitle.textContent = chatName;


        this.loadChatHistory(chatId);
    }

    loadChatHistory(chatId) {
        this.elements.messageHistory.innerHTML = '';

        // Временные данные (заменить на реальный API-запрос)
        const mockMessages = [
            { text: 'Привет! Как дела?', sender: 'incoming', time: '12:30' },
            { text: 'Привет! Все отлично, спасибо!', sender: 'outgoing', time: '12:32' },
            { text: 'Что нового?', sender: 'incoming', time: '12:33' }
        ];

        mockMessages.forEach(msg => {
            this.addMessageToHistory(msg.text, msg.sender, msg.time);
        });
    }

    addMessageToHistory(text, sender, time = null) {
        const messageElement = document.createElement('div');
        messageElement.className = `message message-${sender}`;

        if (!time) {
            time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        messageElement.innerHTML = `
          <div class="message-text">${text}</div>
          <div class="message-time">${time}</div>
        `;

        this.elements.messageHistory.appendChild(messageElement);
        this.scrollToBottom();
    }

    sendMessage() {
        const text = this.elements.messageInput.value.trim();

        if (text) {
            // Добавляем сообщение в историю (оптимистичное обновление)
            this.addMessageToHistory(text, 'outgoing');
            this.elements.messageInput.value = '';

            // Здесь будет отправка на сервер
            // this.sendMessageToServer(text);
        }
    }

    scrollToBottom() {
        this.elements.messageHistory.scrollTop = this.elements.messageHistory.scrollHeight;
    }


}