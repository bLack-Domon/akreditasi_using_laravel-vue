<template>
 <div class="calendar-container">
   <full-calendar :events="events" />
 </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import FullCalendar from 'vue-full-calendar';
import 'fullcalendar/dist/fullcalendar.min.css';

const events = ref([]);

onMounted(async () => {
 try {
   const response = await axios.get('/api/events');
   events.value = response.data;
 } catch (error) {
   console.error('Error fetching events', error);
 }
});

const components = {
 FullCalendar,
};
</script>

<style scoped>
/* Additional styles for your calendar component */
.calendar-container {
 /* Calendar container styles */
}
</style>