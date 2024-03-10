<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Sidebar2 from "@/Components/Sidebar2.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import ProfilePicture from '@/Components/ProfilePicture.vue';
import {ref} from "vue";
import Sidebar from "@/Components/Sidebar.vue";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

//Adding profile picture

const user = usePage().props.auth.user;
const profileImageFile = ref(null);

const onFileChanged = (file) => {
    profileImageFile.value = file;
};

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
    <Head title="Profile" />

    <sidebar/>

    <div class="p-1 sm:ml-64 dark:bg-neutral-800">
        <div class="p-2 rounded-lg mt-9">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <h1 class="text-3xl font-black text-gray-600 dark:text-neutral-400">Settings</h1>

<!--                    Profile Picture-->
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex flex-col dark:bg-neutral-700">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-neutral-100">Profile Information</h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                Update your account's profile information and email address.
                            </p>
                        </header>
                        <div class="flex flex-row">
                            <ProfilePicture
                                :imageFile="profileImageFile"
                                :altText="user.name"
                                :initials="getInitials(user.name)"
                                class="mt-5"
                            />
                            <UpdateProfileInformationForm
                                :must-verify-email="mustVerifyEmail"
                                :status="status"
                                class="w-96 ml-10"
                            />
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-neutral-700">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-neutral-700">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>
