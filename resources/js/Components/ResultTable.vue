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
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">平均額</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">合計金額</th>
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
  <div v-if="data.type === 'rfm'" class="lg:w-2/3 w-full mx-auto overflow-auto">
    <h2 class="text-center text-2xl my-4">RFM 分析結果</h2>
    <div class="text-center my-2">
      合計：{{ data.totals }}人
    </div>
    <h3 class="text-center text-xl">RFMランク毎の人数</h3>
    <table class="table-auto w-full text-left whitespace-no-wrap">
      <thead>
        <tr>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Rank</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">R</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">F</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">M</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="rfm in data.eachCount" :key="rfm.rank">
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.rank }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.r }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.f }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rfm.m }}</td>
        </tr>
      </tbody>
    </table>
    <h3 class="text-center text-xl mt-4">RとFの集計表</h3>
    <table class="table-auto w-full text-left whitespace-no-wrap">
      <thead>
        <tr>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">rRank</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_1</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_2</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_3</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">f_4</th>
          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">f_5</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="rf in data.data" :key="rf.rRank">
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.rRank }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_5 }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_4 }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_3 }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_2 }}</td>
          <td class="px-4 py-3 border-b-2 border-gray-200">{{ rf.f_1 }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>