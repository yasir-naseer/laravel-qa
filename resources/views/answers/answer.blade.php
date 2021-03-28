<answer :answer="{{ $answer }}" inline-template>
    <div class="media post" ref="myid" id="mydiv">
        <vote :model="{{ $answer}}" name="answers"></vote>  
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
                    @can('update', $answer)
                        <a @click="edit" class="btn btn-sm btn-outline-success">Edit</a>
                    @endcan
                    @can('delete', $answer)
                    <button @click="destroy" class="btn btn-sm btn-outline-danger">Delete</button>
                    @endcan
                </div>
                <div class="col-4">
                </div>
                <div class="col-4 ">
                    <user-info :model="{{ $answer }}" label="Answered"><
                </div>
            </div>
        </div>        
        </div>
    </div>
</answer>

   
