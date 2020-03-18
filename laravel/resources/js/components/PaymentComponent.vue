<template>
<h4>pp</h4>
  <div>

    <div
      class="row course-item mb-2 pb-2 border-bottom"
      v-for="entry in this.info"
      v-bind:id="entry.course_id"
    >
      <div class="col-lg">
        <strong>{{entry.tutor_name}}</strong>
        <!-- <br />Chula Engineering -->
      </div>
      <div class="col-lg">{{entry.subjects.join(', ')}}</div>
      <div class="col-lg">{{entry.area}}</div>
      <div class="col-lg">
        {{entry.days.join(', ')}}
        <br />
        {{entry.time}}
        <br />
        ({{entry.hour}} hrs/class)
        <br />
        {{entry.noClass}} Classes,
        <br />
        <div v-if="entry.studentCount == 1">Individual</div>
        <div v-if="entry.studentCount > 1">{{entry.studentCount}} students</div>
      </div>
      <div class="col-lg">
        {{entry.price}} THB
        <br />
        Starts on {{entry.startDate}}
      </div>
    </div>
    <div class="row justify-content-end pr-5 mt-3">
      <div class="col-2 mr-0 pl-5" style="float: right; font-size:1.4em;">
        <p class="text-right">
          <strong>Summary</strong>
        </p>
      </div>

      <div class="col-2 mr-3">
        <p class="mt-1 mb-0 ml-2">
          <br />Total Price
          <br />
        </p>
        <p
          class="mt-0 mb-1 ml-2"
          style="color:rgb(242, 87, 87); font-size: 1.8em"
        >{{totalPrice}} THB</p>

      </div>
    </div>

  </div>
</template>

<script>
import Axios from "axios";

export default {
  data() {
    return {
      info: []
    };
  },
  mounted(){
    axios.get('api/payment',{params: {
          pid: {{totalPrice}}
        }}).then(response =>
      this.info = response.data
    );
  }
};
</script>
