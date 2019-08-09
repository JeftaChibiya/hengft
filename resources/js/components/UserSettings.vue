<script>
    import moment from 'moment'
    export default {
      data(){
          return {          
            routeObj: this.$router.currentRoute,      
            nots: this.$store.state.nots,   
            currentPlan: this.$store.state.currentPlan,             
            unreadCount: this.$store.getters.unreadCount,
            currentSubscription: this.$store.state.user.subscriptions,                                                                     
          }
      },   
      computed: {
        displayCurrentPlan(){
          if(this.today < this.trialEndDate.date){
            return this.currentPlan.trial_period_days + ' day trial'
          }
          else{
            return this.currentPlan.nickname           
          }
        },        
        today(){
          return moment().format('YYYY-MM-DD')
        }, 
        // format date for trial ending date
        trialEndDate(){
           let date = moment(this.currentSubscription[0].trial_ends_at).format('YYYY-MM-DD');

           let humanReadableDate = moment(this.currentSubscription[0].trial_ends_at).format('dddd, MMMM Do YYYY')

           return {date , humanReadableDate};
        }          
      },            
      created() {             

        // if no current route - push root view 'settings/account
        if(!this.$router.currentRoute.name){
          
          this.$router.push('/account/details/update');

        }
        // if there is one, but page is reloaded, current route / view is maintained
        else{
          
          this.$router.push(this.$router.currentRoute) 

        }
      },
      mounted(){
          this.$store.dispatch('getSettingsData')          
      }
    }
</script>
