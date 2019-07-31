<template>
    <div>
        <div v-if="finished" class="lg:text-xl text-center font-bold mb-4 text-gray-600">
            <scale-loader></scale-loader>

            <p class="text-lg sm:text-lg font-light text-gray-600 leading-normal mb-3 mt-6">
                In the meantime - stay in touch with us on any of our social media
            </p>  

            <div class="flex items-stretch w-1/2 mx-auto text-gray-500 text-center py-2">
                <div class="flex-1">
                    <i class="fab fa-facebook-square fa-2x hover:text-gray-400" style="transition: .5s"></i> 
                </div>
                <div class="flex-1">
                    <a href="https://www.instagram.com/heeengft/" target="_blank">
                        <i class="fab fa-instagram fa-2x hover:text-gray-400" style="transition: .5s"></i>
                    </a>                
                </div>
                <div class="flex-1">
                    <a href="https://mobile.twitter.com/HengFT" target="_blank">
                        <i class="fab fa-twitter-square fa-2x hover:text-gray-400" style="transition: .5s"></i>
                    </a>       
                </div>
            </div>                          
        </div>

        <div class="flex flex-rowitems-stretch text-xl sm:text-xl text-center font-bold text-gray-600" v-else>
            <div class="flex-1 flex flex-col">
                <p class="mb-2"> {{ remaining.hours }} </p> 
                <p class="text-sm font-light">HR</p>
            </div>
            <div class="flex-1 flex flex-col">
                <p class="mb-2"> {{ remaining.minutes }}</p> 
                <p class="text-sm font-light">MINS</p>
            </div>
            <div class="flex-1 flex flex-col">
                <p class="mb-2"> {{ remaining.seconds }} </p> 
                <p class="text-sm font-light">SEC</p>
            </div>                        
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import ScaleLoader from 'vue-spinner/src/ScaleLoader.vue'

    export default {
        props: {
            until: String,
            // expiredText: { default: 'Now Expired' }
        },
        data () {
            return { 
              now: new Date(), 
            }
        },
        components: {
            ScaleLoader       
        },        
        created () {
            this.refreshEverySecond();
        },

        computed: {
            finished () {
                return this.remaining.total <= 0;
            },

            remaining () {
                let remaining = moment.duration(Date.parse(this.until) - this.now);

                if (remaining <= 0) this.$emit('finished');

                return {
                    total: remaining,
                    days: remaining.days(),
                    hours: remaining.hours(),
                    minutes: remaining.minutes(),
                    seconds: remaining.seconds()
                };
            }
        },

        methods: {
            refreshEverySecond () {
                let interval = setInterval(() => this.now = new Date(), 1000);

                this.$on('finished', () => clearInterval(interval));
            }
        }
    }
</script>