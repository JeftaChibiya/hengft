<template>
    <div>
        <!-- title and subscription plan -->
        <div class="flex flex-col sm:flex-row sm:items-center mb-12">
            <div class="mb-3 sm:mb-0 sm:mr-5">
                <p class="text-gray-700 font-medium text-3xl">Billing Plan</p>                
            </div>            
        </div>  

        <!-- on trial period && trial ending date is later than today -->
        <div class="bg-orange-300 w-full sm:w-1/3 h-auto bg-gray-200 p-4 pb-10 mb-6 rounded-lg" v-if="today < trialEndDate.date">
          <div class="flex flex-row items-center absolute w-auto p-2 bg-gray-700 text-xs text-gray-200 rounded-full">
              <div class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current" width="15" height="15" viewBox="0 0 24 24"><path d="M6 23v-11c-4.036 0-6 2.715-6 5.5 0 2.807 1.995 5.5 6 5.5zm18-5.5c0-2.785-1.964-5.5-6-5.5v11c4.005 0 6-2.693 6-5.5zm-12-13.522c-3.879-.008-6.861 2.349-7.743 6.195-.751.145-1.479.385-2.161.716.629-5.501 4.319-9.889 9.904-9.889 5.589 0 9.29 4.389 9.916 9.896-.684-.334-1.415-.575-2.169-.721-.881-3.85-3.867-6.205-7.747-6.197zm-1.151 16.712l.786-4.788.803 3.446c.079.353.569.393.703.053l.727-1.858.678 1.582c.113.262.468.303.637.072l.618-.84h1.199v-.737h-1.391c-.117 0-.229.056-.298.151l-.342.469-.779-1.813c-.13-.303-.562-.296-.683.011l-.616 1.576-.95-4.208c-.09-.398-.659-.375-.724.022l-.788 4.86-.805-2.993c-.09-.357-.595-.377-.709-.023l-.598 1.948h-1.317v.737h1.607c.133 0 .278-.108.315-.235l.298-1.008.906 3.607c.099.389.659.363.723-.031z"/></svg>
              </div>
              <div class="">
                <span class="uppercase font-bold">{{ currentPlan.trial_period_days }} day trial</span>  
              </div>                                            
          </div>   

          <div class="flex-col pl-3 mt-16">
            <div class="flex flex-row mb-2">
              <div class="mr-2">
                <p class="font-bold text-gray-700">Days left: </p>
              </div>
              <div>{{ timeLeftOnTrial }} (excluding today) </div>
            </div>  

            <div class="flex flex-row mb-2">
              <div class="mr-2">
                <p class="font-bold text-gray-700">Ends:</p>
              </div>
              <div>{{ trialEndDate.humanReadableDate }} </div>
            </div> 

            <div class="flex flex-row">
              <div class="mr-2">
                <p class="font-bold text-gray-700">First billing date:</p>
              </div>
              <div>{{ trialEndDate.humanReadableDate }} </div>
            </div>             
          </div>         
        </div>

        <!-- trial period has ended & now on to paid -->
        <div v-if="today > trialEndDate.date">
            <!-- if data is loading -->
            <vue-simple-spinner :speed="0.9" v-if="currentSubscribtion.length < 1"></vue-simple-spinner>           

            <!-- subscription plans: active & alternative option -->
            <div class="flex flex-row">
              
              <transition-group name="fade" tag="div" class="w-full sm:w-1/3 flex-none flex sm:flex-row mb-10">
                    <active-plan v-for="plan in plans" :plan="plan" @restrictPlan="restrictPlan" :currentPlan="currentPlan" @showInfo="showInfo" v-model="activePlan" :key="plan.id"></active-plan>           
              </transition-group> 

              <div class="hidden sm:block flex-none">
                <transition name="component-fade" mode="out-in">
                  <component v-bind:is="view" :timeLeft="timeLeft" :currentPlan="currentPlan" :nextChargeDate="nextChargeDate"></component>
                </transition> 
              </div>  

            </div>

            <!-- update-plan Modal -->
            <confirm-change :user="user" :restrict="restrict" :currentPlan="currentPlan" :activePlan="activePlan" :nextChargeDate="nextChargeDate"></confirm-change>
        </div>   


        <!-- if not subscribed at all  -->
        <div class="mb-4" v-if="!currentSubscribtion">
          <p class="text-gray-600 font-light text-xl">
              You do not have any subscriptions               
          </p>               
        </div>    

    </div>
