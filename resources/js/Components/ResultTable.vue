<script setup>
import dayjs from 'dayjs';

const props = defineProps({
  data: Object
})
</script>

<template>
  <div v-if="data.type === 'perDay' || data.type === 'perMonth' || data.type === 'perYear'" class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
          <thead>
              <tr>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">年月日</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">金額</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="item in data.data" :key="item.date">
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ dayjs(item.date).format('YYYY-MM-DD') }}</td>
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ Number(item.total).toLocaleString()}}円</td>
              </tr>
          </tbody>
      </table>
  </div>
  <div v-if="data.type === 'decile'" class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
          <thead>
              <tr>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">グループ</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">平均額</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">合計金額</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">構成比</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="item in data.data" :key="item.date">
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.decile }}</td>
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ Number(item.average).toLocaleString()}}円</td>
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ Number(item.totalPerGroup).toLocaleString()}}円</td>
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.totalRatio }}%</td>
              </tr>
          </tbody>
      </table>
  </div>
</template>