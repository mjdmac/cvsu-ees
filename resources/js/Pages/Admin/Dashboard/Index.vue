<template>
  <admin-layout title="Dashboard">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Dashboard</span>
          </h2>
        </div>
        <!-- Header -->
      </div>
    </template>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <welcome />
    </div>
  </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";

export default {
  components: {
    AdminLayout,
    Welcome,
  },
}
</script>
