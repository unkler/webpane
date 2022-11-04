<template>
  <section class="text-gray-600 body-font">
  <div>
    <div class="m-4">
      <div class="p-4 lg:w-1/2 md:w-full">
        <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8">
          <div class="flex-grow">
            <div class="leading-relaxed text-base">
              id: {{ blog.id }}
            </div>
            <div class="leading-relaxed text-base">
              タイトル: {{ blog.title }}
            </div>
            <div class="leading-relaxed text-base">
              コンテンツ: {{ blog.content }}
            </div>
            <div>
              <button @click="deleteConfirm(blog.id)" class=" text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">削除</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</template>
<script setup>
import { Inertia } from '@inertiajs/inertia'

defineProps ({
  blog: Object,
})

const deleteConfirm = id => {
  Inertia.delete(`/inertia/${id}`, {
    onBefore: () => confirm('本当に削除しますか？'),
  })
}
</script>