<template>
  <v-tabs v-model="tab" background-color="blue" centered grow dark>
    <v-tab>Requests</v-tab>
    <v-tab>My Course Request</v-tab>

    <v-tab-item>
      <v-card>
        <v-data-table
          :headers="requestHeaders"
          :items="requests"
          sort-by="courseId"
          class="elevation-1"
        >
          <template v-slot:item.action="{ item }">
            <v-icon small class="mr-2" @click.native="accept(item)">mdi-checkbox-marked-circle</v-icon>
            <v-icon small @click.native="decline(item)">mdi-cancel</v-icon>
          </template>

          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-tab-item>

    <v-tab-item>
      <v-card>
        <v-data-table
          :headers="myRequestHeaders"
          :items="myRequests"
          sort-by="courseId"
          class="elevation-1"
        >
          <template v-slot:top>
            <v-toolbar flat color="white">
              <v-dialog v-model="dialog" max-width="500px">
                <template v-slot:activator="{ on }">
                  <v-btn color="primary" dark outlined v-on="on">
                    <v-icon left>mdi-plus</v-icon>New Item
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="auto" lg="6" md="6">
                          <h5>Subjects</h5>
                          <v-autocomplete
                            v-model="chooseSubject"
                            :items="fetchSubjects"
                            label="Subjects"
                            dense
                            chips
                            small-chips
                            multiple
                            solo
                            :allow-overflow="false"
                          ></v-autocomplete>
                        </v-col>
                        <v-col cols="auto" lg="6" md="6">
                          <div class="form-group">
                            <h5>Day</h5>
                            <v-autocomplete
                              v-model="editedItem.date"
                              :items="fetchDays"
                              prepend-inner-icon="event"
                              label="Days"
                              dense
                              chips
                              small-chips
                              multiple
                              solo
                            ></v-autocomplete>
                          </div>
                        </v-col>
                        <v-col cols="auto" sm="6" md="6">
                          <h5>Time</h5>
                          <v-menu
                            ref="menuTime"
                            v-model="menuTime"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            :return-value.sync="editedItem.time"
                            transition="scale-transition"
                            offset-y
                            max-width="290px"
                            min-width="290px"
                          >
                            <template v-slot:activator="{ on }">
                              <v-text-field
                                v-model="editedItem.time"
                                label="Time"
                                prepend-inner-icon="access_time"
                                readonly
                                v-on="on"
                                dense
                                chips
                                small-chips
                                multiple
                                solo
                              ></v-text-field>
                            </template>
                            <v-time-picker
                              v-if="menuTime"
                              v-model="editedItem.time"
                              full-width
                              @click:minute="$refs.menuTime.save(time)"
                            ></v-time-picker>
                          </v-menu>
                        </v-col>
                        <v-col cols="auto" sm="6" md="4">
                          <v-text-field v-model="editedItem.hours" label="Hours"></v-text-field>
                        </v-col>
                        <v-col cols="auto" sm="6" md="4">
                          <v-text-field v-model="editedItem.price" label="Price (Baht)"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>

          <template v-slot:item.action="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">mdi-pencil</v-icon>
            <v-icon small @click="deleteItem(item)">mdi-delete</v-icon>
          </template>

          <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">Reset</v-btn>
          </template>
        </v-data-table>
      </v-card>
    </v-tab-item>
  </v-tabs>
</template>

<script>
import Axios from "axios";
export default {
  data: () => {
    return {
      fetchSubjects: [],
      fetchDays: [],
      chooseSubject: [],
      chooseDays: [],
      menuTime: false,
      time: "",
      tab: null,
      dialog: false,
      requestHeaders: [
        { text: "Requester", align: "start", sortable: false, value: "name" },
        { text: "Course ID", value: "courseId" },
        { text: "Actions", value: "action", sortable: false }
      ],
      requests: [
        
      ],
      myRequestHeaders: [
        { text: "My Course ID", align: "start", value: "myCourseId" },
        { text: "Subjects", sortable: false, value: "subjects" },
        { text: "Start Date", value:'startDate'},
        { text: "Date", sortable: false, value: "date" },
        { text: "Time", sortable: false, value: "time" },
        { text: "Hours", sortable: false, value: "hours" },
        { text: "Nunber of Class", value: "noClasses"},
        { text: "Price(Baht)", value: "price" },
        { text: "Actions", sortable: false, value: "action" }
      ],
      myRequests: [
        
      ],
      editedIndex: -1,
      editedItem: {
        subjects: [],
        date: [],
        time: "",
        price: 0,
        hours: 0,
        noClasses: 0,
        startDate: "",
      }
    };
  },
  mounted: function() {
    axios
      .get("/api/fetch-days")
      .then(response => (this.fetchDays = response.data));
    axios
      .get("/api/fetch-subjects")
      .then(response => (this.fetchSubjects = response.data));
    axios
      .get("/api/get-my-course-request")
      .then(response => (this.myRequests = response.data))
    axios
      .get('/api/course-requests')
      .then(response => (this.requests = response.data))
  },
  methods: {
    initialize: function(){
      axios
        .get("/api/get-my-course-request")
        .then(response => (vm.$set(myRequests,response.data)))
      axios
        .get('/api/course-requests')
        .then(response => (vm.$set(requests,response.data)))
    },
    accept: function(item) {
      const index = this.requests.indexOf(item);
      if (confirm('Confirm Request')){
        axios
          .post('/api/accept-request', {
            id: item.id,
            courseId: item.courseId,
            requesterId: item.requesterId
          })
          .then(response => (
            this.requests.splice(index, 1)
          ));
        // TODO: edit course tutor to requested tutor
        
        // ENDTODO
        axios
          .post('api/cart/add', {
              course_id: item.courseId
          })
          .then(
            response=> console.log(200)  
          );
          // .then(window.location.href="/cart")
          // .catch(error => console.log(error))
          
      }
    },
    decline: function(item) {
      const index = this.requests.indexOf(item);
      if (confirm('Are you sure you want to decline this request?')){
        axios
          .post('/api/decline-request', {
            id: item.id
          })
          .then(this.requests.splice(index, 1))
      }
    },
    editItem: function(item) {
      this.editedIndex = this.myRequests.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.chooseSubject = item.subjects;
      this.chooseDays = item.date;
      this.dialog = true;
    },
    deleteItem: function(item) {}
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Request" : "Edit Request";
    }
  }
};
</script>

<style>
</style>