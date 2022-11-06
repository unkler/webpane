<script setip>
</script>

<template>
  <div v-if="$page.props.flash.status === 'success'" class="bg-violet-300 text-white p-4">
    {{ $page.props.flash.message }}
  </div>
  <div v-if="$page.props.flash.status === 'alert'" class="bg-gray-300 text-white p-4">
    {{ $page.props.flash.message }}
  </div>
</template>