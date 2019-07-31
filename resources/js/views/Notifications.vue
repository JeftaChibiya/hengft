<template>
    <div>
        <div class="mb-8">
            <div class="mb-10">
                <p class="text-gray-700 font-medium text-3xl"> Notifications</p>              
            </div>
            <!-- if notifications are available -->
            <div class="flex flex-col" v-if="nots.length">
                <transition-group tag="div" name="fade">
                    <div class="flex flex-row bg-gray-200 text-gray-700 text-lg rounded-md p-4 mb-3" v-for="(not,index) in nots" :key="not.id">
                        <div class="mr-3 justify-center items-center flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>                        
                        </div>
                        <div class="w-11/12">
                            <p class="mb-2 font-bold text-lg mb-2">{{ not.data.title }} </p>                    
                            <p class="mb-4">{{ not.data.message }} </p>
                            <p class="text-sm font-medium italic">
                            {{ not.created_at | timeAgo }}
                            </p>                         
                        </div>                   
                        <div class="flex items-center">
                           <button class="text-sm uppercase" @click="delNotification(index, not.id)">remove</button>
                        </div>
                    </div>                     
                </transition-group>              
            </div>
            <!-- if there are notifications -->
            <p class="text-gray-600 font-light text-xl" v-else>
                This page will list all email subscriptions for your account.                
            </p>                        
        </div>         
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
        data(){
            return {
              nots: this.$store.state.nots, // notifications payload               
            }
        },
        filters: {
            // display amount of time elapsed since action
            timeAgo: function (date) {
                return moment(date).fromNow()
            }
        }, 
        methods:{
          // delete a given notification
          delNotification(indexOfItem, id){
              this.nots.splice(indexOfItem, 1)  
              
                // send request to server
                axios.post(`/del-notification/${id}`)
                     .then(() => location.reload())       
          }            
        },       
        created(){            
            // refresh data on component creation            
            this.$store.dispatch('getSubscriptionData')              
        },
        updated(){            
            // refresh data on component creation            
            this.$store.dispatch('getSubscriptionData')              
        }                    
    }
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ 
{
  opacity: 0;
}
</style>
