<template>
    <section v-if="show_chat">

    <div class="d-none justify-content-between p-3 quote-box">
        <div>
            <p class="mb-0 font-italic overflow-text-dots-one-line reply-txt"></p>
            <div class="reply-img-box">
                <img class="reply-img" />
            </div>
        </div>
        <span class="fa fa-times cross-icon" @click="crossBox" ></span>
    </div>
        <div class="chat-input-holder">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text blue-btn p-0">
                        <span id="upload_button" class="p-0">
                            <label class="m-0">
                                <input class="d-none upload-file" type="file" id="file" ref="file"
                                       v-on:change="handleFileUpload()">
                                <span class="fa fa-paperclip text-white p-2 pl-3 pr-3"></span>
                            </label>
                        </span>
                    </div>
                </div>

                <input type="text" class="chat-input" placeholder="Type a message" name="message" v-model="newMessage"
                       @keyup.enter="sendMessage"></input>
                <input type="submit" value="Send" @click="sendMessage" class="message-send red-btn"/>
            </div>
            <button class="d-none clearChatInput" @click="clearChatInput">clear</button>
        </div>
    </section>
</template>
<script>
export default {
    props: ['company_id', 'user', 'show_chat','quote_msg_id','quote_msg_txt','quote_extension','quote_file_type','quote_file_path'],
    name: 'chatFormComponent',
    data() {
        return {
            newMessage: '',
            file: '',
            url: null,
            ext: '',
            extension: '',
            file_name: '',
            id: '',

        }
    },
    methods: {
        sendMessage() {

            console.log('check quote msg again ', this.quote_msg_id+' '+this.quote_extension + ' '+this.quote_file_type+' '+this.quote_file_path);
            
            this.$emit('messagesent', {
                company_id: this.company_id,
                sender_id: this.user.id,
                user: {
                    id: this.user.id,
                    name: this.user.name,
                    first_name: this.user.id,
                    last_name: this.user.id,
                    avatar: this.user.avatar != 'users/default.png' ?  this.user.avatar : this.$baseUrl + '/public/storage/users/default.png',
                },
                quote: {
                    id: this.quote_msg_id,
                    message: this.quote_msg_txt,
                    file_path: this.quote_file_path,
                    file_type: this.quote_file_type,
                    extension: this.quote_extension,
                },
                message: this.newMessage,

                attachment: this.file,
                file_path: this.url,
                file_ext: this.ext,
                extension: this.extension,
                file_name: this.file_name,
                created_at: moment()
            });
            // console.log(this.file);
            this.newMessage = '';
            this.url = null;
            this.ext = '';
            this.extension = '';
            this.file_name = '';
            this.id = '';
            this.file = '';

        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
            if (this.file != '') {
                this.url = URL.createObjectURL(this.file);
                this.ext = this.file.type.substring(0, this.file.type.indexOf('/'));
                this.extension = this.file.type.substring((this.file.type.indexOf('/') + 1));
                this.file_name = this.file.name;
            }
        },
        clearChatInput() {
            this.$refs.file.value = null;
            this.url = null;
            this.ext = '';
            this.extension = '';
            this.file_name = '';
            this.file = '';
        },
        crossBox(){
            console.log("hello bhai kia masla hai");
            this.$emit('cross-the-box', {feedback:true});
        }


    }
}
</script>
