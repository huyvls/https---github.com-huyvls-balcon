export class ChatService {
    constructor() {
        this.chats = [];
    }

    async addChat(name) {
        if (!name) return false;

        try {
            console.log('addChat');
            const userExists = await this.checkUserExists(name);
            if (!userExists) {
                console.error('Пользователь не найден');
                return false;
            }

            const result = await this.createChat({ name });

            return result;

        } catch (error) {
            console.error('Ошибка при проверке пользователя:', error);
            return false;
        }

    }

    async checkUserExists(name) {
        try {
            const response = await fetch('/chatUserExist', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ name })
            });

            if (!response.ok) {
                throw new Error('Ошибка сети');
            }

            const data = await response.json();
            return data.exists;
        }
        catch (error) {
            console.log(error);
            return false;
        }
    }

    async createChat({ name }) {
        const response = await fetch('/createChat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name })
        });


        const result = await response.json();

        if (result.message === true) {
            this.chats.push({ name });
            return result;
        }

        return result;
    }

    async loadChats() {
        const response = await fetch('/getChats');
        this.chats = await response.json();
        return this.chats;
    }

    async deleteChat(index, chat_id) {
        if (index >= 0 && index < this.chats.length) {
            this.chats.splice(index, 1);

            console.log(chat_id);

            const response = await fetch('/deleteChat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ chat_id: chat_id })
            });

            const result = await response.json();

            if (result.message === 'deleted')
                return true;
        }
        return false;
    }

    getChats() {
        return [...this.chats];
    }
}