<template>
  <Head title="Log in" />

  <jet-authentication-card>
    <template #logo class="center">
      <JetAuthenticationCardLogo />
    </template>

    <jet-validation-errors class="mb-4" />

    <div>
      <!-- Control Number -->
      <div class="mt-4">
        <jet-label for="control_number" value="Control Number" />
        <jet-input
          id="control_number"
          type="number"
          class="mt-1 block w-full"
          v-model="form.control_number"
          required
        />
      </div>
      <!-- Email -->
      <div class="mt-4">
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />
      </div>
      <!-- Birthday -->
      <div class="mt-4">
        <jet-label for="birthday" value="Birthdate" />
        <jet-input
          id="birthday"
          type="date"
          class="mt-1 block w-full"
          v-model="form.birthday"
          @keyup.enter="login(form)"
          required
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <jet-secondary-button class="ml-4" @click="back"> Cancel </jet-secondary-button>
        <jet-button class="ml-4" @click="login(form)"> Log in </jet-button>
      </div>
    </div>
  </jet-authentication-card>
</template>

<script>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import JetFormSection from "@/Jetstream/FormSection";
import JetActionMessage from "@/Jetstream/ActionMessage";

export default {
  components: {
    Head,
    Link,
    useForm,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetSecondaryButton,
    JetValidationErrors,
    JetFormSection,
    JetActionMessage,
  },

  props: {},

  data() {
    return {
      disabled: null,

      form: this.$inertia.form({
        control_number: "",
        email: "",
        birthday: "",
        // remember_me: false,
      }),
    };
  },

  methods: {
    // Disable function
    disabledClick: function (s) {
      this.disabled = s;
    },

    // Back to index
    back: function () {
      this.$inertia.visit("/");
    },

    // Login method
    login: function (form) {
      this.$inertia.visit(route("applicant-login"), {
        method: "post",
        data: form,
        onBefore: () => {
          this.disabledClick(true);
        },
        onSuccess: () => {
          this.disabledClick(false), this.openModal(false), (this.form = {});
        },
        preserveScroll: true,
        preserveState: true,
      });
    },
  },
};
</script>
