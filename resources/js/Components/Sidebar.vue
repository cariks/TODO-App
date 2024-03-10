<script setup>
import {onMounted, ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link, router, usePage} from '@inertiajs/vue3';
import ToastList from "@/Components/ToastList.vue";
import ProfilePicture from "@/Components/ProfilePicture.vue";
import ProfilePictureSmall from "@/Components/ProfilePictureSmall.vue";

const showingNavigationDropdown = ref(false);

const user = usePage().props.auth.user;
const profileImageFile = ref(null);

// Logo images
const imageUrls = [
    'https://i.imgur.com/A3aTFuC.png',  //Default
    'https://i.imgur.com/DNFKD23.png',  //Clay
    'https://i.imgur.com/HUqHCeY.png',  //Drawing
];

const currentImageIndex = ref(0);

const changeImage = () => {
    currentImageIndex.value = (currentImageIndex.value + 1) % imageUrls.length;
    localStorage.setItem('currentImageIndex', currentImageIndex.value.toString());
};

// checking index when page is loaded
onMounted(() => {
    const savedIndex = localStorage.getItem('currentImageIndex');
    if (savedIndex !== null) {
        currentImageIndex.value = parseInt(savedIndex, 10);
    }
});

const toggleTheme = () => {
    const html = document.documentElement;

    if (html.classList.contains('dark')) {
        html.classList.remove('dark');
        localStorage.setItem('color-theme', 'light');
    } else {
        html.classList.add('dark');
        localStorage.setItem('color-theme', 'dark');
    }
};

//Profile pic
const getInitials = (name) => {
    const words = name.split(' ');

    if (words.length === 1) {
        return words[0].slice(0, 2);
    } else {
        return words.slice(0, 2).map(word => word.charAt(0)).join('');
    }
};

</script>

