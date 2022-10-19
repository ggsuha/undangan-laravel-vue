<script setup>
defineProps(["message"]);
</script>

<template>
    <div v-if="message !== undefined">
        <p class="text-sm">
            {{ message }}
        </p>
    </div>
</template>

<style>
p {
    color: #eeb34a;
}
</style>
