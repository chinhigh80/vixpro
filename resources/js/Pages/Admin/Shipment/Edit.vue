<template>
  <div class="p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Edit Shipment</h1>
      <div class="flex space-x-3">
        <link :href="route('admin.shipments.show', shipment.id)" class="btn btn-outline">View</link>
        <link :href="route('admin.shipments.index')" class="btn btn-outline">Back to Shipments</link>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block text-sm font-medium mb-1">Tracking Number</label>
          <input type="text" v-model="form.tracking_number" class="input input-bordered w-full" :class="{'input-error': errors.tracking_number}" readonly>
          <p class="text-xs text-error" v-if="errors.tracking_number">{{ errors.tracking_number }}</p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Status</label>
            <select v-model="form.status" class="select select-bordered w-full" :class="{'select-error': errors.status}">
              <option value="">Select Status</option>
              <option value="pending">Pending</option>
              <option value="picked up">Picked Up</option>
              <option value="in transit">In Transit</option>
              <option value="customs">Customs</option>
              <option value="out for delivery">Out for Delivery</option>
              <option value="delivered">Delivered</option>
              <option value="exception">Exception</option>
            </select>
            <p class="text-xs text-error" v-if="errors.status">{{ errors.status }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Service Level</label>
            <select v-model="form.service_level" class="select select-bordered w-full" :class="{'select-error': errors.service_level}">
              <option value="">Select Service Level</option>
              <option value="standard">Standard</option>
              <option value="express">Express</option>
              <option value="overnight">Overnight</option>
              <option value="same_day">Same Day</option>
            </select>
            <p class="text-xs text-error" v-if="errors.service_level">{{ errors.service_level }}</p>
          </div>
        </div>

        <h2 class="text-xl font-bold mt-6">Sender Information</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" v-model="form.sender_name" class="input input-bordered w-full" :class="{'input-error': errors.sender_name}">
            <p class="text-xs text-error" v-if="errors.sender_name">{{ errors.sender_name }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="tel" v-model="form.sender_phone" class="input input-bordered w-full" :class="{'input-error': errors.sender_phone}">
            <p class="text-xs text-error" v-if="errors.sender_phone">{{ errors.sender_phone }}</p>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Address</label>
          <textarea v-model="form.sender_address" class="textarea textarea-bordered w-full" rows="3" :class="{'textarea-error': errors.sender_address}"></textarea>
          <p class="text-xs text-error" v-if="errors.sender_address">{{ errors.sender_address }}</p>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input type="email" v-model="form.sender_email" class="input input-bordered w-full" :class="{'input-error': errors.sender_email}">
          <p class="text-xs text-error" v-if="errors.sender_email">{{ errors.sender_email }}</p>
        </div>

        <h2 class="text-xl font-bold mt-6">Receiver Information</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Name</label>
            <input type="text" v-model="form.receiver_name" class="input input-bordered w-full" :class="{'input-error': errors.receiver_name}">
            <p class="text-xs text-error" v-if="errors.receiver_name">{{ errors.receiver_name }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Phone</label>
            <input type="tel" v-model="form.receiver_phone" class="input input-bordered w-full" :class="{'input-error': errors.receiver_phone}">
            <p class="text-xs text-error" v-if="errors.receiver_phone">{{ errors.receiver_phone }}</p>
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Address</label>
          <textarea v-model="form.receiver_address" class="textarea textarea-bordered w-full" rows="3" :class="{'textarea-error': errors.receiver_address}"></textarea>
          <p class="text-xs text-error" v-if="errors.receiver_address">{{ errors.receiver_address }}</p>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Email</label>
          <input type="email" v-model="form.receiver_email" class="input input-bordered w-full" :class="{'input-error': errors.receiver_email}">
          <p class="text-xs text-error" v-if="errors.receiver_email">{{ errors.receiver_email }}</p>
        </div>

        <h2 class="text-xl font-bold mt-6">Package Details</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Package Type</label>
            <input type="text" v-model="form.package_type" class="input input-bordered w-full" :class="{'input-error': errors.package_type}">
            <p class="text-xs text-error" v-if="errors.package_type">{{ errors.package_type }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Weight (kg)</label>
            <input type="number" step="0.01" v-model="form.weight_kg" class="input input-bordered w-full" :class="{'input-error': errors.weight_kg}">
            <p class="text-xs text-error" v-if="errors.weight_kg">{{ errors.weight_kg }}</p>
          </div>
        </div>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          <div v-if="form.dimensions">
            <label class="block text-sm font-medium mb-1">Length (cm)</label>
            <input type="number" step="0.01" v-model="form.dimensions.length" class="input input-bordered w-full">
          </div>
          <div v-if="form.dimensions">
            <label class="block text-sm font-medium mb-1">Width (cm)</label>
            <input type="number" step="0.01" v-model="form.dimensions.width" class="input input-bordered w-full">
          </div>
          <div v-if="form.dimensions">
            <label class="block text-sm font-medium mb-1">Height (cm)</label>
            <input type="number" step="0.01" v-model="form.dimensions.height" class="input input-bordered w-full">
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Content Description</label>
          <textarea v-model="form.content_description" class="textarea textarea-bordered w-full" rows="3" :class="{'textarea-error': errors.content_description}"></textarea>
          <p class="text-xs text-error" v-if="errors.content_description">{{ errors.content_description }}</p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Estimated Delivery Date</label>
            <input type="date" v-model="form.estimated_delivery_date" class="input input-bordered w-full">
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Actual Delivery Date</label>
            <input type="date" v-model="form.actual_delivery_date" class="input input-bordered w-full">
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Branch</label>
            <select v-model="form.branch_id" class="select select-bordered w-full">
              <option value="">No Branch</option>
              <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Assigned Driver</label>
            <select v-model="form.assigned_driver_id" class="select select-bordered w-full">
              <option value="">No Driver Assigned</option>
              <option v-for="driver in drivers" :key="driver.id" :value="driver.id">{{ driver.name }}</option>
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label class="block text-sm font-medium mb-1">Proof of Delivery</label>
            <input type="text" v-model="form.proof_of_delivery" class="input input-bordered w-full" :class="{'input-error': errors.proof_of_delivery}" placeholder="URL or file path">
            <p class="text-xs text-error" v-if="errors.proof_of_delivery">{{ errors.proof_of_delivery }}</p>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Label PDF Path</label>
            <input type="text" v-model="form.label_pdf_path" class="input input-bordered w-full" :class="{'input-error': errors.label_pdf_path}" placeholder="URL or file path">
            <p class="text-xs text-error" v-if="errors.label_pdf_path">{{ errors.label_pdf_path }}</p>
          </div>
        </div>

        <div class="flex justify-end space-x-4">
          <button type="button" @click="resetForm" class="btn btn-outline">Reset</button>
          <button type="submit" class="btn btn-primary">Update Shipment</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { ref, reactive, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

export default {
  setup() {
    const page = usePage();
    const shipment = ref(page.props.shipment);

    const form = useForm({
      tracking_number: shipment.value.tracking_number,
      status: shipment.value.status,
      service_level: shipment.value.service_level,
      sender_name: shipment.value.sender_name,
      sender_phone: shipment.value.sender_phone,
      sender_address: shipment.value.sender_address,
      sender_email: shipment.value.sender_email,
      receiver_name: shipment.value.receiver_name,
      receiver_phone: shipment.value.receiver_phone,
      receiver_address: shipment.value.receiver_address,
      receiver_email: shipment.value.receiver_email,
      package_type: shipment.value.package_type,
      weight_kg: shipment.value.weight_kg,
      dimensions: shipment.value.dimensions ? {
        length: shipment.value.dimensions.length,
        width: shipment.value.dimensions.width,
        height: shipment.value.dimensions.height
      } : { length: '', width: '', height: '' },
      content_description: shipment.value.content_description,
      estimated_delivery_date: shipment.value.estimated_delivery_date,
      actual_delivery_date: shipment.value.actual_delivery_date,
      branch_id: shipment.value.branch_id || '',
      assigned_driver_id: shipment.value.assigned_driver_id || '',
      proof_of_delivery: shipment.value.proof_of_delivery || '',
      label_pdf_path: shipment.value.label_pdf_path || '',
      user_id: shipment.value.user_id,
      created_by: shipment.value.created_by,
    });

    const branches = page.props.branches || [];
    const drivers = page.props.drivers || [];

    const submit = () => {
      form.put(route('admin.shipments.update', shipment.value.id), {
        onSuccess: () => {
          // Form will reset on success via Inertia
        },
        onError: () => {
          // Form errors are automatically handled by useForm
        }
      });
    };

    const resetForm = () => {
      form.reset();
    };

    return {
      form,
      shipment,
      branches,
      drivers,
      submit,
      resetForm,
    };
  }
};
</script>
