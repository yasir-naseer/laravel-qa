<template>
    <a  title="Click to mark this question as favorite (click again to undo)" 
        :class="classes" 
        @click="toggle"
        >
            <i class="fas fa-star fa-2x"></i>
            <span class="favorites-count">{{ count }}</span>
    </a>
</template>

<script>
export default {
    props: ['question'],
    data () {
        return {
            isFavorited : this.question.is_favorited,
            count : this.question.favorited_count,
            questionId : this.question.id
        }
    },
    computed: {
        classes() {
            return [
                'favorite', 'mt-2',
                ! this.signedIn ? 'off' : (this.isFavorited ? 'favorited' : '')
            ];
        },
        signedIn() {
            return window.Auth.signedIn;
        }
    },
    methods: {
        toggle() {
            if(! this.signedIn) {
                this.$toast.warning("Please login to favorite the question", "Warning", {
                    timeout : 3000,
                    position : 'bottomLeft'
                });
                return;
            }
            this.isFavorited ? this.destroy() : this.create();
        },

        destroy() {
            axios.delete(`/questions/${this.questionId}/favorite`)
            .then(res => {
                this.count--;
                this.isFavorited = false;
            });
            
        },

        create() {
            axios.post(`/questions/${this.questionId}/favorite`)
            .then(res => {
                this.count++;
                this.isFavorited = true;
            });
           
        }


    }
}
</script>