<template>
<AppLayout title="Create post">
    
    <JetFormSection @submitted="submit" class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <template #title>
                Create Category
        </template>
        <template #description> 
                Description Category
        </template>
        <template #form>
            <div class="col-span-6">
                <jet-input-label for="">Titulo</jet-input-label>
                <jet-input-error :message="errors.title"></jet-input-error>
                <jet-text-input class="mt-1 w-full" type="text" v-model="form.title"/>
                
                <jet-input-label for="">Slug</jet-input-label>
                <jet-input-error :message="errors.slug"></jet-input-error>
                <jet-text-input  class="mt-1 w-full" type="text" v-model="form.slug"  />
            </div>
        </template>
        <template #actions>
            
                <jet-primary-button class="mt-1" type="submit">
                  Send
                </jet-primary-button>
            
        </template>
    </JetFormSection>

            <!-- <div>
                <form @submit.prevent="submit">
                    <label for="">Titulo</label>
                    <input type="text" v-model="form.title">
                    <div v-if="errors.title">{{ errors.title }}</div>

                    <label for="">Slug</label>
                    <input type="text" v-model="form.slug"  >
                    <div v-if="errors.slug">{{ errors.slug }}</div>

                    <input type="submit" value="Enviar">
                </form>
            </div> -->
        
</AppLayout>
</template>

<script>

import { useForm, router} from '@inertiajs/vue3';

import AppLayout from "@/Layouts/AppLayout.vue";
import JetFormSection from "@/Components/FormSection.vue";
import JetInputLabel from "@/Components/InputLabel.vue";
import JetInputError from "@/Components/InputError.vue";
import JetTextInput from "@/Components/TextInput.vue";
import JetPrimaryButton from "@/Components/PrimaryButton.vue";

export default{
    components:{
        AppLayout,
        JetFormSection,
        JetInputLabel,
        JetInputError,
        JetTextInput,
        JetPrimaryButton,
    },
   props:{
    errors: Object
   },
    setup() {
        const form = useForm({
            title: null,
            slug: null,
        })
        
        function submit(){
            //codigo
            // alert('mensaje')
            router.post(route("category.store"), form);
        }
        
        return { form, submit }
    }
}
</script>