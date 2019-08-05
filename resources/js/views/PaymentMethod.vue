<template>
    <div>
        <div class="flex flex-row items-center mb-6">
            <div class="mr-3">
                <p class="text-gray-700 font-medium text-3xl">
                    Payment Details
                </p>                
            </div>
        </div> 

        <div class="flex items-center my-3 pt-6 mb-12">
            <div class="mr-8">
                <img v-if="user.card_brand = 'Visa'" src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt=""> 
                <!-- <img src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt=""> 
                <img src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt=""> 
                <img src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt=""> 
                <img src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt=""> 
                <img src="/images/card_brands/visa-pay-logo.svg" style="width: 50px" alt="">                                                                                                -->
            </div>
            <div class="font-light text-xl text-gray-700 mr-3">
                .... .... .... {{ user.card_last_four }}
            </div>
            <div class="bg-gray-600 rounded-full text-xs p-1 px-2 font-bold text-gray-100 mr-1">
                current
            </div>            
        </div>
        
        <p class="text-gray-700 font-medium text-lg mb-2">
            Want to update your payment method?
        </p>

        <p class="text-gray-600 leading-normal font-light text-md sm:text-md sm:w-1/3 mb-4" v-if="currentSubscribtion.length">
            Provide your new details below. This is an AES-256 encrypted form. You're safe.              
        </p>  

        <div class="flex flex-col w-full sm:w-1/3 mb-4" v-if="currentSubscribtion.length">
            <form method="POST" @submit.prevent="update">
                <div class="card-details w-full">
                    <div class="flex flex-col py-2">
                        <div class="flex-no-shrink w-full mb-4">
                            <div ref="card"></div>
                        </div>
                    </div>       
                </div>            
                <div class="flex flex-col w-full sm:w-1/2">
                    <button class="bg-blue-500 py-4 px-4 tracking-wide text-xs font-bold text-white rounded-full" type="submit">
                        UPDATE CARD
                    </button>            
                </div>                 
            </form>            
        </div> 

        <p class="text-gray-600 font-light text-lg mb-8" v-else>
            We do not have your card details on file               
        </p>                           
    </div>      
</template>

<script>
let stripe = Stripe('pk_test_mn0CWCCbMqesOBIi2HIghwjx00TQqq0vDt'),
    elements = stripe.elements(),
    card = undefined;

    export default {
        data(){
            return {
                cardError: '',
                cardFormError: '',
                customer: {
                    stripeToken: ''
                },
                user: this.$store.state.user,
                currentSubscribtion: this.$store.state.user.subscriptions,              
            }
        },     
        methods :{
            setUpStripe(){
                    // Custom Styling
                    let style = {
                        base: {
                            color: 'black',
                            fontSize: '17px',
                            fontWeight: '400',
                            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                            fontSmoothing: 'antialiased',              
                            '::placeholder': {
                                color: '#999999'
                            }
                        },
                        invalid: {
                            color: '#E53A40',
                            iconColor: '#fa755a'
                        }
                    }; 

                    card = elements.create('card', {style});
                    card.mount(this.$refs.card);        
                
                    
                    // Handle real-time validation errors from the card Element.
                    this.$refs.card.addEventListener('change', function(event) {
                        var self = this;
                        if (event.error) {
                            self.cardFormError = event.error.message;
                        } else {
                            self.stripeToken();
                            self.cardFormError = '';
                        }
                    }); 
            },
            async update(){
                
                let self = this;

                await stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        self.cardError = result.error.message;
                    } else {
                    // Send the token to your server.
                        self.customer.stripeToken = result.token;
                    }
                }); 

                // this.showLoader = true;     
                
                let formInput = new FormData();            
                
                // update on server            
                formInput.append('stripeToken', self.customer.stripeToken.id);

                axios.post('/update-payment-details', formInput)
                    .then(() => location.reload())
                    .catch(error => {
                        this.errors = '';
                        // form submission failed, pass form  errors to errors array
                        this.errors = error.response.data.errors
                        this.showLoader = false;                    
                    })
            }   
        },   
        beforeMount: function () {
            card.unmount();
            card.destroy()                    
        },        
        // create a new card element on visiting or re-visiting this component                  
        mounted: function () {
            this.setUpStripe();                      
        },
        created: function () {                                
            this.$store.dispatch('getSubscriptionData')                                              
        }                  
    }
</script>
