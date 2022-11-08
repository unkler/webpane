<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { onMounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import dayjs from 'dayjs';

const props = defineProps({
  items: Array,
  order: Array,
})
</script>

<template>
    <Head title="購買履歴　詳細画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              購買履歴　詳細画面
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                      <section class="text-gray-600 body-font relative">
                        <form @submit.prevent="storePurchase">
                          <div class="container px-5 py-4 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label class="leading-7 text-sm text-gray-600">日付</label>
                                    <div class="border-b-2 text-base text-gray-700 py-1 px-3">
                                      {{ dayjs(props.order[0].created_at).format('YYYY/MM/DD') }}
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div>
                                    <label class="leading-7 text-sm text-gray-600">顧客名</label>
                                    <div class="border-b-2 text-base text-gray-700 py-1 px-3">
                                      {{ props.order[0].customer_name }}
                                    </div>
                                  </div>
                                </div>
                                <div class="w-full mx-auto mt-8 overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">商品ID</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">価格</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">小計</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in props.items" :key="item.id">
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.item_id}}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.item_name }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.item_price }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.quantity }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.subtotal }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-2 w-full">
                                  <label class="leading-7 text-sm text-gray-600">合計価格</label>
                                  <div class="border-b-2 text-base text-gray-700 py-1 px-3">
                                    {{ props.order[0].total }}<span class="text-sm">円</span>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <label class="leading-7 text-sm text-gray-600">ステータス</label>
                                  <div v-if="props.order[0].status == true"  class="border-b-2 text-base text-gray-700 py-1 px-3">
                                    未キャンセル
                                  </div>
                                  <div v-if="props.order[0].status == false"  class="border-b-2 text-base text-gray-700 py-1 px-3">
                                    キャンセル済み
                                  </div>
                                </div>
                                <div v-if="props.order[0].status == false" class="p-2 w-full">
                                    <label class="leading-7 text-sm text-gray-600">キャンセル日</label>
                                    <div class="border-b-2 text-base text-gray-700 py-1 px-3">
                                      {{ dayjs(props.order[0].updated_at).format('YYYY/MM/DD') }}
                                    </div>
                                </div>

                                <div v-if="props.order[0].status == true" class="p-2 w-full">
                                  <Link as="button" :href="route('purchases.edit', { purchase: props.order[0].id })" class="flex mx-auto px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-purple-50 text-indigo-600">
                                    <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-indigo-600 group-hover:h-full opacity-90"></span>
                                    <span class="relative group-hover:text-white">編集</span>
                                  </Link>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                      </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
