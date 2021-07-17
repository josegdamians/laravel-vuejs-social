<template>
    <div>
        <div class="text-xs float-right">
            {{ postDate }}
            <div class="md:flex mt-2">
                <a :href="user.url" class="pr-2"><img class="rounded-full" :src="user.avatar"></a>
                <a class="mt-1" :href="user.url">{{ user.name }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['model','label'],

    computed: {
        postDate() {
            return this.label + " " + this.model.created_date;
        }
    },

    data() {
        return {
            user: this.model.user
        }
    }
}
</script>