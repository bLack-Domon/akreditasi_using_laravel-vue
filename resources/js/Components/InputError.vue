<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-red">
            <b>{{ message }}</b>
        </p>
    </div>
</template>
