<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import MicroModal from '@/Components/MicroModal.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { getToday } from '@/common'

const props = defineProps({
  items: Array,
})

const itemList = ref([])

const form = reactive({
  date: null,
  customer_id: null,
  status: true,
  items: [],
})

const quantity = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']

const totalPrice = computed(() => {
  let total = 0
  itemList.value.forEach( item => {
    total += item.price * item.quantity
  })
  return total
})

const storePurchase = () => {
  itemList.value.forEach( item => {
    if(item.quantity > 0) {
      form.items.push({
        id: item.id,
        quantity: item.quantity,
      })
    }
  })
  Inertia.post('/purchases', form)
}

const setCustomerId = id => {
    form.customer_id = id
}

onMounted(() => {
  form.date = getToday()
  props.items.forEach( item => {
    itemList.value.push({
      id: item.id,
      name: item.name,
      price: item.price,
      quantity: 0,
    })
  })
})
</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              購入画面
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
                              <ValidationErrors class="md-4" />
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                    <input type="date" id="date" name="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div>
                                    <label for="customer" class="leading-7 text-sm text-gray-600">顧客名</label>
                                    <MicroModal @update:customerId="setCustomerId" />
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
                                            <tr v-for="item in itemList" :key="item.id">
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.id}}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.name }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.price }}</td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">
                                                  <select name="quantity" v-model="item.quantity">
                                                    <option v-for="q in quantity" :key="q" :value="q">
                                                      {{ q }}
                                                    </option>
                                                  </select>
                                                </td>
                                                <td class="px-4 py-3 border-b-2 border-gray-200">{{ item.price * item.quantity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="p-2 w-full mt-8 text-center">
                                  <div>
                                    <label for="price" class="leading-7 text-sm text-gray-600">合計価格</label>
                                    <div id="price" name="price" class="w-full border-b-2 border-gray-300 text-xl">{{ totalPrice }}円</div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <button class="flex mx-auto px-5 py-2.5 rounded group overflow-hidden font-medium bg-purple-50 text-indigo-600 hover:bg-indigo-600 hover:text-purple-50">
                                    登録
                                  </button>
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
