/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-chat-scroll'))

window.moment = require('moment');


Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$baseUrl = document.querySelector("meta[name='base-url']").getAttribute('content');
Vue.prototype.$appUrl = document.querySelector("meta[name='app-url']").getAttribute('content');
Vue.prototype.$company = document.querySelector("meta[name='company']").getAttribute('content');
// Vue.prototype.$profileId = document.querySelector("meta[name='profile-id']").getAttribute('content');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        users: [],
        actualUsers: [],
        company_id: 0,
        current_user: {},
        auth_id: 0,
        show_chat: true,
        active_company: this.$company,
        active_user_id: 0,
        quote_msg_id: 0,
        quote_msg_txt: "",
        quote_file_path: "",
        quote_file_type: "",
        quote_extension:"",
        received_from: 0,
        notifications: [],
        total_notifications: 0,
        audio: '',
        baseUrl: '',
        newsearch: '',
        user: '',
        file_ext: '',
        extension: '',
        file_name: '',
        id: 0,
    },

    created() {
        this.fetchMessages();


        Echo.private('chat')
            .listen('MessageSent', (e) => {
                console.log("listening",e);

                this.messages.push({
                    // id: e.message.id,
                    company_id: e.message.company_id,
                    sender_id: e.message.sender_id,
                    file_path: this.$baseUrl + '/public/storage/' + e.message.file_path,
                    file_ext: e.message.file_type,
                    extension: e.message.extension,
                    file_name: e.message.file_name,
                    created_at: e.message.created_at,
                    updated_at: e.message.updated_at,
                    message: e.message.message,
                    id: e.message.id,
                    user: {
                        id: e.user.id,
                        name: e.user.name,
                        first_name: e.user.first_name,
                        last_name: e.user.last_name,
                        avatar: e.user.avatar != 'users/default.png' ?  e.user.avatar : this.$baseUrl + '/public/storage/users/default.png',
                    },
                    quote: e.quoted_message? {
                        id: e.quoted_message.id,
                        message: e.quoted_message.message,
                        file_path: this.$baseUrl + '/public/storage/' + e.quoted_message.file_path,
                        file_type: e.quoted_message.file_type,
                        extension: e.quoted_message.extention,
                     }: null,

                });


                axios.get(this.$baseUrl + '/group-chat').then(response => {
                    console.log('done');
                });

            });
    },


    methods: {
        fetchMessages() {
            axios.get(this.$baseUrl + '/fetch-messages').then(response => {
                this.messages = response.data;
                // console.log(this.messages);
            });

        },
        fetchMessagesForUser(id){
            console.log('hello from the app.js file',id);
            this.quote_msg_id = id.id;
            this.quote_msg_txt = id.message;
            this.quote_file_path = id.file_path;
            this.quote_file_type = id.file_type;
            this.quote_extension = id.extension;

            
            
        },
        emptyBox(source){
            console.log('bhai' , source);
            if(source.feedback == true){
                this.quote_msg_id = 0;
                this.quote_msg_txt = '';
                this.quote_file_path = '';
                this.quote_file_type = '';
                this.quote_extension = '';
            }
            
        },
        addMessage(message, company_id) {
            console.log(message);
            if (message.message !== '' || message.attachment !== '') {
                let formData = new FormData();
                formData.append('attachment', message.attachment);
                formData.append('message', message.message);
                formData.append('quote_msg_id', this.quote_msg_id);
                formData.append('company_id', message.company_id);
                formData.append('file_type', message.file_ext);
                formData.append('extension', message.extension);
                formData.append('file_name', message.file_name);
                axios.post(this.$baseUrl + '/send-message', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    message.id = response.data.id;
                    this.messages.push(message);
                    
                });
            }
            this.quote_msg_id = 0;
            this.quote_msg_txt = '';
            this.quote_file_path = '';
            this.quote_file_type = '';
            this.quote_extension = '';
        },
        

    }
});
