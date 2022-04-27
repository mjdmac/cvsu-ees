<template>
  <admin-layout title="Exam">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <Link
              :href="route('admin.exams.index')"
              class="
                text-xs
                uppercase
                px-2
                font-bold
                cursor-pointer
                inline-block
              "
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
                  d="M15 19l-7-7 7-7"
                />
              </svg>
            </Link>

            <!-- <span class="inline-block px-1">Exam: </span> -->
            <span class="text-gray-500 text-md inline-block">
              {{ exam.exam_code }}
            </span>
          </h2>
        </div>
        <!-- Header -->

        <!-- Page Buttons -->
        <div align="right">
          <!-- Line buttons and show dropdown -->
          <div class="block" align="right">
            <button
              :disabled="disabled"
              @click="deleteModal(true)"
              class="
                bg-red-500
                hover:bg-red-700
                text-white
                py-1
                px-2
                rounded
                text-sm
                font-semibold
              "
            >
              Delete
            </button>
          </div>
          <!-- Hide in line buttons and show dropdown -->
        </div>
        <!-- End Page Buttons -->
      </div>
    </template>

    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="px-5 py-3">
        <div class="text-2xl">
          <span class="text-gray-800 font-bold uppercase">
            <span>{{ exam.subject }}</span>
          </span>
          <button
            class="px-1 text-gray-500 rounded text-sm font-semibold"
            @click="editExam(exam, true)"
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
          </button>
        </div>
        <div class="text-md">
          <span> Description: </span>
          <span class="text-gray-500">{{ exam.description }}</span>
        </div>
      </div>
    </div>

    <!-- Search Field and Button -->
    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 px-5 py-3">
        <div>
          <div class="inline-block">
            <jet-input
              type="text"
              class="block ml-2 mb-4 w-60"
              placeholder="Search..."
              v-model="params.search"
            />
          </div>
        </div>
        <div class="block" align="right">
          <jet-button
            @click="addQuestionModal(true)"
            class="
              bg-green-500
              font-semibold
              capitalize
              text-white
              hover:bg-green-700 hover:text-gray-50
            "
            >Add Question
          </jet-button>
        </div>
      </div>

      <!-- Display questions -->
      <div></div>
      <!-- Display questions -->
    </div>
  </admin-layout>

  <!-- Edit Exam Model -->
  <dialog-modal :show="isOpen" @close="editModal(false)">
    <template #title>
      <span> Update Exam </span>
    </template>

    <template #content>
      <!-- Subject -->
      <div class="mb-4">
        <jet-label for="subject" value="Subject" />
        <jet-input
          id="subject"
          type="text"
          class="mt-1 block w-full"
          v-model="examform.subject"
          @keyup.enter="updateExam(exam)"
        />
      </div>

      <!-- Description -->
      <div class="mb-4">
        <jet-label for="description" value="Description" />
        <jet-input
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="examform.description"
          @keyup.enter="updateExam(exam)"
        />
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="editModal(false)">
        Cancel
      </jet-secondary-button>
      <jet-button
        class="ml-2"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        @click="updateExam(exam)"
        @keyup.enter="updateExam(exam)"
      >
        Update
      </jet-button>
    </template>
  </dialog-modal>
  <!-- Edit Exam Model -->

  <!-- Delete Confirm Dialog -->
  <dialog-modal :show="deleteModalisOpen" @close="deleteModal(false)">
    <template #title>
      <span> Do you want to remove {{ exam.exam_code }}? </span>
    </template>

    <template #content> </template>

    <template #footer>
      <jet-secondary-button @click="deleteModal(false)">
        Cancel
      </jet-secondary-button>
      <jet-button
        class="ml-2 bg-red-500 hover:bg-red-700 text-white"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        @click="destroyExam(exam.id)"
        @keyup.enter="destroyExam(exam.id)"
      >
        Delete
      </jet-button>
    </template>
  </dialog-modal>
  <!-- Delete Confirm Dialog -->

  <!-- Add Question Dialog -->
  <dialog-modal :show="addQuestionisOpen" @close="addQuestionModal(false)">
    <template #title>
      <span> Add Question </span>
    </template>

    <template #content>
      <!-- Question -->
      <div class="mb-4">
        <jet-label for="question" value="Question" />
        <div class="text-center">
          <jet-input
            id="question"
            type="text"
            v-model="questionform.question"
            placeholder="Enter Question"
            class="inline-block w-full"
            required
          >
          </jet-input>

          <span class="uppercase text-gray-500 mx-4">or</span>

          <jet-input
            id="imgphoto"
            type="file"
            class="inline-block w-full"
            @input="questionform.img_path = $event.target.files[0]"
            accept="image/png, image/jpeg"
          >
          </jet-input>
        </div>
      </div>
      <div class="mb-4">
        <jet-label for="choices" value="Choices" class="mx-2 text-lg" />
        <div
          v-for="(value, id) in questionform.choices"
          :key="id"
          class="w-full my-4"
        >
          <div class="inline-block mr-2 mb-1 w-full">
            <span class="text-gray-500">
              Correct Answer:
              <Toggle
                v-model="value.is_correct"
                :id="id"
                @change="toggleChange(id)"
              />
            </span>
            <div class="inline-block w-full">
              <jet-input
                type="text"
                v-model="value.option"
                placeholder="Enter option"
              >
              </jet-input>

              <span class="uppercase text-gray-500 mx-4">or</span>

              <jet-input
               :id="id"
                type="file"
                @input="value.img_path = $event.target.files[0]"
                accept="image/png, image/jpeg">
              </jet-input>
            </div>
          </div>
          <button
            v-show="questionform.choices.length > 1"
            @click="removeOption(id)"
            class="
              mt-3
              py-1
              px-4
              bg-red-500
              text-white text-sm
              font-semibold
              rounded-md
              shadow-md
              hover:bg-red-700
              focus:outline-none
              focus:ring-2
              focus:ring-red-400
              focus:ring-opacity-75
            "
          >
            Remove
          </button>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="addQuestionModal(false)">
        Cancel
      </jet-secondary-button>
       <jet-button
        class="ml-2  bg-green-500"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        @click="addOption()"
      >
        Add Option
      </jet-button>
      <jet-button
        class="ml-2"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        @click="saveQuestion(questionform)"
        @keyup.enter="saveQuestion(questionform)"
      >
        Save
      </jet-button>
    </template>
  </dialog-modal>
  <!-- Add Question Dialog -->
