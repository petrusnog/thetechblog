<template>
    <div class="card">
        <div>
            <header class="card-header">
                <p class="card-header-title">{{ post.title }}</p>
                <span class="tag m-3" :class="post.status === 'published' ? 'is-success' : 'is-warning'">
                    {{ post.status }}
                </span>
            </header>
            <div class="card-content is-flex pt-0 pb-0">
                <div class="publishedAt px-3 py-2">{{ publishedAt }}</div>
            </div>
            <div class="card-content">
                <div class="content">
                    {{ preview }}
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <a :href="viewLink" class="card-footer-item">View</a>
            <a href="#" class="card-footer-item">Edit</a>
            <a href="#" class="card-footer-item has-text-danger">Delete</a>
        </footer>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import moment from 'moment';

const props = defineProps({
    post: { type: Object, required: true }
})

const preview = computed(() => {
    const text = props.post.body || ''
    return text.length > 150 ? text.substring(0, 150) + '...' : text
})

const  viewLink = computed(() => {
    return `posts/${props.post.id}`
})

const publishedAt = computed(() => {
    return moment(props.post.published_at).format('MM/DD/YYYY HH:mm')
})

</script>

<style>
.card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.publishedAt {
    border: 1px solid rgb(206, 206, 206);
    width: fit-content;
    font-size: 15px;
    background: rgb(206, 206, 206);
}
</style>