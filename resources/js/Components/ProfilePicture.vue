<template>
    <div class="relative inline-block overflow-hidden w-60 h-60 rounded-full">
        <img
            v-if="hasImage"
            :src="imageUrl"
            :alt="altText"
            class="object-cover w-full h-full rounded-full"
        />
        <div v-else class="flex items-center justify-center w-full h-full bg-gray-200 rounded-full dark:bg-gray-600">
            <span class="no-select text-9xl font-light -mt-3 -ml-1 text-gray-500 dark:text-gray-300">{{ initials }}</span>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps(['imageFile', 'altText', 'initials']);

const hasImage = props.imageFile !== null && props.imageFile !== undefined;

const imageUrl = computed(() => {
    if (hasImage) {
        return URL.createObjectURL(props.imageFile);
    }
    return '';
});
</script>

<style scoped>

</style>
