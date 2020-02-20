<template>
  <div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th>username</th>
      <th>email</th>
      <th>role</th>
      <th>action</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="user in users" v-bind:key="user.email">
       <td>{{ user.name  }}</td>  
       <td>{{ user.email }}</td> 
       <td>{{ user.role }}</td>  
       <td>
         <button type="button" @click="promoteAdmin(user.email)">Promote</button>
         <button type="button" @click="demoteAdmin(user.email)">Demote</button>
       </td>  
    </tr>
   </tbody>
</table>
  </div>
</template>

<script>
import Axios from "axios";

export default {
  data: function() {
    return {
      users : [],
      admins : [],
      status : '',
    };
  },

  mounted: function() {
    axios.get("/admin-panel/fetchUsers").then(response => {
        this.users = response.data;
        this.status = "fetch users sucess"
    });
    axios.get("/admin-panel/fetchAdmins").then(response => {
        this.admins = response.data;
        this.status = "fetch Admins sucess"
    });
  },
  methods: {
    promoteAdmin: function(email) {
        axios.get('/admin-panel/promoteAdmin/'+ String(email)).then(response => {
          this.status = "Admin is promoted"
        })
        axios.get("/admin-panel/fetchUsers").then(response => {
            this.users = response.data;
            this.status = "fetch users sucess"
        });
    },
    demoteAdmin: function(email) {
        axios.get('/admin-panel/demoteAdmin/'+ String(email)).then(response => {
          this.status = "Admin is promoted"
        })
        axios.get("/admin-panel/fetchUsers").then(response => {
            this.users = response.data;
            this.status = "fetch users sucess"
        });
    }
  }
};
</script>

<style>
</style>


