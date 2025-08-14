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

      <!-- Pagination -->
      <nav class="pagination is-centered mt-6" role="navigation" aria-label="pagination">
        <a class="pagination-previous">
          Previous
        </a>
        <a class="pagination-next">
          Next
        </a>
      </nav>
    </div>
  </section>
</template>

<script setup>
  import Card from '../../Components/Card.vue'

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