<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold">Shipment Details</h2>
      <div class="flex space-x-3">
        <router-link :href="route('admin.shipments.index')" class="btn btn-secondary">
          Back to Shipments
        </router-link>
        <router-link :href="route('admin.shipments.edit', shipment.id)" class="btn btn-outline">
          Edit
        </router-link>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="text-center py-12">
      <div class="loading loading-spinner loading-lg mx-auto mb-4"></div>
      <p class="text-muted-foreground">Loading shipment details...</p>
    </div>

    <!-- Shipment Details -->
    <div v-else-else class="space-y-6">
      <!-- Shipment Header -->
      <div class="border p-6 rounded-lg">
        <div class="flex justify-between items-start">
          <div>
            <h3 class="text-lg font-medium">{{ shipment.tracking_number }}</h3>
            <p class="text-sm text-muted-foreground">
              Created on {{ formatDate(shipment.created_at) }}
            </p>
          </div>
          <span
            :class="[
              'badge',
              badgeVariant(shipment.status),
              shipment.status === 'Delivered' ? 'badge-success' :
                shipment.status === 'In Transit' ? 'badge-info' :
                shipment.status === 'Pending' ? 'badge-warning' : 'badge-secondary'
            ]"
          >
            {{ shipment.status }}
          </span>
        </div>
      </div>

      <!-- Details Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Sender Info -->
        <div class="border p-4 rounded-lg">
          <h3 class="text-lg font-semibold mb-4">Sender Information</h3>
          <div class="space-y-3">
            <p><span class="font-medium">Name:</span> {{ shipment.sender_name }}</p>
            <p><span class="font-medium">Phone:</span> {{ shipment.sender_phone }}</p>
            <p><span class="font-medium">Email:</span> {{ shipment.sender_email }}</p>
            <p><span class="font-medium">Address:</span></p>
            <p class="ml-4 text-muted-foreground">{{ shipment.sender_address }}</p>
          </div>
        </div>

        <!-- Receiver Info -->
        <div class="border p-4 rounded-lg">
          <h3 class="text-lg font-semibold mb-4">Receiver Information</h3>
          <div class="space-y-3">
            <p><span class="font-medium">Name:</span> {{ shipment.receiver_name }}</p>
            <p><span class="font-medium">Phone:</span> {{ shipment.receiver_phone }}</p>
            <p><span class="font-medium">Email:</span> {{ shipment.receiver_email }}</p>
            <p><span class="font-medium">Address:</span></p>
            <p class="ml-4 text-muted-foreground">{{ shipment.receiver_address }}</p>
          </div>
        </div>

        <!-- Package Details -->
        <div class="border p-4 rounded-lg">
          <h3 class="text-lg font-semibold mb-4">Package Details</h3>
          <div class="space-y-3">
            <p><span class="font-medium">Package Type:</span> {{ shipment.package_type }}</p>
            <p><span class="font-medium">Weight:</span> {{ shipment.weight_kg }} kg</p>
            <p><span class="font-medium">Dimensions:</span>
              {{ shipment.dimensions ? (
                `${shipment.dimensions.length} x ${shipment.dimensions.width} x ${shipment.dimensions.height} cm`
              ) : 'Not specified' }}
            </p>
            <p><span class="font-medium">Content Description:</span></p>
            <p class="ml-4 text-muted-foreground">{{ shipment.content_description }}</p>
            <p><span class="font-medium">Service Level:</span> {{ shipment.service_level }}</p>
            <p><span class="font-medium">Estimated Delivery:</span>
              {{ shipment.estimated_delivery_date ? formatDate(shipment.estimated_delivery_date) : 'Not set' }}
            </p>
          </div>
        </div>

        <!-- Delivery Info -->
        <div class="border p-4 rounded-lg">
          <h3 class="text-lg font-semibold mb-4">Delivery Information</h3>
          <div class="space-y-3">
            <p><span class="font-medium">Actual Delivery Date:</span>
              {{ shipment.actual_delivery_date ? formatDate(shipment.actual_delivery_date) : 'Not delivered' }}
            </p>
            <p><span class="font-medium">Delivered At:</span>
              {{ shipment.delivered_at ? formatDateTime(shipment.delivered_at) : 'Not delivered' }}
            </p>
            <p><span class="font-medium">Proof of Delivery:</span>
              {{ shipment.proof_of_delivery ? (
                <a :href="`/storage/${shipment.proof_of_delivery}`" target="_blank" class="text-primary underline">
                  View Proof
                </a>
              ) : 'None' }}
            </p>
            <p><span class="font-medium">Label PDF:</span>
              {{ shipment.label_pdf_path ? (
                <a :href="`/storage/${shipment.label_pdf_path}`" target="_blank" class="text-primary underline">
                  Download Label
                </a>
              ) : 'Not generated' }}
            </p>
          </div>
        </div>
      </div>

      <!-- Status Updates -->
      <div class="border p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-4">Status Updates</h3>
        <div v-if="loadingStatus" class="text-center py-4">
          <div class="loading loading-spinner loading-md mx-auto mb-2"></div>
          <p class="text-muted-foreground">Loading status updates...</p>
        </div>
        <div v-else-if="!loadingStatus && shipment.statusUpdates.length === 0" class="text-center py-4">
          <p class="text-muted-foreground">No status updates available.</p>
        </div>
        <div v-else-else class="space-y-3">
          <div
            v-for="update in shipment.statusUpdates"
            :key="update.id"
            class="border-l-2 border-primary pl-4 mb-4 pb-2"
          >
            <div class="flex justify-between items-start mb-1">
              <span class="font-medium">{{ update.status }}</span>
              <span class="text-xs text-muted-foreground">
                {{ formatDateTime(update.updated_at) }}
              </span>
            </div>
            <p class="text-sm text-muted-foreground">
              {{ update.note }}
            </p>
            <p v-if="update.user" class="text-xs text-muted-foreground mt-1">
              Updated by: {{ update.user.name }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'
import { useToast } from 'vue-toastification/compat'
import ToastPlugin from 'vue-toastification'

const toast = useToast()

const props = defineProps({
  shipment: Object,
})

const loading = ref(false)
const loadingStatus = ref(false)

// Helper functions
const formatDate = (dateString) => {
  if (!dateString) return ''
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const formatDateTime = (dateString) => {
  if (!dateString) return ''
  return new Date(dateString).toLocaleString()
}

const badgeVariant = (status) => {
  switch (status.toLowerCase()) {
    case 'pending':
      return 'badge-warning'
    case 'picked up':
      return 'badge-info'
    case 'in transit':
      return 'badge-info'
    case 'customs':
      return 'badge-info'
    case 'out for delivery':
      return 'badge-primary'
    case 'delivered':
      return 'badge-success'
    case 'exception':
      return 'badge-error'
    default:
      return 'badge-secondary'
  }
}
</script>