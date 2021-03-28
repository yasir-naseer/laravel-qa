<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form v-if="editing">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control" v-model="title">
                            </div>
                        </div>
                        <hr>

                        <div class="media">
                            <div class="media-body">
                                <textarea  v-model="body" class="form-control" id="" cols="30" rows="10"></textarea> 
                                <div class="row">
                                    <div class="col-12 text-right mt-2">
                                        <button class="btn btn-primary" @click="submit" type="button" :disabled="inValid">Update</button>    
                                        <button class="btn btn-success" @click="cancel" type="button">Cancel</button>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body" v-else>
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2>{{ title }}</h2>
                            <div class="ml-auto">
                                <a href="/questions" class="btn btn-outline-secondary">See All Questions</a>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="media">
                        <vote :model="question" name="questions"></vote>
                        <div class="media-body">
                                {{ body }}
                               <div class="row">
                                     <div class="col-4">
                                        <a v-if="authorize('modify', question)" @click="edit" class="btn btn-sm btn-outline-success">Edit</a>
                                        <button v-if="authorize('modify', question)" @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4">
                                        <div class="mt-3">
                                           <user-info v-bind:model="question" label="Asked"></user-info>
                                        </div>  
                                    </div>
                               </div>
                        </div>
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
    props: ['question'],
    data() {
        return {
            title : this.question.title,
            body : this.question.body,
            id : this.question.id,
            editing: false,
            cachedData : null
        }
    },
      methods: {
        edit() {
            this.cachedData = {
                title : this.title,
                body : this.body
            };
            this.editing = true;
        },
        cancel() {
            this.body = this.cachedData.body;
            this.title = this.cachedData.title;
            this.editing = false;
        },
        submit() {
            //this.editing = false;
            this.update();
        },  
        update() {
            axios.patch(`/questions/${this.id}`, {
                body : this.body,
                title : this.title
            })
            .then(res => {
                this.editing = false;
                this.body = res.data.question.body;
                this.title = res.data.question.title;
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
                        axios.delete(`/questions/${this.id}`)
                        .then( ({data}) => {
                            this.$toast.success(data.message, "Success", { timeout: 3000 });
                            window.location.href = "/questions";
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