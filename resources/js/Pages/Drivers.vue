<template>
    <Head title="Drivers" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Drivers
                </h2>

                <Link :href="$routes('drivers.create')" class="ml-auto px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded hover:shadow-lg transition duration-200">Add Driver</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="min-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="w-full">
                                        <thead>
                                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b">
                                            <th class="px-4 py-3">Driver</th>
                                            <th class="px-4 py-3">Email Address</th>
                                            <th class="px-4 py-3">Phone Number</th>
                                            <th class="px-4 py-3">KRA PIN</th>
                                            <th class="px-4 py-3">DL No.</th>
                                            <th class="px-4 py-3"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="driver in drivers" :key="`driver-${driver.id}`" class="text-gray-700 border-b">
                                            <td class="px-4 py-3">
                                                <div class="flex items-center text-sm">
                                                    <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                        <img class="object-cover w-full h-full rounded-full" src="/images/driver.png" alt="" loading="lazy" />
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold text-black">{{ driver.driver_name }}</p>
                                                        <p class="text-xs text-gray-600">{{ driver.date_of_birth }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-3">{{ driver.email_address }}</td>
                                            <td class="px-4 py-3">{{ driver.phone_number }}</td>
                                            <td class="px-4 py-3">{{ driver.kra_pin }}</td>
                                            <td class="px-4 py-3">{{ driver.license_no }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-center">
                                                    <Link class="mr-2" :href="$routes('drivers.edit', driver.id)"><icon name="pencil-alt"></icon></Link>
                                                    <button class="mr-2" @click="deleteDriver(driver.id)"><icon name="trash"></icon></button>
                                                </div>
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
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head, useForm} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    data(){
        return {
            drivers: this.$page.props.drivers
        }
    },
    methods: {
        deleteDriver: function(id){
            let _this = this
            this.$swal({
                title: "Delete Driver",
                text: "This action cannot be undone. Proceed?",
                showCancelButton: true,
                confirmButtonText: 'Continue',
                showLoaderOnConfirm: true
            })
                .then((result) => {
                    if (result.isConfirmed) {
                        let form = new useForm({
                            id: id
                        })

                        form.delete(_this.$routes("drivers.destroy", id))
                    }
                })
        }
    }
}
</script>
