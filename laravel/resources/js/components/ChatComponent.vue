<template>
    <v-layout row>
    <v-flex xs12 sm8 offset-sm2 style="height:80vh">
      <v-card class="chat-card" style="height:100%;">
          <v-subheader>
              {{responder.name}}
            </v-subheader>
            <v-divider class='mt-0'></v-divider>
            <v-flex style="height:59vh;overflow-y:scroll;">
            <v-list
              class="p-3 pt-1 pb-1"
              v-for="(message, index) in allMessages"
              :key="index">
          <div class="message-wrapper">
            <template v-if="responder.id==message.sender_id">
            <v-row class="ml-0">
                <v-list-item-avatar>
                    <v-img :src="responder.avatar"></v-img>
                </v-list-item-avatar>
                <div v-if="message.message" class="text-message-container">
                    <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);">
                      {{message.message}}
                    </v-chip>
                </div>
            </v-row>
                <v-flex class="font-italic" style="font-size:10px;color:grey">
                  {{message.created_at}}
                </v-flex>
            </template>

            <template v-else>
            <v-row class="mr-0">
                <div v-if="message.message" class="text-message-container" style="margin-left:auto; margin-right:0;">
                    <v-chip :color="'blue'" text-color="white"  style="position: relative;top: 50%;transform: translateY(-50%);
                    margin-left:auto; margin-right:0;">
                      {{message.message}}
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
      <v-divider style="align:bottom"></v-divider>
      <v-layout row class="m-2" style="align-self:flex-end">
        <v-flex xs10 >
            <v-text-field
              rows=2
              v-model="message"
              label="Enter Message"
              single-line
              @keyup.enter="sendMessage"
            ></v-text-field>
        </v-flex>

        <v-flex xs2>
            <v-btn @click="sendMessage" class="mt-3 ml-2 white--text" small color="primary">send</v-btn>
        </v-flex>
      </v-layout>
      </v-card>
    </v-flex>
    </v-layout>
</template>

<script>
import Axios from "axios";

export default {
  props:['item'],
  data: function() {
    return {
        responder: {id:1,name:'Student1',avatar:'https://cdn.vuetifyjs.com/images/lists/2.jpg'},
        allMessages: [ {message:"My name is Knot", created_at:"22:33 14 Apr 20", index:1,sender_id:1},
        {message:"My name is KnotKnot", created_at:"22:38 14 Apr 20", index:2,sender_id:1},
        {message:"My name is PaengPaeng", created_at:"22:53 14 Apr 20", index:4,sender_id:2},
        {message:"My name is PaengPaengPaengPaeng", created_at:"23:55 14 Apr 20", index:3,sender_id:2}],
      }
  },

  mounted: function() {
  },
  methods: {
  }
};
</script>

<style>
</style>


