<template>
    <div>
        <div class="px-4 my-3 py-3 bg-white rounded-lg shadow-md mb-4">
            <div class="flex">
                <h2>Pregunta</h2>
                <div class="ml-auto">
                    <router-link :to="{ name: 'questions'}" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Regresar  a todas las preguntas</router-link>
                </div>
            </div>
        </div>
        <div class="px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4">
            <div class="mb-8">
                Realiza tu pregunta
            </div>
            <question-form @submitted="create"></question-form>
        </div>
    </div>
</template>

<script>
import QuestionForm from '../components/QuestionForm.vue'
import EventBus from '../event-bus'

export default {
    components: {
        QuestionForm
    },
    
    methods: {
        create(data) {
            axios.post('/questions',data,{
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMmFjMDFiNmUxMmNiMmVlOGM1Zjc5MWRhMzcyNDVhYTVlMGQ4ZjFkNmQ5NmFmNDJmYjIwZTgyZjI2Yjc4M2JkYWU2YjdhYWM1YTUxYjNhMmEiLCJpYXQiOjE2MDU5ODcyNTcsIm5iZiI6MTYwNTk4NzI1NywiZXhwIjoxNjM3NTIzMjU2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.cT24aaIe8pKmgVmqEeYfndH539-FMHqc8a2_S5jmhLaOjk-ZXS1F9DJVSUlJQ7Ypu0YNGJyFCx8WvpeXlXIkipz8Xrm6A7gYij0FOiYG7ZCEW8z9Xk3GBqwmi-BjCaCL6DcLKxVExx9dqRPM-2PQF0BSh7vMEYcjkfDKDlARQ59hslFGEsIrz1ZcPrdSLKa3D89gR6-6rBQXyhYVKGpSHOiVof_r3dhZBh-SGyYnOU1MUl_VqjgzkNWmPv6ydhph8EYMavLtUZfd5DztozSI8mYlObZ-fUh7e_3PgrpzRjfSGRtQZOzTlH4Xp2xGO9wTrTDHRuhj7CSCfbE6Kl7Pj00MFUaKfs_hZHDbyjgsqjorxVJUQ2FYGVj_6mnsD-tbFwhGXUgqn4uVINN6ak5KDr20o7fS0jrlQjPo2nsKI3Xxw8I7vc4xLVyJ-32hkJlYtJgtWxvJTANP_cEiBbrQucoL9Id2g3pm-BUovNrtBItwlL6lXPmxGpx7ku4BCcv7sP9J_N-xf4Dgkxyrr2ec-9P-AENskoxBxltSuXfyvRu826OFdKFD9w2GAVJHOQxpnbZcGx9NFcP-Cwn-Koz6eVDyxWG212yc_RxgaX0r55xKga6J-oIeoEqk4FkTyaffKg5ia6XvI-3NzIKvlkxxp7db1frtrOgTmuUnvbMsteE"
                    }
                })
                .then(({ data }) => {
                    this.$router.push({ name: 'questions' })
                    this.$toast.success(data.message, "Success")
                })
                .catch(({response}) => {
                    EventBus.$emit('error', response.data.errors)
                });
        }
    }
}
</script>