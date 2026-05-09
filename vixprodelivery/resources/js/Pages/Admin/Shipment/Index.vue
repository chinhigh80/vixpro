<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold">Shipments</h2>
      <div class="flex space-x-3">
        <router-link :href="route('admin.shipments.create')" class="btn btn-primary">
          New Shipment
        </router-link>
      </div>
    </div>

    <!-- Search and Filter Form -->
    <form @submit.prevent="applyFilters" class="bg-white p-4 rounded-lg shadow-sm mb-6">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label for="tracking" class="block text-sm font-medium mb-1">Tracking Number</label>
          <input
            v-model="filters.tracking"
            id="tracking"
            type="text"
            class="input input-bordered w-full"
            placeholder="Enter tracking number"
          />
        </div>

        <div>
          <label for="status" class="block text-sm font-medium mb-1">Status</label>
          <select
            v-model="filters.status"
            id="status"
            class="select select-bordered w-full"
          >
            <option value="">All Statuses</option>
            <option v-for="status in statuses" :key="status" :value="status">
              {{ status }}
            </option>
          </select>
        </div>

        <div class="flex items-end">
          <button type="submit" class="btn btn-primary">Apply Filters</button>
          <button @click="resetFilters" class="btn btn-ghost ml-2">Reset</button>
        </div>
      </div>
    </form>

    <!-- Loading State -->
    <div v-if="loading" class="text-center py-12">
      <div class="loading loading-spinner loading-lg mx-auto mb-4"></div>
      <p class="text-muted-foreground">Loading shipments...</p>
    </div>

    <!-- Empty State -->
    <div v-else-if="!loading && shipments.length === 0" class="text-center py-12">
      <p class="text-muted-foreground">No shipments found matching your criteria.</p>
    </div>

    <!-- Shipments Table -->
    <div v-else-else class="overflow-x-auto">
      <table class="table table-zircon w-full">
        <thead>
          <tr>
            <th>Tracking #</th>
            <th>Sender</th>
            <th>Receiver</th>
            <th>Status</th>
            <th>Service Level</th>
            <th>Weight (kg)</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="shipment in shipments" :key="shipment.id" class="hover:bg-muted">
            <td>
              <div class="font-medium">{{ shipment.tracking_number }}</div>
              <div class="text-xs text-muted-foreground">
                {{ formatDate(shipment.created_at) }}
              </div>
            </td>
            <td>
              <div class="font-medium">{{ shipment.sender_name }}</div>
              <div class="text-sm">{{ shipment.sender_address }}</div>
            </td>
            <td>
              <div class="font-medium">{{ shipment.receiver_name }}</div>
              <div class="text-sm">{{ shipment.receiver_address }}</div>
            </td>
            <td>
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
            </td>
            <td>{{ shipment.service_level }}</td>
            <td>{{ shipment.weight }}</td>
            <td class="text-center space-x-2">
              <router-link
                :href="route('admin.shipments.show', shipment.id)"
                class="btn btn-sm btn-primary"
              >
                View
              </router-link>
              <router-link
                :href="route('admin.shipments.edit', shipment.id)"
                class="btn btn-sm btn-secondary"
              >
                Edit
              </router-link>
              <button
                @click="confirmDelete(shipment.id)"
                class="btn btn-sm btn-error"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination (placeholder) -->
    <div v-if="!loading && shipments.length > 0" class="mt-6 flex justify-center">
      <p class="text-muted-foreground">
        Showing {{ shipments.length }} shipments
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePage, useForm } from '@inertiajs/inertia-vue3'
import { useToast } from 'vue-toastification/compat'
import ToastPlugin from 'vue-toastification'

const toast = useToast()

// Form for filters
const form = useForm({
  tracking: '',
  status: '',
})

// Computed filters
const filters = computed({
  get: () => form.data,
  set: (value) => {
    form.processing = false
    form.reset(value, { preserveState: true })
  },
})

// State
const loading = ref(false)
const shipments = ref([])
const statuses = ref([
  'Pending',
  'Processing',
  'In Transit',
  'Out for Delivery',
  'Delivered',
  'Exception',
  'Cancelled',
])

// Methods
const applyFilters = () => {
  loading.value = true
  form.get(route('admin.shipments.index'), {
    preserveState: true,
    onSuccess: () => {
      loading.value = false
    },
    onFinish: () => {
      loading.value = false
    },
  })
}

const resetFilters = () => {
  form.reset({
    tracking: '',
    status: '',
  })
  applyFilters()
}

const confirmDelete = (id) => {
  if (window.confirm('Are you sure you want to delete this shipment?')) {
    deleteShipment(id)
  }
}

const deleteShipment = async (id) => {
  try {
    await form.delete(route('admin.shipments.destroy', id))
    toast.success('Shipment deleted successfully')
    applyFilters()
  } catch (error) {
    toast.error('Failed to delete shipment')
  }
}

// Helper functions
const formatDate = (dateString) => {
  if (!dateString) return ''
  const options = { year: 'numeric', month: 'short', day: 'numeric' }
  return new Date(dateString).toLocaleDateString(undefined, options)
}

const badgeVariant = (status) => {
  switch (status.toLowerCase()) {
    case 'pending':
      return 'badge-warning'
    case 'processing':
      return 'badge-info'
    case 'in transit':
      return 'badge-info'
    case 'out for delivery':
      return 'badge-primary'
    case 'delivered':
      return 'badge-success'
    case 'exception':
      return 'badge-error'
    case 'cancelled':
      return 'badge-secondary'
    default:
      return 'badge-secondary'
  }
}

// Initial load
applyFilters()
</script>