<template>
  <div class="p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Shipment Details</h1>
      <div class="flex space-x-3">
        <link :href="route('admin.shipments.edit', shipment.id)" class="btn btn-outline btn-secondary">Edit</link>
        <form @submit.prevent="deleteShipment" class="inline">
          <button type="submit" class="btn btn-outline btn-error" onclick="return confirm('Are you sure you want to delete this shipment?')">Delete</button>
        </form>
        <link :href="route('admin.shipments.index')" class="btn btn-outline">Back to Shipments</link>
      </div>
    </div>

    <!-- Shipment Info -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Tracking Information</h2>
        <p class="text-2xl font-bold tracking-wide">{{ shipment.tracking_number }}</p>
        <p class="text-muted-foreground">Created: {{ formatDate(shipment.created_at) }}</p>
      </div>
      
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Status</h2>
        <span :class="`badge badge-${getStatusBadgeClass(shipment.status)}`">{{ shipment.status }}</span>
        <p class="mt-2 text-sm text-muted-foreground">
          {{ shipment.estimated_delivery_date ? 'Estimated delivery: ' + formatDate(shipment.estimated_delivery_date) : '' }}
        </p>
        <p class="mt-1 text-sm text-muted-foreground" v-if="shipment.actual_delivery_date">
          Actual delivery: {{ formatDate(shipment.actual_delivery_date) }}
        </p>
      </div>

      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Service & Weight</h2>
        <p class="mb-1"><strong>Service Level:</strong> {{ shipment.service_level }}</p>
        <p class="mb-1"><strong>Weight:</strong> {{ shipment.weight_kg }} kg</p>
        <p v-if="shipment.dimensions" class="mb-1"><strong>Dimensions:</strong> 
          {{ shipment.dimensions.length }} × {{ shipment.dimensions.width }} × {{ shipment.dimensions.height }} cm
        </p>
      </div>

      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Assigned To</h2>
        <p class="mb-1"><strong>Branch:</strong> {{ shipment.branch ? shipment.branch.name : 'Not assigned' }}</p>
        <p class="mb-1"><strong>Driver:</strong> {{ shipment.assignedDriver ? shipment.assignedDriver.name : 'Not assigned' }}</p>
        <p class="mb-1"><strong>Created By:</strong> {{ shipment.createdBy ? shipment.createdBy.name : 'Unknown' }}</p>
      </div>
    </div>

    <!-- Sender & Receiver Info -->
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Sender Information</h2>
        <p class="mb-1"><strong>Name:</strong> {{ shipment.sender_name }}</p>
        <p class="mb-1"><strong>Phone:</strong> {{ shipment.sender_phone }}</p>
        <p class="mb-1"><strong>Email:</strong> {{ shipment.sender_email }}</p>
        <p class="mb-1"><strong>Address:</strong></p>
        <p class="text-sm text-muted-foreground">{{ shipment.sender_address }}</p>
      </div>

      <div class="bg-white rounded-lg shadow p-4">
        <h2 class="text-lg font-medium mb-2">Receiver Information</h2>
        <p class="mb-1"><strong>Name:</strong> {{ shipment.receiver_name }}</p>
        <p class="mb-1"><strong>Phone:</strong> {{ shipment.receiver_phone }}</p>
        <p class="mb-1"><strong>Email:</strong> {{ shipment.receiver_email }}</p>
        <p class="mb-1"><strong>Address:</strong></p>
        <p class="text-sm text-muted-foreground">{{ shipment.receiver_address }}</p>
      </div>
    </div>

    <!-- Package Details -->
    <div class="bg-white rounded-lg shadow p-4">
      <h2 class="text-lg font-medium mb-2">Package Details</h2>
      <p class="mb-1"><strong>Package Type:</strong> {{ shipment.package_type }}</p>
      <p class="mb-1"><strong>Content Description:</strong></p>
      <p class="text-sm text-muted-foreground">{{ shipment.content_description }}</p>
    </div>

    <!-- Status Updates -->
    <div class="mt-6">
      <h2 class="text-lg font-medium mb-4">Status Updates</h2>
      <div class="space-y-4">
        <div v-for="update in shipment.statusUpdates" :key="update.id" class="border-l-2 border-info pl-4">
          <div class="flex justify-between items-start mb-1">
            <span class="font-medium">{{ update.status }}</span>
            <span class="text-xs text-muted-foreground">{{ formatDateTime(update.created_at) }}</span>
          </div>
          <p class="text-sm text-muted-foreground" v-if="update.location"><strong>Location:</strong> {{ update.location }}</p>
          <p class="text-sm text-muted-foreground" v-if="update.note"><strong>Note:</strong> {{ update.note }}</p>
          <p class="text-xs text-muted-foreground" v-if="update.updatedBy">
            Updated by: {{ update.updatedBy ? update.updatedBy.name : 'Unknown' }}
          </p>
        </div>
      </div>
      <div v-if="shipment.statusUpdates.length === 0" class="text-center py-8 text-muted-foreground">
        No status updates yet.
      </div>
    </div>
  </div>
</template>

<script>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

export default {
  setup() {
    const page = usePage();
    const shipment = ref(page.props.shipment);

    const formatDate = (dateString) => {
      if (!dateString) return '';
      return new Date(dateString).toLocaleDateString();
    };

    const formatDateTime = (dateString) => {
      if (!dateString) return '';
      return new Date(dateString).toLocaleString();
    };

    const getStatusBadgeClass = (status) => {
      const statusMap = {
        pending: 'warning',
        'picked up': 'info',
        'in transit': 'info',
        customs: 'info',
        'out for delivery': 'primary',
        delivered: 'success',
        exception: 'error',
      };
      return statusMap[status] || 'neutral';
    };

    const deleteShipment = () => {
      // Use Inertia's delete method
      window.Inertia.delete(route('admin.shipments.destroy', shipment.value.id));
    };

    return {
      shipment,
      formatDate,
      formatDateTime,
      getStatusBadgeClass,
      deleteShipment,
      route
    };
  }
};
</script>