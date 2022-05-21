<template>
  <home-layout title="Home">
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Full dashboard -->
        <div>
          <div class="flex flex-wrap mt-8">
            <!-- Left side -->
            <div class="w-full lg:w-8/12">
              <!-- Table div -->
              <div class="px-4 py-2 w-full bg-gray-700">
                <span class="uppercase tracking-wider text-white">Schedules</span>
              </div>

              <div class="relative md:pt-6 pb-6 pt-12">
                <div class="mx-auto w-full">
                  <div>
                    <div class="flex flex-wrap"></div>
                  </div>
                </div>
              </div>
              <!-- Table div -->
            </div>
            <!-- Left side -->

            <!-- Right side -->
            <div class="w-full lg:w-4/12">
              <div class="px-4 py-2 w-full bg-emerald-600">
                <span class="uppercase tracking-wider text-white">Calendar</span>
              </div>
              <div class="relative md:pt-6 pb-6 pt-12">
                <div class="mx-auto w-full">
                  <!-- <h5>Calendar</h5> -->
                  <div class="px-4">
                    <Calendar :attributes="attrs" disable-page-swipe is-expanded>
                    </Calendar>
                  </div>
                </div>
              </div>

              <!--  -->

              <div class="px-4 py-2 w-full bg-emerald-600">
                <span class="uppercase tracking-wider text-white"
                  >Contact Information</span
                >
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
    </div>
  </home-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HomeLayout from "@/Layouts/HomeLayout";
import { Calendar, DatePicker } from "v-calendar";

export default defineComponent({
  components: {
    Head,
    Link,
    Calendar,
    DatePicker,
    HomeLayout,
  },

  data() {
    return {
      attrs: [
        {
          key: "today",
          highlight: true,
          dates: new Date(),
        },
      ],
    };
  },
});
</script>
