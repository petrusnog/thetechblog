<template>
    <section class="section">
        <div class="container">
            <div class="title has-text-centered mb-5">📚 The Tech Blog</div>
        </div>
        <div class="container">
            <div class="is-flex is-justify-content-space-between mb-4">
                <a href="/" class="button is-info" style="color: white">
                    <i class="fa-solid fa-arrow-left mr-2"></i>
                    Back
                </a>
            </div>
            <div class="is-flex is-flex-direction-column is-align-items-center">
                <div class="card">
                    <div class="card-content">
                        <h1 class="title has-text-centered">Create a new post</h1>
                        <form @submit.prevent="submitAllData" class="steps">
                            <div class="mb-4">
                                <Step1 v-if="currentStep === 1" v-model="formData.step1"></Step1>
                                <Step2 v-if="currentStep === 2" v-model="formData.step2"></Step2>
                            </div>
                        </form>
                        <div class="is-flex is-justify-content-space-between">
                            <button class="button" @click="currentStep--" :disabled="currentStep == 1">
                                <i class="fa-solid fa-arrow-left mr-2"></i> Previous
                            </button>
                            <button v-if="currentStep === 2" class="button is-success"  @click="createPost()">
                                Create
                            </button>
                            <button v-else class="button"  @click="currentStep++">
                                Next <i class="fa-solid fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>

import { ref, reactive } from 'vue';
import { $route } from '@/ziggy';
import Step1 from './Step1.vue';
import Step2 from './Step2.vue';
import axios from 'axios';
import { toast } from 'vue3-toastify';
import "vue3-toastify/dist/index.css";

const props = defineProps({
  status: { type: Array }
})

console.log(props);

const currentStep = ref(1);

const formData = reactive({
    step1: {
        title: "",
        status: props.status,
        selectedStatus: "published"
    },
    step2: {
        body: ""
    }
});

const createPost = async () => {
    axios.post('/api/posts/store', {
        title: formData.step1.title,
        status: formData.step1.selectedStatus,
        body: formData.step2.body
    }).then(response => {
        console.log(response.data)
    }).catch(error => {
        toast(error.response.data.message)
    })
}


</script>

<style scoped>
.card {
    min-width: 1200px;
}

.section {
    background-color: #dadada;
    min-height: 100vh;
}

.content h1 {
    margin: 0;
}

.steps {
    max-width: 900px;
    margin: auto;
}
</style>