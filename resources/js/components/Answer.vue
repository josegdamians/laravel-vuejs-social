<template>
    <div class="flex post">
        <vote :model="answer" name="answer"></vote>
        <div class="flex-auto mb-8 mt-8 w-full">
            <form v-show="authorize('modify',answer) && editing" @submit.prevent="update">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <m-editor :body="body" :name="uniqueName">
                            <textarea v-model="body" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" rows="7"></textarea>
                        </m-editor>
                    </div>
                </div>
                <button :disabled="isInvalid" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Actualizar</button>
                <button class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" @click="cancel" type="button">Cancelar</button>
            </form>
            <div v-show="!editing">
                <div :id="uniqueName" v-html="bodyHtml" ref="bodyHtml"></div>
                <div class="flex">
                    <div class="ml-auto">
                        <button v-if="authorize('modify',answer)" type="button" @click.prevent="edit" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Editar</button>
                        <button v-if="authorize('modify',answer)" @click="destroy" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Borrar</button>
                    </div>
                </div>
                <div class="px-4 w-full p-10">
                    <user-info :model="answer" label="respuesta"></user-info>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import modification from '../mixins/modification';

export default {
    props: ['answer'],

    mixins: [modification],

    data() {
        return {
            body: this.answer.body,
            bodyHtml: this.answer.body_html,
            id: this.answer.id,
            questionId: this.answer.question_id,
            beforeEditCache: null
        }
    },

    methods: {
        setEditCache() {
            this.beforeEditCache = this.body;
        },

        restoreFromCache() {
            this.body = this.beforeEditCache;
        },
        
        payload() {
            return {
                body: this.body
            }
        },

        delete() {
            axios.delete(this.endpoint)
            .then(res => {
                this.$toast.success(res.data.message, "Success", { timeout: 2000});
                this.$emit('deleted')
            });
        }
    },

    computed: {
        isInvalid() {
            return this.body.length < 10;
        },

        endpoint() {
            return `/questions/${this.questionId}/answers/${this.id}`;
        },

        uniqueName() {
            return `answer-${this.id}`;
        }
    }
}
</script>