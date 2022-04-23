<template>
  <admin-layout title="Examinations">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Examinations</span>
          </h2>
        </div>
        <!-- Header -->

        <!-- Page Buttons -->
        <div align="right">
          <!-- Line buttons and show dropdown -->
          <div class="block" align="right">
            <jet-dropdown>
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    type="button"
                    class="py-2 px-4 inline-flex items-center border border-transparent text-sm leading-4 font-medium rounded-md text-gray-100 bg-gray-800 hover:text-gray-300 focus:outline-none transition"
                  >
                    <span>Data Management</span>
                    <svg
                      class="ml-2 -mr-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </span>
              </template>

              <template #content>
                <!-- Export buttons -->
                <div class="block px-4 py-2 text-xs text-gray-600">Export Data</div>
                <div class="border-t border-gray-100"></div>
                <div class="px-4 py-2">
                  <div class="py-2">
                    <jet-button
                      class="py-2 px-4 bg-blue-500 text-white text-sm font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                    >
                      Export(.xlsx)
                    </jet-button>
                  </div>
                  <div class="py-2">
                    <jet-button
                      class="py-2 px-4 bg-blue-500 text-white text-sm font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                    >
                      Export(.csv)
                    </jet-button>
                  </div>
                </div>
              </template>
            </jet-dropdown>
          </div>
          <!-- Hide in line buttons and show dropdown -->
        </div>
        <!-- End Page Buttons -->
      </div>
    </template>

    <!-- Search Field and Button -->
    <div class="py-12">
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
              @click="openModal(true)"
              class="bg-green-500 font-semibold capitalize text-white hover:bg-green-700 hover:text-gray-50"
              >Create Exam
            </jet-button>
          </div>
        </div>
      </div>

      <!-- List of exams -->
      <div>
        <div class="px-4 py-2 w-full bg-gray-700">
          <span class="uppercase tracking-wider text-white">List of Exams</span>
        </div>
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <!-- NO data -->
            <div v-if="!exams.data.length">
              <div class="w-full py-8">
                <div class="p-4 text-center text-sm text-gray-800">
                  <span class="text-red-500 uppercase text-xl">No exam found!</span>
                  <NoData />
                </div>
              </div>
            </div>
            <!-- NO data -->

            <div class="p-4 align-middle sm:px-8 lg:px-10">
              <!-- One row / data / card -->
              <div class="flex flex-wrap">
                <div v-for="(exam, id) in exams.data" :key="exam.id" class="w-full md:w-6/12 lg:w-4/12">
                  <div
                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg m-2"
                  >
                    <div class="w-full bg-emerald-500 py-2 px-4">
                      <span class="text-xl text-white"> {{ exam.exam_code }}</span>
                    </div>
                    <div class="text-md">
                      <div class="px-2 pt-4">
                        <span class="text-gray-500 px-2">Title:</span>
                        <span> {{ exam.subject }}</span>
                      </div>
                      <div class="px-2">
                        <span class="text-gray-500 px-2 break-all truncate"
                          >Description:</span
                        >
                        <span> {{ exam.description }}</span>
                      </div>
                      <div class="px-2">
                        <span class="text-gray-500 px-2">Duration:</span>
                        <span> {{ exam.duration }}</span>
                      </div>
                    </div>
                    <div
                      class="px-6 py-4 space-x-1 whitespace-nowrap text-right text-sm font-medium"
                    >
                      <button
                        class="bg-gray-500 hover:bg-gray-700 text-white py-1 px-2 rounded text-sm font-semibold"
                        @click="show(exam)"
                      >
                        View
                      </button>

                      <button
                        class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded text-sm font-semibold"
                        @click="edit(exam, true)"
                      >
                        Edit
                      </button>

                      <button
                        :disabled="disabled"
                        @click="deleteRow(exam.id)"
                        class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-sm font-semibold"
                      >
                        Delete
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- One row / data / card -->
            </div>
          </div>
        </div>
      </div>
      <!-- List of exams -->
    </div>
  </admin-layout>

  <dialog-modal :show="isOpen" @close="openModal(false)">
    <template #title>
      <span> Create Exam </span>
    </template>

    <template #content>
      <!-- Subject -->
      <div class="mb-4">
        <jet-label for="subject" value="Subject" />
        <jet-input
          id="subject"
          type="text"
          class="mt-1 block w-full"
          v-model="form.subject"
          v-show="!editMode"
          @keyup.enter="save(form)"
        />
        <jet-input
          id="subject"
          type="text"
          class="mt-1 block w-full"
          v-model="form.subject"
          v-show="editMode"
          @keyup.enter="update(form)"
        />
      </div>

      <!-- Description -->
      <div class="mb-4">
        <jet-label for="description" value="Description" />
        <jet-input
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="form.description"
          v-show="!editMode"
          @keyup.enter="save(form)"
        />
        <jet-input
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="form.description"
          v-show="editMode"
          @keyup.enter="update(form)"
        />
      </div>

      <!-- Duration -->
      <div class="mb-4">
        <jet-label for="duration" value="Duration (in minutes)" />
        <jet-input
          id="duration"
          type="text"
          class="mt-1 block w-full"
          v-model="form.duration"
          v-show="!editMode"
          @keyup.enter="save(form)"
        />
        <jet-input
          id="duration"
          type="number"
          class="mt-1 block w-full"
          v-model="form.duration"
          v-show="editMode"
          @keyup.enter="update(form)"
        />
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="openModal(false)"> Cancel </jet-secondary-button>

      <jet-button
        class="ml-2"
        v-show="!editMode"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        @click="save(form)"
        @keyup.enter="save(form)"
      >
        Save
      </jet-button>

      <jet-button
        class="ml-2"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        v-show="editMode"
        @click="update(form)"
        @keyup.enter="update(form)"
      >
        Update
      </jet-button>
    </template>
  </dialog-modal>
