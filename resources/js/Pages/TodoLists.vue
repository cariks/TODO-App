
<template>
    <Head title="TODO Lists" />

    <sidebar2/>

    <div class="p-1 sm:ml-64">
        <div class="rounded-lg mt-10">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 dark:bg-neutral-700">
                        <h3 class="text-xl leading-6 font-medium text-neutral-600 dark:text-neutral-200">
                            Create TODO Lists
                        </h3>
                        <div class="flex flex-col mb-4 mt-4">
                            <div class="w-1/2 mr-4">
                                <label for="group" class="block text-gray-600 text-sm font-bold mb-2 dark:text-neutral-400">Select group:</label>
                                <select v-model="selectedGroup" id="group" class="py-3 px-4 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-gray-200 dark:focus:ring-gray-600">
                                    <option value="">All Groups</option>
                                    <option v-for="group in groups" :key="group.id" :value="group.id">
                                        {{ group.title }}
                                    </option>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="subtitle" class="block text-gray-600 text-sm font-bold mt-3 mb-2 dark:text-neutral-400">List title:</label>
                                <input v-model="subtitle" type="text" id="subtitle" name="subtitle" class="py-3 px-4 w-full block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-gray-600" placeholder="Title">
                            </div>
                            <!--                            Tasks-->
                            <label for="subtitle" class="block text-gray-600 text-sm font-bold mt-3 mb-2 dark:text-neutral-400">Tasks:</label>
                            <!-- Input Group -->
                            <div id="hs-wrapper-for-copy" class="space-y-3 ml-6">
                                <div id="hs-content-for-copy" class="flex flex-row">
                                    <input type="text" class="py-3 px-4 block w-64 border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-gray-600" placeholder="Enter Task">
                                    <input v-model="time" type="time" id="time" name="time" class="py-3 px-4 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-gray-600">
                                    <input v-model="untilDate" type="date" id="date" name="date" class="py-3 px-4 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-gray-600">
                                    <select v-model="selectNotif" id="notif1" class="py-3 px-4 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-600 dark:border-neutral-700 dark:text-neutral-200 dark:focus:ring-gray-600">
                                        <option value="" selected disabled>Notifications</option>
                                        <option value="" disabled>--------------</option>
                                        <option value="1">On day of event</option>
                                        <option value="2">1 day before</option>
                                        <option value="3">2 days before</option>
                                        <option value="4">1 week before</option>
                                    </select>
                                </div>

                            </div>

                            <p class="mt-3 text-end">
                                <button type="button" data-hs-copy-markup='{
                                "targetSelector": "#hs-content-for-copy",
                                "wrapperSelector": "#hs-wrapper-for-copy",
                                "limit": 30
                                }' id="hs-copy-content" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-500 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600">
                                    <svg class="flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                                    Add new task
                                </button>
                            </p>



                        </div>
                        <div class="border-t border-gray-200 dark:border-neutral-600 pt-4">
                            <button type="button" @click="addTask" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </button>
                        </div>
                        <ul class="mt-3 list-disc space-y-2">
                            <li v-for="task in tasks" :key="task.id">
                                <div class="flex flex-row items-center">
                                    <input type="checkbox" class="mr-2">
                                    <span class="text-sm font-medium text-gray-600">{{ task.title }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-5 dark:bg-neutral-700">
                        <h3 class="text-xl leading-6 font-medium text-neutral-600 dark:text-neutral-200">
                            Your TODO Lists
                        </h3>
                        <div class="-m-1.5 overflow-x-auto mt-3">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div class="overflow-hidden">
                                    <table class="min-w-full divide-y  divide-gray-200 dark:divide-neutral-500 dark:divide-gray-700">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Status</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Title</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Time</th>
                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Until Date</th>
                                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Delete</button>
                                                <button type="button" class="inline-flex ml-3 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</button>

                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar2 from "@/Components/Sidebar2.vue";
import groups from "@/Pages/Groups.vue";


// Replace these with actual data fetching and state management

const selectedGroup = null; // Replace with selected group data
const todoLists = []; // Replace with todo list data for the selected group

const newTodoList = {
    title: '',
};

const createTodoList = () => {
    // Implement backend logic to create a new todo list within the selected group
    console.log('Creating new todo list:', newTodoList);
    newTodoList.title = '';
};
</script>
