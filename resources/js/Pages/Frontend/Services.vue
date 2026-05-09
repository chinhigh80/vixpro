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
            Our Services
          </h1>
          <p class="text-xl text-gray-600 mb-8">
            Comprehensive courier and logistics solutions for businesses and individuals.
          </p>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Services We Offer
          </h2>
          <p class="text-gray-600 max-w-4xl mx-auto">
            From same-day delivery to nationwide shipping, we have you covered.
          </p>
        </div>
        <div class="grid gap-8 sm:grid-cols-1 lg:grid-cols-3">
          <div v-for="(service, index) in services" :key="index" class="bg-white rounded-lg shadow hover:shadow-xl transition-shadow duration-500 overflow-hidden">
            <div class="relative">
              <!-- Image placeholder -->
              <div class="w-full h-48 bg-gradient-to-r from-indigo-50 to-indigo-100 flex items-center justify-center">
                <svg class="w-16 h-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <!-- Dynamic icon based on service -->
                  <slot :name="service.icon"></slot>
                </svg>
              </div>
              <!-- Badge -->
              <div class="absolute top-4 left-4 bg-indigo-600 text-white text-xs font-medium px-2 py-1 rounded">
                {{ service.badge }}
              </div>
            </div>
            <div class="p-6">
              <h3 class="text-xl font-medium text-gray-900 mb-3">{{ service.title }}</h3>
              <p class="text-gray-600 mb-4">{{ service.description }}</p>
              <ul class="space-y-2 text-gray-500">
                <li v-for="feature in service.features" :key="feature" class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                  </svg>
                  <span>{{ feature }}</span>
                </li>
              </ul>
              <a href="#" class="mt-4 inline-block text-indigo-600 font-medium hover:text-indigo-800">
                Learn More
                <svg class="w-4 h-4 ml-1 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Service Areas Section -->
    <section class="bg-indigo-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">
            Nationwide Coverage
          </h2>
          <p class="text-gray-600 max-w-3xl mx-auto">
            We deliver to all 36 states in Nigeria, including major cities and remote areas.
          </p>
        </div>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
          <div v-for="(city, index) in cities" :key="index" class="text-center">
            <div class="w-16 h-16 mb-4 flex items-center justify-center bg-indigo-100 rounded-lg">
              <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"></circle>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
              </svg>
            </div>
            <p class="text-gray-600">{{ city }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            Ready to Use Our Services?
          </h2>
          <p class="text-gray-600 mb-8">
            Create an account and start shipping today with free shipping on qualifying orders.
          </p>
          <div class="flex justify-center space-x-4">
            <a href="/register" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
              Create Account
            </a>
            <a href="/contact" class="px-6 py-2 bg-white text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-50 transition-colors">
              Contact Us
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