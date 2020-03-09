<template>
    <button class="addToCartBtn actionBtn" :disabled="isClicked" @click="isClicked = !isClicked; buttonAction()">
      <span style="white-space: normal;">{{!isClicked? 'Add To Cart':'Remove From Cart'}}</span>
    </button>
</template>

<script>
  import axios from 'axios'

  export default {
    components: {
    },
    props: ['courseid', 'clicked'],
    data () {
      return {
        courseId: this.courseid,
        isClicked: this.clicked
      }
    },
    mounted: function (){

    },

    methods: {
      buttonAction(){
        // fking bad design
        if (!this.clicked){
          axios.post('api/cart/add', {
            course_id: this.courseid
          }).then(response => console.log(200)).catch(error => console.log(error))
        }else{
          axios.post('api/cart/remove', {
            course_id: this.courseid
          }).catch(error => console.log(error))
        }
      }
    }
  }
</script>
