import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


/***  import views  ***/

import NotFound from './views/NotFound';
import UpdateAccount from './views/UpdateAccount';
import Billing from './views/Billing';
import Notifications from './views/Notifications';
import Invoices from './views/Invoices';
import PaymentDetails from './views/PaymentDetails';
import Cancel from './views/Cancel';
import ConfirmCancel from './views/ConfirmCancel';


const router = new VueRouter({
    
    /***  router settings  ***/  

    mode: 'history',
    base: '/settings',

    /***  Array of routes and view objects  ***/    
    routes: [                               
        { path: '/account', component: UpdateAccount, name: 'update-account', meta: {title: 'HengFT | Update Account'} },
        { path: '/subscription/plan', component: Billing, name: 'billing', meta: {title: 'HengFT | Billing'} },
        { path: '/subscription/notifications', component: Notifications, name: 'notifications', meta: {title: 'HengFT | Notifications'} },
        { path: '/subscription/invoices', component: Invoices, name: 'invoices', meta: {title: 'HengFT | Invoices'} },
        { path: '/payment-details/edit', 
          component: PaymentDetails, 
          name: 'payments',
          meta: {title: 'HengFT | Payments'}             
        },
        { 
          name: 'cancel',          
          path: '/subscription/cancel', 
          component: Cancel,
          meta: {title: 'HengFT | Cancel Subscription'}                
        },
        {
          name: 'confirm',                
          path: '/subscription/cancel/confirm',
          component: ConfirmCancel,
          meta: {title: 'HengFT | Confirm Cancellation'}                                        
        }, 
        
        // extra meta
        {               
          path: '/register',
          meta: {title: 'HengFT | Create Account'}                                        
        },  
        {               
          path: '/',
          meta: {title: 'HengFT'}                                        
        },   
        {               
          path: '/tips',
          meta: {title: 'HengFT | Pre-match Tips'}                                        
        },   
        {               
          path: '/inplay',
          meta: {title: 'HengFT | Inplay Tips'}                                        
        },                                 
        {               
          path: '/specials',
          meta: {title: 'HengFT | Specials'}                                        
        },           
        {               
          path: '/login',
          meta: {title: 'HengFT | Login'}                                        
        }, 
        {               
          path: '/password/reset',
          meta: {title: 'HengFT | Forgot Password'}                                        
        }                   

    ]
    
});


/***  Insert title tag before each route visit  ***/

router.beforeEach((to, from, next) => {
  document.title = to.meta.title
  next()
})

/***  export routes  ***/
export default router;