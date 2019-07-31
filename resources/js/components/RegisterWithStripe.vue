
<script>

import moment from 'moment'
import SelectablePlan from './SelectablePlan';

// to prod
let stripe = Stripe('pk_live_4wktgZA6yJrZU4beXGCoXXdE00qmn1gR6N'),
    elements = stripe.elements(),
    card = undefined;

export default {
    props: ['plans'],    
    data () {
      return {
        errors: {},  
        DateMessage: 'First Billing Date:',
        EmailMessage:'Email Reminder is sent on:',                        
        loading: false, 
        submitted: false,         
        deactivate: true,       
        cardError: '',                  
        cardFormError: '',          

        customer: {      
          activePlan: {},                   
          stripeToken: '',        
          name: '',
          email: '',
          password: '',
          password_confirmation: '',          
        }

      }
    },   
    filters: {
    },           
    components: {
       
       SelectablePlan,

    },   
    computed: {
        plusTrialDays: function () {
            return moment().add(this.customer.activePlan.trial_period_days, 'days').format('ddd D MMM YYYY')
        },
        trialDaysMinusOne: function () {
            return moment().add(this.customer.activePlan.trial_period_days - 1, 'days').format('ddd D MMM YYYY')
        },                
        isDeactive: function(){
          return this.customer.activePlan &&
            this.customer.name &&
            this.customer.email &&
            this.customer.password && 
            this.customer.password_confirmation                                        
        }
    },       
    beforeMount: function () {
        
        card.unmount();
        card.destroy()           

    },           
    mounted: function () {
        
        this.setUpStripe()   

    },  
    created(){

    },
    // destroy current card element before exiting this component 
    reset () {
        card.unmount();
        card.destroy();
        destroy()          
    },       
    methods: {
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
        // on submit
        async register(){
            
            this.deactivate = true;
            this.loading = true;             
            
            let self = this;
            
                this.planerror = false 
                await stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        self.cardError = result.error.message;
                    } else {
                        // Send the token to your server.
                        self.customer.stripeToken = result.token;
                    }
                });     
                
                let formInput = new FormData();            
                
                // register
                formInput.append('plan', self.customer.activePlan.id);            
                formInput.append('stripeToken', self.customer.stripeToken.id);
                formInput.append('name', self.customer.name);
                formInput.append('email', self.customer.email);               
                formInput.append('password', self.customer.password);                                                          
                formInput.append('password_confirmation', self.customer.password_confirmation);

                // to server
                axios({
                    method: 'post',
                    url: '/register',
                    data: formInput
                })
                .then(() => location.reload(true))
                .catch(error => {
                    this.errors = {}; // clear old 
                    this.errors = error.response.data.errors // pass new
                    this.deactivate = false; // stop progress indicators                 
                    this.loading = false; 
                })                               
        }                    
    },             
}
</script>