</template>

<script>
import { reactive, watchEffect } from "vue";
import { pickBy, throttle } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import DialogModal from "@/Jetstream/DialogModal";
import shared from "@/Scripts/shared";
import Toggle from "@vueform/toggle";
import NoData from "@/Components/Fillers/NoData.vue";

export default {
  components: {
    AdminLayout,
    JetButton,
    JetSecondaryButton,
    JetFormSection,
    JetInput,
    JetLabel,
    DialogModal,
    Link,
    Toggle,
    NoData,
  },

  props: {
    exam: Object,
  },
  remember: "form",

  data() {
    return {
      params: {},

      isOpen: false,
      deleteModalisOpen: false,
      addQuestionisOpen: false,
      disabled: null,
      editMode: false,

      examform: this.$inertia.form({
        subject: this.exam.subject,
        description: this.exam.description,
        duration: this.exam.duration,
      }),

      valid: true,
      questionform: this.$inertia.form({
        exam_id: this.exam.id,
        question: "",
        img_path: null,
        choices: [
          {
            option: "",
            is_correct: false,
            img_path: "",
          },
          {
            option: "",
            is_correct: false,
            img_path: "",
          },
          {
            option: "",
            is_correct: false,
            img_path: "",
          },
          {
            option: "",
            is_correct: false,
            img_path: "",
          }
        ],
      }),
    };
  },

  methods: {
    toggleChange: function (id) {
      this.questionform.choices.forEach((item, index) => {
        if (id != index) {
          item.is_correct = false;
        }
      });
    },

    removeOption(counter) {
      this.questionform.choices.splice(counter, 1);
    },

    addOption() {
      this.questionform.choices.push({
            option: "",
            is_correct: false,
            img_path: "",
      });
    },

    saveQuestion: function (questions) {
      this.$inertia.visit("/admin/questions", {
        method: "post",
        data: questions,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false),  this.addQuestionModal(false), (this.questionform.reset());
        },
        preserveScroll: true,
        preserveState: true,
      });
    },
    // Disable function
    disabledClick: function (s) {
      this.disabled = s;
    },

    // Exam edit modal function
    editModal: function (status) {
      if (status == true) {
        this.isOpen = true;
      } else if (status == false) {
        this.isOpen = false;
      }
      return this.isOpen;
    },

    // Exam assign data
    editExam: function (exam, status) {
      // this.form = Object.assign({}, exam);
      this.editModal(status);
    },

    // Exam update function
    updateExam: function (exam) {
      this.$inertia.put(
        this.route("admin.exams.update", this.exam.id),
        this.examform,
        {
          onBefore: () => {
            this.disabledClick(true);
          },
          onSuccess: () => {
            this.disabledClick(false), this.editModal(false);
          },
        }
      );
    },

    // Delete modal
    deleteModal: function (status) {
      if (status == true) {
        this.deleteModalisOpen = true;
      } else if (status == false) {
        this.deleteModalisOpen = false;
      }
      return this.deleteModalisOpen;
    },

    // Destroy exam
    destroyExam: function (id) {
      this.$inertia.visit("/admin/exams/" + id, {
        method: "delete",
        preserveScroll: true,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false);
        },
      });
    },

    // Add question modal
    addQuestionModal: function (status) {
        this.addQuestionisOpen = status;
        this.questionform.reset()
      return this.addQuestionisOpen;
    },
  },
};
</script>

<style src="@vueform/toggle/themes/default.css"></style>
