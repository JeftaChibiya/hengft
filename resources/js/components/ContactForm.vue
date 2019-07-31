<template>
    <div> 
        <p @click="$modal.show('contact-support-modal')" class="cursor cursor-pointer text-xl font-light text-gray-600 mb-8">
            Send us an Email
        </p>         

       <modal name="contact-support-modal" height="100%" width="100%" :pivotY="1" classes="bg-gray-200 rounded-none shadow-inner">
            <svg @click="$modal.hide('contact-support-modal')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" class="cursor-pointer position-right">
                <path fill="#BEBEBE" d="M23.954 21.03l-9.184-9.095 9.092-9.174-2.832-2.807-9.09 9.179-9.176-9.088-2.81 2.81 9.186 9.105-9.095 9.184 2.81 2.81 9.112-9.192 9.18 9.1z"/>
            </svg> 

           <div class="container mx-auto sm:px-16 px-8">
                <div class="flex flex-col justify-center items-center pt-16 sm:pt-20">
                    <p class="text-center text-2xl text-gray-800 font-bold mb-8">Have a Question?</p>

                    <form action="" autocomplete="off" @submit.prevent="contactSupport" 
                          class="sm:w-1/2 w-full mb-10" @keydown="submitted = false">
                            <!--  -->
                            <div class="flex border-b border-b-2 border-gray-600 py-2 w-full">
                                <input id="name" type="text" placeholder="What's your name?" 
                                       class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  
                                       v-model="client.name" 
                                       @keydown="delete errors.name" 
                                       aria-label="email"/>                       
                            </div>

                            <span class="text-sm text-red-500 pt-1" v-if="errors.name">{{ errors.name[0] | capitalize }}</span>
                            <div class="mb-6"></div>
                            <!--  -->
                            <div class="flex border-b border-b-2 border-gray-600 py-2 w-full">
                                <input id="email" type="text" placeholder="What email address should we reply to?" 
                                       class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  
                                       v-model="client.email" 
                                       @keydown="delete errors.email" 
                                       aria-label="email"/>                       
                            </div>
                            <span class="text-sm text-red-500 pt-1" v-text="errors.email[0]" v-if="errors.email"></span>
                            <div class="mb-6"></div>                            

                            <!--  -->
                            <div class="flex border-b border-b-2 border-gray-600 py-2 w-full">
                                <textarea id="question" type="text" placeholder="What's your question?" 
                                          rows="4" 
                                          class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  
                                          v-model="client.question" 
                                          @keydown="delete errors.question" 
                                          aria-label="text" 
                                          data-autosize>
                                </textarea>                       
                            </div>  
                            <span class="text-sm text-red-500 pt-1" v-text="errors.question[0]" v-if="errors.question"></span>
                            <div class="mb-6"></div>

                            <div class="flex border-b border-b-2 border-gray-600 py-2 w-full">
                                <input id="verification" type="text" placeholder="What is 4 + 3?" 
                                       class="appearance-none bg-transparent border-none w-full text-black text-lg font-light py-1 leading-tight focus:outline-none"  
                                       v-model="client.verification" 
                                       @keydown="delete errors.verification" 
                                       aria-label="text"/>                       
                            </div>
                            <span class="text-sm text-red-500 pt-1" v-text="errors.verification[0]" v-if="errors.verification"></span>
                            <div class="mb-10"></div>

                            <div class="flex flex-row items-center">
                                <button class="mr-3 rounded-full border border-gray-600 text-gray-600 p-1 py-2 w-1/4" @click="cancel">
                                    CANCEL
                                </button>
                                <button class="bg-blue-500 rounded-full p-1 py-2 w-1/4" type="submit" :disabled="submitted">
                                    SEND
                                </button>                        
                            </div>                                    
                    </form>

                    <!-- quick links -->
                    <div class="flex flex-row items-stretch justify-between border-t border-gray-300 pt-4 sm:pt-8 w-full sm:w-1/2">
                        <div>
                            <a href="/about" class="mr-4 text-gray-600 hover:text-gray-500 text-lg no-underline mb-3">
                                About Us
                            </a>
                        </div>
                        <div>
                            <a href="/privacy" classes="text-gray-600 hover:text-gray-700 text-lg no-underline mb-3"></a>
                        </div>
                    </div>
                </div>               
           </div>
       </modal>
    </div>
</template>

<script>
export default {
    props: ['classes'],    
    data(){
        return {
            client: {
                name: '',
                email: '', 
                question: '',
                verification: ''
            },
            submitted: false,
            errors: {}
        }
    },  
    methods: {
        cancel(){
            this.$modal.hide('contact-support-modal');
            this.resetForm(),
            location.reload()
        },
        contactSupport(){
            this.submitted = true
        axios
            .post('/contact', this.client)
            .then(() => {
                this.$modal.hide('contact-support-modal');
                this.resetForm();
            })            
            .catch(errors => {
                this.errors = errors.response.data.errors
                console.log(errors.response.data.errors)
            })
        },
        resetForm(){
            this.client = {}
        }        
    }
}
</script>

