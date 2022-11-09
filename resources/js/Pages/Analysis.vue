<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { reactive, onMounted } from 'vue';
import { getToday } from '@/common';
import Chart from '@/Components/Chart.vue';
import ResultTable from '@/Components/ResultTable.vue';

const form = reactive({
    startDate: null,
    endDate: null,
    type: 'perDay',
})

const data = reactive({})

const getData = async() => {
    try {
        await axios.get('/api/analysis/', {
            params: {
                startDate: form.startDate,
                endDate: form.endDate,
                type: form.type

            }
        })
        .then( res => {
            data.data = res.data.data
            data.labels = res.data.labels
            data.totals = res.data.totals
            data.type = res.data.type
            // console.log(res.data)
        })
    } catch (e) {
        console.log(e.message);
    }
}

onMounted(() => {
    form.startDate = getToday()
    form.endDate = getToday()
})
</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                データ分析
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="getData">
                            分析方法<br>
                            <input type="radio" name="type" value="perDay" v-model="form.type" checked><span class="mr-2">日別</span>
                            <input type="radio" name="type" value="perMonth" v-model="form.type"><span class="mr-2">月別</span>
                            <input type="radio" name="type" value="perYear" v-model="form.type"><span class="mr-2">年別</span>
                            <input type="radio" name="type" value="decile" v-model="form.type"><span class="mr-2">デシル分析</span>
                            <br>
                            From:<input type="date" name="start_date" v-model="form.startDate">
                            To:<input type="date" name="end_date" v-model="form.endDate"><br>
                            <button class="flex mx-auto mt-4 px-5 py-2.5 relative rounded group overflow-hidden font-medium bg-purple-50 text-indigo-600">
                                <span class="absolute top-0 left-0 flex w-full h-0 mb-0 transition-all duration-200 ease-out transform translate-y-0 bg-indigo-600 group-hover:h-full opacity-90"></span>
                                <span class="relative group-hover:text-white">分析する</span>
                            </button>
                        </form>
                        <div v-show="data.data">
                            <Chart :data="data" />
                            <ResultTable :data="data" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
