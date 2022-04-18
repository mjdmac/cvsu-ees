<template>
  <home-layout title="Home">
    <!-- <template #header>
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Home</span>
          </h2>
        </div>
      </div>
    </template> -->
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow-md sm:rounded-lg">
          <div class="flex flex-wrap">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 bg-">Schedules</div>
            <div class="w-full xl:w-4/12 px-4">Calendar</div>
          </div>
        </div>
      </div>
    </div>
  </home-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HomeLayout from "@/Layouts/HomeLayout";

export default defineComponent({
  components: {
    Head,
    Link,
    HomeLayout,
  },
});
</script>
