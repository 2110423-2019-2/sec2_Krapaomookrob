<template>
<div>
<v-btn @click="expand = !expand" class="px-0 mx-auto" :depressed="true">
    <v-badge v-if="numNewNoti>=1" :content="this.numNewNoti" :left="true" :inline="true" color="#59B7DF">
        🔔
    </v-badge>
    <div v-if="numNewNoti===0">
        🔔
    </div>
</v-btn>
<v-expand-transition>
    <v-card class="mx-auto" width="400" v-show="expand" :elevation="1" tile  style="position:absolute; z-index:99 !important;">
        <v-list class="overflow-y-auto" style="max-height: 400px" :subheader="true">
            <v-subheader>NOTIFICATIONS</v-subheader>
            <template
            v-if="numNewNoti > 0" 
            v-for="notification in this.notifications">
                <v-list-item>
                    <v-list-item-content two-line>
                        <v-list-item-title>{{notification.title}}</v-list-item-title>
                        <v-list-item-subtitle>{{notification.message}}</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </template>
            <template v-if="numNewNoti == 0">
                <v-list-item>
                    <v-list-item-content>
                        No New Notifications
                    </v-list-item-content>
                </v-list-item>
            </template>
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