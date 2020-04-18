<template>
      <v-layout row>
      <div class='col-4 pr-1'>
        <v-card  style="height:100%;">
           <v-list style="height:30rem; overflow-y:scroll;" subheader>
              <v-subheader>Recent chat</v-subheader>
        
              <v-list-item
                v-for="item in receiverList"
                :key="item.id"
                @click="fetchChatList(item)"
              >
                <v-list-item-avatar>
                  <v-img :src="item.image"></v-img>
                </v-list-item-avatar>
        
                <v-list-item-content>
                  <v-list-item-title v-text="item.name"></v-list-item-title>
                </v-list-item-content>
        
                <v-list-item-icon>
                  <v-icon v-if='receiver!=null' :color="item.id==receiver.id ? 'blue' : 'grey'">chat_bubble</v-icon>
                  <v-icon v-else color='grey'>chat_bubble</v-icon>
                </v-list-item-icon>
              </v-list-item>
            </v-list>
        </v-card>
      </div>
      <div class='col-8 pl-0'>
        <v-flex style="height:30rem">
          <v-card class="chat-card" style="height:30rem;">
              <v-subheader>
                  {{receiver?receiver.name:null}}
                </v-subheader>
                <v-divider class='mt-0'></v-divider>
                <v-flex ref='chatBox' style="height:22rem;overflow-y:scroll;">
                <v-list
                  class="p-3 pt-1 pb-1"
                  v-for="(message, index) in allMessages"
                  :key="index">
              <div class="message-wrapper">
                <template v-if="receiver.id==message.sender_id">
                <v-row class="ml-0">
                    <v-list-item-avatar>
                        <v-img :src="receiver.image"></v-img>
                    </v-list-item-avatar>
                    <div v-if="message.content" class="text-message-container w-50">
                        <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);">
                          <p class='chat-text'>{{message.content}}</p>
                        </v-chip>
                    </div>
                </v-row>
                    <v-flex class="font-italic" style="font-size:10px;color:grey">
                      {{message.created_at}}
                    </v-flex>
                </template>

                <template v-else>
                <v-row class="mr-0">
                    <div v-if="message.content" class="text-message-container d-flex justify-content-right w-50" style="margin-left:auto; margin-right:0;">
                        <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);
                        margin-left:auto; margin-right:0;">
                          <p class='chat-text'>{{message.content}}</p>
                        </v-chip>
                    </div>
                </v-row>
                    <v-flex class="font-italic" style="font-size:10px;color:grey;text-align:right">
                      {{message.created_at}}
                    </v-flex>
                </template>

              </div>
          </v-list>
                </v-flex>
          <v-divider class='mb-0' style="align:bottom"></v-divider>
          <div class='flex my-1 mx-8'>
              <v-row>
                <v-text-field
                placeholder="Enter Message"
                filled
                rounded
                dense
                v-model="sendingMessage"
                @keyup.enter="sendMessage"
                ></v-text-field>
                <v-btn icon color="blue" @click='sendMessage()'>
                  <v-icon>send</v-icon>
                </v-btn>
              </v-row>
          </div>
          </v-card>
        </v-flex>
      </div>
      </v-layout>
</template>

<script>
import Axios from "axios";
import Pusher from "pusher-js";
import Echo from 'laravel-echo';

export default {
  props:['userid'],
  data: function() {
    return {
        receiver: null,
        allMessages: [],
        receiverList: [
        ],
        sendingMessage: '',
      }
  },

  mounted: function() {
      let url = new URL(window.location.href);
      let receiver_id = url.searchParams.get("user-id")
      this.fetchReceiverList(receiver_id);

      Pusher.logToConsole = true;
         
      window.Echo = new Echo({
        broadcaster: 'pusher',
        key: 'eaef6fa526d79c6c3766',
        cluster: 'ap1',
        encrypted: true,
        logToConsole: true
      });
      
      window.Echo.private('to.' + this.userid)
      .listen('MessageSent', (e) => {
          if(this.receiver && e.message.sender_id === this.receiver.id){
            this.allMessages.push(e.message);
          }
          else{
            this.fetchReceiverList(this.receiver.id)
          }
      });
  },
  methods: {
      sendMessage: function(){
        let content = this.sendingMessage;
        let now = new Date();
        this.allMessages.push({
          content: this.sendingMessage, 
          receiver_id: this.receiver.id, 
          sender_id: this.userid, 
          created_at: now.toISOString().slice(0, 19).replace('T', ' ')
        });
        this.sendingMessage = '';
        axios.post('/api/send-message', {content: content, receiver: this.receiver.id})
      },
      fetchChatList: function(receiver){
        axios.post('/api/chat-list', {receiver: receiver.id})
          .then( response => {
            this.allMessages = response.data;
            this.receiver = receiver;
        });
      },
      fetchReceiverList: function(receiver_id){
        axios.post('/api/receiver-list', {receiver_id: receiver_id})
          .then( response => {
            this.receiverList = response.data.receiverList;
            this.receiver = response.data.receiver;
        });
      }
  },
  watch: {
    allMessages: function(val) {
      Vue.nextTick(() => {
        this.$refs.chatBox.scrollTo(0, this.$refs.chatBox.scrollHeight);
      });
    }
  }

};
</script>

<style>

.v-chip {
  height: auto !important;
  padding-top: 0.3rem;
  padding-bottom: 0.3rem;
  word-break: break-all !important;
}

.v-chip__content {
  white-space: pre-line !important;
}

.chat-text {
  margin-bottom: 0 !important;
}

</style>


