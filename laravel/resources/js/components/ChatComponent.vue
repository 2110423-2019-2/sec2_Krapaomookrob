<template>
      <v-layout row>
      <div class='col-4 pr-1'>
        <v-card  style="height:100%;">
           <v-list style="height:30rem; overflow-y:scroll;" three-line>
              <template v-for="(item, index) in responderList">
                <v-subheader
                  v-if="item.header"
                  :key="item.header"
                  v-text="item.header"
                ></v-subheader>
        
                <v-divider
                  v-else-if="item.divider"
                  :key="index"
                  :inset="item.inset"
                ></v-divider>
        
                <v-list-item
                  v-else
                  :key="item.title"
                  @click=""
                >
                  <v-list-item-avatar>
                    <v-img :src="item.avatar"></v-img>
                  </v-list-item-avatar>
        
                  <v-list-item-content>
                    <v-list-item-title v-html="item.title"></v-list-item-title>
                    <v-list-item-subtitle v-html="item.subtitle"></v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </template>
            </v-list>
        </v-card>
      </div>
      <div class='col-8 pl-0'>
        <v-flex style="height:30rem">
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
          <v-divider class='mb-0' style="align:bottom"></v-divider>
          <v-layout row class="mx-2" style="align-self:flex-end">
            <v-flex xs10 >
                <v-text-field
                  class="pt-0"
                  rows=2
                  v-model="message"
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

export default {
  props:['item'],
  data: function() {
    return {
        responder: {id:1,name:'Student1',avatar:'https://cdn.vuetifyjs.com/images/lists/2.jpg'},
        allMessages: [ {message:"My name is Knot", created_at:"22:33 14 Apr 20", index:1,sender_id:1},
        {message:"My name is KnotKnot", created_at:"22:38 14 Apr 20", index:2,sender_id:1},
        {message:"My name is PaengPaeng", created_at:"22:53 14 Apr 20", index:4,sender_id:2},
        {message:"My name is PaengPaengPaengPaeng", created_at:"23:55 14 Apr 20", index:3,sender_id:2},
        ],
        responderList: [
          { header: 'Chatter' },
          {
            avatar: 'https://cdn.vuetifyjs.com/images/lists/1.jpg',
            title: 'Brunch this weekend?',
            subtitle: "<span class='text--primary'>Ali Connors</span> &mdash; I'll be in your neighborhood doing errands this weekend. Do you want to hang out?",
          },
          { divider: true, inset: true },
          {
            avatar: 'https://cdn.vuetifyjs.com/images/lists/2.jpg',
            title: 'Summer BBQ <span class="grey--text text--lighten-1">4</span>',
            subtitle: "<span class='text--primary'>to Alex, Scott, Jennifer</span> &mdash; Wish I could come, but I'm out of town this weekend.",
          },
          { divider: true, inset: true },
          {
            avatar: 'https://cdn.vuetifyjs.com/images/lists/3.jpg',
            title: 'Oui oui',
            subtitle: "<span class='text--primary'>Sandra Adams</span> &mdash; Do you have Paris recommendations? Have you ever been?",
          },
          { divider: true, inset: true },
          {
            avatar: 'https://cdn.vuetifyjs.com/images/lists/4.jpg',
            title: 'Birthday gift',
            subtitle: "<span class='text--primary'>Trevor Hansen</span> &mdash; Have any ideas about what we should get Heidi for her birthday?",
          },
          { divider: true, inset: true },
          {
            avatar: 'https://cdn.vuetifyjs.com/images/lists/5.jpg',
            title: 'Recipe to try',
            subtitle: "<span class='text--primary'>Britta Holt</span> &mdash; We should eat this: Grate, Squash, Corn, and tomatillo Tacos.",
          },
        ],
        
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


