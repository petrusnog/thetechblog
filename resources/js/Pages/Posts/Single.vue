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
            <div class="card">
                <div class="card-content">
                    <div class="content is-large">
                        <div class="is-flex is-align-items-center is-justify-content-center mb-4">
                            <span class="tag mr-3" :class="post.data.status === 'published' ? 'is-success' : 'is-warning'">
                                {{ post.data.status }}
                            </span>
                            <h1 class="title has-text-centered">{{ post.data.title }}</h1>
                        </div>
                        <p class="is-4">{{ post.data.body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const props = defineProps({
    post: { type: Object, required: true }
});
</script>

<style scoped>
.section {
    background-color: #dadada;
    min-height: 100vh;
}

.content h1 {
    margin: 0;
}
</style>