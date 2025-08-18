<template>
  <section class="section">
    <div class="container">
      <h1 class="title has-text-centered mb-5">📚 The Tech Blog</h1>

      <div class="is-flex is-justify-content-center">
        <!-- Search Form -->
        <div class="field mr-3">
          <label class="label">Search:</label>
          <div class="control">
            <input type="text" v-model="search" placeholder="Search posts"
              class="input border p-2 mb-4 mr-4 w-full rounded">
          </div>
        </div>

        <!-- Order -->
        <div class="field mr-3">
          <div class="label">Order:</div>
          <div class="control">
            <div class="select is-fullwidth">
              <select v-model="order" class="border p-2 mb-4 w-full rounded">
                <option value="asc">ASC</option>
                <option value="desc">DESC</option>
              </select>
            </div>
          </div>
        </div>

        <!-- Order By -->
        <div class="field mr-3">
          <div class="label">Order by:</div>
          <div class="control">
            <div class="select">
              <select v-model="orderBy" name="orderBy" id="orderBy" class="border p-2 mb-4 w-full rounded">
                <template v-for="column in orderableColumns" :key="column">
                  <option :value="column">{{ column }}</option>
                </template>
              </select>
            </div>
          </div>
        </div>
      </div>

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
import { Link, router } from '@inertiajs/vue3'
import { debounce } from 'lodash'
import { ref, watch } from 'vue'
import { $route } from '@/ziggy'

const props = defineProps({
  posts: { type: Object, required: true },
  orderableColumns: { type: Array },
  filters: { type: Object, default: () => ({}) }
})

// Search system
const search = ref(props.filters.search)
const order = ref(props.filters.order ?? 'asc')
const orderBy = ref(props.filters.orderBy ?? 'title')

const performSearch = debounce((value = "", order = "asc", orderBy = "title") => {
  if (!value) {
    router.get(
      $route('posts.index'),
      { order: order, orderBy: orderBy },
      { preserveState: true, replace: true }
    )
    return
  }

  router.get(
    $route('posts.index'),
    { search: value, order: order, orderBy: orderBy  },
    { preserveState: true, replace: true }
  )
}, 500)

watch(search, (searchValue) => {
  performSearch(searchValue, order.value, orderBy.value)
})

watch(order, (orderValue) => {
  performSearch(search.value, orderValue, orderBy.value)
})

watch(orderBy, (orderByValue) => {
  performSearch(search.value, order.value, orderByValue)
})
// End of search system

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

.select select {
  padding-right: 2.5em !important;
}
</style>