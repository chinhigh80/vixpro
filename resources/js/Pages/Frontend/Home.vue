<template>
  <frontend-layout>
    <!-- Hero Section with Animated Background -->
    <section class="relative bg-gray-50 overflow-hidden">
      <div class="absolute inset-0 -z-10">
        <!-- Animated gradient background -->
        <div class="absolute inset-0 bg-[linear-gradient_135deg,_#6a11cb_0%,#2575fc_100%] opacity-10"></div>
        <div class="absolute inset-0 -rotate-12 bg-[linear-gradient_135deg,_#6a11cb_0%,#2575fc_100%] opacity-5 animate-spin-slow"></div>
      </div>
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center">
          <h1 class="text-5xl font-bold text-white mb-6 drop-shadow-lg">
            Fast, Reliable Delivery <span class="text-indigo-100">with Free Shipping</span>
          </h1>
          <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto drop-shadow">
            Get your packages delivered anywhere in Nigeria with our trusted courier service. Enjoy real-time tracking, secure handling, and free shipping on qualifying orders.
          </p>
          <div class="flex justify-center space-x-4 flex-wrap">
            <input
              type="text"
              placeholder="Enter tracking number..."
              class="px-5 py-3 border border-gray-300 rounded-lg w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 bg-white/90 backdrop-blur-sm"
            >
            <button
              @click="trackPackage"
              class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105 active:scale-95 shadow-lg"
            >
              Track Package
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section with Icons and Animations -->
    <section class="py-16 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose VixProDelivery?</h2>
          <p class="text-gray-600 max-w-4xl mx-auto">
            Experience the difference with our premium courier services designed for your peace of mind.
          </p>
        </div>
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
          <div v-for="(feature, index) in features" :key="index" class="text-center group">
            <div class="w-20 h-20 mb-5 flex items-center justify-center bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg shadow-inner">
              <transition :name="`fade-${index}`">
                <svg class="w-10 h-10 text-white" v-if="feature.icon" :class="`animate-${feature.animation}`" aria-hidden="true">
                  <!-- Inline SVG based on feature -->
                  <slot :name="feature.icon"></slot>
                </svg>
              </transition>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ feature.title }}</h3>
            <p class="text-gray-600">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works Section with Slides -->
    <section class="bg-indigo-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">How It Works</h2>
          <p class="text-gray-600 max-w-3xl mx-auto">
            Simple steps to get your package delivered with VixProDelivery.
          </p>
        </div>
        <div class="relative">
          <!-- Slides container -->
          <div class="overflow-hidden rounded-lg shadow-lg">
            <div class="flex transition-transform duration-700 ease-in-out" :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
              <div v-for="(step, index) in steps" :key="index" class="flex-shrink-0 w-full lg:w-1/3 px-4">
                <div class="bg-white p-8 rounded-lg shadow hover:shadow-xl transition-shadow duration-500">
                  <div class="flex items-center mb-6">
                    <div class="w-14 h-14 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                      <span class="text-indigo-600 text-2xl font-bold">{{ index + 1 }}</span>
                    </div>
                    <div>
                      <h3 class="text-xl font-medium text-gray-900">{{ step.title }}</h3>
                      <p class="text-gray-600 mt-1">{{ step.description }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Navigation dots -->
          <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <button
              v-for="(step, index) in steps"
              :key="index"
              class="w-3 h-3 bg-gray-300 rounded-full hover:bg-indigo-500 transition-colors duration-300"
              :class="{ 'bg-indigo-500': currentSlide === index }"
              @click="currentSlide = index"
            ></button>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action Section with Video Background -->
    <section class="relative overflow-hidden">
      <!-- Video background (placeholder) -->
      <div class="absolute inset-0">
        <video autoPlay muted loop class="w-full h-full object-cover">
          <source src="https://assets.mixkit.co/videos/preview/mixkit-a-courier-delivering-a-package-in-an-urban-city_40280-large.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-black/40"></div>
      </div>
      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <h2 class="text-4xl font-bold text-white mb-6 drop-shadow-lg">
          Ready to Ship?
        </h2>
        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto drop-shadow">
          Create an account and start sending packages today with free shipping on qualifying orders.
        </p>
        <a href="/register" class="px-8 py-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105 active:scale-95 shadow-lg inline-block">
          Get Started Free
        </a>
      </div>
    </section>
  </frontend-layout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const features = [
  {
    title: 'Free Shipping',
    description: 'Enjoy free shipping on all orders over ₦10,000. No hidden fees.',
    icon: 'truck',
    animation: 'bounce'
  },
  {
    title: 'Fast Delivery',
    description: '95% of packages delivered within 24-48 hours across Nigeria.',
    icon: 'clock',
    animation: 'pulse'
  },
  {
    title: 'Real-time Tracking',
    description: 'Monitor your package every step of the way with live updates.',
    icon: 'map',
    animation: 'spin'
  },
  {
    title: 'Secure & Insured',
    description: 'All packages are insured and handled with utmost care.',
    icon: 'shield',
    animation: 'fade'
  }
];

const steps = [
  {
    title: 'Book Online',
    description: 'Schedule a pickup or drop off your package at our location.'
  },
  {
    title: 'We Pickup',
    description: 'Our courier arrives at your location to collect the package.'
  },
  {
    title: 'Track & Receive',
    description: 'Track in real-time and get notified when delivered.'
  }
];

const currentSlide = ref(0);
const form = useForm({
  tracking_number: ''
});

function trackPackage() {
  if (form.tracking_number) {
    router.post(route('tracking.submit'), form.only(['tracking_number']));
  }
}

// Auto slide change every 5 seconds
setInterval(() => {
  currentSlide.value = (currentSlide.value + 1) % steps.length;
}, 5000);
</script>

<style scoped>
/* Custom animations */
@keyframes spin-slow {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}
.animate-spin-slow {
  animation: spin-slow 20s linear infinite;
}
@keyframes bounce {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}
@keyframes fade {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}
</style>