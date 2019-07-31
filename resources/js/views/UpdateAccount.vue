<template>
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center mb-10">
            <div class="mb-3 sm:mb-0 sm:mr-5">
                <p class="text-gray-700 font-medium text-3xl">Update Account Info</p>              
            </div>
        </div>   
        <div class="flex flex-col mb-10 w-full sm:w-1/2">
            <form @submit.prevent="updateDetails">
                <!-- username -->
                <span class="font-bold text-sm font-sans text-gray-700">Name</span>
                <div class="flex items-center border-b border-b-2 border-grey py-2 w-full mb-5">               
                    <input id="name" type="text" v-model="user.name" placeholder="Full Name" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" aria-label="name"/>                                                     
                </div>
                <!-- <span v-for="(error, key) in errors.name"  v-text="errors.name" :key="key" class="text-red-500 mt-1 mb-3"></span> -->

                <!-- email -->   
                <span class="font-bold text-sm font-sans text-gray-700">Email Address</span>                 
                <div class="flex border-b border-b-2 border-grey py-2 w-full mb-5">
                    <input id="email" type="email" v-model="user.email" placeholder="Email Address" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" aria-label="email" />                       
                </div>
                <!-- <span v-for="error in errors.email" v-if="error" v-text="error" class="text-red-500 mt-1 mb-3"></span> -->

                <!-- password -->
                <span class="font-bold text-sm font-sans text-gray-700">Password</span>            
                <div class="flex items-center border-b border-b-2 border-grey py-2 w-full mb-5">
                    <input id="password" type="password" v-model="user.password" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Password" aria-label="password"/>  
                </div>
                <!-- <span v-for="error in errors.password" v-if="error" v-if="error" v-text="error" class="text-red-500 mt-1 mb-3"></span> -->
                
                <!-- password confirmation -->
                <span class="font-bold text-sm font-sans text-gray-700">Password Confirmation</span>            
                <div class="flex items-center border-b border-b-2 border-grey py-2 w-full mb-6">
                    <input id="password-confirm" type="password" v-model="user.password_confirmation" class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none" placeholder="Confirm Password" aria-label="password-confirm"/>
                    <span class="input-error"></span>
                </div> 

                <button class="bg-blue-500 py-4 px-4 tracking-wide text-sm sm:text-xs font-bold text-gray-100 rounded-full focus:outline-none" type="submit">
                    UPDATE PROFILE
                </button>  
            </form>                     
        </div>            
    </div>
</template>

<script>
    export default {
        data(){
            return {
                errors: '',
                loading: false,
                user: this.$store.state.user,
                currentSubscribtion: this.$store.state.user.subscriptions,
                currentPlan: this.$store.state.currentPlan,                           
            }
        },
        methods: {
            updateDetails (){
            
                this.showLoader = true;     
                
                let formInput = new FormData();            
                
                // update         
                formInput.append('_method', 'PUT');                
                formInput.append('name', this.user.name);
                formInput.append('email', this.user.email);               
                formInput.append('password', this.user.password);                                                          
                formInput.append('password_confirmation', this.user.password_confirmation);

                axios.post('/account-update/', formInput)
                    .then(() => location.reload())
                    .catch(error => {
                        this.errors = '';
                        // form submission failed, pass form  errors to errors array
                        this.errors = error.response.data.errors
                        this.showLoader = false;                    
                    })                
            }
        },       
        mounted(){
          this.loading = true;
          this.$store.dispatch('getSubscriptionData')  
        }         
    }
</script>
