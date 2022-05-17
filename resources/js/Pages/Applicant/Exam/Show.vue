<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Examinations</span>
          </h2>
        </div>
      </div>
    </template>

    <div class="flex flex-col">
      <!-- Card -->
      <div class="w-full lg:w-6/12 xl:w-6/12 px-4">
        <div
          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
        >
          <div class="flex-auto p-8">
            <div class="flex flex-wrap">
              <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                <h5 class="text-gray-400 uppercase font-bold text-xl">Title</h5>
                <span class="font-semibold text-xl text-gray-700">
                  <!-- {{ noOfSched }} -->
                  Description
                </span>
              </div>
              <div class="relative w-auto pl-4 flex-initial">
                <Link class="cursor-pointer" :href="route('applicant.results.index')">
                  <div
                    class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                      />
                    </svg>
                  </div>
                </Link>
              </div>
            </div>
            <p class="text-md text-gray-400 mt-4">
              <Link
                class="cursor-pointer mr-2 text-emerald-500 hover:text-emerald-700 hover:animate-pulse"
                :href="route('applicant.results.index')"
              >
                <span class="inline-flex">
                  Take exam
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M13 7l5 5m0 0l-5 5m5-5H6"
                    />
                  </svg>
                </span>
              </Link>
            </p>
          </div>
        </div>
      </div>
      <!-- Card -->
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
