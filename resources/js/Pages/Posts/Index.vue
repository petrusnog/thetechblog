<template>
  <section class="section">
    <div class="container">
      <h1 class="title has-text-centered mb-5">📚 The Tech Blog</h1>

      <!-- Cards -->
      <div class="columns is-multiline">
        <div v-for="post in posts.data" :key="post.id" class="column is-one-third">
          <Card :post="post"></Card>
        </div>
      </div>

      <div class="is-flex is-justify-content-center gap-2 mt-4">
        <template v-for="link in posts.links" :key="link.url">
          <Link v-if="link.url" :href="link.url" v-html="link.label"
            class="pagination-item button is-info px-3 py-1 mr-4 border rounded"
            :class="{ 'is-success font-bold': link.active }" />
          <span v-else v-html="link.label" class="button px-3 py-1 mr-4" disabled></span>
        </template>
      </div>
    </div>
  </section>
</template>

<script setup>
import Card from '../../Components/Card.vue'
import { Link } from '@inertiajs/vue3'

// props vindas do controller: posts (paginated) e filters atuais
const props = defineProps({
  posts: { type: Object, required: true },
  filters: { type: Object, default: () => ({}) }
})

</script>

<style scoped>
.section {
  background-color: #dadada;
}

.card {
  height: 100%;
  display: flex;
  flex-direction: column;
}

.card-footer {
  margin-top: auto;
}

.pagination-link {
  cursor: pointer;
}
</style>