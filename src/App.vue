<template>
  <div class="bg-gray-900">
    <Navbar/>
    
      
        <router-view></router-view>
      
    
  <Footer/>
  </div>
  
</template>

<script>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue'
    export default {
      component: {
        Navbar,
        Footer
        },
        name: '',

        data() {
            return {
              isMenuOpen: false,
            };
        },

        methods: {},
    };
</script>
