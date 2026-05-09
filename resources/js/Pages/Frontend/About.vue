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
            About VixProDelivery
          </h1>
          <p class="text-xl text-gray-600 mb-8">
            Our story, mission, and commitment to excellence in delivery services.
          </p>
        </div>
      </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-1 lg:grid-cols-2 items-center">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">
              Our Journey
            </h2>
            <p class="text-gray-600 mb-4">
              Founded in 2020 by Mighty Thunder, VixProDelivery started as a solution to the inefficient delivery services in Nigeria. What began as a small local courier service has grown into a nationwide logistics company serving thousands of customers daily.
            </p>
            <p class="text-gray-600 mb-6">
              Our founder, a senior full-stack developer and serial technical founder, built every aspect of our technology stack from the ground up, ensuring we have the most reliable and efficient delivery platform in the market.
            </p>
            <a href="/services" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors inline-block">
              Learn About Our Services
            </a>
          </div>
          <div class="relative">
            <div class="w-full h-64 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg overflow-hidden shadow-lg">
              <!-- In a real app, we would have an actual image here -->
              <div class="absolute inset-0 flex items-center justify-center bg-indigo-500/20">
                <svg class="w-20 h-20 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                <span class="text-indigo-600 font-medium">Our Delivery Network</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission & Values Section -->
    <section class="bg-indigo-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Our Mission & Values
          </h2>
          <p class="text-gray-600">
            What drives us to deliver excellence every day.
          </p>
        </div>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 text-center">
          <div>
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 1118 0z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Reliability</h3>
            <p class="text-gray-600">
              We deliver on our promises, every single time.
            </p>
          </div>
          <div>
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Speed</h3>
            <p class="text-gray-600">
              Fast delivery times without compromosing safety.
            </p>
          </div>
          <div>
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.1 0-2 .9-2 2s1 2 2 2 2-.9 2-2-1-2-2-2zm0 12c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c2.21 0 4 1.79 4 4h-2c0-1.1-.9-2-2-2-1.1 0-2 .9-2 2z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Security</h3>
            <p class="text-gray-600">
              Your packages are insured and protected throughout transit.
            </p>
          </div>
          <div>
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m2 0a2 2 0 110 4h-6m6 0a2 2 0 100-4h-6m6 0A2 2 0 108 12h4z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Transparency</h3>
            <p class="text-gray-600">
              Real-time tracking and clear communication at every step.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Join Thousands of Satisfied Customers
          </h2>
          <p class="text-gray-600 mb-8">
            Experience the difference of a delivery service built by developers who care about every detail.
          </p>
          <div class="flex justify-center space-x-4">
            <a href="/register" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
              Create Account
            </a>
            <a href="/services" class="px-6 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
              See Our Services
            </a>
          </div>
        </div>
      </div>
    </section>
  </frontend-layout>
</template>

<script setup>
// No script needed for this page
</script>

<style scoped>
/* Add any page-specific styles here */
</style>