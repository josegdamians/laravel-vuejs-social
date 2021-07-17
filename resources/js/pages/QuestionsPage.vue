<template>
    <div>
        <div class="px-4 my-3 py-3 bg-white rounded-lg shadow-md mb-4">
            <div class="flex">
                <h2>Todas las preguntas</h2>
                <div class="ml-auto">
                    <router-link :to="{ name: 'questions.create'}" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Pregunta</router-link>
                </div>
            </div>
        </div>
        <questions></questions>
    </div>
</template>

<script>
import Questions from '../components/Questions.vue'

export default {
    components: {
        Questions
    }
}
</script>