<template>
    <div>
        <div class="w-full lg:max-w-full" v-cloak v-if="count">
            <div class="shadow-md mb-4 bg-white rounded-lg p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <p class="text-sm flex items-center text-gray-900 font-bold mb-2">
                        {{ title }}
                    </p>
                    <hr>
                    <answer @deleted="remove(index)" v-for="(answer,index) in answers" :answer="answer" :key="answer.id"></answer>
                    <div class="text-center mt-3" v-if="theNextUrl">
                        <button @click.prevent="fetch(theNextUrl)" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Mostrar más</button>
                    </div>
                </div>
            </div>
        </div>
        <new-answer @created="add" :question-id="question.id"></new-answer>
    </div>
</template>

<script>
import Answer from './Answer.vue';
import NewAnswer from './NewAnswer.vue';
import highlight from '../mixins/highlight';
import EventBus from '../event-bus'

export default {
    props:['question'],

    mixins: [highlight],

    data() {
        return {
            questionId: this.question.id,
            count: this.question.answers_count,
            answers: [],
            answerIds: [],
            nextUrl: null,
            excludeAnswers: []
        }
    },

    created() {
        this.fetch(`/questions/${this.questionId}/answers`);
    },

    methods: {
        add(answer) {
            this.excludeAnswers.push(answer);
            this.answers.push(answer);
            this.count++;
            this.$nextTick(() => {
                this.highlight(`answer-${answer.id}`);
            });
            if(this.count === 1){
                EventBus.$emit('answers-count-changed',this.count);
            }
            
        },

        remove(index){
            this.answers.splice(index,1);
            this.count--;
            if(this.count === 0) {
                EventBus.$emit('answers-count-changed', this.count);
            }
        },

        fetch(endpoint) {
            this.answerIds = [];
            axios.get(endpoint)
            .then(({data}) => {
                this.answerIds = data.data.map(a => a.id);
                this.answers.push(...data.data);
                this.nextUrl = data.links.next;
            })
            .then(() => {
                this.answerIds.forEach( id => {
                    this.highlight(`answer-${id}`);
                })
            })
        }
    },

    computed: {
        title() {
            return this.count + " " + (this.count > 1 ? 'Answers' : 'Answer');
        },

        theNextUrl () {
            if (this.nextUrl && this.excludeAnswers.length) {
                return this.nextUrl + this.excludeAnswers.map(a => '&excludes[]=' + a.id).join('');
            }
            return this.nextUrl;
        }
    },

    components: {
        Answer,
        NewAnswer
    }
}
</script>