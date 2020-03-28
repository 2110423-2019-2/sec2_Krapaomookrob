<template>
    <v-container fluid>
        <v-row>
            <v-col
            v-for="course in courses"
            cols=4
            key="course.id"
            >
                <v-card>
                    <v-card-title v-text="course.title"></v-card-title>
                    <v-card-text>
                        <div>{{course.subjects}}</div>
                        <div>{{course.days}}</div>
                        <div>{{course.time}}</div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn :disabled="course.promoted" @click.stop="popUp(course)" color="#55B3E0" text>{{course.promoted ? "Promoted":"Promote"}}</v-btn>
                    </v-card-actions>
                </v-card>

                <v-dialog
                v-model="dialog"
                max-width="500"
                >
                    <v-card>
                        <v-card-title>Promote This Course</v-card-title>
                        <v-card-text>
                            <p class="text--primary">{{selectedCourse.title}}</p>
                            <div>Subject: <span>{{selectedCourse.subjects}}</span></div>
                            <div>Days: <span>{{selectedCourse.days}}</span></div>
                            <div>Area: <span>{{selectedCourse.area}}</span></div>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click.stop="promote(selectedCourse)" text>Confirm</v-btn>
                            <v-btn @click.stop="dialog = false" text>Cancel</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            courses: [ // mock data 
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: true},
                { id: 3, title:"Test Course 3", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: false},
                { id: 13, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: false},
                { id: 14, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: false},
                { id: 15, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: false},
                { id: 16, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth", promoted: false},
            ],
            selectedCourse: {
                id: -1,
                title: "",
                subjects: "",
                days: "",
                area: ""
            },
            dialog: false,


        }
    },
    methods: {
        popUp: function(course){
            // this function is call after confirm window
            this.selectedCourse = Object.assign({}, course);
            this.dialog = true;

        },
        promote: function(course){
            // need revisit for a better security
            window.location.href = "/payment/create-advertisement?courseId="+course.id;
        }
    }
}
</script>

<style>

</style>