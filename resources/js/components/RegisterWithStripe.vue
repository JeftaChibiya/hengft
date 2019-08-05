
<script>
// manage date + time
import moment from 'moment'
// custom checkbox: js + template
import SelectablePlan from './SelectablePlan';

// stripe API key + element object + card variable filled on load
let stripe = Stripe('pk_test_mn0CWCCbMqesOBIi2HIghwjx00TQqq0vDt'),
    elements = stripe.elements(),
    card = undefined;

export default {
    props: ['plans'],    
    data () {
      return {
        errors: {},  
        showPlanError: false,
        planError: 'Please select a subscription plan',        
        activePlan: {},      
        stripeToken: '',                                   
        loading: false, 
        submit: false,
        deactivate: true,                     
        cardErrorOnSubmit: '',                  
        cardErrorBeforeSubmit: '',          

        customer: {                               
          name: '',
          email: '',
          password: '',
          password_confirmation: '',          
        }

      }
    },             
    
    components: { SelectablePlan },   

    watch: {
        // no plan has been selected and form submitted
        activePlan(){
            if(this.activePlan.length === 0 && Object.keys(this.customer).length === 1) {
                this.showPlanError = true
            }
        },
    },
    computed: {          
        isDeactive: function(){
          if(Object.keys(this.activePlan).length && this.customer.name && this.customer.email && this.customer.password && this.customer.password_confirmation){

              return true

          }   
          else{
              return false
          }                                     
        }
    },                  
    methods: {

        // 1. set up stripe elements
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
            // instantiate card element
            card = elements.create('card', {style});
            // mount it to the 'card' variable above
            card.mount(this.$refs.card);        
            
            // real-time validation errors on the card element.
            this.$refs.card.addEventListener('change', function(event) {                
                var self = this;

                if (event.error) {
                    self.cardErrorBeforeSubmit = event.error.message;
                } else {
                    self.stripeToken();
                    self.cardErrorBeforeSubmit = '';
                }
            }); 
        },

        // 2. submit seleted subscription plan + card details + credentials to server
        async register(){

            this.submit = true;    
            this.deactivate = true;
            this.loading = true;             
            
            let self = this;             

            await stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    self.cardErrorOnSubmit = result.error.message;
                } else {
                    // Send the token to your server.
                    self.stripeToken = result.token;
                }
            });     
            
            let formInput = new FormData();            
            
            // register
            formInput.append('plan', self.activePlan.id);            
            formInput.append('stripeToken', self.stripeToken.id);

            formInput.append('name', self.customer.name);
            formInput.append('email', self.customer.email);               
            formInput.append('password', self.customer.password);                                                          
            formInput.append('password_confirmation', self.customer.password_confirmation);

            // to server
            axios({ method: 'post', url: '/register', data: formInput })
            .then(() => location.reload(true))
            .catch(error => {
                this.errors = {}; // clear old 
                this.errors = error.response.data.errors // pass new
                this.submit = false;                  
                this.deactivate = false; // stop progress indicators                 
                this.loading = false; 
            })                               
        }                    
    },  
    // clear existing card object before new one
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
    }               
}
</script>