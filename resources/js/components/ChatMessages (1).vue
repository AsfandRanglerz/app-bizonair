<script src="../../../../SSG/assets/js/scripts.js"></script>
<template>
    <ul class="chat-messages" v-chat-scroll>
        <template v-for="message in messages" v-if="show_chat">
            <template>
                <li class="message-box-holder" v-if="auth_id == message.sender_id ">
                    <div class="message-reciever">
                        <span class="time">{{ time(message.created_at) }}</span>
                        <a href="#" class="font-500"> {{ message.user.name }}</a>
                    </div>
                    <div class="message-box">
                    <div class="chat-dots-dropdown" style="display: block;right: -40px;top: 32px;width: 145px;text-align: center;">
                        <ul class="m-0">
                            <li>
                                <a href="#">Quote this message</a>
                            </li>
                        </ul>
                    </div>
                        <span class="fas fa-ellipsis-v" style="
    position: absolute;
    right: 15px;
    bottom: 5px;
    font-size: 13px;
    color: #a52c3e;
    cursor: pointer;
"></span>
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
                        {{ message.message }}
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
                    <div class="chat-dots-dropdown" style="display: block;right: -40px;top: 32px;width: 145px;text-align: center;">
                        <ul class="m-0">
                            <li>
                                <a href="#">Quote this message</a>
                            </li>
                        </ul>
                    </div>
                        <span class="fas fa-ellipsis-v" style="
    position: absolute;
    right: 15px;
    bottom: 5px;
    font-size: 13px;
    color: #a52c3e;
    cursor: pointer;
"></span>
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
                        {{ message.message }}
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
        }
    },
};
</script>
