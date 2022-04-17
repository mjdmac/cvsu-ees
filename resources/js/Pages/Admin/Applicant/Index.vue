<template>
  <admin-layout title="Users">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Applicants</span>
          </h2>
        </div>

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
                      @click="applicantExport('xlsx')"
                      class="py-2 px-4 bg-blue-500 text-white text-sm font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                    >
                      Export(.xlsx)
                    </jet-button>
                  </div>
                  <div class="py-2">
                    <jet-button
                      @click="applicantExport('csv')"
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
      <!-- Header -->
    </template>

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
              class="bg-green-500 font-semibold capitalize text-white hover:bg-green-700 hover:text-gray-50"
              @click="openModal(true)"
              >Add Applicant
            </jet-button>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-xl sm:rounded-lg">
        <div class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('id')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="params.field === 'id' && params.direction === 'asc'"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="params.field === 'id' && params.direction === 'desc'"
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Control Number</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('fname')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'fname' && params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'fname' && params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">First Name</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('mname')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'mname' && params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'mname' && params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Middle Name</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('lname')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'lname' && params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'lname' && params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Last Name</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <div class="inline-block">College</div>
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('birthday')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'birthday' && params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'birthday' && params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Birthday</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('email')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'email' && params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'email' && params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Email</div></span
                        >
                      </th>
                      <th
                        scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                      >
                        <span class="cursor-pointer" @click="sort('phone_number')">
                          <div class="inline-block">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'phone_number' &&
                                params.direction === 'asc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"
                              />
                            </svg>
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              class="h-4 w-4"
                              fill="none"
                              viewBox="0 0 24 24"
                              stroke="currentColor"
                              stroke-width="2"
                              v-if="
                                params.field === 'phone_number' &&
                                params.direction === 'desc'
                              "
                            >
                              <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"
                              />
                            </svg>
                          </div>
                          <div class="inline-block">Phone Number</div></span
                        >
                      </th>
                      <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Edit</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-if="!applicants.data.length">
                      <td class="p-4 text-center text-xs text-gray-800" colspan="9">
                        No data
                      </td>
                    </tr>
                    <tr v-for="(applicant, id) in applicants.data" :key="applicant.id">
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.id }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.fname }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.mname }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.lname }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.colleges.college_name }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.birthday }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.email }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        {{ applicant.phone_number }}
                      </td>
                      <td
                        class="px-6 py-4 space-x-1 whitespace-nowrap text-right text-sm font-medium"
                      >
                        <button
                          class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded text-sm font-semibold"
                          @click="edit(applicant, true)"
                        >
                          Edit
                        </button>

                        <button
                          :disabled="disabled"
                          @click="deleteRow(applicant.id)"
                          class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-sm font-semibold"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="mx-auto sm:px-6 lg:px-8">
          <jet-pagination class="m-5" :links="applicants.links" />
        </div>
      </div>
    </div>
  </admin-layout>

  <dialog-modal :show="isOpen" @close="openModal(false)">
    <template #title>
      <span v-show="!editMode"> Add New Applicant </span>
      <span v-show="editMode"> Update Applicant </span>
    </template>

    <template #content>
      <!-- Colleges -->
      <div class="mb-4">
        <jet-label for="college" value="College" />
        <div>
          <Multiselect
            v-model="form.colleges"
            mode="tags"
            placeholder="Select colleges"
            trackBy="id"
            :searchable="true"
            :close-on-select="false"
            label="college_name"
            :options="college_names"
            @keyup.enter="save(form)"
          />
        </div>
      </div>

      <!-- First Name -->
      <div class="mb-4">
        <jet-label for="fname" value="First Name" />
        <jet-input
          id="fname"
          ref="fname"
          type="text"
          class="mt-1 block w-full"
          v-model="form.fname"
        />
      </div>

      <!-- Middle Name -->
      <div class="mb-4">
        <jet-label for="mname" value="Middle Name" />
        <jet-input
          id="mname"
          ref="mname"
          type="text"
          class="mt-1 block w-full"
          v-model="form.mname"
        />
      </div>

      <!-- Last Name -->
      <div class="mb-4">
        <jet-label for="lname" value="Last Name" />
        <jet-input
          id="lname"
          ref="lname"
          type="text"
          class="mt-1 block w-full"
          v-model="form.lname"
        />
      </div>

      <!-- Email -->
      <div class="mb-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          ref="email"
          type="text"
          class="mt-1 block w-full"
          v-model="form.email"
        />
      </div>

      <!-- Phone -->
      <div class="mb-4">
        <jet-label for="phone_number" value="Phone Number (ex. 639123456789)" />
        <jet-input
          id="phone_number"
          ref="phone_number"
          type="number"
          class="mt-1 block w-full"
          v-model="form.phone_number"
        />
      </div>

      <!-- Biryhday -->
      <div class="mb-4">
        <jet-label for="birthday" value="Birthday" />
        <jet-input
          id="birthday"
          type="date"
          class="mt-1 block w-full"
          v-model="form.birthday"
        />
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="openModal(false)"> Cancel </jet-secondary-button>

      <jet-button
        class="ml-2"
        v-show="!editMode"
        @click="save(form)"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
      >
        Save
      </jet-button>

      <jet-button
        class="ml-2"
        :class="{ 'opacity-25': disabled }"
        :disabled="disabled"
        v-show="editMode"
        @click="update(form)"
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
import Multiselect from "@vueform/multiselect";

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
    Multiselect,
  },

  props: {
    applicants: Object,
    filters: Object,
    college_names: Object,
  },

  extends: shared,

  data() {
    return {
      params: {
        search: this.filters.search,
        field: this.filters.field,
        direction: this.filters.direction,
      },

      form: this.$inertia.form({
        colleges: this.colleges,
        fname: "",
        mname: "",
        lname: "",
        email: "",
        phone_number: "",
        birthday: "",
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

    // Save function
    save: function (applicants) {
      this.$inertia.visit("/admin/applicants", {
        method: "post",
        data: this.form,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false), this.openModal(false), (this.form = {});
        },
        // preserveScroll: true,
        // preserveState: true,
      });
    },

    // Edit mode function
    edit: function (applicant, status) {
      this.form = Object.assign({}, applicant);
      this.editMode = true;
      this.openModal(status);
    },

    // Update function
    update: function (applicant) {
      this.$inertia.visit("/admin/applicants/" + applicant.id, {
        method: "put",
        data: applicant,
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
      this.$inertia.visit("/admin/applicants/" + id, {
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

    // Export function
    applicantExport: function (type) {
      const url = "/admin/export/applicants?type=" + type;
      window.location.href = url;
    },
  },

  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);

        this.$inertia.get(this.route("applicants.index"), params, {
          replace: true,
          preserveState: true,
        });
      }, 150),
      deep: true,
    },
  },
};
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
