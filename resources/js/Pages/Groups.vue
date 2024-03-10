<template>
    <Head title="Groups"/>

    <sidebar2/>

    <div class="pt-1 sm:ml-64 bg-gray-100 dark:bg-neutral-800">
        <div class="rounded-lg mt-10">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-black text-gray-600 dark:text-neutral-400">Groups</h1>
                    <br>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 dark:bg-neutral-700">

                        <form @submit.prevent="createGroup">
                            <div class="mb-4">
                                <label for="title" class="block text-gray-600 text-sm font-bold mb-2 dark:text-neutral-400">Title:</label>
                                <input v-model="newGroup.title" type="text" id="title" name="title" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-600 dark:border-neutral-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-600 text-sm font-bold mb-2 font-medium dark:text-neutral-400">Description:</label>
                                <textarea v-model="newGroup.description" id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-600 dark:border-neutral-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="guests" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Invite guests</label>
                                <div class="relative">
                                    <input type="search" id="guests" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-neutral-600 dark:border-neutral-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add guest email" required />
                                    <button type="button" class="absolute inline-flex items-center px-3 py-1 text-sm font-medium text-white bg-blue-700 rounded-lg end-2 bottom-2 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                        <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/>
                                    </svg>Add</button>
                                </div>
                            </div>

                            <button type="submit" class="inline-block rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-center font-medium text-white hover:bg-indigo-700">Create Group</button>
                        </form>

                    </div>

<!--                    Old groups table-->
<!--                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">-->
<!--                        <h2 class="text-lg leading-6 font-medium text-gray-900">Your Groups</h2>-->
<!--                        <div v-if="groups.length > 0" class="mt-8">-->
<!--                            <h3 class="text-lg font-semibold mb-4">Groups:</h3>-->
<!--                            <ul>-->
<!--                                <li v-for="group in groups" :key="group.id">-->
<!--                                    <h4 class="text-md font-semibold">{{ group.title }}</h4>-->
<!--                                    <p>{{ group.description }}</p>-->
<!--                                    <hr class="my-2">-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                        <div v-else class="mt-8">-->
<!--                            <p>No groups available.</p>-->
<!--                        </div>-->
<!--                    </div>-->


                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mt-5 dark:bg-neutral-700">
                        <div class="flex flex-col">
                            <h2 class="text-lg ml-2 mt-1 mb-3 leading-6 font-medium text-gray-900 dark:text-neutral-100">Your Groups</h2>
                            <br>
                            <div class="-m-1.5 overflow-x-auto">
                                <div class="p-1.5 min-w-full inline-block align-middle">
                                    <div class="overflow-hidden">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-600">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Title</th>
                                                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Description</th>
                                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-600">
                                            <tr class="hover:bg-gray-100 dark:hover:bg-neutral-600">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Group 1</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Description...</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Delete</button>
                                                    <button type="button" class="inline-flex ml-3 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</button>

                                                </td>
                                            </tr>
                                            <tr class="hover:bg-gray-100 dark:hover:bg-neutral-600">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Group 2</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Description...</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Delete</button>
                                                    <button type="button" class="inline-flex ml-3 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Edit</button>

                                                </td>
                                            </tr>
                                            <tr class="hover:bg-gray-100 dark:hover:bg-neutral-600">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Group 3</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Description...</td>
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
    </div>
</template>

<script>
import { computed, ref } from 'vue'
import { usePage, Inertia } from '@inertiajs/inertia-vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import axios from 'axios';


export default {
    setup() {
        const assetsPath = computed(() => usePage().props.value.assetsPath);

    },
    components: {AuthenticatedLayout},
    data: function () {
        return {
            newGroup: {
                title: "",
                description: "",
            },
        }
    },
    methods:{
        createGroup () {
            console.log(this.newGroup)
            // Now you can use form.value here
            axios.post('api/groups', {input: this.newGroup})
                .then(response => {
                    this.newGroup.title = '' ;
                    this.newGroup.description = '' ;
                    console.log(response)
                })
                .catch(error => {
                    console.error('Error creating group: ', error);
                });
        }

    }
}
</script>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { usePage, Inertia } from '@inertiajs/inertia-vue3'
import axios from 'axios';
import {Head, useForm} from '@inertiajs/vue3';
import Sidebar2 from "@/Components/Sidebar2.vue";
const groups = ref([]);

const loadGroups = async () => {
    try {
        const response = await axios.get('/api/groups');
        groups.value = response.data;
        console.log(groups.value);
    } catch (error) {
        console.error('Error loading groups: ', error);
    }
};

onMounted(loadGroups);
</script>
