<template>
  <v-container fluid>
    <v-data-iterator :items="courses" :items-per-page.sync="itemsPerPage">
      <template v-slot:default="props">
        <v-row>
          <v-col v-for="course in props.items" cols="6" :key="course.course_id">

            <v-card>
              <v-card-title v-text="course.title"></v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <div>Subjects: {{course.subjects}}</div>
                <div>Days: {{course.days}}</div>
                <div>Time: {{course.time}}</div>
                <div>Hours: {{course.hour}}</div>
                <div>Area: {{course.area}}</div>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  :disabled="course.promoted"
                  @click.stop="popUp(course)"
                  color="#55B3E0"
                  text
                >{{course.promoted ? "Promoted":"Promote"}}</v-btn>
              </v-card-actions>
            </v-card>
            <v-dialog v-model="dialog" max-width="500">
              <v-card>
                <v-card-title>Promote This Course</v-card-title>
                <v-card-text>
                  <p class="text--primary">{{selectedCourse.title}}</p>
                  <div>
                    Subject:
                    <span>{{selectedCourse.subjects}}</span>
                  </div>
                  <div>
                    Days:
                    <span>{{selectedCourse.days}}</span>
                  </div>
                  <div>
                    Time:
                    <span>{{selectedCourse.time}}</span>
                  </div>
                  <div>
                    Hours:
                    <span>{{selectedCourse.hour}}</span>
                  </div>
                  <div>
                    Area:
                    <span>{{selectedCourse.area}}</span>
                  </div>
                </v-card-text>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn @click.stop="promote(selectedCourse.course_id)" text>Confirm</v-btn>
                  <v-btn @click.stop="dialog = false" text>Cancel</v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>

            
          </v-col>
        </v-row>
      </template>
      
    </v-data-iterator>
  </v-container>
</template>

<script>
import Axios from "axios";
export default {
  data: () => {
    return {
      itemsPerPage: 6,
      page: 1,
      courses: [],
      selectedCourse: {
        course_id: -1,
        title: "",
        subjects: "",
        days: "",
        time: "",
        hour: "",
        area: ""
      },
      dialog: false
    };
  },
  mounted: function() {
    axios
      .get("/api/getAdsCourses")
      .then(response => (this.courses = response.data));
  },
  methods: {
    popUp: function(course) {
      // this function is call after confirm window
      this.selectedCourse = Object.assign({}, course);
      this.dialog = true;
    },
    promote: function(courseId) {
      // need revisit for a better security
      window.location.href = 
        "/payment/create-advertisement?courseId=" + courseId;
    },
  },
  
};
</script>

<style>
</style>