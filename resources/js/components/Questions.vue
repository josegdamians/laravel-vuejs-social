<template>
    <div>
        <spinner v-if="$root.loading"></spinner> 
        <div v-else-if="questions.length">
            <question-excerpt v-for="question in questions" :question="question" :key="question.id"></question-excerpt>
        </div>
        <div v-else class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div>
                <p class="font-bold">Lo sentimos</p>
                <p class="text-sm">No hay preguntas disponibles.</p>
                </div>
            </div>
        </div>
        <div class="px-4 my-3 py-3 bg-white rounded-lg shadow-md mb-4">
            <pagination :meta="meta" :links="links"></pagination>
        </div>
    </div>
</template>

<script>
import QuestionExcerpt from './QuestionExcerpt.vue'
import Pagination from './Pagination.vue'
import eventBus from '../event-bus'

export default {
    components: {
        QuestionExcerpt,
        Pagination
    },

    data() {
        return {
            questions: [],
            meta: {},
            links: {},
        }
    },

    mounted() {
        this.fetchQuestions();
        eventBus.$on('deleted', (id) => {
            let index = this.questions.findIndex(question => id === question.id)
            this.remove(index)
        })
    },

    methods: {
        fetchQuestions() {
            axios.get('/questions',{ params: this.$route.query})
                .then(({ data }) => {
                    this.questions = data.data
                    this.links = data.links
                    this.meta = data.meta
                })
        },

        remove(index) {
            this.questions.splice(index,1)
            this.count--
        }
    },

    watch: {
        "$route": 'fetchQuestions'
    }
}
</script>