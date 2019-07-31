<script>
import moment from 'moment'
import Countdown from './Countdown'
import Spinner from 'vue-simple-spinner'

export default {
      data(){
          return {
              todaysTips: [],
              recentTips: [],              
              loading: false,                       
          }
      },    
      components: {
        'vue-simple-spinner': Spinner, 
         Countdown        
      },  
      created(){
          this.loading = true;        
          axios.get('/all-tips')
              .then(res => {
                  this.todaysTips = res.data.todaysTips;
                  this.recentTips = res.data.recentTips;                    
                                  
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
[v-cloak] {
  display: none;
}
</style>
