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
            Tracking Results
          </h1>
          <p class="text-xl text-gray-600 mb-8">
            Here are the details for your shipment.
          </p>
        </div>
      </div>
    </section>

    <!-- Tracking Details Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-xl p-8">
          <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
              <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
              </svg>
              Tracking Number: <span class="font-medium ml-2">{{ trackingNumber }}</span>
            </h2>
          </div>

          <!-- Shipment Info -->
          <div class="space-y-6">
            <div class="border-t pb-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4">Shipment Information</h3>
              <div class="grid gap-4 sm:grid-cols-2">
                <div>
                  <p class="text-sm text-gray-500">Sender Name</p>
                  <p class="text-gray-900">{{ shipment?.sender_name }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Sender Address</p>
                  <p class="text-gray-900">{{ shipment?.sender_address }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Receiver Name</p>
                  <p class="text-gray-900">{{ shipment?.receiver_name }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Receiver Address</p>
                  <p class="text-gray-900">{{ shipment?.receiver_address }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Service Level</p>
                  <p class="text-gray-900">{{ shipment?.service_level }}</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Weight</p>
                  <p class="text-gray-900">{{ shipment?.weight }} kg</p>
                </div>
              </div>
            </div>

            <!-- Status Timeline -->
            <div class="border-t pt-6">
              <h3 class="text-lg font-medium text-gray-900 mb-4">Status Timeline</h3>
              <div class="space-y-4">
                <template v-for="(update, index) in shipment?.status_updates" :key="index">
                  <div class="flex items-start">
                    <div class="flex-shrink-0 w-10 h-10" :class="getStatusClass(update.status)">
                      <span class="text-xs font-medium text-white">{{ update.status }}</span>
                    </div>
                    <div class="ml-3">
                      <p class="text-sm font-medium text-gray-900">{{ update.status }}</p>
                      <p class="text-sm text-gray-500">{{ update.note }}</p>
                      <p class="text-xs text-gray-400">{{ formatDate(update.created_at) }}</p>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Need Another Tracking?
          </h2>
          <p class="text-gray-600 mb-8">
            Track another package or learn more about our services.
          </p>
          <div class="flex justify-center space-x-4">
            <a href="/tracking" class="px-6 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
              Track Another Package
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
import { usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  trackingNumber: String,
  shipment: Object
});

const formatDate = (dateString) => {
  if (!dateString) return '';
  const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
  return new Date(dateString).toLocaleDateString(undefined, options);
};

const getStatusClass = (status) => {
  const statusMap = {
    'Pending': 'bg-yellow-500',
    'Processing': 'bg-blue-500',
    'In Transit': 'bg-indigo-500',
    'Out for Delivery': 'bg-green-500',
    'Delivered': 'bg-green-600',
    'Exception': 'bg-red-500',
    'Cancelled': 'bg-gray-500'
  };
  return statusMap[status] || 'bg-gray-500';
};
</script>

<style scoped>
/* Add any page-specific styles here */
</style>