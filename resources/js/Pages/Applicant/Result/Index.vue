<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-lg rounded-md bg-emerald-600">
        <div>
          <h2 class="font-semibold text-xl text-white leading-tight">
            <span>Results</span>
          </h2>
        </div>
      </div>
    </template>

    <div class="flex flex-col my-12">
      <!-- Card -->
      <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-2xl mt-6 px-6 py-4">
          <div
            class="relative px-10 py-8 flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
          >
            <div class="flex flex-wrap">
              <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                <h5 class="text-gray-400 uppercase font-bold text-xl">Results</h5>
                <div class="block">
                  <p class="font-semibold text-xl text-gray-700 py-1">Exam:</p>
                  <p class="font-semibold text-xl text-gray-700 py-1">Score:</p>
                  <p class="font-semibold text-xl text-gray-700 py-1">Course:</p>
                  <p class="font-semibold text-2xl text-gray-700 py-1">
                    QUALIFIED/NOT QUALIFIED
                  </p>
                </div>
              </div>
              <div class="relative w-auto pl-4 flex-initial">
                <jet-button
                  class="text-white p-3 text-center text-md inline-flex items-center justify-center w-auto h-15 shadow-lg rounded-full bg-emerald-500"
                >
                  <span>Save Result</span>
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
                      d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"
                    />
                  </svg>
                </jet-button>
              </div>
            </div>
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
import JetButton from "@/Jetstream/Button.vue";

export default {
  components: {
    ApplicantLayout,
    Link,
    JetSectionBorder,
    JetButton,
  },

  props: {},

  data() {
    return {};
  },

  methods: {},
};
</script>
