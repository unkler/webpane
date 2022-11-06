<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {nl2br } from '@/common'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

defineProps({
  item: Object
})

const deleteItem = id => {
  Inertia.delete(route('items.destroy', {item: id}), {
    onBefore: () => confirm('本当に削除しますか？')
  })
}

</script>

<template>
    <Head title="商品詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              商品詳細
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                  <section class="text-gray-600 body-font relative">
                      <div class="container px-5 py-4 mx-auto">
                        <div class="lg:w-1/2 md:w-2/3 mx-auto">
                          <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                                <div id="name" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ item.name }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="memo" class="leading-7 text-sm text-gray-600">詳細</label>
                                <div v-html="nl2br(item.memo)" id="memo" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="price" class="leading-7 text-sm text-gray-600">価格</label>
                                <div id="price" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ item.price }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="status" class="leading-7 text-sm text-gray-600">販売中/停止中</label>
                                <div id="status" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  <span v-if="item.is_selling === 1">販売中</span>
                                  <span v-if="item.is_selling === 0">停止中</span>
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <Link as="button" :href="route('items.edit', {item: item.id})" class="flex mx-auto px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-purple-50 text-indigo-600">
                                <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-indigo-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">商品編集</span>
                              </Link>
                            </div>
                            <div class="p-2 w-full">
                              <button @click="deleteItem(item.id)" class="flex mx-auto px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-bray-50 text-gray-600">
                                <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-gray-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">商品削除</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </section>
                </div>
              </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
