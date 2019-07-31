<script>
import moment from 'moment';
import Spinner from 'vue-simple-spinner'
import Countdown from './Countdown'

export default {
      data(){
          return {
              inplaytips: [],
              loading: false,            
          }
      },    
    components: {
       'vue-simple-spinner': Spinner, 
        Countdown
    },
      created(){
          this.loading = true;        
          axios.get('/all-inplay-tips')
              .then(res => {
                  this.inplaytips = res.data.inplaytips;  
                  this.loading = false;                  
              })                  
      }    
}
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>