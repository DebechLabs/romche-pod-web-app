<template>
    <Head title="Fleet" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Fleet
                </h2>

                <Link :href="$routes('fleet.create')" class="ml-auto px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded hover:shadow-lg transition duration-200">Add Vehicle</Link>
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
                                        <tr class="text-sm font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b">
                                            <th class="px-2 py-3">Registration No.</th>
                                            <th class="px-2 py-3">Vehicle Type</th>
                                            <th class="px-2 py-3">Engine Number</th>
                                            <th class="px-2 py-3">Chassis Number</th>
                                            <th class="px-2 py-3">Color</th>
                                            <th class="px-2 py-3">Logbook No</th>
                                            <th class="px-2 py-3">Created At</th>
                                            <th class="px-2 py-3"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="vehicle in fleet" :key="`vehicle-${vehicle.id}`" class="text-gray-700 border-b">
                                            <td class="px-2 py-3">
                                                {{ vehicle.registration_no }}
                                            </td>
                                            <td class="px-2 py-3">
                                                {{ vehicle.vehicle_type }}
                                            </td>
                                            <td class="px-2 py-3">
                                                {{ vehicle.engine_no }}
                                            </td>
                                            <td class="px-2 py-3">{{ vehicle.chassis_no }}</td>
                                            <td class="px-4 py-3">{{ vehicle.color }}</td>
                                            <td class="px-4 py-3">
                                                {{ vehicle.logbook_no }}
                                            </td>
                                            <td class="px-4 py-3">{{ vehicle.created_at }}</td>
                                            <td class="px-4 py-3">
                                                <div class="flex items-center justify-center">
                                                    <Link class="mr-2" :href="$routes('fleet.edit', vehicle.id)"><icon name="pencil-alt"></icon></Link>
                                                    <button class="mr-2" @click="deleteVehicle(vehicle.id)"><icon name="trash"></icon></button>
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
import moment from 'moment'

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    filters: {
        moment: function (date) {
            return this.moment(date).format('MMMM Do YYYY, h:mm:ss a');
        }
    },
    created() {

    },
    data(){
        return {
            fleet: this.$page.props.fleet
        }
    },
    methods: {
        deleteVehicle: function (id) {
            let _this = this
            this.$swal({
                title: "Delete Vehicle",
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

                        form.delete(_this.$routes("fleet.destroy", id))
                    }
                })
        }
    }
}
</script>