<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:ring-neutral-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <div class="flex ms-2 md:me-24">
                        <div @click="changeImage" class="cursor-pointer">
                            <img :src="imageUrls[currentImageIndex]" class="h-8 me-3" alt="TODO Logo" />
                        </div>
                        <a href="/dashboard" class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white cursor-pointer">TODO Application</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <!--                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">-->
                            <!--                                <span class="sr-only">Open user menu</span>-->
                            <!--                                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">-->
                            <!--                            </button>-->

                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- Settings Dropdown -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-neutral-800 dark:border-neutral-700" aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-neutral-800">

            <ul class="space-y-2 font-medium">
                <li>
                    <div class="flex items-center p-1.5 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-neutral-700 group">
                        <!--                        <div class="no-select relative inline-flex items-center justify-center w-9 h-9 overflow-hidden bg-gray-200 rounded-full dark:bg-neutral-600">-->
                        <!--                            <span class="font-medium text-gray-600 dark:text-neutral-300">{{ $page.props.auth.user.name.slice(0, 2) }}</span>-->

                        <!--                        </div>-->
                        <div>
                            <ProfilePictureSmall
                                :imageFile="profileImageFile"
                                :altText="user.name"
                                :initials="getInitials(user.name)"
                                class="mt-2"
                            />
                        </div>
                        <span class="ms-3">{{ $page.props.auth.user.name }}</span>

                        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="ml-auto mr-1">
                            <svg class="ease-in w-6 h-6 text-gray-200 transition duration-75 dark:text-neutral-600 group-hover:text-gray-500 dark:group-hover:text-neutral-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2788 2.15224C13.9085 2 13.439 2 12.5 2C11.561 2 11.0915 2 10.7212 2.15224C10.2274 2.35523 9.83509 2.74458 9.63056 3.23463C9.53719 3.45834 9.50065 3.7185 9.48635 4.09799C9.46534 4.65568 9.17716 5.17189 8.69017 5.45093C8.20318 5.72996 7.60864 5.71954 7.11149 5.45876C6.77318 5.2813 6.52789 5.18262 6.28599 5.15102C5.75609 5.08178 5.22018 5.22429 4.79616 5.5472C4.47814 5.78938 4.24339 6.1929 3.7739 6.99993C3.30441 7.80697 3.06967 8.21048 3.01735 8.60491C2.94758 9.1308 3.09118 9.66266 3.41655 10.0835C3.56506 10.2756 3.77377 10.437 4.0977 10.639C4.57391 10.936 4.88032 11.4419 4.88029 12C4.88026 12.5581 4.57386 13.0639 4.0977 13.3608C3.77372 13.5629 3.56497 13.7244 3.41645 13.9165C3.09108 14.3373 2.94749 14.8691 3.01725 15.395C3.06957 15.7894 3.30432 16.193 3.7738 17C4.24329 17.807 4.47804 18.2106 4.79606 18.4527C5.22008 18.7756 5.75599 18.9181 6.28589 18.8489C6.52778 18.8173 6.77305 18.7186 7.11133 18.5412C7.60852 18.2804 8.2031 18.27 8.69012 18.549C9.17714 18.8281 9.46533 19.3443 9.48635 19.9021C9.50065 20.2815 9.53719 20.5417 9.63056 20.7654C9.83509 21.2554 10.2274 21.6448 10.7212 21.8478C11.0915 22 11.561 22 12.5 22C13.439 22 13.9085 22 14.2788 21.8478C14.7726 21.6448 15.1649 21.2554 15.3694 20.7654C15.4628 20.5417 15.4994 20.2815 15.5137 19.902C15.5347 19.3443 15.8228 18.8281 16.3098 18.549C16.7968 18.2699 17.3914 18.2804 17.8886 18.5412C18.2269 18.7186 18.4721 18.8172 18.714 18.8488C19.2439 18.9181 19.7798 18.7756 20.2038 18.4527C20.5219 18.2105 20.7566 17.807 21.2261 16.9999C21.6956 16.1929 21.9303 15.7894 21.9827 15.395C22.0524 14.8691 21.9088 14.3372 21.5835 13.9164C21.4349 13.7243 21.2262 13.5628 20.9022 13.3608C20.4261 13.0639 20.1197 12.558 20.1197 11.9999C20.1197 11.4418 20.4261 10.9361 20.9022 10.6392C21.2263 10.4371 21.435 10.2757 21.5836 10.0835C21.9089 9.66273 22.0525 9.13087 21.9828 8.60497C21.9304 8.21055 21.6957 7.80703 21.2262 7C20.7567 6.19297 20.522 5.78945 20.2039 5.54727C19.7799 5.22436 19.244 5.08185 18.7141 5.15109C18.4722 5.18269 18.2269 5.28136 17.8887 5.4588C17.3915 5.71959 16.7969 5.73002 16.3099 5.45096C15.8229 5.17191 15.5347 4.65566 15.5136 4.09794C15.4993 3.71848 15.4628 3.45833 15.3694 3.23463C15.1649 2.74458 14.7726 2.35523 14.2788 2.15224ZM12.5 15C14.1695 15 15.5228 13.6569 15.5228 12C15.5228 10.3431 14.1695 9 12.5 9C10.8305 9 9.47716 10.3431 9.47716 12C9.47716 13.6569 10.8305 15 12.5 15Z"/>
                            </svg>
                        </button>


                        <!-- Dropdown menu -->
                        <div id="dropdownInformation" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-neutral-700 dark:divide-neutral-600">
                            <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                                <div>{{ $page.props.auth.user.name }}</div>
                                <div class="font-medium truncate">{{ $page.props.auth.user.email }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700 dark:text-neutral-200" aria-labelledby="dropdownInformationButton">
                                <li>
                                    <a href="/profile" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-neutral-600 dark:hover:text-white">Settings</a>
                                </li>
                            </ul>
                            <div class="py-2">
                                <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-neutral-600 dark:text-neutral-200 dark:hover:text-white">Log out</a>
                            </div>
                            <div @click="toggleTheme" class="py-2 flex align-bottom cursor-pointer hover:bg-gray-50 dark:hover:bg-neutral-600 dark:hover:rounded-b-lg">
                                <a class="block select-none px-4 py-2 text-sm text-gray-700 dark:text-neutral-200 dark:hover:text-white">Theme</a>
                                <button
                                    onclick="toggleTheme"
                                    class="mt-1.5 ml-10 w-12 h-6 rounded-full p-1 bg-gray-300 dark:bg-gray-650 relative transition-colors duration-500 ease-in focus:outline-none focus:ring-2 focus:ring-blue-700 dark:focus:ring-blue-600 focus:border-transparent">
                                    <div id="toggle"
                                         class="rounded-full w-4 h-4 bg-blue-600 dark:bg-blue-500 relative ml-0 dark:ml-6 pointer-events-none transition-all duration-300 ease-out">
                                    </div>
                                </button>
                            </div>
                        </div>

                    </div>
                </li>
            </ul>

            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-neutral-700">
                <li>
            </li>
            </ul>
            <div class="absolute bottom-0 left-0 mb-1 p-3 w-full font-medium">
                <a href="/dashboard" class="flex bg-neutral-100 dark:bg-neutral-700 items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-600 group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>return</title>
                        <path d="M0 21.984q0.032-0.8 0.608-1.376l4-4q0.448-0.48 1.056-0.576t1.12 0.128 0.864 0.736 0.352 1.12v1.984h18.016q0.8 0 1.408-0.576t0.576-1.408v-8q0-0.832-0.576-1.408t-1.408-0.608h-16q-0.736 0-1.248-0.416t-0.64-0.992 0-1.152 0.64-1.024 1.248-0.416h16q2.464 0 4.224 1.76t1.76 4.256v8q0 2.496-1.76 4.224t-4.224 1.76h-18.016v2.016q0 0.64-0.352 1.152t-0.896 0.704-1.12 0.096-1.024-0.544l-4-4q-0.64-0.608-0.608-1.44z"></path> </g>
                    </svg>
                    <span class="ms-3">Return</span>
                </a>
            </div>
        </div>

    </aside>

</template>

<style scoped>
</style>

<style>
.no-select {
    user-select: none;
}
</style>
