<template>
  <form @submit.prevent="submitFunction">
    <div v-if="errors.title" class="text-sm text-red-700">{{ errors.title }}</div>
    <div><input type="text" name="title" v-model="form.title"></div>
    <div v-if="errors.content" class="text-sm text-red-700">{{ errors.content }}</div>
    <div><input type="text" name="content" v-model="form.content"></div>
    <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
  </form>
</template>

<script setup>
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'

defineProps({
  errors: Object
})

const form = reactive({
  title: null,
  content: null,
})

const submitFunction = () => {
  Inertia.post('/inertia', form)
}
</script>