<answer :answer="{{ $answer }}" inline-template>
    <div class="flex post">
        <vote :model="{{ $answer }}" name="answer"></vote>
        <div class="flex-auto mb-8 mt-8 w-full">
            <form v-if="editing" @submit.prevent="update">
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-2/3">
                        <textarea v-model="body" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" rows="7"></textarea>
                    </div>
                </div>
                <button :disabled="isInvalid"class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Actualizar</button>
                <button class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1" @click="cancel" type="button">Cancelar</button>
            </form>
            <div v-else>
                <div v-html="bodyHtml"></div>
                <div class="flex">
                    <div class="ml-auto">
                        @can('update',$answer)
                            <button type="button" @click.prevent="edit" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Editar</button>
                        @endcan
                        @can('delete',$answer)
                            <button @click="destroy" class="bg-blue-500 text-white active:bg-blue-600 font-bold text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1">Borrar</button>
                        @endcan
                    </div>
                </div>
                <div class="px-4 w-full p-10">
                    <user-info :model="{{ $answer }}" label="respuesta"></user-info>
                </div>
            </div>
        </div>
    </div>
</answer>