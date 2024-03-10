<script setup>
import ToastListItem from "@/Components/ToastListItem.vue";
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {usePage} from "@inertiajs/vue3";

const items = ref([
    {message: "Notification test!"},
]);

const page = usePage();

Inertia.on("finish" , () => {
    if (page.props.value.toast){
        items.value.unshift({
            message: page.props.value.toast,
        });
    }
});

function remove(index){
    items.value.splice(index, 1);
}
</script>

<template>
    <div class="fixed top-4 right-4 z-50 space-y-4 w-full max-w-xs">
        <ToastListItem
            v-for="(item, index) in items"
            :key="index"
            :message="item.message"
            @remove="remove(index)"
        />

    </div>
</template>

<style scoped>

</style>
