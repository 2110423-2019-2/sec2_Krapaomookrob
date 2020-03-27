<template>
    <v-container fluid>
        <v-row>
            <v-col
            v-for="course in courses"
            cols=4
            key="course.id">

                <v-card>
                    <v-card-title v-text="course.title"></v-card-title>
                    <v-card-text>
                        <div>{{course.subjects}}</div>
                        <div>{{course.days}}</div>
                        <div>{{course.time}}</div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click.native="promote(course)" color="#55B3E0" text>Promote</v-btn>
                    </v-card-actions>
                </v-card>

            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => {
        return {
            courses: [ // test 
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
                { id: 11, title:"Test Course 11", subjects:"A, B, C", days: "Sun, Mon", time: "12:00", area: "Earth"},
            ],
            seletedCourse: {
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
        promote: function(course){
            // pop modal
            this.seletedCourse = Object.assign({}, course);
            this.dialog = true;
        }
    }
}
</script>

<style>

</style>