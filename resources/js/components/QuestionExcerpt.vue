<template>
    <div class="flex px-4 my-4 py-4 bg-white rounded-lg shadow-md mb-4">
        <div class="flex-initial px-4 py-2 m-2 counters">
            <div class="vote">
                <strong>{{ question.votes_count }}</strong> {{ str_plural('vote',question.votes_count) }}
            </div>
            <div class="statusClasses">
                <strong>{{ question.answers_count }}</strong> {{ str_plural('answer',question.answers_count) }}
            </div>
            <div class="view">
                <strong>{{ question.views }}</strong> {{ str_plural('view',question.views) }}
            </div>
        </div>
        <div class="flex-auto px-4 py-2 m-2">
            <div class="flex">
                <router-link :to="{ name: 'questions.show', params: { slug:question.slug } }" class="text-2xl font-bold text-indigo-500 hover:text-blue-800">{{ question.title }}</router-link>
                <div class="ml-auto">
                    <router-link :to="{ name: 'questions.edit', params: { id: question.id } }"  class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Editar</router-link>
                    <button type="submit" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" @click="destroy">Borrar</button>
                </div>
            </div>
            <p class="lead">
                Pregunta realizada por 
                <a href="#" class="text-indigo-500">{{ question.user.name }}</a>
                <small>{{ question.created_date }}</small>
            </p>
            <div class="mt-2 text-gray-600 excerpt">{{ question.excerpt }}</div>
        </div>
    </div>
</template>

<script>
import destroy from '../mixins/destroy'
import eventBus from '../event-bus'

export default {
    mixins: [destroy],

    props: ['question'],

    methods: {
        str_plural(str,count) {
            return str + (count > 1 ? 's' : '')
        },
        delete () {
            this.$root.disableInterceptor();
            axios.delete(`/questions/${this.question.id}`,{
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMmFjMDFiNmUxMmNiMmVlOGM1Zjc5MWRhMzcyNDVhYTVlMGQ4ZjFkNmQ5NmFmNDJmYjIwZTgyZjI2Yjc4M2JkYWU2YjdhYWM1YTUxYjNhMmEiLCJpYXQiOjE2MDU5ODcyNTcsIm5iZiI6MTYwNTk4NzI1NywiZXhwIjoxNjM3NTIzMjU2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.cT24aaIe8pKmgVmqEeYfndH539-FMHqc8a2_S5jmhLaOjk-ZXS1F9DJVSUlJQ7Ypu0YNGJyFCx8WvpeXlXIkipz8Xrm6A7gYij0FOiYG7ZCEW8z9Xk3GBqwmi-BjCaCL6DcLKxVExx9dqRPM-2PQF0BSh7vMEYcjkfDKDlARQ59hslFGEsIrz1ZcPrdSLKa3D89gR6-6rBQXyhYVKGpSHOiVof_r3dhZBh-SGyYnOU1MUl_VqjgzkNWmPv6ydhph8EYMavLtUZfd5DztozSI8mYlObZ-fUh7e_3PgrpzRjfSGRtQZOzTlH4Xp2xGO9wTrTDHRuhj7CSCfbE6Kl7Pj00MFUaKfs_hZHDbyjgsqjorxVJUQ2FYGVj_6mnsD-tbFwhGXUgqn4uVINN6ak5KDr20o7fS0jrlQjPo2nsKI3Xxw8I7vc4xLVyJ-32hkJlYtJgtWxvJTANP_cEiBbrQucoL9Id2g3pm-BUovNrtBItwlL6lXPmxGpx7ku4BCcv7sP9J_N-xf4Dgkxyrr2ec-9P-AENskoxBxltSuXfyvRu826OFdKFD9w2GAVJHOQxpnbZcGx9NFcP-Cwn-Koz6eVDyxWG212yc_RxgaX0r55xKga6J-oIeoEqk4FkTyaffKg5ia6XvI-3NzIKvlkxxp7db1frtrOgTmuUnvbMsteE"
                    }
                })
                .then(res => {
                    this.$toast.success(res.data.message, "Success", { timeout:2000 });
                    eventBus.$emit('deleted', this.question.id)
                    this.$root.enableInterceptor();
                });
        }
    },

    computed: {
        statusClasses() {
            return [
                'status',
                this.question.status
            ]
        }
    }
}
</script>