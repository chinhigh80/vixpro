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
            Contact Us
          </h1>
          <p class="text-xl text-gray-600 mb-8">
            Get in touch with our support team for any questions or assistance.
          </p>
        </div>
      </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-1 lg:grid-cols-2">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
              Get in Touch
            </h2>
            <p class="text-gray-600 mb-4">
              We're here to help! Whether you have a question about our services, need help with a shipment, or want to provide feedback, our team is ready to assist.
            </p>
            <form @submit.prevent="submitForm" class="space-y-6">
              <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">
                  Full Name
                </label>
                <input
                  type="text"
                  id="name"
                  v-model="form.name"
                  name="name"
                  placeholder="Enter your full name"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                  required
                >
              </div>
              <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">
                  Email Address
                </label>
                <input
                  type="email"
                  id="email"
                  v-model="form.email"
                  name="email"
                  placeholder="Enter your email address"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                  required
                >
              </div>
              <div>
                <label for="subject" class="block text-gray-700 font-medium mb-2">
                  Subject
                </label>
                <input
                  type="text"
                  id="subject"
                  v-model="form.subject"
                  name="subject"
                  placeholder="Enter subject"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                  required
                >
              </div>
              <div>
                <label for="message" class="block text-gray-700 font-medium mb-2">
                  Message
                </label>
                <textarea
                  id="message"
                  v-model="form.message"
                  name="message"
                  rows="5"
                  placeholder="Enter your message"
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                  required
                ></textarea>
              </div>
              <div class="flex justify-center">
                <button
                  type="submit"
                  class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105 active:scale-95 shadow-lg"
                  :disabled="form.processing"
                >
                  {{ form.processing ? 'Sending...' : 'Send Message' }}
                </button>
              </div>
            </form>
          </div>
          <div class="space-y-8">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                  Headquarters
                </h3>
                <p class="text-gray-600">
                  123 Delivery Street, Lagos, Nigeria
                </p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M6 6h12a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2z"></path>
                  </svg>
                  </div>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                  Phone
                </h3>
                <p class="text-gray-600">
                  +234 123 456 7890
                </p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                </div>
              </div>
              <div class="ml-4">
                <h3 class="text-lg font-medium text-gray-900 mb-2">
                  Email
                </h3>
                <p class="text-gray-600">
                  info@vixprodelivery.com
                </p>
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
            Need Immediate Assistance?
          </h2>
          <p class="text-gray-600 mb-8">
            For urgent matters, please call our hotline or use the live chat feature available during business hours.
          </p>
          <div class="flex justify-center space-x-4">
            <a href="tel:+2341234567890" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
              Call Now
            </a>
            <a href="/" class="px-6 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
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
  name: '',
  email: '',
  subject: '',
  message: ''
});

async function submitForm() {
  // In a real app, we would send this to a backend endpoint
  // For now, we'll just show a success message
  form.processing = true;
  try {
    // Simulate API call
    await new Promise(resolve => setTimeout(resolve, 1500));
    // Reset form
    form.reset();
    // Show success message (in a real app, we would use a toast or notification)
    alert('Thank you for your message! We will get back to you soon.');
  } catch (error) {
    // Handle error
    alert('Oops! Something went wrong. Please try again later.');
  } finally {
    form.processing = false;
  }
}
</script>

<style scoped>
/* Add any page-specific styles here */
</style>