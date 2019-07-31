<template>
    <div class="w-32 h-32 sm:w-34 sm:h-34 mr-6 bg-white rounded-lg relative heavy-box-shadow p-1 sm:p-4 pt-6 sm:pt-6 cursor-pointer border border-white hover:border-blue-400 focus:outline-none relative" :class="[this.activePlan === plan ? 'border-blue-400': '', submitted ? 'opacity-50 cursor-not-allowed': '']" @click="updateActivePlan" tabindex="0">
      <div class="flex flex-col items-center mt-4 mb-6">
        <p class="text-xl sm:text-3xl tracking-wide font-bold text-blue-600">
          <span class="text-lg">£</span>{{ plan.amount / 100 }}                
        </p>                                 
      </div> 
      <h1 class="text-center uppercase text-xs tracking-wide font-bold text-gray-800 mb-1">
        {{ plan.nickname }}                
      </h1>    
      <div v-if="plan.plan_id === this.currentPlan.plan_id" class="mx-auto w-1/2 text-center bg-gray-600 rounded-full text-xs p-1 px-2 font-bold text-gray-100">
        current
      </div>
      <transition name="fade">
          <div v-if="this.activePlan.stripe_plan === plan.plan_id || this.activePlan.plan_id === plan.plan_id">
            <svg class="absolute top-0 right-0 mr-2 mt-1" width="23px" height="23px" viewBox="0 0 200 200" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="checkmark-outline" fill-rule="nonzero">
                        <path d="M31.1442786,171.840796 C5.2779518,146.858262 -5.09578082,109.862896 4.01023318,75.0738981 C13.1162472,40.2848999 40.2848999,13.1162472 75.0738981,4.01023318 C109.862896,-5.09578082 146.858262,5.2779518 171.840796,31.1442786 C209.549474,70.1869539 209.010186,132.247241 170.628714,170.628714 C132.247241,209.010186 70.1869539,209.549474 31.1442786,171.840796 Z" id="Shape" fill="#328BF2"></path>
                        <polygon id="Path" fill="#fff" points="66.6666667 89.4527363 89.5522388 112.437811 132.338308 69.6517413 146.268657 83.7810945 89.5522388 140.298507 52.7363184 103.482587 66.6666667 89.3532338"></polygon>
                    </g>
                </g>
            </svg>
          </div> 
        </transition>              
    </div>    
</template>

<script>
export default {
    props: ['plan', 'activePlan', 'submitted', 'currentPlan'],
    model: {
      prop: 'activePlan',
      event: 'updatePlan'            
    },        
    data (){
      return {

      }
    },
    methods: {
      updateActivePlan() {
        this.$emit('updatePlan', this.plan); 
        this.$emit('restrictPlan');  
        this.$emit('showInfo');                      
      }
  } 
}
</script>


<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>