<template>
    <Head title="Edit Job" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                    Edit Job: {{ $page.props.job.tracking_number }}
                </h2>
                <Link :href="$routes('jobs.index')" class="bg-green-500 font-bold px-3 py-2 text-white rounded">Back</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" enctype="multipart/form-data" @submit.prevent="submitData">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Job Details
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Tracking Number</label>
                                        <input placeholder="Generated after adding job" type="text" name="tracking_number" readonly v-model="form.tracking_number" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Client</label>
                                        <select name="client" v-model="form.client_id" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option v-for="client in $page.props.clients" :key="client.id" :value="client.id">{{ client.client_name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <label class="block uppercase text-blueGray-600 mb-2">Driver</label>
                                    <select name="driver" v-model="form.driver_id" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                        <option v-for="driver in $page.props.drivers" :key="driver.id" :value="driver.id">{{ driver.driver_name }}</option>
                                    </select>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Pickup</label>
                                        <input type="text" name="pickup" v-model="form.pickup" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Destinaton</label>
                                        <input type="text" name="destination" v-model="form.destination" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Vehicle</label>
                                        <select name="driver" v-model="form.fleet_id" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150" required>
                                            <option v-for="fleet in $page.props.fleet" :key="fleet.id" :value="fleet.id">{{ fleet.registration_no }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Status</label>
                                        <select name="status" v-model="form.status" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                            <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.text }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Goods Description</label>
                                        <textarea rows="5" name="goods_description" v-model="form.goods_description" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="items-center">
                                <button :disabled="form.processing" class = "mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 font-bold rounded hover:shadow-lg transition duration-200 w-full">Update Job</button>
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
    name: "EditJob",
    components: {
        BreezeAuthenticatedLayout,
    },
    data(){
        let job = this.$page.props.job;
        return {
            form: new useForm({
                driver_id: job.driver_id,
                client_id: job.client_id,
                tracking_number: job.tracking_number,
                pickup: job.pickup,
                destination: job.destination,
                goods_description: job.goods_description,
                status: job.status,
                fleet_id: job.fleet_id
            }),
            statuses: [
                { id: 'created', text: 'Created' },
                { id: 'delivered', text: 'Delivered' },
                { id: 'picked-up', text: 'Picked Up' },
                { id: 'canceled', text: 'Canceled'}
            ]
        }
    },
    methods: {
        submitData: function(){
            this.form.put(`${this.$routes('jobs.update', this.$page.props.job.id)}`)
        }
    }
}
</script>

<style scoped>

</style>
