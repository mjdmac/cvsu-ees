<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Dashboard</span>
          </h2>
        </div>
      </div>
    </template>

    <!-- Full dashboard -->
    <div>
      <div class="flex flex-wrap mt-8">
        <!-- Left side -->
        <div class="w-full lg:w-8/12">
          <div class="px-4 py-2 w-full bg-gray-700">
            <span class="uppercase tracking-wider text-white">Statistics</span>
          </div>
          <div class="relative md:pt-6 pb-6 pt-12">
            <div class="mx-auto w-full">
              <div>
                <div class="flex flex-wrap">
                  <!-- Card -->
                  <div class="w-full lg:w-6/12 xl:w-6/12 px-4">
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                    >
                      <div class="flex-auto p-8">
                        <div class="flex flex-wrap">
                          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-gray-400 uppercase font-bold text-md">
                              Result
                            </h5>
                            <span class="font-semibold text-xl text-gray-700">
                              <!-- {{ noOfSched }} -->
                              Qualified/NotQualified
                            </span>
                          </div>
                          <div class="relative w-auto pl-4 flex-initial">
                            <Link
                              class="cursor-pointer"
                              :href="route('applicant.results.index')"
                            >
                              <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="h-5 w-5"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke="currentColor"
                                  stroke-width="2"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"
                                  />
                                </svg>
                              </div>
                            </Link>
                          </div>
                        </div>
                        <p class="text-sm text-gray-400 mt-4">
                          <Link
                            class="cursor-pointer mr-2 text-emerald-500 hover:text-emerald-700 hover:animate-pulse"
                            :href="route('applicant.results.index')"
                          >
                            <span class="inline-flex">
                              See more
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
                  <!-- Card -->
                  <div class="w-full lg:w-6/12 xl:w-6/12 px-4">
                    <div
                      class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                    >
                      <div class="flex-auto p-8">
                        <div class="flex flex-wrap">
                          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                            <h5 class="text-gray-400 uppercase font-bold text-md">
                              Exam
                            </h5>
                            <span class="font-semibold text-xl text-gray-700">
                              <!-- {{ noOfSched }} -->
                              85/100
                            </span>
                          </div>
                          <div class="relative w-auto pl-4 flex-initial">
                            <Link
                              class="cursor-pointer"
                              :href="route('applicant.exams.index')"
                            >
                              <div
                                class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-emerald-500"
                              >
                                <svg
                                  xmlns="http://www.w3.org/2000/svg"
                                  class="h-5 w-5"
                                  fill="none"
                                  viewBox="0 0 24 24"
                                  stroke="currentColor"
                                  stroke-width="2"
                                >
                                  <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                  />
                                </svg>
                              </div>
                            </Link>
                          </div>
                        </div>
                        <p class="text-sm text-gray-400 mt-4">
                          <Link
                            class="cursor-pointer mr-2 text-emerald-500 hover:text-emerald-700 hover:animate-pulse"
                            :href="route('applicant.exams.index')"
                          >
                            <span class="inline-flex">
                              See more
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
              </div>
            </div>
          </div>
        </div>
        <!-- Left side -->

        <!-- Right side -->
        <div class="w-full lg:w-4/12">
          <div class="px-4 py-2 w-full bg-emerald-600">
            <span class="uppercase tracking-wider text-white">Calendar</span>
          </div>
          <div class="relative md:pt-6 pb-6 pt-12">
            <div class="mx-auto w-full">
              <!-- <h5>Calendar</h5> -->
              <div class="px-4">
                <Calendar :attributes="attrs" disable-page-swipe is-expanded> </Calendar>
              </div>
            </div>
          </div>
        </div>
        <!-- Right side -->
      </div>
    </div>
    <!-- Full dashboard -->
  </applicant-layout>
</template>

<script>
import ApplicantLayout from "@/Layouts/ApplicantLayout";
import { reactive, watchEffect } from "vue";
import { pickBy, throttle } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import { Calendar, DatePicker } from "v-calendar";

export default {
  components: {
    ApplicantLayout,
    Link,
    JetSectionBorder,
    Calendar,
    DatePicker,
  },

  props: {},

  data() {
    return {
      attrs: [
        {
          key: "today",
          highlight: true,
          dates: new Date(),
        },
      ],
    };
  },

  methods: {},
};
</script>
