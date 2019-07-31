<template>
    <div>
        <div class="flex flex-col sm:flex-row sm:items-center mb-6">
            <div class="mb-3 sm:mb-0 sm:mr-5">
                <p class="text-gray-700 font-medium text-3xl">Invoices</p>                
            </div>
        </div>        

        <!-- if invoices exist -->
        <div v-if="currentSubscribtion.length">
            <!-- loading -->
            <vue-simple-spinner :speed="0.9" v-if="loading && currentSubscribtion.length"></vue-simple-spinner> 

            <p class="text-gray-600 font-light text-xl mb-16">
                Thank you for your contributions so far                
            </p> 

            <div class="flex flex-col mb-16" v-if="upcomingInvoice">            
                <p class="text-gray-700 font-bold text-2xl mb-6">Upcoming Invoice</p>             
                <table>
                    <tr>
                        <th>Date</th>
                        <th>Charge</th>                       
                    </tr>
                    <tr>
                        <td>{{ dateOfUpcomingInvoice }}</td>
                        <td>£{{ upcomingInvoice.amount_due / 100}}</td>
                    </tr>
                </table>
            </div>     
                            
            <div class="flex flex-col mb-10" v-if="!loading && currentSubscribtion.length">
                <p class="text-gray-700 font-bold text-2xl mb-6">Payment History</p>

                <!-- loading -->
                <vue-simple-spinner :speed="0.9" v-if="loading && currentSubscribtion.length"></vue-simple-spinner>  

                <transition name="fade">                        
                    <table>
                        <tr>
                            <th>Date</th>
                            <th>Charge</th>
                            <th>Status</th>
                            <th>Invoice</th>                        
                        </tr>
                        <tr v-for="(invoice ,key) in invoices" :key="key">
                            <td>{{ invoice.date }}</td>
                            <td>£{{ invoice.total / 100 }}</td>
                            <td>{{ invoice.status }}</td>                    
                            <td><a :href="'/settings/subscription/invoices/' + invoice.id" class="cursor text-blue-700">View</a></td>
                        </tr>
                    </table>
                </transition>
            </div>             
        </div>          

        <!-- if none exist -->
        <p class="text-gray-600 font-light text-lg mb-8" v-else>
            You do not have any invoices               
        </p>     

    </div>    
</template>

<script>
    import moment from 'moment';
    import Spinner from 'vue-simple-spinner';

    export default {
        data(){
            return {
                invoices: this.$store.state.invoices,
                loading: false,                
                upcomingInvoice: this.$store.state.upcomingInvoice,                
                currentPlan: this.$store.state.currentPlan,                 
                currentSubscribtion: this.$store.state.user.subscriptions,                          
            }
        },
        components: {
            'vue-simple-spinner': Spinner, 
        },   
        computed: {
            dateOfUpcomingInvoice(){
                // convert date to a unix timestamp and then format
                return moment.unix(this.upcomingInvoice.created).format('MMM D, Y');
            }
        },
        filters: {
            toTwoDecimalPlaces: function (amount) {
                return amount.toFixed(2); 
            },
            // return a readable format of a give date
            makeReadable: function (date) {
                return moment(moment.unix(date), 'MMM d, Y')
            }
        },            
        created(){     
            this.loading = true;                    
            this.$store.dispatch('getInvoiceData');  
            this.loading = false  
        }         
    }
</script>
