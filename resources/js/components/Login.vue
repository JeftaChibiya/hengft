<script>
export default {
    data(){
       return {
            deactivate: true,
            error: '',
            form: {
                email: '', 
                password: '',                      
            }
       }
    },
    watch: {
        deactivate(){
            if(this.form){
                return false
            }
            else{
                return true
            }
        }
    },
    methods: {
        login(){
            this.deactivate = true 
            axios
               .post('/login', this.form)
               .then(() => location.reload())
               .catch(error => {
                    this.error = 'Wrong email address / password';
               })
               .then(() => {
                   this.$modal.hide('login-modal');
                   this.resetForm()
               })
        },
        resetForm(){
            this.form = {}
        }
    }    
}
</script>