</template>

<script>
    import moment from 'moment'
    import Spinner from 'vue-simple-spinner';
    import ActivePlan from '../components/ActivePlan';
    import ConfirmChange from '../components/ConfirmChange'    
    
    export default {
        data(){
            return {
                view: 'currentPlan',              
                restrict: false,
                loading: false,                        
                user: this.$store.state.user,
                plans: this.$store.state.plans,                
                timeLeft: this.$store.state.timeLeft,                   
                activePlan: this.$store.state.activePlan,
                currentPlan: this.$store.state.currentPlan,                  
                nextChargeDate: this.$store.state.nextChargeDate,
                timeLeftOnTrial: this.$store.getters.timeLeftOnTrial,                
                currentSubscribtion: this.$store.state.user.subscriptions,                                 
            }
        },  
        components:{
            ActivePlan,
            ConfirmChange,
            'vue-simple-spinner': Spinner,  
            'currentPlan': {
              props: ['currentPlan', 'timeLeft', 'nextChargeDate'],
              template: `
              <div class="text-gray-600 text-xl font-light">
                <ul>
                  <li>Days to go: <b>{{ timeLeft }}</b></li>
                  <li>Next Billing Date: <b>{{ nextChargeDate }}</b></li>                  
                </ul>              
              </div>`
            },
            'AlternativePlan': {
              template: `
              <div class="text-gray-600 text-xl font-light">
                <p class="w-1/3 leading-normal">
                  The estimate charge for the <b>unused</b> days on your current plan will be <b>deducted</b> from
                  the total charge you pay when you select a new plan
                </p>
              </div>`
            }                                  
        },                
        computed: {
            today(){
                
                return moment().unix();
                
            }, 
            trialEndDate(){
                let date = moment(this.currentSubscribtion[0].trial_ends_at).unix();

                let humanReadableDate = moment(this.currentSubscribtion[0].trial_ends_at).format('dddd, MMMM Do YYYY')

                return { date, humanReadableDate };
            }         
        },
        methods: {
          showInfo(){
              if(this.activePlan.plan_id === this.currentPlan.plan_id){
                return this.view = 'currentPlan'
              }
              else if(this.activePlan.plan_id != this.currentPlan.plan_id) {
                return this.view = 'alternativePlan'
              }  
          },
          restrictPlan(){
              if(this.activePlan.plan_id === this.currentPlan.plan_id){
                return this.restrict = true
              }
              else if(this.activePlan.plan_id != this.currentPlan.plan_id) {
                return this.restrict = false
              }               
          }
        },
        created(){
            this.$store.dispatch('getSubscriptionData');

            if(this.activePlan.stripe_plan === this.currentPlan.plan_id){
              this.restrict = true
            }
            else if(this.activePlan.stripe_plan != this.currentPlan.plan_id) {
              this.restrict = false
            }           
        }

        // watch: {
        //   restrict(){
        //       if(this.activePlan.plan_id === this.currentSubscribtion.stripe_plan || this.activePlan.stripe_plan === this.currentSubscribtion.stripe_plan){
        //         return true
        //       }
        //       else if(this.activePlan.plan_id != this.currentSubscribtion.stripe_plan || this.activePlan.stripe_plan != this.currentSubscribtion.stripe_plan) {
        //         return false
        //       }                             
        //   }
        // },        
    }
</script>
  

<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

/*! bulma.io v0.7.5 | MIT License | github.com/jgthms/bulma */
@-webkit-keyframes spinAround {
  from {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
  }
}
@keyframes spinAround {
  from {
    -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(359deg);
            transform: rotate(359deg);
  }
}

.loader{
  color: transparent !important;
  pointer-events: none;
  position: relative
}

.loader::after {
  -webkit-animation: spinAround 500ms infinite linear;
  animation: spinAround 500ms infinite linear;
  border: 2px solid #dbdbdb;
  border-radius: 290486px;
  border-right-color: transparent;
  border-top-color: transparent;
  content: "";
  display: block;
  height: 2em;
  width: 2em;  
  position: absolute !important;  
  margin: 0 auto 
}
</style>

