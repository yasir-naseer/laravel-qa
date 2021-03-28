<template>
     <div>
        <div class="card-body" v-cloak>
            <div class="card-title">
                <h2>{{ this.title }}</h2>
            </div>
            <hr>

            <answer @deleted="remove(index)" v-for="(answer, index) in answers" :answer="answer" :key="answer.id"></answer>
            <div v-if="nextUrl" class="text-center mt-2">
                <button type="button" @click="fetch(nextUrl)" class="btn btn-primary">Load More</button>
            </div>

            <new-answer @add="add" :questionId="id"></new-answer>
                    
        </div>
     </div>
</template>

<script>
import Answer from './Answer.vue';
import NewAnswer from './NewAnswer.vue';
export default {
    props: ['question'],
    data() {
        return {
            answers : [],
            id : this.question.id,
            nextUrl : null,
            count: this.question.answers_count
        }
    },
    components: {
        Answer, NewAnswer
    },
    created() {
        this.fetch(`/questions/${this.id}/answers`);
    },
    computed: {
        title() {
            return this.count + (this.count > 1 ? ' Answers' : ' Answer'); 
        }
    },
    methods: {
        fetch(url) {
            console.log(url);
            axios.get(url)
            .then(({data}) => {
                this.answers.push(...data.data);
                this.nextUrl = data.next_page_url;
            })
        },
        remove(index) {
            this.answers.splice(index, 1);
            this.count--;
        },
        add(answer) {
            this.answers.push(answer);
            this.count++;
        }
    }
}
</script>