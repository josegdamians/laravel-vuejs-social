<template>
    <div>
        <form class="px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4" v-show="authorize('modify',question) && editing" @submit.prevent="update">
            <div class="flex mb-2 text-gray-900 font-bold">
                <div class="ml-auto">
                    <router-link exact :to="{ name:'questions' }" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Regresar</router-link>
                </div>
            </div>
            <div class="flex mb-2 text-gray-900 font-bold">
                <input type="text" v-model="title" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
            </div>
            <hr>
            <div class="md:flex md:items-center mt-4">
                <div class="md:w-2/3">
                    <m-editor :body="body" name="uniqueName">
                        <textarea rows="7" v-model="body" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" required></textarea>
                    </m-editor>
                </div>
            </div>
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button :disabled="isInvalid" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Actualizar</button>
                    <button @click="cancel" type="button" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">Cancelar</button>
                </div>
            </div>
        </form>

        <div class="px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4" v-show='!editing'>
            <div class="flex mb-2 text-gray-900 font-bold">
                <h2>{{ title }}</h2>
                <div class="ml-auto">
                    <router-link exact :to="{ name:'questions' }" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Regresar</router-link>
                </div>
            </div>
            <hr>
            <div class="flex mt-4">
                <vote :model="question" name="question"></vote>
                <div class="flex-auto p-4">
                    <div v-html="bodyHtml" ref="bodyHtml"></div>
                </div>
                <div class="ml-auto">
                    <button v-if="authorize('modify',question)" type="button" @click.prevent="edit" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Editar</button>
                    <button v-if="authorize('deleteQuestion',question)" type="button" @click="destroy" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Borrar</button>
                </div>
            </div>
            <div class="mb-8 w-full">
                <div class="px-4 w-full p-10">
                    <user-info :model="question" label="pregunta"></user-info>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import modification from '../mixins/modification';
import EventBus from '../event-bus';

export default {
    props: ['question'],

    mixins: [modification],
    mounted() {
        EventBus.$on('answers-count-changed', (count) => {
            this.question.answers_count = count;
        })
    },

    data() {
        return {
            title: this.question.title,
            body: this.question.body,
            bodyHtml: this.question.body_html,
            id: this.question.id,
            beforeEditCache: {}
        }
    },

    computed: {
        isInvalid() {
            return this.body.length < 10 || this.title.length < 10;
        },

        endpoint() {
            return `/questions/${this.id}`;
        },

        uniqueName() {
            return `question-${this.id}`;
        }
    },

    methods: {
        setEditCache() {
            this.beforeEditCache = {
                body: this.body,
                title: this.title
            };
        },

        restoreFromCache() {
            this.body = this.beforeEditCache.body;
            this.title = this.beforeEditCache.title;
        },

        payload() {
            return {
                body: this.body,
                title: this.title
            };
        },

        delete() {
            axios.delete(this.endpoint)
            .then(({data}) => {
                this.$toast.success(data.message, "Success", { timeout: 2000});
                this.$router.push({ name: 'question' });
            });
        }
    }
}
</script>