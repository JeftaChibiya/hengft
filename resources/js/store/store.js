import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import moment from 'moment'

Vue.use(Vuex);

export const store = new Vuex.Store({   

    state: {
        nots: [],
        user: {}, 
        when: '',   
        plans: [], 
        timeLeft: '',        
        invoices: [],     
        activePlan: {},
        unread_count: '',         
        currentPlan: {},          
        nextChargeDate: '',        
        upcomingInvoice: {},        
    },
    
    plugins: [createPersistedState()],    

    mutations: {
        // replace the current state when new data becomes available
		initialiseStore(state) {
			// Check if the ID exists
			if(localStorage.getItem('store')) {
				// Replace the state object with the stored item
				this.replaceState(
					Object.assign(state, JSON.parse(localStorage.getItem('store')))
				);
			}
		},        
        cancellationTime(state, payload){
            state.when = payload.when
        },
        subscriptionData: function (state, payload) {
            state.nots = payload.nots;                      
            state.user = payload.user; 
            state.plans = payload.plans;
            state.timeLeft = payload.timeLeft;            
            state.nots_read = payload.nots_read;   
            state.activePlan = payload.user.subscriptions[0]; 
            state.nextChargeDate = payload.nextChargeDate;
            state.currentPlan = payload.currentPlan[0]; 
        },
        invoiceData: function (state, payload) {
            state.invoices = payload.paidInvoices;
            state.upcomingInvoice = payload.upcomingInvoice;            
        }      
    },
    getters: {
        unreadCount: (state) => {
            return state.nots.filter(not => not.read_at === null).length;
        },
        timeLeftOnTrial (state) {
            return moment(state.user.subscriptions[0].trial_ends_at).diff(moment(), 'days')
        }                
    },

    actions: {
        // 
        getSubscriptionData : async(context, payload) => {
                await axios.get('/subscription_log')
                    .then(res => {                  
                        context.commit('subscriptionData', res.data); 
                        console.log(res.data)                                                                                                                     
                }); 
        },
        // get previous invoices, one upcoming invoice
        getInvoiceData : async (context, payload) => {
                await axios.get('/invoices')
                    .then(res => {
                      context.commit('invoiceData', res.data);                                     
                      console.log(res.data)                       
                });  
        },
        // set when to cancel the subscription
        setWhen(context, payload){
            context.commit('cancellationTime', payload);  
        }        

    }
});