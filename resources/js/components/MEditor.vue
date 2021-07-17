<template>
    <div class="flex flex-wrap">
        <div class="w-full">
            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :href="tabId('write','#')" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(1)" v-bind:class="{'text-blue-600 bg-white': openTab !== 1, 'text-white bg-blue-600': openTab === 1}">
                        Redactar
                    </a>
                </li>
                <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                    <a :href="tabId('preview','#')" class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal" v-on:click="toggleTabs(2)" v-bind:class="{'text-blue-600 bg-white': openTab !== 2, 'text-white bg-blue-600': openTab === 2}">
                        Vista previa
                    </a>
                </li>
            </ul>
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                <div class="px-4 py-5 flex-auto">
                    <div class="tab-content tab-space">
                        <div v-bind:class="{'hidden': openTab !== 1, 'block': openTab === 1}" :id="tabId('write')">
                            <slot></slot>
                        </div>
                        <div v-html="preview" v-bind:class="{'hidden': openTab !== 2, 'block': openTab === 2}" :id="tabId('preview')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MarkdownIt from 'markdown-it';
import prism from 'markdown-it-prism';
import autosize from 'autosize';

const md = new MarkdownIt();
md.use(prism);

export default {
    props: ['body','name'],
    name: "blue-tabs",

    data() {
        return {
            openTab: 1
        }
    },

    computed: {
        preview() {
            return md.render(this.body);
        }
    },

    methods: {
        toggleTabs: function(tabNumber){
            this.openTab = tabNumber
        },

        tabId (tabName, hash = '') {
            return `${hash}${tabName}${this.name}`;
        }
    },

    updated() {
        autosize(this.$el.querySelector('textarea'));
    }
}
</script>