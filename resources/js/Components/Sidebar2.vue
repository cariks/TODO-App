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
<!--                                <div class="ms-3 relative">-->
<!--                                    <Dropdown align="right" width="48">-->
<!--                                        <template #trigger>-->
<!--                                        <span class="inline-flex rounded-md">-->
<!--                                            <button-->
<!--                                                type="button"-->
<!--                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"-->
<!--                                            >-->
<!--                                                {{ $page.props.auth.user.name }}-->

<!--                                                <svg-->
<!--                                                    class="ms-2 -me-0.5 h-4 w-4"-->
<!--                                                    xmlns="http://www.w3.org/2000/svg"-->
<!--                                                    viewBox="0 0 20 20"-->
<!--                                                    fill="currentColor"-->
<!--                                                >-->
<!--                                                    <path-->
<!--                                                        fill-rule="evenodd"-->
<!--                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"-->
<!--                                                        clip-rule="evenodd"-->
<!--                                                    />-->
<!--                                                </svg>-->
<!--                                            </button>-->
<!--                                        </span>-->
<!--                                        </template>-->

<!--                                        <template #content>-->
<!--                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>-->
<!--                                            <DropdownLink :href="route('logout')" method="post" as="button">-->
<!--                                                Log Out-->
<!--                                            </DropdownLink>-->
<!--                                        </template>-->
<!--                                    </Dropdown>-->
<!--                                </div>-->
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
                    <a href="/dashboard" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-neutral-100 dark:hover:bg-neutral-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/groups" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-neutral-100 dark:hover:bg-neutral-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Groups</span>
                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
                    </a>
                </li>

                <li>
                    <a href="/todo-lists" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-neutral-100 dark:hover:bg-neutral-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-neutral-400 group-hover:text-neutral-900 dark:group-hover:text-white" viewBox="0 -0.5 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>list [#1422]</title> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-379.000000, -600.000000)" fill="currentColor"> <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path d="M326.15,444 C325.5704,444 325.1,443.552 325.1,443 C325.1,442.448 325.5704,442 326.15,442 C326.7296,442 327.2,442.448 327.2,443 C327.2,443.552 326.7296,444 326.15,444 M327.2,440 L325.1,440 C323.93975,440 323,440.895 323,442 L323,444 C323,445.105 323.93975,446 325.1,446 L327.2,446 C328.36025,446 329.3,445.105 329.3,444 L329.3,442 C329.3,440.895 328.36025,440 327.2,440 M326.15,451 C325.5704,451 325.1,450.552 325.1,450 C325.1,449.448 325.5704,449 326.15,449 C326.7296,449 327.2,449.448 327.2,450 C327.2,450.552 326.7296,451 326.15,451 M327.2,447 L325.1,447 C323.93975,447 323,447.895 323,449 L323,451 C323,452.105 323.93975,453 325.1,453 L327.2,453 C328.36025,453 329.3,452.105 329.3,451 L329.3,449 C329.3,447.895 328.36025,447 327.2,447 M326.15,458 C325.5704,458 325.1,457.552 325.1,457 C325.1,456.448 325.5704,456 326.15,456 C326.7296,456 327.2,456.448 327.2,457 C327.2,457.552 326.7296,458 326.15,458 M327.2,454 L325.1,454 C323.93975,454 323,454.895 323,456 L323,458 C323,459.105 323.93975,460 325.1,460 L327.2,460 C328.36025,460 329.3,459.105 329.3,458 L329.3,456 C329.3,454.895 328.36025,454 327.2,454 M340.85,451 L334.55,451 C333.9704,451 333.5,450.552 333.5,450 C333.5,449.448 333.9704,449 334.55,449 L340.85,449 C341.4296,449 341.9,449.448 341.9,450 C341.9,450.552 341.4296,451 340.85,451 M341.9,447 L333.5,447 C332.33975,447 331.4,447.895 331.4,449 L331.4,451 C331.4,452.105 332.33975,453 333.5,453 L341.9,453 C343.06025,453 344,452.105 344,451 L344,449 C344,447.895 343.06025,447 341.9,447 M340.85,444 L334.55,444 C333.9704,444 333.5,443.552 333.5,443 C333.5,442.448 333.9704,442 334.55,442 L340.85,442 C341.4296,442 341.9,442.448 341.9,443 C341.9,443.552 341.4296,444 340.85,444 M341.9,440 L333.5,440 C332.33975,440 331.4,440.895 331.4,442 L331.4,444 C331.4,445.105 332.33975,446 333.5,446 L341.9,446 C343.06025,446 344,445.105 344,444 L344,442 C344,440.895 343.06025,440 341.9,440 M340.85,458 L334.55,458 C333.9704,458 333.5,457.552 333.5,457 C333.5,456.448 333.9704,456 334.55,456 L340.85,456 C341.4296,456 341.9,456.448 341.9,457 C341.9,457.552 341.4296,458 340.85,458 M341.9,454 L333.5,454 C332.33975,454 331.4,454.895 331.4,456 L331.4,458 C331.4,459.105 332.33975,460 333.5,460 L341.9,460 C343.06025,460 344,459.105 344,458 L344,456 C344,454.895 343.06025,454 341.9,454" id="list-[#1422]"> </path> </g> </g> </g> </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Tasks</span>
                    </a>
                </li>
            </ul>



            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-neutral-700">
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700" :aria-controls="'dropdown-example-' + 1" :data-collapse-toggle="'dropdown-example-' + 1">

                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-neutral-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5 10.2c.6 0 1 .4 1 1v.2l6 3.5 6-3.5v-.2a1 1 0 1 1 2 0v.8c0 .4-.2.7-.5.9l-7 4a1 1 0 0 1-1 0l-7-4A1 1 0 0 1 4 12v-.8c0-.6.5-1 1-1Zm0 5c.6 0 1 .4 1 1v.2l6 3.4 6-3.4V16a1 1 0 1 1 2 0v.9c0 .3-.2.6-.5.8l-7 4a1 1 0 0 1-1 0l-7-4A1 1 0 0 1 4 17v-1c0-.5.4-1 1-1Z" clip-rule="evenodd"/>
                            <path d="M12.5 2.1a1 1 0 0 0-1 0l-7 4a1 1 0 0 0 0 1.8l7 4c.3.2.7.2 1 0l7-4a1 1 0 0 0 0-1.7l-7-4Z"/>
                        </svg>


                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Groups</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul :id="'dropdown-example-' + 1" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-700">Group name</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-neutral-100 dark:text-white dark:hover:bg-neutral-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg class="flex-shrink-0  w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-neutral-400 dark:group-hover:text-white" viewBox="0 -64 640 640" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                            <path d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"></path></g>
                        </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Shared groups</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-700">Shared group #1</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-neutral-700">Shared group #2</a>
                        </li>

                    </ul>
                </li>
            </ul>
            <div class="absolute bottom-0 left-0 p-3 w-full font-medium">
                <a href="/profile" class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-700 dark:text-white group">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-neutral-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M17 10v1.1l1 .5.8-.8 1.4 1.4-.8.8.5 1H21v2h-1.1l-.5 1 .8.8-1.4 1.4-.8-.8a4 4 0 0 1-1 .5V20h-2v-1.1a4 4 0 0 1-1-.5l-.8.8-1.4-1.4.8-.8a4 4 0 0 1-.5-1H11v-2h1.1l.5-1-.8-.8 1.4-1.4.8.8a4 4 0 0 1 1-.5V10h2Zm.4 3.6c.4.4.6.8.6 1.4a2 2 0 0 1-3.4 1.4A2 2 0 0 1 16 13c.5 0 1 .2 1.4.6ZM5 8a4 4 0 1 1 8 .7 7 7 0 0 0-3.3 3.2A4 4 0 0 1 5 8Zm4.3 5H7a4 4 0 0 0-4 4v1c0 1.1.9 2 2 2h6.1a7 7 0 0 1-1.8-7Z" clip-rule="evenodd"/>
                    </svg>

                    <span class="ms-3">Settings</span>
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
