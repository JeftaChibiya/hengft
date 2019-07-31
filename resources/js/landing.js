
require('./bootstrap');


/*** Vue.js components  ***/

import Flash from './components/Flash'
import moment from 'moment'


new Vue({
      el: '#app',               
      components: {         
          Flash                                   
      },
      /** Use: home, timeline */
      computed: {
        trialDuration(){
          let today = moment();
          let tomorrow = moment().add(1, 'd');
          let plusOne = moment().add(2, 'd');          
          let lastDay = moment().add(3, 'd');

          return {
            today: today.format('DD/MM'),
            tomorrow: tomorrow.format('DD/MM'),          
            plusOne: plusOne.format('DD/MM'),            
            lastDay: lastDay.format('DD/MM'),
            lastDayString: lastDay.format('ddd, MMM DD YYYY'),              
          }
        },                                
      }           
  });