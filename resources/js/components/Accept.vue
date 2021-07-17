<template>
    <div>
        <a v-if="authorize('accept',answer)" title="Marcar esta respuesta como mejor respuesta" :class="classes" @click.prevent="create">
            <i class="fas fa-check fa-2x"></i>
        </a>
        <a v-if="accepted" title="El propietario de esta pregunta acepto esta respuesta como mejor respuesta" :class="classes">
            <i class="fas fa-check fa-2x"></i>
        </a>
    </div>
</template>
<script>
import EventBus from '../event-bus';

export default {
    props: ['answer'],

    data() {

        return {

            isBest: this.answer.is_best,
            id: this.answer.id

        }
    },

    created() {
        EventBus.$on('accepted',id => {
            this.isBest = (id === this.id);
        });
    },

    methods: {
        create() {
            axios.post(`/answers/${this.id}/accept`)
            .then(res => {
                this.$toast.success(res.data.message,"!Bien",{
                    timeout: 3000,
                    position: 'topCenter'
                });
                this.isBest = true;
                EventBus.$emit('accepted',this.id);
            });
        }
    },

    computed: {

        canAccept() {

            return this.authorize('accept',this.answer);

        },

        accepted() {

            return !this.canAccept && this.isBest;

        },

        classes() {

            return [
                'mt-2',
                this.isBest ? 'vote-accepted' : ''
            ];

        }

    }
}
</script>