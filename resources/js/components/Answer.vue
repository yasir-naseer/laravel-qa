<template>
     <div class="media post" ref="myid" id="mydiv">
        <vote :model="answer" name="answers"></vote>  
        <div class="media-body">
        <form id="form-1" v-if="editing === true" >  
            <textarea  v-model="body" class="form-control" id="" cols="30" rows="10"></textarea> 
               
            <button class="btn btn-primary" @click="submit" :disabled="inValid">Update</button>    
            <button class="btn btn-success" @click="cancel" type="button">Cancel</button>    

        </form>

        <div v-if="editing === false">
            <div v-html="body"></div>
            <div class="row mt-3">
                <div class="col-4">
                    <a v-if="authorize('modify', answer)" @click="edit" class="btn btn-sm btn-outline-success">Edit</a>
                    <button v-if="authorize('modify', answer)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                </div>
                <div class="col-4">
                </div>
                <div class="col-4 ">
                    <user-info :model="answer" label="Answered"></user-info>
                </div>
            </div>
        </div>        
        </div>
    </div>
</template>
<script>
import Vote from './Vote.vue';
import UserInfo from './UserInfo.vue';

export default {
    components: {
        Vote,
        UserInfo
    },
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
                            this.$emit('deleted');
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