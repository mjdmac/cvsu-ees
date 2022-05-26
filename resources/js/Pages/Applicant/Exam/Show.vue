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
                    <div class="px-8">
                      <span
                        v-for="(question, id) in questions"
                        :key="id"
                        class="w-full px-4"
                      >
                        <span v-if="id === questionIndex">
                          <p class="text-md mb-8 text--primary">
                            {{ id + 1 }}) {{ question.question }}
                          </p>
                          <jet-input
                            v-for="choice in question.choices"
                            :key="choice"
                            v-model="choice.option"
                            label="Solo"
                            height="50"
                            solo
                            readonly
                            rounded
                          >
                            <template v-s lot:prepend-inner>
                              <v-radio-group
                                v-model="applicantResponses[id]"
                                class="w-full p-4 shadow overflow-hidden border-b border-gray-500 rounded-lg m-2 md:m-2 lg:m-4"
                              >
                                <div class="text-lg">
                                  <div class="px-4 py-4">
                                    <v-radio
                                      type="radio"
                                      :value="
                                        choice.is_correct == true ? true : choice.option
                                      "
                                      name="id"
                                      @click="choices(question.id, choice.id)"
                                    ></v-radio>
                                  </div>
                                </div>
                              </v-radio-group>
                            </template>
                          </jet-input>
                        </span>
                      </span>
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
                <div class="px-4">
                  Question/s attempted: {{ questionIndex }}/{{ questions.length }}

                  <div class="mb-16 px-6" v-if="questionIndex != questions.length">
                    <button
                      v-if="questionIndex > 0"
                      text
                      color="secondary"
                      class="ml-2 float-left inline-flex"
                      @click="prev"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L9.414 11H13a1 1 0 100-2H9.414l1.293-1.293z"
                          clip-rule="evenodd"
                        />
                      </svg>
                      Previous
                    </button>
                    <button
                      text
                      color="primary"
                      class="ml-2 white--text float-right inline-flex"
                      @click="postApplicantAnswers"
                    >
                      Next
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 ml-2"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z"
                          clip-rule="evenodd"
                        />
                      </svg>
                    </button>
                  </div>
                </div>
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

  methods: {
    prev() {
      this.questionIndex--;
    },
    choices(question, answer) {
      (this.currentAnswer = answer), (this.currentQuestion = question);
    },
    postApplicantAnswers() {
      this.questionIndex++;
      axios.post("/quiz/test", {
        answerId: this.currentAnswer,
        questionId: this.currentQuestion,
        examId: this.exam.id,
      });
    },
  },
};
</script>
