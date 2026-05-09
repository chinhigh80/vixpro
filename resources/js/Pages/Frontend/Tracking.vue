<template>
  <frontend-layout>
    <!-- Hero Section -->
    <section class="relative bg-gray-50 overflow-hidden">
      <div class="absolute inset-0 -z-10">
        <div class="absolute top-0 left-0 w-full h-1/2 bg-indigo-50"></div>
        <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-indigo-100"></div>
      </div>
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
          <h1 class="text-4xl font-bold text-gray-900 mb-6">
            Track Your Package
          </h1>
          <p class="text-xl text-gray-600 mb-8">
            Enter your tracking number to get real-time updates on your shipment.
          </p>
        </div>
      </div>
    </section>

    <!-- Tracking Form Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8">
          <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
            Enter Tracking Number
          </h2>
          <form @submit.prevent="trackPackage" class="space-y-6">
            <div>
              <label for="tracking_number" class="block text-gray-700 font-medium mb-2">
                Tracking Number
              </label>
              <input
                type="text"
                id="tracking_number"
                v-model="form.tracking_number"
                name="tracking_number"
                placeholder="e.g., VIXPRO123456789NG"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                autocomplete="off"
              >
              <p class="mt-2 text-sm text-gray-500">
                Your tracking number can be found in your confirmation email or SMS.
              </p>
            </div>
            <div class="flex justify-center">
              <button
                type="submit"
                class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105 active:scale-95 shadow-lg"
                :disabled="form.processing"
              >
                {{ form.processing ? 'Tracking...' : 'Track Package' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <!-- How Tracking Works Section -->
    <section class="bg-indigo-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            How Tracking Works
          </h2>
          <p class="text-gray-600 max-w-4xl mx-auto">
            Stay informed every step of the way with our detailed tracking system.
          </p>
        </div>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
          <div v-for="(step, index) in steps" :key="index" class="text-center group">
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <span class="text-indigo-600 text-xl font-bold">{{ index + 1 }}</span>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ step.title }}</h3>
            <p class="text-gray-600">{{ step.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Need Help Tracking?
          </h2>
          <p class="text-gray-600 mb-8">
            If you're having trouble tracking your package, our support team is here to help.
          </p>
          <div class="flex justify-center space-x-4">
            <a href="/contact" class="px-6 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
              Contact Support
            </a>
            <a href="/" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
              Back to Home
            </a>
          </div>
        </div>
      </div>
    </section>
  </frontend-layout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const form = useForm({
  tracking_number: ''
});

const steps = [
  {
    title: 'Package Picked Up',
    description: 'Your package has been collected from the sender and is ready for transit.'
  },
  {
    title: 'In Transit',
    description: 'Your package is moving through our network toward the destination.'
  },
  {
    title: 'Out for Delivery',
    description: 'Your package is with the courier and will be delivered today.'
  },
  {
    title: 'Delivered',
    description: 'Your package has been successfully delivered to the recipient.'
  }
];

function trackPackage() {
  if (form.tracking_number) {
    router.post(route('tracking.submit'), form.only(['tracking_number']));
  }
}
</script>

<style scoped>
/* Add any page-specific styles here */
</style>