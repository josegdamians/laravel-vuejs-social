<template>
    <div class="w-full lg:max-w-full">
        <div class="shadow-md mb-4 bg-white rounded-lg p-4 flex flex-col justify-between leading-normal">
            <div class="mb-8">
                <p class="text-sm flex items-center text-gray-900 font-bold mb-2"/>
                    <h3>Tu respuesta</h3>
                    <hr>
                <form @submit.prevent="create">
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-2/3">
                            <m-editor :body="body" name="new-answer">
                                <textarea class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" required name="body" v-model="body" rows="7"></textarea>
                            </m-editor>
                        </div>
                    </div>
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                            <button :disabled="isInvalid" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import MEditor from './MEditor.vue';

export default {

    props: ['questionId'],

    components: { MEditor },

    methods: {
        create() {
            axios.post(`/questions/${this.questionId}/answers`,{
                        body: this.body
                    },{
                    headers: {
                        Accept: "application/json",
                        Authorization: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiMmFjMDFiNmUxMmNiMmVlOGM1Zjc5MWRhMzcyNDVhYTVlMGQ4ZjFkNmQ5NmFmNDJmYjIwZTgyZjI2Yjc4M2JkYWU2YjdhYWM1YTUxYjNhMmEiLCJpYXQiOjE2MDU5ODcyNTcsIm5iZiI6MTYwNTk4NzI1NywiZXhwIjoxNjM3NTIzMjU2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.cT24aaIe8pKmgVmqEeYfndH539-FMHqc8a2_S5jmhLaOjk-ZXS1F9DJVSUlJQ7Ypu0YNGJyFCx8WvpeXlXIkipz8Xrm6A7gYij0FOiYG7ZCEW8z9Xk3GBqwmi-BjCaCL6DcLKxVExx9dqRPM-2PQF0BSh7vMEYcjkfDKDlARQ59hslFGEsIrz1ZcPrdSLKa3D89gR6-6rBQXyhYVKGpSHOiVof_r3dhZBh-SGyYnOU1MUl_VqjgzkNWmPv6ydhph8EYMavLtUZfd5DztozSI8mYlObZ-fUh7e_3PgrpzRjfSGRtQZOzTlH4Xp2xGO9wTrTDHRuhj7CSCfbE6Kl7Pj00MFUaKfs_hZHDbyjgsqjorxVJUQ2FYGVj_6mnsD-tbFwhGXUgqn4uVINN6ak5KDr20o7fS0jrlQjPo2nsKI3Xxw8I7vc4xLVyJ-32hkJlYtJgtWxvJTANP_cEiBbrQucoL9Id2g3pm-BUovNrtBItwlL6lXPmxGpx7ku4BCcv7sP9J_N-xf4Dgkxyrr2ec-9P-AENskoxBxltSuXfyvRu826OFdKFD9w2GAVJHOQxpnbZcGx9NFcP-Cwn-Koz6eVDyxWG212yc_RxgaX0r55xKga6J-oIeoEqk4FkTyaffKg5ia6XvI-3NzIKvlkxxp7db1frtrOgTmuUnvbMsteE"
                    }})
                    .catch(error => {
                        this.$toast.error(error.response.data.message, "Error");
                    })
                    .then(({data}) => {
                        this.$toast.success(data.message, "success");
                        this.body = '';
                        this.$emit('created', data.answer);
                    });
        }
    },

    data() {
        return {
            body:''
        }
    },

    computed: {
        isInvalid() {
            return  this.body.length < 10;
        }
    }
}
</script>