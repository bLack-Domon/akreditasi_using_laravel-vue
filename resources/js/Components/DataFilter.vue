<template>
 <div>
   <label for="status">Filter by Status:</label>
   <select v-model="selectedStatus" @change="applyFilter">
     <option value="">All</option>
     <option value="pending">Pending</option>
     <option value="completed">Completed</option>
   </select>
 </div>
</template>

<script>
export default {
 data() {
   return {
     selectedStatus: '',
   };
 },
 methods: {
   applyFilter() {
     this.$inertia.get(this.route('tasks.index', { status: this.selectedStatus }));
   },
 },
};
</script>
