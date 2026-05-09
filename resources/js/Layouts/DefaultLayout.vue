<template>
  <div class="min-h-screen bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
              <a href="/" class="text-xl font-bold text-indigo-600">
                VixProDelivery
              </a>
            </div>
            <!-- Navigation -->
            <div class="hidden md:flex md:items-center md:ml-10">
              <nav class="space-x-8">
                <a href="/" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                <a href="/about" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">About</a>
                <a href="/services" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Services</a>
                <a href="/tracking" class="text-indigo-600 border border-indigo-600 hover:bg-indigo-50 px-3 py-2 rounded-md text-sm font-medium">Tracking</a>
                <a href="/contact" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
              </nav>
            </div>
          </div>
          <div class="flex items-center">
            <!-- Authentication links will be handled by Jetstream -->
            <div class="ml-4">
              <!-- Placeholder for auth -->
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main -->
    <main class="py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <slot />
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <div>
            <h3 class="text-white font-bold mb-4">VixProDelivery</h3>
            <p class="text-gray-400">
              Reliable courier services with free shipping options. We deliver your packages with care and speed.
            </p>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Quick Links</h4>
            <ul class="space-y-2 text-gray-400">
              <li><a href="/" class="hover:text-white">Home</a></li>
              <li><a href="/about" class="hover:text-white">About</a></li>
              <li><a href="/services" class="hover:text-white">Services</a></li>
              <li><a href="/tracking" class="hover:text-white">Tracking</a></li>
              <li><a href="/contact" class="hover:text-white">Contact</a></li>
            </ul>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Contact Info</h4>
            <p class="text-gray-400">
              <span class="block">123 Delivery Street, Lagos, Nigeria</span>
              <span class="block">+234 123 456 7890</span>
              <span class="block">info@vixprodelivery.com</span>
            </p>
          </div>
          <div>
            <h4 class="text-white font-bold mb-4">Follow Us</h4>
            <div class="flex space-x-4">
              <a href="#" class="text-gray-400 hover:text-white"><!-- Facebook --></a>
              <a href="#" class="text-gray-400 hover:text-white"><!-- Twitter --></a>
              <a href="#" class="text-gray-400 hover:text-white"><!-- Instagram --></a>
              <a href="#" class="text-gray-400 hover:text-white"><!-- LinkedIn --></a>
            </div>
          </div>
        </div>
        <div class="mt-10 pt-8 border-t border-gray-700 text-center text-gray-400">
          <p>&copy; {{ new Date().getFullYear() }} VixProDelivery. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
// No script needed for layout
</script>

<style scoped>
/* Add any layout-specific styles here */
</style>
