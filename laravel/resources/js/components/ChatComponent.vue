<template>
      <v-layout row>
      <div class='col-4 pr-1'>
        <v-card  style="height:100%;">
           <v-list subheader>
              <v-subheader>Recent chat</v-subheader>
        
              <v-list-item
                v-for="item in receiverList"
                :key="item.id"
                @click="selectReceiver(item)"
              >
                <v-list-item-avatar>
                  <v-img :src="item.image"></v-img>
                </v-list-item-avatar>
        
                <v-list-item-content>
                  <v-list-item-title v-text="item.name"></v-list-item-title>
                </v-list-item-content>
        
                <v-list-item-icon>
                  <v-icon :color="item.active ? 'deep-purple accent-4' : 'grey'">chat_bubble</v-icon>
                </v-list-item-icon>
              </v-list-item>
            </v-list>
        </v-card>
      </div>
      <div class='col-8 pl-0'>
        <v-flex style="height:30rem">
          <v-card class="chat-card" style="height:100%;">
              <v-subheader>
                  {{receiver.name}}
                </v-subheader>
                <v-divider class='mt-0'></v-divider>
                <v-flex ref='chatBox' style="height:59vh;overflow-y:scroll;">
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
                    <div v-if="message.content" class="text-message-container">
                        <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);">
                          {{message.content}}
                        </v-chip>
                    </div>
                </v-row>
                    <v-flex class="font-italic" style="font-size:10px;color:grey">
                      {{message.created_at}}
                    </v-flex>
                </template>

                <template v-else>
                <v-row class="mr-0">
                    <div v-if="message.content" class="text-message-container" style="margin-left:auto; margin-right:0;">
                        <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);
                        margin-left:auto; margin-right:0;">
                          {{message.content}}
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
          <v-layout row class="mx-2" style="align-self:flex-end">
            <v-flex xs10 >
                <v-text-field
                  class="pt-0"
                  rows=2
                  v-model="sendingMessage"
                  label="Enter Message"
                  single-line
                  @keyup.enter="sendMessage"
                ></v-text-field>
            </v-flex>

            <v-flex xs2>
                <v-btn @click="sendMessage" class="my-1 ml-2 white--text" small color="primary">send</v-btn>
            </v-flex>
          </v-layout>
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
  props:['item', 'userid'],
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
      axios.get('/api/receiver-list')
        .then( response => {
          this.receiverList.push(...response.data)
          this.receiver = this.receiverList[0];
        });


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
          if(e.message.sender_id === this.receiver.id){
            this.allMessages.push(e.message);
          }
      });
  },
  methods: {
      sendMessage: function(){
        axios.post('/api/send-message', {content: this.sendingMessage, receiver: this.receiver.id})
          .then( response => {
            this.allMessages.push(response.data.message);
            this.sendingMessage = '';
          });
      },
      selectReceiver: function(receiver){
        axios.post('/api/chat-list', {receiver: receiver.id})
          .then( response => {
            this.allMessages = response.data;
            this.receiver = receiver;
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
</style>