</template>

<script>
import { reactive, watchEffect } from "vue";
import { pickBy, throttle } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import AdminLayout from "@/Layouts/AdminLayout";
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetFormSection from "@/Jetstream/FormSection";
import JetActionMessage from "@/Jetstream/ActionMessage";
import DialogModal from "@/Jetstream/DialogModal";
import JetPagination from "@/Components/Pagination";
import { Link } from "@inertiajs/inertia-vue3";
import NoData from "@/Components/Fillers/NoData.vue";

export default {
  components: {
    AdminLayout,
    JetButton,
    JetSecondaryButton,
    JetLabel,
    JetInput,
    JetPagination,
    JetDropdown,
    JetDropdownLink,
    JetFormSection,
    JetActionMessage,
    DialogModal,
    Link,
    NoData,
  },

  props: {
    exams: Object,
    filters: Object,
  },

  data() {
    return {
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
      },

      form: this.$inertia.form({
        subject: this.subject,
        description: this.description,
        duration: this.duration,
      }),

      isOpen: false,
      disabled: null,
      editMode: false,
    };
  },

  methods: {
    // Disable function
    disabledClick: function (s) {
      this.disabled = s;
    },

    // Modal function
    openModal: function (status) {
      if (status == true) {
        this.isOpen = true;
      } else if (status == false) {
        this.form = {};
        this.isOpen = false;
        this.editMode = false;
      }

      return this.isOpen;
    },

    // Sort function
    sort(field) {
      this.params.field = field;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },

    show: function (id) {
      this.form = Object.assign({}, id);
      this.$inertia.visit(route("admin.exams.show", id));
    },

    // Save function
    save: function (exams) {
      this.$inertia.visit("/admin/exams", {
        method: "post",
        data: exams,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false), this.openModal(false), (this.form = {});
        },
      });
    },

    // Edit mode function
    edit: function (exam, status) {
      this.form = Object.assign({}, exam);
      this.editMode = true;
      this.openModal(status);
    },

    // Update function
    update: function (exam) {
      this.$inertia.visit("/admin/exams/" + exam.id, {
        method: "put",
        data: exam,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false), this.openModal(false);
        },
        onFinish: () => (this.form = {}),
        preserveScroll: true,
      });
    },

    // Delete function
    deleteRow: function (id) {
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
  },

  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);

        this.$inertia.get(this.route("admin.exams.index"), params, {
          replace: true,
          preserveState: true,
        });
      }, 150),
      deep: true,
    },
  },
};
</script>
