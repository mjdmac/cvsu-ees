<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Applicants</span>
          </h2>
        </div>
      </div>
    </template>

    <div class="py-12"></div>

    <div class="bg-white shadow-xl sm:rounded-lg">
      <div class="flex flex-col"></div>
    </div>
  </applicant-layout>
</template>

<script>
import ApplicantLayout from "@/Layouts/ApplicantLayout";
import { reactive, watchEffect } from "vue";
import { pickBy, throttle } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";

export default {
  components: {
    ApplicantLayout,
    Link,
    JetSectionBorder,
  },

  props: {},

  data() {
    return {};
  },

  methods: {},
};
</script>
