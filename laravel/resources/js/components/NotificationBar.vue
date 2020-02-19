<template>
<div>
<v-btn @click="expand = !expand" class="px-0 mx-auto">
    <v-badge :content="this.numNewNoti" :left="true" :inline="true" color="#59B7DF">
        🔔
    </v-badge>
</v-btn>
<v-expand-transition>
    <v-card class="mx-auto" width="400" v-show="expand" tile>
        <v-list class="scroll-y">
            <v-subheader>NOTIFICATIONS</v-subheader>
            <div v-for="notification in notifications">
                <v-list-item>
                    <v-list-item-content two-line>
                        <v-list-item-title>Cancel Course</v-list-item-title>
                        <v-list-item-subtitle>{{notification.message}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </div>
        </v-list>
    </v-card>
</v-expand-transition>
</div>
</template>

<script>
export default {
    data: function() {
        return {
            expand: false,
            notifications: [],
            numNewNoti: 0
        }
    },
    mounted: function(){
        axios.get('/api/notification').then(response => {
            this.notifications = response.data.notifications;
            this.numNewNoti = response.data.numNewNoti;
        })
    }
}
</script>

<style>

</style>