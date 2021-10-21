<template>
    <Head title="Edit Vehicle" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Vehicle
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" enctype="multipart/form-data" @submit.prevent="submitData">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Vehicle Details
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Vehicle Registration</label>
                                        <input required type="text" name="registration_no" v-model="form.registration_no" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Vehicle Type</label>
                                        <select name="driver" v-model="form.vehicle_type" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" required>
                                            <option v-for="type in $page.props.fleet_types" :key="type.id" :value="type.id">{{ type.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Engine No</label>
                                        <input required type="text" name="date_of_birth" v-model="form.engine_no" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Chassis No</label>
                                        <input required type="text" name="chassis_no" v-model="form.chassis_no" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Logbook No</label>
                                        <input type="text" name="logbook_no" v-model="form.logbook_no" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Color</label>
                                        <input required type="text" name="color" v-model="form.color" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <div class="items-center">
                                <button :disabled="form.processing" class = "mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 font-bold rounded hover:shadow-lg transition duration-200 w-full">Update Vehicle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>

</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    name: "EditFleet",
    components: {
        BreezeAuthenticatedLayout,
    },
    data(){
        let vehicle = this.$page.props.vehicle;
        return {
            form: new useForm({
                registration_no: vehicle.registration_no,
                vehicle_type: vehicle.vehicle_type,
                color: vehicle.color,
                chassis_no: vehicle.chassis_no,
                engine_no: vehicle.engine_no,
                logbook_no: vehicle.logbook_no
            })
        }
    },
    methods: {
        submitData: function(){
            this.form.post(`${this.$routes('fleet.update', this.$page.props.vehicle.id)}`)
        }
    }
}
</script>

<style scoped>

</style>

