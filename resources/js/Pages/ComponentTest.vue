<template>
  <GuestLayout>
    <InputLabel value="名前"></InputLabel>
    <TextInput 
      modelValue="入力して下さい"
      @update:modelValue="emitTest"
    >
    </TextInput>

  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Checkbox from '@/Components/Checkbox.vue'
import DropdownLink from '@/Components/DropdownLink.vue'

const emitTest = e => console.log(e)
</script>