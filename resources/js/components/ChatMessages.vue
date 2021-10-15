<script src="../../../../SSG/assets/js/scripts.js"></script>
<template>
    <ul class="chat-messages" v-chat-scroll>
        <template v-for="message in messages" v-if="show_chat">
            <template v-if="company_id == message.company_id">
                <li class="message-box-holder" v-if="auth_id == message.sender_id ">
                    <div class="message-reciever">
                        <span class="time">{{ time(message.created_at) }}</span>
                        <a href="#" class="font-500"> {{ message.user.name }}</a>
                    </div>
                    <div class="message-box">
                        
                        <div v-if="message.quote != null && message.quote.id != 0" class="font-italic pb-2 mb-2 quoted-message-outer" style="border-bottom: 1px solid #000">
                            <div v-if="message.quote.file_type == 'image'" :data-src="message.quote.file_path"
                             class="d-block message-box-link">
                            <img v-if="message.quote.file_type == 'image'" :src="message.quote.file_path"
                                 class="mb-1 pb-1 border-bottom msg-img-box">
                            </div>

                            <p class="mb-1 pb-2 border-bottom" v-if="message.quote.file_type == 'application'">
                                <img v-if="message.quote.extension == 'pdf'"
                                        :src="'public/assets/front_site/images/file_icons/pdficon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet'"
                                        :src="'public/assets/front_site/images/file_icons/excelicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'vnd.openxmlformats-officedocument.wordprocessingml.document'"
                                        :src="'public/assets/front_site/images/file_icons/wordicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'vnd.openxmlformats-officedocument.presentationml.presentation'"
                                        :src="'public/assets/front_site/images/file_icons/ppicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'x-zip-compressed'"
                                        :src="'public/assets/front_site/images/file_icons/zipicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else
                                        :src="'public/assets/front_site/images/file_icons/fileicon.ico'"
                                        class="mb-1 file-icon">
                                {{ message.quote.file_path }}
                            </p>

                            <div v-if="message.quote.file_type == 'text'" class="d-block msg-attachment" >
                                <p class="mb-1 pb-2 border-bottom">
                                    <img v-if="message.quote.file_type == 'text'"
                                        :src="'public/assets/front_site/images/file_icons/txticon.png'"
                                        class="mb-1 file-icon">
                                    {{ message.quote.file_path }}
                                </p>
                            </div>
                            <div v-if="message.quote.file_type == 'audio'" class="d-block audio-msg">
                                <audio controls v-if="message.quote.file_type == 'audio'"
                                    class="mb-1 pb-1 border-bottom audio-msg-player">
                                    <source :src="message.quote.file_path" :type="'audio/'+message.quote.extension">
                                </audio>
                            </div>
                            <div v-if="message.quote.file_type == 'video'" class="d-block video-msg">
                                <video controls v-if="message.quote.file_type == 'video'"
                                    class="mb-1 pb-1 border-bottom video-msg-player">
                                    <source :src="message.quote.file_path" :type="'video/'+message.quote.extension">
                                </video>
                            </div>


                        
                            <p class="mb-0 quoted-message" v-if="message.quote.message">" {{message.quote.message}} "</p>
                        </div>

                        <div class="chat-dots-dropdown">
                            <ul class="m-0">
                                <li>
                                    <a href="#" class="quote-message" @click="setQuoteMessageId(message.id, message.message, message.file_path, message.file_ext, message.extension)">Quote this message</a>
                                </li>
                            </ul>
                        </div>
                        <span class="fas fa-ellipsis-v chat-dots"></span>
                        <div v-if="message.file_ext == 'image'" :data-src="message.file_path"
                             class="d-block message-box-link">
                            <img v-if="message.file_ext == 'image'" :src="message.file_path"
                                 class="mb-1 pb-1 border-bottom msg-img-box">
                        </div>
                        <div v-if="message.file_ext == 'application'" class="d-block msg-attachment" :data-msgid="message.id">
                            <p class="mb-1 pb-2 border-bottom">
                                <img v-if="message.extension == 'pdf'"
                                     :src="'public/assets/front_site/images/file_icons/pdficon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet'"
                                     :src="'public/assets/front_site/images/file_icons/excelicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.wordprocessingml.document'"
                                     :src="'public/assets/front_site/images/file_icons/wordicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.presentationml.presentation'"
                                     :src="'public/assets/front_site/images/file_icons/ppicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'x-zip-compressed'"
                                     :src="'public/assets/front_site/images/file_icons/zipicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else
                                     :src="'public/assets/front_site/images/file_icons/fileicon.ico'"
                                     class="mb-1 file-icon">
                                {{ message.file_name }}
                            </p>
                        </div>
                        <div v-if="message.file_ext == 'text'" class="d-block msg-attachment" :data-msgid="message.id">
                            <p class="mb-1 pb-2 border-bottom">
                                <img v-if="message.file_ext == 'text'"
                                     :src="'public/assets/front_site/images/file_icons/txticon.png'"
                                     class="mb-1 file-icon">
                                {{ message.file_name }}
                            </p>
                        </div>
                        <div v-if="message.file_ext == 'audio'" class="d-block audio-msg">
                            <audio controls v-if="message.file_ext == 'audio'"
                                   class="mb-1 pb-1 border-bottom audio-msg-player">
                                <source :src="message.file_path" :type="'audio/'+message.extension">
                            </audio>
                        </div>
                        <div v-if="message.file_ext == 'video'" class="d-block video-msg">
                            <video controls v-if="message.file_ext == 'video'"
                                   class="mb-1 pb-1 border-bottom video-msg-player">
                                <source :src="message.file_path" :type="'video/'+message.extension">
                            </video>
                        </div>
                        <p class="my-2 message-box-text" :data-msgid="message.id">{{ message.message }}</p>
                    </div>
                    <span class="my-img-container">
                        <img :src="message.user.avatar">
                    </span>
                </li>
                <li class="message-box-holder" v-else>
                    <span class="group-img-container">
                        <img :src="message.user.avatar">
                    </span>
                    <div class="message-sender">
                        <a href="#">{{ message.user.name }}, </a>
                        <span class="time">{{ time(message.created_at) }}</span>
                    </div>
                    <div class="message-box message-partner">

                        <div v-if="message.quote != null && message.quote.id != 0" class="font-italic pb-2 mb-2 quoted-message-outer" style="border-bottom: 1px solid #000">
                            <div v-if="message.quote.file_type == 'image'" :data-src="message.quote.file_path"
                             class="d-block message-box-link">
                            <img v-if="message.quote.file_type == 'image'" :src="message.quote.file_path"
                                 class="mb-1 pb-1 border-bottom msg-img-box">
                            </div>

                            <p class="mb-1 pb-2 border-bottom" v-if="message.quote.file_type == 'application'">
                                <img v-if="message.quote.extension == 'pdf'"
                                        :src="'public/assets/front_site/images/file_icons/pdficon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet'"
                                        :src="'public/assets/front_site/images/file_icons/excelicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'vnd.openxmlformats-officedocument.wordprocessingml.document'"
                                        :src="'public/assets/front_site/images/file_icons/wordicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'vnd.openxmlformats-officedocument.presentationml.presentation'"
                                        :src="'public/assets/front_site/images/file_icons/ppicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else-if="message.quote.extension  == 'x-zip-compressed'"
                                        :src="'public/assets/front_site/images/file_icons/zipicon.png'"
                                        class="mb-1 file-icon">
                                <img v-else
                                        :src="'public/assets/front_site/images/file_icons/fileicon.ico'"
                                        class="mb-1 file-icon">
                                {{ message.quote.file_path }}
                            </p>

                            <div v-if="message.quote.file_type == 'text'" class="d-block msg-attachment" >
                                <p class="mb-1 pb-2 border-bottom">
                                    <img v-if="message.quote.file_type == 'text'"
                                        :src="'public/assets/front_site/images/file_icons/txticon.png'"
                                        class="mb-1 file-icon">
                                    {{ message.quote.file_path }}
                                </p>
                            </div>
                            <div v-if="message.quote.file_type == 'audio'" class="d-block audio-msg">
                                <audio controls v-if="message.quote.file_type == 'audio'"
                                    class="mb-1 pb-1 border-bottom audio-msg-player">
                                    <source :src="message.quote.file_path" :type="'audio/'+message.quote.extension">
                                </audio>
                            </div>
                            <div v-if="message.quote.file_type == 'video'" class="d-block video-msg">
                                <video controls v-if="message.quote.file_type == 'video'"
                                    class="mb-1 pb-1 border-bottom video-msg-player">
                                    <source :src="message.quote.file_path" :type="'video/'+message.quote.extension">
                                </video>
                            </div>


                        
                            <p class="mb-0 quoted-message" v-if="message.quote.message">" {{message.quote.message}} "</p>
                        </div>


                        <div class="chat-dots-dropdown">
                            <ul class="m-0">
                                <li>
                                    <a href="#" class="quote-message" @click="setQuoteMessageId(message.id, message.message, message.file_path, message.file_ext, message.extension)">Quote this message</a>
                                </li>
                            </ul>
                        </div>
                        <span class="fas fa-ellipsis-v chat-dots"></span>
                        <div v-if="message.file_ext == 'image'" :data-src="message.file_path"
                             class="d-block message-box-link">
                            <img v-if="message.file_ext == 'image'" :src="message.file_path"
                                 class="mb-1 pb-1 border-bottom">
                        </div>
                        <div v-if="message.file_ext == 'application'" class="d-block msg-attachment" :data-msgid="message.id">
                            <p class="mb-1 pb-2 border-bottom">
                                <img v-if="message.extension == 'pdf'"
                                     :src="'public/assets/front_site/images/file_icons/pdficon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet'"
                                     :src="'public/assets/front_site/images/file_icons/excelicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.wordprocessingml.document'"
                                     :src="'public/assets/front_site/images/file_icons/wordicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'vnd.openxmlformats-officedocument.presentationml.presentation'"
                                     :src="'public/assets/front_site/images/file_icons/ppicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else-if="message.extension == 'x-zip-compressed'"
                                     :src="'public/assets/front_site/images/file_icons/zipicon.png'"
                                     class="mb-1 file-icon">
                                <img v-else
                                     :src="'public/assets/front_site/images/file_icons/fileicon.ico'"
                                     class="mb-1 file-icon">
                                {{ message.file_name }}
                            </p>
                        </div>
                        <div v-if="message.file_ext == 'text'" class="d-block msg-attachment" :data-msgid="message.id">
                            <p class="mb-1 pb-2 border-bottom">
                                <img v-if="message.file_ext == 'text'"
                                     :src="'public/assets/front_site/images/file_icons/txticon.png'"
                                     class="mb-1 file-icon">
                                {{ message.file_name }}
                            </p>
                        </div>
                        <div v-if="message.file_ext == 'audio'" class="d-block audio-msg">
                            <audio controls v-if="message.file_ext == 'audio'"
                                   class="mb-1 pb-1 border-bottom audio-msg-player">
                                <source :src="message.file_path" :type="'audio/'+message.extension">
                            </audio>
                        </div>
                        <div v-if="message.file_ext == 'video'" class="d-block video-msg">
                            <video controls v-if="message.file_ext == 'video'"
                                   class="mb-1 pb-1 border-bottom video-msg-player">
                                <source :src="message.file_path" :type="'video/'+message.extension">
                            </video>
                        </div>
                        <p class="my-2 message-box-text" :data-msgid="message.id">{{ message.message }}</p>
                    </div>
                </li>
            </template>
        </template>
    </ul>
</template>
<script>
export default {
    props: ['messages', 'auth_id', 'show_chat', 'baseUrl', 'company_id', 'file_ext', 'file_path', 'extension'],
    methods: {
        checkTrue(message) {
            // console.log(message)
            if ((message.to == this.auth_id && message.user.id == this.send_message_to) || (message.user.id == this.auth_id && message.to == this.send_message_to)) {
                return true;
            } else if ((message.send == this.auth_id && message.user.id == this.send_message_to) || (message.user.id == this.auth_id && message.send == this.send_message_to)) {
                return true;
            } else {
                return false;
            }
        },
        time(time) {
            return moment(time).format("D MMM YY, hh:mma");
            // return time;
        },
        setQuoteMessageId(id, text, file_path, file_type, extension){
				console.log('hello', id+" "+text);
    			// this.active_user_id = user.id;
				// user.message_status = false;
    			this.$emit('fetch-quote-msg-id' , {
    				'id' : id,
                    'message': text,
                    'file_path' : file_path,
                    'file_type' : file_type,
                    'extension' : extension
    			});
				// this.quote_msg_id= id;

                // console.log("quote msg id", this.quote_msg_id);
    		},
    },
};
</script>
