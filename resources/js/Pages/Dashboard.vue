<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import LineChart from "@/Pages/Chart/LineChart.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";

const form = useForm({
    email: '',
    symbol_price: '',
});
let status = '';
const submit = () => {
    form.post(route('createEmailNotification'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('email', 'symbol_price');
            status = 'success';
        },
        onError: () => {
            status = 'error';
        }
    });
};

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <LineChart/>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div
                    v-show="status === 'success'"
                    class="mt-2 font-medium text-green-600"
                >
                    You will be notified when the desired symbol price is reached!
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4, p-2">
                    <form @submit.prevent="submit">
                        <div>
                            <div class="block font-medium text-gray-700 my-2">Get notified via email when the price reaches desired level:</div>
                            <InputLabel for="email" value="Enter Your Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="price" value="Desired Price" />

                            <TextInput
                                id="price"
                                type="number"
                                class="mt-1 block w-full"
                                v-model="form.symbol_price"
                                required
                            />

                            <InputError class="mt-2" :message="form.errors.symbol_price" />
                        </div>

                        <div class="flex items-center justify-end mt-4">

                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Get Notified
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
