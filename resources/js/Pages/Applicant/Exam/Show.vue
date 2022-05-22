<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-lg rounded-md bg-emerald-600">
        <div>
          <h2 class="font-semibold text-xl text-white leading-tight">
            <span>{{ exam.exam_code }}</span>
          </h2>
        </div>
        <!-- Page Buttons -->
        <div align="right">
          <!-- Line buttons and show dropdown -->
          <div class="inline-flex" align="right">
            <div class="text-xl font-medium text-white leading-tight">
              <!-- Time left: <span>{{ time }}</span> -->
            </div>
          </div>
          <!-- Hide in line buttons and show dropdown -->
        </div>
        <!-- End Page Buttons -->
      </div>
    </template>

    <div class="flex flex-col">
      <!-- Card -->
      <div class="w-full px-4">
        <div
          class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-sm"
        >
          <div class="flex-auto p-8">
            <div class="flex flex-wrap">
              <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                <h5 class="text-gray-400 uppercase font-bold text-xl">
                  {{ exam.subject }}
                </h5>
                <span class="font-semibold text-xl text-gray-700">
                  {{ exam.description }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Card -->

      <!-- Full dashboard -->
      <div>
        <div class="flex flex-wrap mt-8">
          <!-- Left side -->
          <div class="w-full lg:w-8/12">
            <!-- Table div -->
            <div class="px-4 py-2 w-full bg-gray-700">
              <span class="uppercase tracking-wider text-white">Question</span>
            </div>

            <div class="relative md:pt-6 pb-6 pt-12">
              <div class="mx-auto w-full">
                <div>
                  <div class="flex flex-wrap">
                    <!-- Question card -->
                    <div
                      v-for="question in questions"
                      :key="question.id"
                      class="w-full px-4"
                    >
                      <div
                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg"
                      >
                        <div class="flex-auto p-8">
                          <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                              <p class="capitalize font-medium text-md py-2">
                                <span>{{ currentQuestion + 1 + ")" }}</span>
                                {{ question.question }}
                              </p>
                              <jet-input
                                v-for="choice in question.choices"
                                :key="choice.id"
                                v-model="choice.option"
                                class="w-full p-4 shadow overflow-hidden border-b border-gray-500 rounded-lg m-2 md:m-2 lg:m-4"
                                solo
                                readonly
                              >
                                <div class="text-lg">
                                  <div class="px-4 py-4">
                                    <jet-input
                                      type="radio"
                                      :value="choice.is_correct == 1 ? 1 : choice.option"
                                      ><span> {{ choice.option }}</span>
                                    </jet-input>
                                  </div>
                                </div>
                              </jet-input>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Question card -->
                  </div>
                </div>
              </div>
            </div>
            <!-- Table div -->
          </div>
          <!-- Left side -->

          <!-- Right side -->
          <div class="w-full lg:w-4/12">
            <div class="px-4 py-2 w-full bg-emerald-600">
              <span class="uppercase tracking-wider text-white">Navigation</span>
            </div>
            <div class="relative md:pt-6 pb-6 pt-12">
              <div class="mx-auto w-full">
                <div class="px-4"></div>
              </div>
            </div>
          </div>
          <!-- Right side -->
        </div>
      </div>
      <!-- Full dashboard -->
    </div>
  </applicant-layout>
</template>

<script>
import ApplicantLayout from "@/Layouts/ApplicantLayout";
import moment from "moment";
import { Link } from "@inertiajs/inertia-vue3";
import JetPagination from "@/Components/Pagination";
import JetInput from "@/Jetstream/Input";

export default {
  components: {
    ApplicantLayout,
    moment,
    Link,
    JetPagination,
    JetInput,
  },

  props: {
    exam: Object,
    questions: Object,
    examHasTaken: Object,
    duration: Number,
  },

  data() {
    return {
      radioGroup: 0,
      questionIndex: 0,
      applicantResponses: Array(this.questions.length).fill(false),
      currentQuestion: 0,
      currentAnswer: 0,
      clock: moment(this.duration * 60 * 1000),
    };
  },

  // mounted() {
  //   setInterval(() => {
  //     this.clock = moment(this.clock.subtract(1, "seconds"));
  //   }, 1000);
  // },

  // computed: {
  //   time: function () {
  //     var time = this.clock.format("mm:ss");

  //     if (time == "00:00") {
  //       alert("test");
  //     }
  //     return time;
  //   },
  // },

  methods: {},
};
</script>
