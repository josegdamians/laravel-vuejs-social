<template>
    <div class="flex">
        <div class="col mr-5">
            <button :disabled="isFirst" @click="prev" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Newer</button>
        </div>
        <div class="col mr-5">
            {{ pagesInfo }}
        </div>
        <div class="col">
            <button :disabled="isLast" @click="next" class="bg-transparent hover:bg-blue-500 text-blue-500 font-semibold hover:text-white py-1 px-2 border border-blue-500 hover:border-transparent rounded">Older</button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['meta','links'],

    computed: {
        pagesInfo() {
            let currentPage = this.meta.current_page || 1,
                lastPage = this.meta.last_page || 1;
            return `Page ${currentPage} of ${lastPage}`
        },

        isFirst() {
            return this.meta.current_page === 1;
        },

        isLast() {
            return this.meta.current_page === this.meta.last_page;
        }
    },

    methods: {
        switchPage() {
            this.$router.push({
                name: 'questions',
                query: {
                    page: this.meta.current_page
                }
            });
        },

        prev() {
            if(!this.isFirst) {
                this.meta.current_page--;
            }

            this.switchPage();
        },

        next() {
            if(!this.isLast) {
                this.meta.current_page++;
            }

            this.switchPage();
        }
    }
}
</script>