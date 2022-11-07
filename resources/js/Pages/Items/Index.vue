<script setup>
import FlashMessage from '@/Components/FlashMessage.vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

defineProps({
    items: Array,
})

</script>


<template>
    <Head title="商品管理" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                商品管理
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-4 mx-auto">
                                <FlashMessage />
                                <div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
                                    <Link as="button" :href="route('items.create')" class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">新規登録</Link>
                                </div>
                                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                    <table class="table-auto w-full text-left whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">商品ID</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">価格</th>
                                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">販売中/停止中</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="item in items" :key="item.id">
                                                <td class="px-4 py-3 border-b-2 border-gray-200 text-blue-500 underline">
                                                    <Link :href="route('items.show', {item: item.id})">
                                                        {{ item.id}}
                                                    </Link> 
                                                </td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.name }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.price }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.is_selling}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>