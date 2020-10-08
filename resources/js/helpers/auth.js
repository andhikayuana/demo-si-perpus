
const auth = {

    getToken() {
        return window.localStorage.getItem('api_token');
    },
    saveToken(token) {
        window.localStorage.setItem('api_token', token);
    },
    isLoggedIn() {
        return this.getToken() != undefined;
    },
    getUser() {
        return JSON.parse(window.localStorage.getItem('user'));
    },
    saveUser(user) {
        window.localStorage.setItem('user', JSON.stringify(user));
    },
    clear() {
        window.localStorage.clear();
    }

};

export default auth;