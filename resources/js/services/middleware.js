import Cookie from "js-cookie";

export default {
    auth(to, from, next) {
        const token = Cookie.get('access_token');

        this.post('me', null, data => {
            this.$store.dispatch('user', data);
        }, null, true, true);

        if(!token) {
            next('/login')
        }

        fetch('http://127.0.0.1:8000/api/me', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token,
            }
        })
        .then(response => response.json())
        .then (data => {
            if(!data.name) {
                next('/login')
            }
        })

        next();
    }
}
