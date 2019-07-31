<template>
    <transition name="slide" mode="in-out">
        <div @mouseover="resetTimer" @mouseleave="unfreezeTimer" class="flex flex-row xl:rounded-lg bg-green-400 text-gray-100 text-sm px-4 py-8 fixed w-full xl:w-1/3 bottom-0 xl:bottom-0 mb-0 xl:mb-10 xl:right-0 mr-10" role="alert" v-show="show">        
            <div class="w-full font-light text-xl ml-4">
                {{ content }} 
            </div>  

            <transition name="fade" mode="out-in">
                <!-- countdown -->
                <div class="w-1/12 font-light text-2xl font-sans" v-if="!paused">
                    {{ time }}
                </div>        
                <div class="w-1/12 font-light text-2xl font-sans cursor-pointer" v-else>
                    <svg @click.stop="hide" xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 24 24"><path fill="#f2f2f2" d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg>                    
                </div>                        
            </transition>                      
        </div>     
    </transition>        
</template>

<script>
import moment from 'moment'
export default {
    props: ['message'],
    data(){
        return{
         content: this.message,
         show: false,
         paused: false,
         time: 11     
        }
    },
    created() {
        setTimeout(() => {
            if(this.message){         
                this.flash(this.message)               
            }
            
            // below is a global event bus
            // listen for event named 'flash' + display message available from all parts of the application
            window.events.$on('flash', message => {    
                this.flash(this.message)                  
            });
        }, 80)
    },   
    watch: {
        // show time left
        time() {                          
            if (this.time === 0) {
                this.$emit('finished');                        
            }
        }         
    },
    methods: {
        resetTimer(){
            this.paused = true;
            this.show = true;
            this.$emit('reset');             
        },
        unfreezeTimer(){       
            this.paused = false;                
            this.refreshEverySecond()                         
        },
        // display message when available
        flash(message){
            this.content = message;            
            this.show = true;
            
            this.refreshEverySecond();
        },
        // hide flash notification after timeout
        hide(){
            this.show = false
        },
        close(){
            this.$emit('finished');              
        },
        // 
        refreshEverySecond () {
            let interval = setInterval(() => {
                this.time --
            }, 1000);
            
            this.$on('finished', function(){
                
                clearInterval(interval);
                this.hide() // hide message after timeout                

            });                

            this.$on('reset', function(){
                if(this.time === 0){
                    this.time = 11
                }
                else if (this.time > 0){
                    clearInterval(interval)
                }
            })                        
        }               
    }
}
</script>

<style>
.slide-enter-active {
  transition: 1s;
}

.slide-leave-active { 
  transition: 2s;
}

.slide-enter {
  transform: translateY(1000px);
}
.slide-leave-to {
    opacity: 0
}
</style>
