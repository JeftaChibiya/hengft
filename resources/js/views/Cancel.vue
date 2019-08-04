<template>
    <div>
        <!-- title  -->        
        <div class="flex mb-8 text-gray-700">
            <!-- before subscription has been cancelled -->
            <p class="font-medium text-3xl leading-normal" v-if="!currentSubscribtion[0].ends_at">Cancel Your Subscription</p>
            <!-- after subscription is due cancellation -->
            <p class="font-medium text-3xl" v-if="currentSubscribtion[0].ends_at">Your Subscription is scheduled for cancellation</p>                           
        </div>    

        <!-- some copy -->
        <div class="w-full sm:w-1/3 font-light leading-normal text-lg text-gray-700 mb-6" v-if="!currentSubscribtion[0].ends_at">
            Are you <b>really</b> sure? Don't forget HengFT is updated multiple times every week.
        </div>             

        <!-- ************ Free Trial Period ************* -->
        <!-- Free trial user actions: cancel later | cancel now -->
        <!-- today's date is before end of free trial date | subscription hasn't been cancelled --> 
        <div class="w-full py-6" v-if="time.today < time.freeTrialEndsAt && !currentSubscribtion[0].ends_at"> 
            <div class="flex flex-col sm:flex-row sm:items-center">
                <div class="sm:mr-3 mb-4 sm:mb-0">
                    <!-- set cancellation time as 'later' -->
                    <router-link tag="button" class="w-full sm:w-auto text-gray-100 bg-blue-500 hover:bg-blue-600 p-4 px-6 text-xs font-bold rounded-full" 
                                to="/subscription/cancel/confirm"
                                v-on:click.native="setLater">
                                CANCEL ACCOUNT WHEN TRIAL ENDS
                    </router-link>
                </div>
                <div class="">
                    <!-- set cancellation time as 'now' -->                    
                    <router-link tag="button"
                                class="w-full sm:w-auto border border-gray-500 hover:border-gray-600 text-gray-600 hover:text-gray-700 p-4 px-6 text-xs font-bold rounded-full" 
                                to="/subscription/cancel/confirm" 
                                v-on:click.native="setNow">
                                CANCEL NOW
                    </router-link>
                </div>
            </div>
        </div>                     

        <!-- *******  Paid Subscription ********* -->
        <!-- subscription hasn't been cancelled -->        
        <div v-if="time.today > time.freeTrialEndsAt && !currentSubscribtion[0].ends_at">                 
            <div class="flex flex-col w-full sm:w-1/5">
                <!-- vue-router link to confirmation page -->
                <!-- set cancellation time as 'later' -->                
                <router-link tag="button" 
                            to="/subscription/cancel/confirm" 
                            class="bg-blue-500 hover:bg-blue-700 py-4 px-4 tracking-wide text-xs font-bold text-gray-100 rounded-full"
                            v-on:click.native="setLater"
                            exact>
                    YES, I AM SURE
                </router-link>          
            </div>             
        </div>          
        
        <!-- ***********  Free trial & Paid Subscription ************** -->
        <!-- User actions: be informed of ending date | click to resume subscription -->        
        <!-- cancel request has been issued && 'ends_at' field set on subscription-->
        <div class="bg-gray-200 p-4 rounded-lg" v-if="currentSubscribtion[0].ends_at">
            <p class="text-gray-600 font-light text-md sm:text-lg mb-8 w-full sm:w-1/2 leading-normal">
                Your account is due to be cancelled and removed from file on <b class="text-gray-700 font-medium">{{ time.freeTrialEndsAtDate }}</b> at <b class="text-gray-700 font-medium">{{ time.freeTrialEndsAtTime }}</b>
            </p> 
            <!-- User Action: resume subscription -->
            <button class="flex flex-col justify-center items-center bg-blue-500 hover:bg-blue-700 p-3 px-4 text-xs font-bold text-gray-100 rounded-full focus:outline-none" 
                    :class="[posting ? 'loader': '', submit ? 'opacity-50 cursor-not-allowed': '']"
                    @click="resumeAccount">
                RESUME ACCOUNT
            </button>         
        </div>                

    </div>     
</template>

<script>
    // created and re-factored: 29/07/2019
    // JC
    import moment from 'moment'

    export default {
        data(){
            return {  
                submit: false,
                posting: false,                                                                         
                currentSubscribtion: this.$store.state.user.subscriptions,                               
            }
        },       
        // when component is instantiated
        created(){            
            this.$store.dispatch('getSubscriptionData');                         
        },         
        methods: {
            // set Cancellation time as later date
            setLater(){
                this.$store.dispatch('setWhen', { when: 'later'})                 
            },
            // set cancellation time as today, now
            setNow(){
                this.$store.dispatch('setWhen', { when: 'now'})                 
            },    
            // resume subscription        
            async resumeAccount(){      
                // activate loading spinner animation
                this.submit = true;
                this.posting = true;  

                // resume subscription on server            
                await axios.post('/resume-subscription')
                     .then(() => this.$store.dispatch('getSubscriptionData')) 
                     .then(() => location.reload()) 
                     
                // process has successfully ended, deactivate loading spinner animation                     
                this.submit = false;
                this.posting = false;                        
            }
        },
        computed: {                      
            time(){
                // today's date as unix timestamp
                let today = moment().unix();                   
                // unix timestamp
                let freeTrialEndsAt = moment(this.currentSubscribtion[0].trial_ends_at).unix();
                // readable format of the date
                let freeTrialEndsAtDate = moment(this.currentSubscribtion[0].trial_ends_at).format('dddd, MMMM Do YYYY')
                // readable format of the time              
                let freeTrialEndsAtTime = moment(this.currentSubscribtion[0].trial_ends_at).format('HH:mm a')                
                // subscription scheduled cancellation date
                let subscriptionEndsAtDate = moment(this.currentSubscribtion[0].ends_at).format("dddd, MMMM Do YYYY")                
                // subscription scheduled cancellation time
                let subscriptionEndsAtTime = moment(this.currentSubscribtion[0].ends_at).format("HH:mm a")

                // return output
                return { 
                    today, 
                    freeTrialEndsAt,
                    freeTrialEndsAtDate, 
                    freeTrialEndsAtTime,
                    subscriptionEndsAtDate, 
                    subscriptionEndsAtTime 
                };
            }                                    
        }                     
    }
</script>


<style>
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
