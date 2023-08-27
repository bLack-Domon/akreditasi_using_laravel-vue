<script setup>
import {Link} from '@inertiajs/vue3';

defineProps({
 data: {
  type: Object,
  default: () => ({}),
 },
});
</script>

<template>
 <nav aria-label="Page navigation example">
   <ul class="pagination" style="width: 400px; " v-if="data.links.length > 3">
     <li v-for="(link, k) in data.links" :key="k" class="page-item" :class="{'page-item active': link.active}">
      <a class="page-link" :href="link.url">
       <span v-html="link.label"></span>
      </a>
     </li>
   </ul>
 </nav>
</template>