
<template>

    <AppLayout title="Lista de categorias">
        
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-body">
                    <Link :href="route('post.create')" 
                    class="link-button-default my-3">Create</Link>

                    <table class="w-full border">
                        <thead class="bg-slate-200">
                            <tr class="border-b">
                                <th class="p-3">Id</th>
                                <th class="p-3">Image</th>
                                <th class="p-3">Title</th>
                                <th class="p-3">Slug</th>
                                <th class="p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b" v-for="c in posts.data" :key="c.id">
                                <td class="p-2">{{ c.id }}</td>
                                <td class="p-2"><img :src="'/image/post/'+c.image" class="w-16"/></td>
                                <td class="p-2">{{ c.title }}</td>
                                <td class="p-2">{{ c.slug }}</td>
                                <td class="p-2">
                                    <Link as="button" type="button" class="text-sm text-green-400 hover:text-green-700" :href="route('post.edit', c.id)">Editar</Link>
                                    <Link as="button" type="button" method="DELETE" class="text-sm text-red-400 hover:text-red-700 ml-2" :href="route('post.destroy', c.id)">Eliminar</Link>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- <template v-for="l in posts.links" :key="l">
                        <Link v-if="!l.active" class="px-2 py-1 "  :href="l.url" v-html="l.label"></Link>
                        <span v-else class="px-2 py-1 text-emerald-600 font-bold"  v-html="l.label"/>
                    </template> -->

                    <!-- <Link class="px-2 py-1" v-for="l in posts.links" :key="l" :href="l.url" v-html="l.label"/> -->
                    <Pagination class="my-4" :links="posts"/>
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<script>

import { Link } from '@inertiajs/vue3';


import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from '@/Shared/Pagination.vue';


export default {
   components:{
    AppLayout,
    Link,
    Pagination,
   },
   props:{
    posts: Object,
   }
} 
</script>
