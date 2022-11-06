<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {nl2br } from '@/common'
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia'

defineProps({
  customer: Object
})

const deleteCustomer = id => {
  Inertia.delete(route('customers.destroy', {customer: id}), {
    onBefore: () => confirm('本当に削除しますか？')
  })
}

</script>

<template>
    <Head title="顧客詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              顧客詳細
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
                                <label for="name" class="leading-7 text-sm text-gray-600">顧客名</label>
                                <div id="name" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.name }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="kana" class="leading-7 text-sm text-gray-600">顧客名(カナ)</label>
                                <div id="kana" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.kana }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="tel" class="leading-7 text-sm text-gray-600">電話番号</label>
                                <div id="tel" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.tel }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                <div id="email" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.email }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="postcode" class="leading-7 text-sm text-gray-600">郵便番号</label>
                                <div id="postcode" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.postcode }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                <div id="address" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.address }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="birthday" class="leading-7 text-sm text-gray-600">誕生日</label>
                                <div id="birthday" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  {{ customer.birthday }}
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="gender" class="leading-7 text-sm text-gray-600">性別</label>
                                <div id="gender" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                  <span v-if="customer.gender === 0">男性</span>
                                  <span v-if="customer.gender === 1">女性</span>
                                  <span v-if="customer.gender === 2">その他</span>
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <div class="relative">
                                <label for="memo" class="leading-7 text-sm text-gray-600">詳細</label>
                                <div v-html="nl2br(customer.memo)" id="memo" class="border-b-2 text-base text-gray-700 py-1 px-3">
                                </div>
                              </div>
                            </div>
                            <div class="p-2 w-full">
                              <Link as="button" :href="route('customers.edit', {customer: customer.id})" class="flex mx-auto px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-purple-50 text-indigo-600">
                                <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-indigo-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">顧客編集</span>
                              </Link>
                            </div>
                            <div class="p-2 w-full">
                              <button @click="deleteCustomer(customer.id)" class="flex mx-auto px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-bray-50 text-gray-600">
                                <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-gray-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">顧客削除</span>
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
