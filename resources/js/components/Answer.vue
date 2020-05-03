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
                alert(res.data.message);
            })
            .catch(err => {
                alert(err.response.data.message);
            })   
        },
        destroy() {
           if(confirm('Are you sure you wants to delete the question?')){
                axios.delete(`/questions/${this.questionId}/answers/${this.answerId}`)
                .then(res => {
                    $(this.$el).fadeOut(500, function() {
                        alert(res.data.message);
                    });
                })
           }
        }
    },
    computed: {
        inValid() {
            return this.body.length < 10 ;
        }
    }
  
  
  
}
</script>