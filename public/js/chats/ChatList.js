export class ChatList {
    constructor(containerId, chats) {
        this.container = document.getElementById(containerId);
        this.chats = chats;
    }

    render() {
        this.container.innerHTML = '';
        this.chats.forEach((chat, index) => {
            const chatEl = document.createElement('div');
            console.log(chat.name);
            chatEl.className = 'chat-item';
            chatEl.innerHTML = `
            <span>${chat.name}</span>
            <button class="delete-button js-delete-button" data-index="${index}">✖</button>
          `;
            this.container.appendChild(chatEl);
        });
    }

    bindDeleteHandlers(deleteHandler) {
        this.container.querySelectorAll('.js-delete-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const index = e.target.dataset.index;
                deleteHandler(index);
            });
        });
    }

    update(chats) {
        this.chats = chats;
        this.render();
    }
}