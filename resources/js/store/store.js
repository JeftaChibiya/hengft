import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import moment from 'moment'

Vue.use(Vuex);

export const store = new Vuex.Store({   

    state: {
        // Cache version
        version: '',
        count: 1,  
              
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
        settingsData: function (state, payload) {
            state.nots = payload.user.notifications;                      
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
        // get most of user-related subscription data
        getSettingsData : async(context, payload) => {
                await axios.get('/settings_payload')
                    .then(res => {                  
                        context.commit('settingsData', res.data);                                                                                                                 
                }); 
        },
        // get previous invoices + one upcoming invoice
        getInvoiceData : async (context, payload) => {
                await axios.get('/invoices')
                    .then(res => {
                      context.commit('invoiceData', res.data);                                                           
                });  
        },
        // set when to cancel the subscription
        setWhen(context, payload){
            context.commit('cancellationTime', payload);  
        }        

    }
});