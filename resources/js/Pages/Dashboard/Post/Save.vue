<template>
    <app-layout>
        <jet-form-section @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <template #title> Create Post A</template>
            <template #description> Create a Post </template>
            <template #form>
                <div class="col-span-6">
                    <jet-label>Title</jet-label>
                    <jet-input class="w-full" type="text" v-model="form.title" />
                    <jet-input-error :message="errors.title" />
                </div>


                <div class="col-span-6">
                    <jet-label value="Slug" />
                    <jet-input class="w-full" type="text" v-model="form.slug" />
                    <jet-input-error :message="errors.slug" />
                </div>
                <div class="col-span-6">
                    <jet-label value="Date" />
                    <jet-input class="w-full" type="date" v-model="form.date" />
                    <jet-input-error :message="errors.date" />
                </div>
                <div class="col-span-6">
                    <jet-label value="Text" />
                    <!-- <textarea class="rounded-md w-full border-gray-300" v-model="form.text"></textarea> -->
                    <ckeditor :editor="editor.editor" v-model="form.text" ></ckeditor>
                    <!-- <textarea
         class="rounded-md w-full border-gray-300"
         v-model="form.text"></textarea> -->

                    <!-- <ckeditor :editor="editor.editor" v-model="form.text"></ckeditor> -->

                    <jet-input-error :message="errors.text" />
                </div>
                <div class="col-span-6">
                    <jet-label value="Description" />
                    <textarea class="rounded-md w-full border-gray-300" v-model="form.description"></textarea>
                    <jet-input-error :message="errors.description" />
                </div>
                <div class="col-span-6">
                    <jet-label value="Posted" />

                    <select class="rounded-md w-full border-gray-300" v-model="form.posted">
                        <option value="not">No</option>
                        <option value="yes">Yes</option>
                    </select>

                    <jet-input-error :message="errors.posted" />
                </div>
                <div class="col-span-6">
                    <jet-label value="Type" />

                    <select class="rounded-md w-full border-gray-300" v-model="form.type">
                        <option value="adverd">Adverd</option>
                        <option value="post">Post</option>
                        <option value="course">Course</option>
                        <option value="movie">Movie</option>
                    </select>

                    <jet-input-error :message="errors.type" />
                </div>
                
                <div class="col-span-6">
                    <jet-label value="Category" />
                    <select class="rounded-md w-full border-gray-300" v-model="form.category_id">
                        <option value=""></option>
                        <option v-for="c in categories" :value="c.id" :key="c.id">{{ c.title }}</option>
                    </select>
                    <jet-input-error :message="errors.category_id" />
                </div>

                <div class="col-span-6">
                  
                    <jet-label value="Image"/>
                    <jet-input class="w-full" type="file" @input="form.image = $event.target.files[0]"/>
                    <jet-input-error :message="errors.image"/>
                    <!-- <jet-button @click="upload">Subir</jet-button>  -->
                    
                </div>

                
<!-- 
                <div class="col-span-6">
                    <o-field class="file">
                        <o-upload v-model="image">
                        <o-button tag="a" variant="primary">
                            <fa icon="fa-upload"/>
                            <span> Subir imagen</span>
                        </o-button>
                        </o-upload>
                        <span class="file-name" v-if="file">
                        {{ file.name }}
                        </span>
                    </o-field>
                </div> -->
                <!-- <div class="col-span-6" v-if="post.id">
                    <o-field>
                        <o-upload v-model="dropFile" multiple drag-drop>
                            <section class="text-center">
                            <p>
                                <fa icon="fa-upload"/>
                            </p>
                            <p>Suelte sus archivos aquí o haga clic para cargar</p>
                            </section>
                        </o-upload>
                    </o-field>
                </div> -->
                <!-- <div class="tags">
                    <span v-for="(file, index) in dropFiles" :key="index">
                        {{ file.name }}
                        <o-button icon-left="times" size="small" native-type="button" @click="deleteDropFile(index)">
                        </o-button>
                    </span>
                </div> -->
            </template>
            <template #actions>
                
                <jet-button type= "submit">Send</jet-button>
            </template>
            
        </jet-form-section>
        <div class="container mb-4" v-if="post.image">
            <div class="card">
                <div class="card-body">
                    <jet-button  @click="form.delete(route('post.image-delete', form.id))">Delete</jet-button>
                    <a :href="'/image/post/'+post.image" download="" class="ml-2 mt-4 link-button-default">Descargar</a>
                    <div class="col-span-3 " v-if="post.image">
                        <div class="card ">
                            <div class="card-body">
                                <img class="max-w-xs" :src="'/image/post/'+post.image" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </app-layout>
</template>
 
<script>
import { useForm, router} from "@inertiajs/vue3";

import AppLayout from "@/Layouts/AppLayout.vue";
import JetFormSection from "@/Components/FormSection.vue";
import JetLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetInput from "@/Components/TextInput.vue";
import JetButton from "@/Components/PrimaryButton.vue";

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';//para CKeditor


export default {
    components: {
        AppLayout,
        JetInput,
        JetInputError,
        JetLabel,
        JetButton,
        JetFormSection,
        ClassicEditor,
        // ClassicEditor
    },
    data() {
        return {
            editor: {
                editor: ClassicEditor,
            }
            // editor: {
            //     editor: ClassicEditor
            // }
        }
    },
    props: {
        errors: Object,
        post: {
            type: Object,
            default: {
                id: "",
                title: "",
                slug: "",
                date: "",
                description: "",
                text: "",
                type: "",
                posted: "",
                category_id: "",
                image: "",
            },
        },
        categories: Object,
       
    },

    setup(props) {
        const form = useForm({
            id: props.post.id,
            title: props.post.title,
            slug: props.post.slug,
            date: props.post.date,
            description: props.post.description,
            text: props.post.text,
            type: props.post.type,
            posted: props.post.posted,
            category_id: props.post.category_id,
        });

        function submit() {
            console.log(form.id);
            if (form.id == "") {
                router.post(route("post.store"), form);
            }
            else{
                router.post(route("post.update", form.id),{
                    _method: "put",
                    title: form.title,
                    date: form.date,
                    description: form.description,
                    text: form.text,
                    type: form.type,
                    posted:form.posted,
                    category_id: form.category_id,
                    image: form.image,
                });
            }
            
        }

        return { form, submit};
    },
    watch:{
        dropFile:{
            handler(val){
                console.log(val);
                
                
            }
        }
    }
};
</script>