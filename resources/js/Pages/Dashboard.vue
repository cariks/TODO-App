<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Sidebar2 from '@/Components/Sidebar2.vue';
import { Head } from '@inertiajs/vue3';
import {onMounted, ref} from "vue";
import axios from "axios";


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

//Calendar
import moment from 'moment';

const weekDays = ref([]);

const isToday = (date) => {
    const today = moment().format('YYYY-MM-DD');
    return date === today;
};

const fillWeekDays = () => {
    const currentDate = moment();
    weekDays.value = Array.from({ length: 7 }).map((_, index) => {
        const currentDay = currentDate.clone().add(index, 'days');
        return {
            name: currentDay.format('ddd'),
            date: currentDay.format('YYYY-MM-DD'),
            dayOfMonth: currentDay.format('D'),
        };
    });
};

fillWeekDays();


onMounted(loadGroups);
</script>

<template class="dark:bg-neutral-800">
    <Head title="Dashboard" />
    <sidebar2/>

    <div class="p-3 pt-1 sm:ml-64 bg-gray-100 dark:bg-neutral-800">
        <div class="p-4 rounded-lg mt-14">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border dark:bg-neutral-700">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                        <div class="max-w-full px-3 lg:w-1/2 lg:flex-none">
                            <div class="ml-3 flex flex-col h-full">
                                <h2 class="pt-2 mb-1 font-semibold text-3xl dark:text-neutral-100">Welcome, you have 0 tasks to complete for today!</h2>
                                <p class="mb-12 dark:text-neutral-400">TODO is a great app for keeping yourself organized and on track with all the things that you have to do! It's very intuitive and easy to navigate.</p>
                            </div>
                        </div>
                        <div class="max-w-full px-3 mt-12 ml-auto text-center lg:mt-0 lg:w-5/12 lg:flex-none">
                            <div class="h-full bg-gradient-to-tl from-purple-700 to-pink-500 rounded-xl">
                                <div class="relative flex items-center justify-center h-full">
                                    <img class="relative z-20 w-full pt-6" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-dashboard/assets/img/illustrations/rocket-white.png" alt="rocket" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 rounded-lg -mt-1 ">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border dark:bg-neutral-700 ">
                <div class="flex-auto p-4 ">
                    <div class="flex flex-wrap -mx-3 justify-center ">
<!--                        CALENDAR-->
                            <div class="flex space-x-1 ">
                                <div v-for="day in weekDays" :key="day.name" class="flex group hover:bg-purple-100 h-24 dark:hover:bg-neutral-500 hover:shadow-lg hover-light-shadow rounded-lg mx-1 transition-all duration-300 cursor-pointer justify-center w-16 relative">
                                   <div class="flex items-center px-4 py-4 rounded-lg " :class="{ 'bg-purple-500': isToday(day.date) }">
                                     <div class="text-center">
                                        <p :class="{ 'text-purple-900 font-bold dark:text-neutral-100': isToday(day.date), 'text-gray-900 dark:text-neutral-100': !isToday(day.date) }" class="text-sm transition-all duration-300">{{ day.name }} {{ day.dayOfMonth }}</p>
                                        <span v-if="isToday(day.date)" class="flex h-3 w-3 absolute -top-1 -right-1">
                                        <span class="animate-ping absolute group-hover:opacity-75 opacity-0 inline-flex h-full w-full rounded-full bg-purple-400 "></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
                                        </span>
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
