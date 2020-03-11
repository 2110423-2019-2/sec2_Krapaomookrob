<template>
  <div>
    <table class="table table-striped">
  <thead>
    <tr>
      <th>id</th>
      <th>username</th>
      <!-- <th>title</th> -->
      <th>message</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="report in reports">
      <td>{{ report.id }}</td>
      <td>{{ report.name }}</td>  
      <td>{{ report.message }}</td>  
      <td>{{ report.status }}</td>  
      <td>
         <button type="button" @click="readReport(report.id)">Read</button>
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
      reports : [],
    };
  },

  mounted: function() {
    axios.get("/admin-panel/getReports").then(response => {
        this.reports = response.data;
        this.status = "fetch users sucess"
    });
  },

  methods: {
    readReport: function(id) {
        axios.get('/admin-panel/readReport/'+ String(id)).then(response => {
          this.status = "Report is read"
        });
    },
  }
};
</script>


