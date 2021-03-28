<template>
    <div>
        <a v-if="canAccept" title="mark this answer as best" 
        :class="classes"
        @click="create">
            <i class="fas fa-check fa-2x"></i>
        </a>

        <a v-if="accepted" title="mark this answer as best" :class="classes">
            <i class="fas fa-check fa-2x"></i>
        </a>      
    </div>
</template>

<script>
import EventBus from '../event-bus.js';
export default {
    props: ['answer'],
    data () {
        return {
            isBest : this.answer.id === this.answer.question.best_answer_id,
            id: this.answer.id
        };
    },
    mounted() {
        EventBus.$on('accepted', (id) => {
            console.log(id);
            this.isBest = (id === this.id);
        });
    },
    methods: {
        create() {
            axios.post(`/answer/${this.id}/accept`)
            .then(res => {
                this.$toast.success(res.data.message, 'Success', {
                    timeout : 3000,
                    position: 'bottomLeft'
                });
            });

            EventBus.$emit('accepted', this.id);
            this.isBest = true;

        }
    },
    computed: {
        canAccept() {
            return this.authorize('accept', this.answer);
        },
        accepted() {
            return !this.canAccept && this.isBest;
        },
        classes() {
            return [
                'mt-2',
                this.isBest ? 'vote-accepted' : ''
            ];
        }


    }
}
</script>