<template>
<div class="columns is-flex is-align-items-center is-justify-content-space-between">
  <div class="column is-four-fifths">
    <label class="label">Title</label>
    <div class="control">
      <input class="input" v-model="modelValue.title">
    </div>
  </div>
  <div class="column auto">
    <label class="label">Status</label>
    <div class="control">
      <div class="select">
        <select v-model="modelValue.selectedStatus">
          <option disabled>Select status</option>
          <option v-for="status in modelValue.status" :value="status">{{ status }}</option>
        </select>
      </div>
    </div>
  </div>
</div>
</template>

<script setup>

const props = defineProps(['modelValue'])

</script>
