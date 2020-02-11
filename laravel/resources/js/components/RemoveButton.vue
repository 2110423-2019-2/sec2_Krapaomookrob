<template>

    <button class="cancelbtn btn px-5 mt-3">{{buttonText}}</button>

</template>

<script>
    export default {
        mounted: function() {
                    console.log('Component mounted.')
        },

        props: ['buttonText']
    }
</script>
