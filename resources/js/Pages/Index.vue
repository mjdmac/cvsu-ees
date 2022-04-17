<template>
  <home-layout title="Home">
    <template #header>
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Home</span>
          </h2>
        </div>
      </div>
    </template>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    sample
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
