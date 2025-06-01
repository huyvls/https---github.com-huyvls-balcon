import { AuthView } from "/js/auth/AuthView.js";
import { ErrorHandler } from "/js/auth/ErrorHandler.js";
import { AuthService } from "/js/auth/AuthService.js";

export class AuthController {
    constructor() {
        this.view = new AuthView();
        this.errorHandler = new ErrorHandler();
        this.init();
    }

    init() {
        this.view.bindLogin(() => this.handleLogin());
    }

    async handleLogin() {
        const { username, password } = this.view.getCredentials();

        if (!username || !password) {
            this.errorHandler.show('Необходимо заполнить все поля');
            return;
        }

        try {
            const data = await AuthService.login(username, password);

            if (data.success === false) {
                this.errorHandler.show(data.message || 'Неверные учетные данные');
            } else {
                this.view.redirectToChat(data.theme);
            }
        } catch (error) {
            this.errorHandler.show('Ошибка при подключении к серверу');
            console.error('Login error:', error);
        }
    }
}