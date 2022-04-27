<template>
  <jet-form-section>
    <template #title> Profile Information </template>

    <template #description> Update your profile information. </template>

    <template #form>
      <!-- Email -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="email" value="Email" />
        <jet-input id="email" type="email" class="mt-1 block w-full" />
        <jet-input-error class="mt-2" />
      </div>

      <!-- Phone Number -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="phone" value="Phone Number" />
        <jet-input id="phone" type="number" class="mt-1 block w-full" />
        <jet-input-error class="mt-2" />
      </div>

      <!-- Birthday -->
      <div class="col-span-6 sm:col-span-4">
        <jet-label for="birthday" value="Birthday" />
        <jet-input id="birthday" type="date" class="mt-1 block w-full" />
        <jet-input-error class="mt-2" />
      </div>
    </template>

    <template #actions>
      <jet-action-message class="mr-3"> Saved. </jet-action-message>

      <jet-button> Save </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";

export default {
  props: ["sessions"],

  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
  },
};
</script>
