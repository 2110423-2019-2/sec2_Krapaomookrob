<template>
  <div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>email</th>
      <th>role</th>
      <th>action</th>
    </tr>
  </thead>
  <tbody>
   <!--
    <tr v-for="user in users" v-bind:key="user.email">
       <td>{{ user.name  }}</td>  
       <td>{{ user.email }}</td> 
       <td>{{ user.role }}</td>  
       <td>
         <button type="button" @click="promoteAdmin(user.email)">Promote</button>
         <button type="button" @click="demoteAdmin(user.email)">Demote</button>
       </td>  
    </tr>
    -->
   </tbody>
</table>
  </div>
</template>

<script>
import Axios from "axios";

export default {
  data: function() {
    return {
    };
  },

  mounted: function() {
  },
  methods: {
    
  }
};
</script>

<style>
</style>


