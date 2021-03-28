<template>
    <div class="d-flex flex-column votes-control">
        <a @click.prevent="voteUp" :title="title('up')" 
        class="vote-up" :class="classes">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>
       
        <span class="votes-count">{{ count }}</span>
        <a @click.prevent="voteDown" :title="title('down')"
        class="vote-down" :class="classes">
            <i class="fas fa-caret-down fa-3x"></i>
        </a>
        
        <favorite v-if="name === 'questions'" :question="this.model" />
    
        <accept v-else :answer="this.model"></accept>
        
    </div>
</template>

<script>
import Favorite from './Favorite.vue';
import Accept from './Accept.vue';
export default {
    components: {
        Favorite,
        Accept
    },
    props: ['name', 'model'],
    computed: {
        classes() {
            return [
                ! this.signedIn ? 'off' : ''        
            ];
        },
        endpoint() {
            return `/${this.name}/${this.id}/vote `;
        }
    },
    methods: {
        title(type) {
            let titles = {
                up: `This ${this.name} is useful`,
                down: `This ${this.name} is useful`
            };

            return titles[type];
        },
        voteUp() {
            this.vote(1);
        },
        voteDown() {
            this.vote(-1);
        },
        vote(value) {
            if(!this.signedIn) {
                 this.$toast.warning('Please sign in to vote a question', 'Warning', {
                    timeout : 3000,
                    position: 'bottomLeft'
                });

                return ;
            }
            axios.post(this.endpoint, { value })
            .then(res => {
                this.$toast.success(res.data.message, 'Success', {
                    timeout : 3000,
                    position: 'bottomLeft'
                });

                this.count += value;
            });
        }
    },
    data() {
        return {
            count : this.model.votes_count || 0,
            id : this.model.id
        }
    }
}
</script>