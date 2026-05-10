<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Shipments</h2>
        <Link :href="route('admin.shipments.create')" class="btn-primary">
          Create Shipment
        </Link>
      </div>

      <!-- Filters -->
      <form @submit.prevent="applyFilters" class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div>
          <label for="tracking_number" class="block text-sm font-medium text-gray-700 mb-1">
            Tracking Number
          </label>
          <input
            id="tracking_number"
            v-model="filters.tracking_number"
            type="text"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter tracking number"
          />
        </div>

        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
            Status
          </label>
          <select
            id="status"
            v-model="filters.status"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          >
            <option value="">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="picked up">Picked Up</option>
            <option value="in transit">In Transit</option>
            <option value="customs">Customs</option>
            <option value="out for delivery">Out for Delivery</option>
            <option value="delivered">Delivered</option>
            <option value="exception">Exception</option>
          </select>
        </div>

        <div>
          <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
            Start Date
          </label>
          <input
            id="start_date"
            v-model="filters.start_date"
            type="date"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          />
        </div>

        <div>
          <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
            End Date
          </label>
          <input
            id="end_date"
            v-model="filters.end_date"
            type="date"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          />
        </div>

        <div class="flex items-end">
          <button
            type="submit"
            class="btn-primary w-full"
          >
            Apply Filters
          </button>
          <button
            @click="resetFilters"
            class="ml-3 w-full btn-secondary"
          >
            Reset
          </button>
        </div>
      </form>

      <!-- Shipments Table -->
      <div class="border border-gray-200 rounded">
        <div class="px-4 py-3 sm:px-6">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tracking Number
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Sender
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Receiver
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Service Level
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr
                v-for="shipment in shipments.data"
                :key="shipment.id"
                class="hover:bg-gray-50"
              >
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ shipment.tracking_number }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ shipment.sender_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ shipment.receiver_name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span
                    :class="[
                      'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                      statusColor(shipment.status)
                    ]"
                  >
                    {{ shipment.status }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-500">{{ shipment.service_level }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <Link :href="route('admin.shipments.show', shipment.id)" class="text-indigo-600 hover:text-indigo-900">
                    View
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <% if (shipments.last_page > 1) { %>
        <div class="px-4 py-3 bg-gray-50 text-sm sm:px-6">
          <%= shipments.first_item %>–<%= shipments.last_item %> of <%= shipments.total %> shipments
        </div>
        <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6 sm:flex sm:items-center sm:justify-between">
          <% if (shipments.current_page > 1) { %>
          <Link
            :href="route('admin.shipments', { page: shipments.current_page - 1, ...filters })"
            <% } else { %>
              aria-disabled="true"
              class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-400 bg-white hover:bg-gray-50"
            <% } %>
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700"
          >
            Previous
          </Link>
          <% } %>
          <% if (shipments.current_page < shipments.last_page) { %>
          <Link
            :href="route('admin.shipments', { page: shipments.current_page + 1, ...filters })"
            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 ml-3"
          >
            Next
          </Link>
          <% } else { %>
            <span class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-400 bg-white hover:bg-gray-50 ml-3">
              Next
            </span>
          <% } %>
        </div>
        <% } %>
      </div>
    </div>
  </div>
</template>

<script>
import Link from '@/Jetstream/Link'

export default {
  layout: 'admin',
  props: {
    shipments: Object,
    filters: Object
  },
  methods: {
    statusColor(status) {
      switch (status.toLowerCase()) {
        case 'pending': return 'bg-yellow-100 text-yellow-800';
        case 'picked up': return 'bg-blue-100 text-blue-800';
        case 'in transit': return 'bg-indigo-100 text-indigo-800';
        case 'customs': return 'bg-purple-100 text-purple-800';
        case 'out for delivery': return 'bg-pink-100 text-pink-800';
        case 'delivered': return 'bg-green-100 text-green-800';
        case 'exception': return 'bg-red-100 text-red-800';
        default: return 'bg-gray-100 text-gray-800';
      }
    },
    applyFilters() {
      this.$inertia.get(
        route('admin.shipments', this.filters),
        { preserveState: true, preserveScroll: true }
      )
    },
    resetFilters() {
      this.$inertia.get(
        route('admin.shipments'),
        { preserveState: true, preserveScroll: true }
      )
      // Reset filters in the form (handled by the parent component via props)
      this.$emit('update:filters', {
        tracking_number: '',
        status: '',
        start_date: '',
        end_date: ''
      })
    }
  }
}
</script>