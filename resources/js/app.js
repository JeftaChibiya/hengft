
/***  Global JS dependencies  ***/

require('./bootstrap');

import Turbolinks from 'turbolinks';
Turbolinks.start();

import { store } from './store/store'
import router from './router';


/***  Vue Filter: Turn first letter to uppercase  ***/ 

Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.slice(1)
});


/***  Vue.js components + more  ***/

import Login from './components/Login' // regular login
import Flash from './components/Flash'
import Specials from './components/Specials'
import InplayTips from './components/InplayTips'
import ContactForm from './components/ContactForm'
import UserSettings from './components/UserSettings'
import PreMatchTips from './components/PreMatchTips'
import RegisterWithStripe from './components/RegisterWithStripe'


/***  A Vue application instance and attach div#app  ***/

document.addEventListener('turbolinks:load', () => {
    let app = new Vue({
        el: '#app',
        store: store,      
        router: router,             
        components: {                                                    
            Login,
            Flash,           
            Specials, 
            InplayTips,
            ContactForm,              
            UserSettings,            
            PreMatchTips,                                    
            RegisterWithStripe,                       
        },
        beforeCreate() {
          this.$store.commit('initialiseStore');
        }                
    });
  });
