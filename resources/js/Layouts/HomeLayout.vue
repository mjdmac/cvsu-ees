<template>
  <div>
    <Head :title="title" />
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-white border-b border-gray-100">
      </nav>

      <!-- Page Heading -->
      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header"></slot>
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot></slot>
      </main>
    </div>
  </div>
</template>
<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import AdminSideBar from "@/Components/SideBar/AdminSidebar.vue";
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetBanner from "@/Jetstream/Banner.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";

export default {
  props: {
    title: String,
  },
  components: {
    AdminSideBar,
    Head,
    Link,
    JetDropdown,
    JetDropdownLink,
    JetBanner,
  },
};
</script>
