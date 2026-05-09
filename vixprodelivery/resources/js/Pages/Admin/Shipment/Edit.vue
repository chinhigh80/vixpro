<template>
  <div>
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-2xl font-semibold">Edit Shipment</h2>
      <div class="flex space-x-3">
        <router-link :href="route('admin.shipments.index')" class="btn btn-secondary">
          Back to Shipments
        </router-link>
        <router-link :href="route('admin.shipments.show', shipment.id)" class="btn btn-outline">
          View
        </router-link>
      </div>
    </div>

    <!-- Form -->
    <form @submit.prevent="onSubmit" class="space-y-6">
      <!-- Tracking Number -->
      <div>
        <label for="tracking_number" class="block text-sm font-medium mb-1">Tracking Number</label>
        <input
          id="tracking_number"
          v-model="form.tracking_number"
          type="text"
          class="input input-bordered w-full"
          required
        />
        <p class="text-xs text-destructive" v-if="errors.tracking_number">
          {{ errors.tracking_number[0] }}
        </p>
      </div>

      <!-- User (optional) -->
      <div>
        <label for="user_id" class="block text-sm font-medium mb-1">Assigned Customer (Optional)</label>
        <select
          id="user_id"
          v-model="form.user_id"
          class="select select-bordered w-full"
        >
          <option value="">None</option>
          <option v-for="user in users" :key="user.id" :value="user.id">
            {{ user.name }} ({{ user.email }})
          </option>
        </select>
      </div>

      <!-- Status -->
      <div>
        <label for="status" class="block text-sm font-medium mb-1">Status</label>
        <select
          id="status"
          v-model="form.status"
          class="select select-bordered w-full"
          required
        >
          <option value="">Select Status</option>
          <option
            v-for="status in statusOptions"
            :key="status"
            :value="status"
          >
            {{ status }}
          </option>
        </select>
        <p class="text-xs text-destructive" v-if="errors.status">
          {{ errors.status[0] }}
        </p>
      </div>

      <!-- Service Level -->
      <div>
        <label for="service_level" class="block text-sm font-medium mb-1">Service Level</label>
        <select
          id="service_level"
          v-model="form.service_level"
          class="select select-bordered w-full"
          required
        >
          <option value="">Select Service Level</option>
          <option
            v-for="level in serviceLevels"
            :key="level"
            :value="level"
          >
            {{ level }}
          </option>
        </select>
        <p class="text-xs text-destructive" v-if="errors.service_level">
          {{ errors.service_level[0] }}
        </p>
      </div>

      <!-- Sender Information -->
      <div class="border p-4 rounded-lg">
        <h3 class="text-lg font-semibold mb-4">Sender Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="sender_name" class="block text-sm font-medium mb-1">Name</label>
            <input
              id="sender_name"
              v-model="form.sender_name"
              type="text"
              class="input input-bordered w-full"
              required
            />
          </div>
          <div>
            <label for="sender_phone" class="block text-sm font-medium mb-1">Phone</label>
            <input
              id="sender_phone"
              v-model="form.sender_phone"
              type="tel"
              class="input input-bordered w-full"
              required
            />
          </div>
        </div>
        <div>
          <label for="sender_address" class="block text-sm font-medium mb-1">Address</label>
          <textarea
            id="sender_address"
            v-model="form.sender_address"
            rows="3"
            class="textarea textarea-bordered w-full"
            required
          ></textarea>
        </div>
        <div>
          <label for="sender_email" class="block text-sm font-medium mb-1">Email</label>
          <input
            id="sender_email"
            v-model="form.sender_email"
            type="email"
            class="input input-bordered w-full"
            required
          />
        </div>
      </div>

      <!-- Receiver Information -->
      <div class="border p-4 rounded-lg mt-4">
        <h3 class="text-lg font-semibold mb-4">Receiver Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="receiver_name" class="block text-sm font-medium mb-1">Name</label>
            <input
              id="receiver_name"
              v-model="form.receiver_name"
              type="text"
              class="input input-bordered w-full"
              required
            />
          </div>
          <div>
            <label for="receiver_phone" class="block text-sm font-medium mb-1">Phone</label>
            <input
              id="receiver_phone"
              v-model="form.receiver_phone"
              type="tel"
              class="input input-bordered w-full"
              required
            />
          </div>
        </div>
        <div>
          <label for="receiver_address" class="block text-sm font-medium mb-1">Address</label>
          <textarea
            id="receiver_address"
            v-model="form.receiver_address"
            rows="3"
            class="textarea textarea-bordered w-full"
            required
          ></textarea>
        </div>
        <div>
          <label for="receiver_email" class="block text-sm font-medium mb-1">Email</label>
          <input
            id="receiver_email"
            v-model="form.receiver_email"
            type="email"
            class="input input-bordered w-full"
            required
          />
        </div>
      </div>

      <!-- Package Details -->
      <div class="border p-4 rounded-lg mt-4">
        <h3 class="text-lg font-semibold mb-4">Package Details</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label for="package_type" class="block text-sm font-medium mb-1">Package Type</label>
            <input
              id="package_type"
              v-model="form.package_type"
              type="text"
              class="input input-bordered w-full"
              required
            />
          </div>
          <div>
            <label for="weight_kg" class="block text-sm font-medium mb-1">Weight (kg)</label>
            <input
              id="weight_kg"
              v-model.number="form.weight_kg"
              type="number"
              class="input input-bordered w-full"
              min="0.01"
              step="0.01"
              required
            />
          </div>
        </div>
        <div class="mt-4">
          <label for="content_description" class="block text-sm font-medium mb-1">Content Description</label>
          <textarea
            id="content_description"
            v-model="form.content_description"
            rows="3"
            class="textarea textarea-bordered w-full"
            required
          ></textarea>
        </div>
        <div class="mt-4">
          <label for="estimated_delivery_date" class="block text-sm font-medium mb-1">Estimated Delivery Date</label>
          <input
            id="estimated_delivery_date"
            v-model="form.estimated_delivery_date"
            type="date"
            class="input input-bordered w-full"
          />
        </div>
        <div class="mt-4">
          <label for="actual_delivery_date" class="block text-sm font-medium mb-1">Actual Delivery Date</label>
          <input
            id="actual_delivery_date"
            v-model="form.actual_delivery_date"
            type="date"
            class="input input-bordered w-full"
          />
        </div>
        <div class="mt-4">
          <label for="delivered_at" class="block text-sm font-medium mb-1">Delivered At (Timestamp)</label>
          <input
            id="delivered_at"
            v-model="form.delivered_at"
            type="datetime-local"
            class="input input-bordered w-full"
          />
        </div>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button
          type="submit"
          class="btn btn-primary"
          :disabled="processing"
        >
          {{ processing ? 'Updating...' : 'Update Shipment' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useForm, usePage } from '@inertiajs/inertia-vue3'
import { useToast } from 'vue-toastification/compat'
import ToastPlugin from 'vue-toastification'

const toast = useToast()

const props = defineProps({
  shipment: Object,
})

const form = useForm({
  tracking_number: '',
  user_id: '',
  status: '',
  service_level: '',
  sender_name: '',
  sender_address: '',
  sender_phone: '',
  sender_email: '',
  receiver_name: '',
  receiver_address: '',
  receiver_phone: '',
  receiver_email: '',
  package_type: '',
  weight_kg: '',
  content_description: '',
  estimated_delivery_date: '',
  actual_delivery_date: '',
  delivered_at: '',
})

const errors = ref({})
const processing = ref(false)

const statusOptions = [
  'pending',
  'picked up',
  'in transit',
  'customs',
  'out for delivery',
  'delivered',
  'exception',
]

const serviceLevels = ['standard', 'express', 'overnight', 'same_day']

// Fetch users for the dropdown (optional)
const users = ref([])

async function fetchUsers() {
  try {
    const { data } = await usePage().props.value
    users.value = data.users || []
  } catch (error) {
    console.error('Failed to fetch users:', error)
  }
}

// Initialize form with shipment data
onMounted(() => {
  form.reset(shipment)
  // Convert dates to proper format for input
  if (shipment.estimated_delivery_date) {
    form.estimated_delivery_date = shipment.estimated_delivery_date
  }
  if (shipment.actual_delivery_date) {
    form.actual_delivery_date = shipment.actual_delivery_date
  }
  if (shipment.delivered_at) {
    // Convert to ISO string for datetime-local input
    const date = new Date(shipment.delivered_at)
    form.delivered_at = date.toISOString().slice(0, 16)
  }
  fetchUsers()
})

// Submit handler
async function onSubmit() {
  processing.value = true
  errors.value = {}

  try {
    await form.put(route('admin.shipments.update', shipment.id))
    toast.success('Shipment updated successfully')
    // Redirect to show page
    window.location.href = route('admin.shipments.show', shipment.id)
  } catch (error) {
    if (error.response && error.response.data && error.response.data.errors) {
      errors.value = error.response.data.errors
    }
    toast.error('Failed to update shipment. Please check the form.')
  } finally {
    processing.value = false
  }
}
</script>