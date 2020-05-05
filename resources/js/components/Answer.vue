<script>
export default {
    props: ['answer'],
    data() {
        return {
            editing : false,
            body : this.answer.body,
            questionId : this.answer.question_id,
            answerId : this.answer.id,
            cachedBody : null
        }
    },
    methods: {
        edit() {
            this.cachedBody = this.body;
            this.editing = true;
        },
        cancel() {
            this.body = this.cachedBody;
            this.editing = false;
        },
        submit() {
            this.editing = false;
            this.update();
        },  
        update() {
            axios.patch(`/questions/${this.questionId}/answers/${this.answerId}`, {
                body : this.body
            })
            .then(res => {
                this.editing = false;
                this.body = res.data.body;
                this.$toast.success(res.data.message, "Success", { timeout: 3000 });
                
            })
            .catch(err => {
                this.$toast.error(err.response.data.message, "Error", { timeout: 3000 });
            })   
        },
        destroy() {
            this.$toast.question('Are you sure about that?', "Confirm", {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>',  (instance, toast) => {
        
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        axios.delete(`/questions/${this.questionId}/answers/${this.answerId}`)
                        .then(res => {
                            $(this.$el).fadeOut(500, () =>  {
                                this.$toast.success(res.data.message, "Success", { timeout: 3000 });
                            });
                        })
                   
                }, true],
                ['<button>NO</button>', function (instance, toast) {
        
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
        
                }],
            ]
        });
           
        }
    },
    computed: {
        inValid() {
            return this.body.length < 10 ;
        }
    }
  
  
  
}
</script>