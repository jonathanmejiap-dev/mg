<template>
    <div class="pt-5">
        <Component v-for="l in links.links" :key="l" :is="!l.active ? 'Link':'span'" 
        class="px-4 py-2 border-gray-700 text-sm font-medium rounded-md text-gray-400 bg-white hover:bg-gray-50 ml-2" 
        :class="!l.active ? '': 'text-gray-300 cursor-pointer'"  :href="l.url" v-html="l.label"/>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    components:{
        Link
    },
    props:{
        links:Object
    }
}
</script>
