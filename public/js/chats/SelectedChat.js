export class SelectedChat {
    constructor() {
        this.initElements();
        this.bindEvents();
        this.socket = null;
        this.currentChatId = null;

        window.addEventListener('beforeunload', () => {
            if (this.socket) this.socket.close();
        });
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
        const chatId = chatElement.dataset.chatId;

        const chatName = chatElement.textContent;

        this.elements.chatWindow.style.display = 'flex';
        this.elements.chatTitle.textContent = chatName;

        this.loadChatHistory(chatId);

        this.connectToWebSocket(chatId);
    }

    async loadChatHistory(chatId) {
        this.elements.messageHistory.innerHTML = '';

        const response = await fetch('/openChat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ chatId })
        });

        const result = await response.json();

        result.forEach(msg => {
            this.addMessageToHistory(msg.text, msg.sender, msg.time);
        });
    }

    addMessageToHistory(text, sender, time = null) {
        const messageElement = document.createElement('div');

        const isCurrentUser = sender === Number(localStorage.getItem('userId'));

        const senderClass = isCurrentUser ? 'outgoing' : `incoming`;

        messageElement.className = `message message-${senderClass}`;

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
            
            this.elements.messageInput.value = '';

           
             this.sendMessageToServer(text);
        }
    }

    scrollToBottom() {
        this.elements.messageHistory.scrollTop = this.elements.messageHistory.scrollHeight;
    }

    connectToWebSocket(chatId) {
        if (this.socket) {
            this.socket.close();
        }

        this.socket = new WebSocket(`ws://localhost:8080?chatId=${chatId}`);
        this.currentChatId = chatId;

        this.socket.onopen = () => {
           // console.log(`WebSocket подключён к чату ${chatId}`);
        };

        this.socket.onmessage = (event) => {
            const data = JSON.parse(event.data);
            this.addMessageToHistory(data.text, data.sender, data.time);
        };

        this.socket.onerror = (err) => {
            console.error('WebSocket ошибка:', err);
        };

        this.socket.onclose = () => {
         //   console.log(` WebSocket отключён от чата ${chatId}`);
        };
    }

    sendMessageToServer(text) {
        if (!this.socket || this.socket.readyState !== WebSocket.OPEN) {
            console.warn('WebSocket не подключён');
            return;
        }
    
        const message = {
            text: text,
            sender: Number(localStorage.getItem('userId')),
            time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }),
            chatId: this.currentChatId
        };
    
        this.socket.send(JSON.stringify(message));
    }
}