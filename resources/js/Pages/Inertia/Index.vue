<template>
  <div v-if="$page.props.flash.message" class="bg-violet-700 text-white">
    {{ $page.props.flash.message }}
  </div>
  <section class="text-gray-600 body-font">
  <div class="container px-5 py-24 mx-auto flex flex-wrap">
    <div class="flex flex-wrap -m-4">
      <div v-for="blog in blogs" :key="blog.id" class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
          <ul class="flex-grow">
            <div class="leading-relaxed text-base">
              件名：<Link :href="route('inertia.show', {id: blog.id})" class="text-blue-700 hover:text-blue-900">{{ blog.title }}</Link>
            </div>
            <div class="leading-relaxed text-base">
              本文：{{ blog.content }}
            </div>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  blogs: Array
})
</script>