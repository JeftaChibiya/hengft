
<template>
    <div>
        <button class="flex justify-center items-center bg-blue-500 py-4 px-4 tracking-wide text-sm sm:text-xs font-bold text-gray-100 rounded-full" 
                :class="[restrict ? 'opacity-50 cursor-not-allowed': '']"
                @click="$modal.show('confirm-change')"
                :disabled="restrict">
            UPDATE PLAN
        </button>

        <modal name="confirm-change"
               height="auto"
               :adaptive="true"
               classes="bg-gray-100 rounded-none shadow-inner">
            <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" class="position-right cursor-pointer" @click="close">
                        <path fill="#595D74" d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/>
                    </svg>        

                    <div class="flex flex-col pt-6">
                        <div class="container px-10 p-3 sm:p-8">
                            <p class="text-xl sm:text-2xl font-sans leading-normal font-medium text-gray-700">Change Subscription Plan</p>
                        </div>    
                        
                        <!-- login form -->
                        <form @submit.prevent="updatePlan" @keydown="submitted = false">

                        <div class="bg-gray-300 text-gray-600 px-10 py-2 sm:px-8 sm:py-3 mx-auto border-b border-gray-500">
                            <p class="text-sm mb-2">CURRENT PLAN:  &nbsp;<b> {{ currentPlan.nickname }} </b> </p>
                            <p class="text-sm mb-2">£{{ currentPlan.amount / 100 }} / month</p>
                        </div>

                        <div class="bg-gray-300 text-gray-800 px-10 py-2 sm:px-8 sm:py-3 mx-auto mb-2">
                            <p class="text-sm mb-2">NEW PLAN:  &nbsp;<b> {{ activePlan.nickname }} </b> </p>
                            <p class="text-sm mb-2">£{{ activePlan.amount / 100 }} / year</p>
                        </div>       

                        <div class="px-10 py-2 sm:px-8 sm:py-3">
                            <p class="text-md text-gray-700" v-if="monthlyToYearly"> The estimate of time left on current plan will be deducated</p> 
                            <p class="text-md text-gray-700" v-if="yearlyToMonthly"> Charge <b>£0.00</b>. You will not be charged until <b>{{ nextChargeDate }}</b> </p>                             
                        </div>                                        

                        <div class="container px-10 sm:px-8 py-3">
                            <!-- actions -->
                            <div class="flex flex-row items-center">
                                <button class="flex justify-center items-center mr-3 bg-blue-500 hover:bg-blue-700 p-3 px-4 text-sm font-bold text-gray-100 rounded-sm" type="submit"
                                        :class="[posting ? 'loader': '', submitted ? 'opacity-50 cursor-not-allowed': '']"
                                        :disabled="submitted">
                                    CONTINUE
                                </button>                                
                                <button class="border border-gray-600 text-gray-600 hover:text-gray-800 p-3 px-4 text-sm font-bold rounded-sm" @click="cancel">
                                    CANCEL
                                </button>                       
                            </div>                            
                        </div>

                        </form>

                    </div>                        
                </div>
        </modal>
    </div>
</template>

<script>
export default {
    props: ['user','classes', 'currentPlan','restrict', 'activePlan', 'nextChargeDate'],
    
    data(){
       return {
         submitted: false,
         posting: false, 
         monthlyToYearly: false, 
         yearlyToMonthly: false,                                        
       }
    },
    created(){
        this.$store.dispatch('getSubscriptionData');        
    },
    watch: {
        activePlan(){
            if(this.activePlan.nickname === 'Yearly'){
                return this.monthlyToYearly = true
            }
            else if(this.activePlan.nickname === 'Monthly'){
                return this.yearlyToMonthly = true                
            }
        }
    },
    methods: {
            close(){
                this.$modal.hide('confirm-change');
            },
            cancel(){
                this.$modal.hide('contact-support-modal');
                this.resetForm(),
                location.reload()
            },            
           async updatePlan(){
                this.submitted = true;
                this.posting = true;

                let formInput = new FormData();                            

                // update         
                formInput.append('_method', 'PUT'); 
                formInput.append('plan', this.activePlan.plan_id);                  
                
                axios.post(`/update_plan/${this.user.id}`, formInput)
                    .then(function (response){
                        location.reload(true)
                    })
                    .catch(error => {
                        this.errors = '';                    
                        this.errors = error.response.data.errors // form submission failed, pass form  errors to errors array
                        this.posting = false;                    
                })                
                
        },
        resetForm(){
            this.form = {}
        }
    }    
}
</script>
<style>
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-enter-active {
        transition: all .9s ease;
    }
    .slide-leave-active {
        transform: translateY(100%);
    }
    .slide-enter, .slide-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateY(0);
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
