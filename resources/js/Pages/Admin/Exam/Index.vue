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
            <!-- View filter -->
            <div class="inline-block">
              <span class="px-1 text-gray-500">Show</span>
              <select
                ref="perpage"
                id="perpage"
                class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                v-model="params.perpage"
              >
                <option
                  v-for="perpage in perpages"
                  :key="perpage"
                  :value="perpage"
                  class="capitalize"
                >
                  <span>{{ perpage }}</span>
                </option>
              </select>
              <span class="px-1 text-gray-500">per page</span>
            </div>
            <!-- View filter -->
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
                <div
                  v-for="(exam, id) in exams.data"
                  :key="exam.id"
                  class="w-full md:w-6/12 lg:w-4/12"
                >
                  <div
                    class="shadow overflow-hidden border-b border-gray-200 rounded-lg m-2 md:m-2 lg:m-4"
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

    <div class="mx-auto sm:px-6 lg:px-8">
      <jet-pagination class="m-5" :links="exams.links" />
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
    </template>

    <template #footer>
      <jet-secondary-button @click="openModal(false)"> Close </jet-secondary-button>

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
import shared from "@/Scripts/shared";
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

  extends: shared,

  data() {
    return {
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
        perpage: this.filters.perpage,
      },

      form: this.$inertia.form({
        subject: this.subject,
        description: this.description,
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
          this.disabledClick(false), (this.form = {});
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
