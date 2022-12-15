<script>
import Cookie from "js-cookie";
import AppendToast from "./appendToast.vue";
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
    data() {
        return{
            language: ''
        }
    },
    created() {
        this.language = Cookie.get("language") ?? navigator.language;

        axios.defaults.baseURL = `/api/`;
        axios.defaults.headers = {
            "Authorization" : "Bearer " + Cookie.get("access_token"),
            "Accept" : "application/json",
            "Accept-Language" : this.language
        };
    },
    methods: {

        del(url, callback, errorHandler, hideSuccessMessage) {
            axios.delete(url)
            .then(data => {
                if(!hideSuccessMessage) this.showToast(data.data.message, "success");
                callback(data.data);
            })
            .catch(error => {
                if(error.response.status == 401 && this.$route.name != 'login') this.$router.push('/login');

                if(!hideSuccessMessage) this.showErrors(error.response.data)
                if(errorHandler) errorHandler(error.response.data)
            })
        },

        post(url,payload, callback, errorHandler, hideSuccessMessage, hideErrorMessage) {
            axios.post(url, payload)
                .then(data => {
                    if(!hideSuccessMessage) this.showToast(data.data.message, "success");
                    callback(data.data)
                })
                .catch(error => {
                    if(error.response.status == 401 && this.$route.name != 'login') this.$router.push('/login');

                    if(!hideErrorMessage) this.showErrors(error.response.data);
                    if(errorHandler) errorHandler(error.response.data);
                })
        },

        patch(url,payload, callback, errorHandler, hideSuccessMessage) {
            axios.patch(url, payload)
                .then(data => {
                    if(!hideSuccessMessage) this.showToast(data.data.message, "success");
                    callback(data.data)
                })
                .catch(error => {
                    if(error.response.status == 401 && this.$route.name != 'login') this.$router.push('/login');

                    errorHandler ?
                        errorHandler(error.response.data) :
                        this.showErrors(error.response.data);
                })
        },

        put(url,payload, callback, errorHandler) {
            axios.put(url, payload)
                .then(data => {
                    this.showToast(data.data.message, "success");
                    callback(data.data)
                })
                .catch(error => {
                    if(error.response.status == 401 && this.$route.name != 'login') this.$router.push('/login');

                    errorHandler ?
                        errorHandler(error.response.data) :
                        this.showErrors(error.response.data);
                })
        },

        get(url, callback, errorHandler, hideSuccessMessage) {
            axios.get(url)
            .then(data => {
                if(data.status == 200) {
                    callback(data.data);
                    if(!hideSuccessMessage) this.showToast(data.data.message, "success");
                } else {
                    errorHandler ?
                        errorHandler(error.response.data) :
                        this.showErrors(error.response.data);
                }
            })
        },


        showErrors(data) {
            if(data.error) {
                this.showToast(data.error, "danger", 'exclamation-triangle-fill');
            }
            if(data.message) {
                this.showToast(data.message, "danger", 'exclamation-triangle-fill');
            }
            if(data.errors) {
                this.displayErrors(data.errors);
            }
        },

        changeLanguage(language) {
            Cookie.set('language', language);
            window.location.reload()
        }
    },

    computed: {
        ...mapGetters(['access_token'])
    },

    mixins: [AppendToast]
}
</script>
