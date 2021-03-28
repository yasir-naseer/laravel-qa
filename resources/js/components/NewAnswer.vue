<template>
    <div class="card-body">
        <div class="card-title">
            <h3>Your answer</h3>
        </div>
        <hr>
        <form @submit.prevent="create"> 
            <div class="form-group">
                <textarea name="body" id="body" v-model="body"  rows="7" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" :disabled="inValid" class="btn btn-outline-primary float-right">Submit</button>
            </div>
        </form>                 
    </div>
</template>

<script>
import AnswersVue from './Answers.vue';
export default {
    props: ['questionId'],
    data: function() {
        return {
            body: ''
        }
    },
    computed: {
        inValid(){
            return ! this.signedIn || this.body.length < 10;
        }
    },
    methods: {
        create() {
            axios.post(`/questions/${this.questionId}/answers`, { body: this.body})
            .then(({data}) => {
                this.$toast.success(data.message, 'Success');
                this.$emit('add', data.answer);
            })
            .catch((error) => {  
                this.$toast.error(error.response.data.message, 'Error');
            });
        }
    }
}
</script>