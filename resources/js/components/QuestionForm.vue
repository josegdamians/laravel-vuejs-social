<template>
    <form @submit.prevent="handleSubmit">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Titulo de la pregunta
            </label>
        </div>
        <div class="md:w-2/3">
            <input type="text" name="title" v-model="title" :class="errorClass('title')">
            <p v-if="errors['title'][0]" class="text-red-500 text-xs italic">{{ errors['title'][0] }}</p>
        </div>
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                Descripción
            </label>
        </div>
        <div class="md:w-2/3">
            <m-editor :body="body" name="question-body">
                <textarea name="body" v-model="body" rows="10" :class="errorClass('body')">
                </textarea>
                <p v-if="errors['body'][0]" class="text-red-500 text-xs italic">{{ errors['body'][0] }}</p>
            </m-editor>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
                <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    <spinner :small="true" v-if="$root.loading"></spinner>
                    <span v-else>{{ buttonText }}</span>
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import eventBus from '../event-bus'
import MEditor from './MEditor.vue'

export default {
    components: {
        MEditor
    },
    
    props: {
        isEdit: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {
            title: '',
            body: '',
            errors: {
                title: [],
                body: []
            }
        }
    },

    mounted() {
        eventBus.$on('error',errors => this.errors = errors)

        if(this.isEdit) {
            this.fetchQuestion();
        }
    },

    computed: {
        buttonText() {
            return this.isEdit ? 'Actualizar pregunta' : 'Hacer pregunta'
        }
    },

    methods: {
        handleSubmit() {
            this.$emit('submitted',{
                title: this.title,
                body: this.body
            })
        },

        errorClass(column) {
            return [
                'bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500',
                this.errors[column] && this.errors[column][0] ? 'border-red-500' : ''
            ]
        },

        fetchQuestion() {
            axios.get(`/questions/${this.$route.params.id}`,{
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMmFjMDFiNmUxMmNiMmVlOGM1Zjc5MWRhMzcyNDVhYTVlMGQ4ZjFkNmQ5NmFmNDJmYjIwZTgyZjI2Yjc4M2JkYWU2YjdhYWM1YTUxYjNhMmEiLCJpYXQiOjE2MDU5ODcyNTcsIm5iZiI6MTYwNTk4NzI1NywiZXhwIjoxNjM3NTIzMjU2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.cT24aaIe8pKmgVmqEeYfndH539-FMHqc8a2_S5jmhLaOjk-ZXS1F9DJVSUlJQ7Ypu0YNGJyFCx8WvpeXlXIkipz8Xrm6A7gYij0FOiYG7ZCEW8z9Xk3GBqwmi-BjCaCL6DcLKxVExx9dqRPM-2PQF0BSh7vMEYcjkfDKDlARQ59hslFGEsIrz1ZcPrdSLKa3D89gR6-6rBQXyhYVKGpSHOiVof_r3dhZBh-SGyYnOU1MUl_VqjgzkNWmPv6ydhph8EYMavLtUZfd5DztozSI8mYlObZ-fUh7e_3PgrpzRjfSGRtQZOzTlH4Xp2xGO9wTrTDHRuhj7CSCfbE6Kl7Pj00MFUaKfs_hZHDbyjgsqjorxVJUQ2FYGVj_6mnsD-tbFwhGXUgqn4uVINN6ak5KDr20o7fS0jrlQjPo2nsKI3Xxw8I7vc4xLVyJ-32hkJlYtJgtWxvJTANP_cEiBbrQucoL9Id2g3pm-BUovNrtBItwlL6lXPmxGpx7ku4BCcv7sP9J_N-xf4Dgkxyrr2ec-9P-AENskoxBxltSuXfyvRu826OFdKFD9w2GAVJHOQxpnbZcGx9NFcP-Cwn-Koz6eVDyxWG212yc_RxgaX0r55xKga6J-oIeoEqk4FkTyaffKg5ia6XvI-3NzIKvlkxxp7db1frtrOgTmuUnvbMsteE"
                    }
                })
                .then(({ data }) => {
                    this.title = data.title
                    this.body = data.body
                })
                .catch(error => {
                    console.log(error.response);
                })
        }
    }
}
</script>