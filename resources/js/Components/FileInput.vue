<template>
    <input
        :id="id"
        type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help"
        accept="image/*"
        @change="onFileChange"
    />
    <p class="text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG or JPG (MAX. 800x400px).</p>
</template>

<script setup>
const { emit } = defineEmits(['fileChanged']);

const props = defineProps(['id']);

const onFileChange = (event) => {
    const file = event.target.files[0];
    emit('fileChanged', file);
};
</script>
