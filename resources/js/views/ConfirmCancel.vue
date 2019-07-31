<template>
    <div>
        <!-- breadcrumb: cancel | confirm-cancellation -->
        <div class="flex flex-row items-center mb-6">
            <router-link tag="div" class="mr-3 text-xs text-gray-600 font-medium" to="/subscription/cancel">
                <a>Cancel</a>
            </router-link> 
            <div class="text-gray-300 font-light mr-2">
                |
            </div>
            <router-link active-class="text-blue-400" tag="div" class="mr-2 text-xs text-gray-600 font-medium" to="/subscription/cancel/confirm">
                <a>Confirm</a>
            </router-link>                        
        </div>

        <!-- Contextual title: cancel later | cancel now -->
        <div class="flex flex-col mb-8">
            <div class="mb-6 w-full sm:w-1/2">
                <!-- if subscription to be cancelled later -->
               <p class="text-gray-700 font-medium text-3xl leading-tight" v-if="when === 'later'">You are cancelling your account at a later date</p>                
                <!-- if subscription to be cancelled now -->                
               <p class="text-gray-700 font-medium text-3xl" v-if="when === 'now'">You are cancelling your account right away</p>                
            </div>
            <div class="text-md border-b pb-8 text-gray-600 font-light w-full sm:w-1/2 leading-normal">
                <p>
                Visit <b>Billing</b> after cancelling your subscription to view the scheduled date 
                for your cancellation                    
                </p>
            </div>
        </div>    

        <p class="text-gray-700 font-medium text-2xl mb-4">Any Special reason?</p>                       

        <!-- Instruction: provide a reason if possible -->
        <p class="text-gray-600 font-light text-md sm:text-md mb-8 w-full sm:w-1/2 leading-normal">
            You can skip this section if you wish, but if there's a specific reason behind your cancellation, 
            a quick explanation would be greatly appreciated. 
            We're always trying to improve the site!
        </p>  

        <!-- div: form for cancellation reason -->
        <div class="flex flex-col w-full sm:w-1/2 mt-4">
            <!-- form for cancellation reason  -->
            <form @submit.prevent="commitCancellation">                            
                <!-- textfield: reason for cancellation reason -->           
                <div class="mb-6">
                    <textarea v-model="cancellation_reason" class="w-full p-4 focus:outline-none border border-grey" placeholder="..." rows="6"></textarea>
                </div> 
                
                <!-- user actions: confirm cancel | change mind  -->
                <div class="flex flex-col sm:flex-row w-full">
                    <!-- button: commit cancellation -->
                    <button class="flex flex-col mr-2 mb-4 sm:mb-0 w-full justify-center items-center bg-blue-500 hover:bg-blue-600 p-3 px-4 text-sm font-bold text-gray-100 rounded-full focus:outline-none" 
                            type="submit"
                            :class="[posting ? 'loader': '', submit ? 'opacity-50 cursor-not-allowed': '']"
                            :disabled="submit">
                        <span class="tracking-wider">CANCEL</span>                 
                    </button>
                    <!-- button: discontinue cancellation -->
                    <router-link to="/subscription/cancel" tag="button" class="flex flex-col w-full justify-center items-center border border-gray-400 hover:border-gray-500 p-3 px-4 text-sm font-bold text-gray-700 hover:text-gray-800 rounded-full focus:outline-none" 
                                :class="[submit ? 'opacity-50 cursor-not-allowed': '']" :disabled="submit">
                        <span class="tracking-wider">NOT NOW</span>                 
                    </router-link>                    
                </div>

            </form> 
        </div>                            
    </div>     
</template>

<script>
    export default {       
        data(){
            return {           
              submit: false,
              posting: false,
              cancellation_reason: '',
              when: this.$store.state.when, // set cancellation time                          
              currentSubscribtion: this.$store.state.user.subscriptions                                            
            }
        },      
        created(){            
            this.$store.dispatch('getSubscriptionData')              
        },  
        // return view to 'Cancel' when user comes out of 'Confirmation' view
        destroy(){
            router.push({ path: '/settings/subscription/cancel'})            
        },                           
        methods: {
            // commit cancellation and save to server
            async commitCancellation(){
            
                this.submit = true;
                this.posting = true;  

                let formInput = new FormData();            
                
                // commit to form 
                formInput.append('when', this.when); // cancellation time              
                formInput.append('cancellation_reason', this.cancellation_reason); // reason

                // send to server                 
                await axios.post('/cancel-subscription', formInput)
                     .then(() => this.$store.dispatch('getSubscriptionData'));                                  
                
                this.$router.push({ path: '/subscription/cancel'}) // return to 'Cancel' page                 

                this.submit = false;
                this.posting = false;    
                                                 
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