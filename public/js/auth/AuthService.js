export class AuthService {
    static async login(username, password) {
        const response = await fetch('/auth', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username,
                password
            })
        });
        console.log(username, password);
        if (!response.ok){
            console.log('HTTP status:'  + response.status);
        }

        return await response.json();
    }
}