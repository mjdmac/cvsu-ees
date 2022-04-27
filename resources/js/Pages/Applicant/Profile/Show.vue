<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-md rounded-md">
        <div>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>Manage Account</span>
          </h2>
        </div>
        <!-- Header -->
      </div>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div>
          <!-- Personal -->
          <UpdatePersonalInformationForm />
          <jet-section-border />
        </div>
        <div>
          <!-- Profile -->
          <UpdateProfileInformationForm />
          <jet-section-border />
        </div>
      </div>
    </div>
  </applicant-layout>
</template>

<script>
import { defineComponent } from "vue";
import ApplicantLayout from "@/Layouts/ApplicantLayout.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";
import UpdatePersonalInformationForm from "@/Pages/Applicant/Profile/Parts/UpdatePersonalInformationForm.vue";
import UpdateProfileInformationForm from "@/Pages/Applicant/Profile/Parts/UpdateProfileInformationForm.vue";

export default defineComponent({
  props: ["sessions"],

  components: {
    ApplicantLayout,
    JetSectionBorder,
    UpdatePersonalInformationForm,
    UpdateProfileInformationForm,
  },
});
</script>
