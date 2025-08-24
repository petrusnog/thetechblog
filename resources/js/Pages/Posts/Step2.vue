<template>
    <div class="columns is-flex is-align-items-center is-justify-content-space-between">
        <div class="column is-full">
            <label class="label">Body</label>
            <div class="control">
                <textarea class="textarea" v-model="modelValue.body"></textarea>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps(["modelValue"])

</script>

<style></style>