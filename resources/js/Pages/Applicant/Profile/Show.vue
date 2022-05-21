<template>
  <applicant-layout title="Applicant">
    <template #header>
      <!-- Header -->
      <div class="grid grid-cols-2 px-5 py-3 shadow-lg rounded-md bg-emerald-600">
        <div>
          <h2 class="font-semibold text-xl text-emerald-100 leading-tight">
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
          <jet-form-section>
            <template #title> Personal Information </template>

            <template #description> Update your personal information. </template>

            <template #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-input v-model="personal.user_id" disabled hidden />
                <jet-label for="fname" value="First Name" />
                <jet-input
                  id="fname"
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="fname"
                  v-model="personal.fname"
                />
                <jet-input-error class="mt-2" />
              </div>

              <div class="col-span-6 sm:col-span-4">
                <jet-label for="mname" value="Middle Name" />
                <jet-input
                  id="mname"
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="mname"
                  v-model="personal.mname"
                />
                <jet-input-error class="mt-2" />
              </div>

              <div class="col-span-6 sm:col-span-4">
                <jet-label for="lname" value="Last Name" />
                <jet-input
                  id="lname"
                  type="text"
                  class="mt-1 block w-full"
                  autocomplete="lname"
                  v-model="personal.lname"
                />
                <jet-input-error class="mt-2" />
              </div>
            </template>

            <template #actions>
              <jet-button @click="savePersonal(personal)"> Save </jet-button>
            </template>
          </jet-form-section>
          <jet-section-border />
        </div>
        <div>
          <!-- Profile -->
          <jet-form-section>
            <template #title> Profile Information </template>

            <template #description> Update your profile information. </template>

            <template #form>
              <!-- Email -->
              <jet-input v-model="personal.user_id" disabled hidden />
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="email" value="Email" />
                <jet-input
                  id="email"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="profile.email"
                />
                <jet-input-error class="mt-2" />
              </div>

              <!-- Phone Number -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Phone Number" />
                <jet-input
                  id="phone"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="profile.phone_number"
                />
                <jet-input-error class="mt-2" />
              </div>

              <!-- Birthday -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="birthday" value="Birthday" />
                <jet-input
                  id="birthday"
                  type="date"
                  class="mt-1 block w-full"
                  v-model="profile.birthday"
                />
                <jet-input-error class="mt-2" />
              </div>
            </template>

            <template #actions>
              <jet-button @click="saveProfile(profile)"> Save </jet-button>
            </template>
          </jet-form-section>
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
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default defineComponent({
  components: {
    ApplicantLayout,
    JetSectionBorder,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
  },

  props: {
    applicant: Object,
  },

  data() {
    return {
      personal: this.$inertia.form({
        id: this.applicant.user_id,
        fname: this.applicant.fname,
        mname: this.applicant.mname,
        lname: this.applicant.lname,
      }),
      profile: this.$inertia.form({
        id: this.applicant.user_id,
        email: this.applicant.email,
        phone_number: this.applicant.phone_number,
        birthday: this.applicant.birthday,
      }),
    };
  },

  methods: {
    // Save personal
    savePersonal: function (personal) {
      this.$inertia.post(
        this.route("applicant.update.personal", this.personal.id),
        this.personal,
        {}
      );
    },

    // Save profile
    saveProfile: function (profile) {
      this.$inertia.post(
        this.route("applicant.update.profile", this.profile.id),
        this.profile,
        {}
      );
    },
  },
});
</script>
