import { ChatList } from './ChatList.js';
import { ChatModal } from './ChatModal.js';
import { ChatService } from './ChatService.js';
import { SelectedChat } from './SelectedChat.js'
import { ErrorHandler } from '../ErrorHandler.js';

export class Main {
    constructor() {
        this.chatService = new ChatService();
        this.chatList = new ChatList('chatList');
        this.chatModal = new ChatModal('newChatModal', 'chatNameInput');
        this.errorHandler = new ErrorHandler();
        this.selectedChat = new SelectedChat();

        this.initElements();
        this.initEventListeners();
        this.loadInitialChats();

    }

    initElements() {
        this.elements = {
            addButton: document.querySelector('.js-add-button'),
            createNewLink: document.querySelector('.js-create-new'),
            cancelButton: document.querySelector('.js-cancel-button'),
            createButton: document.querySelector('.js-create-button')
        };
    }

    initEventListeners() {
        this.elements.addButton?.addEventListener('click', () => this.chatModal.open());
        this.elements.createNewLink?.addEventListener('click', () => this.chatModal.open());
        this.elements.cancelButton?.addEventListener('click', () => this.chatModal.close());
        this.elements.createButton?.addEventListener('click', () => this.handleCreate());
    }

    async loadInitialChats() {
        try {
            const chats = await this.chatService.loadChats();
            this.render(chats);
            return chats;
        } catch (error) {
            this.showError('Ошибка загрузки чатов');
            console.log(error);
        }
    }

    async handleCreate() {
        const name = this.chatModal.getInputValue();
        if (!name) {
            this.showError('Введите имя пользователя');
            return;
        }

        try {
            const result = await this.chatService.addChat(name);
            console.log(result.message);
            if (result.message === true) {
                this.render(this.chatService.getChats());
                this.chatModal.close();
            }
            else if (result.message.includes("Duplicate entry") && result.message.includes("uk_user_pair")) {
                this.showError('Чат уже существует');
            }
            else {
                this.showError('Не удалось создать чат');
            }
        } catch (error) {
            this.showError('Ошибка сервера');
            console.error(error);
        }
    }

    async handleDelete(index) {

        try {
            const currentChats = await this.chatService.loadChats();

            if (confirm('Удалить этот чат?')) {
                await this.chatService.deleteChat(index, currentChats[index].Chat_connections.chat_id);
                this.render(this.chatService.getChats());
            }

        } catch (error) {
            console.error('Ошибка в handleDelete:', error);
            alert('Ошибка при удалении чата' + error);
        }
    }

    showError(message) {
        this.errorHandler.show(message);
    }

    render(chats) {
        this.chatList.update(chats);
        this.chatList.bindDeleteHandlers((index) => this.handleDelete(index));
        
        // Обновляем ссылки на новые .chat-item и биндим события
        this.selectedChat.initElements();
        this.selectedChat.bindEvents();
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Main();
});