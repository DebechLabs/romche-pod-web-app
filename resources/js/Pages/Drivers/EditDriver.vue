<template>
    <Head title="Add Client" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                    Edit Driver: <i>{{ driver.driver_name }}</i>
                </h2>
                <Link :href="$routes('drivers.index')" class="bg-green-500 font-bold px-3 py-2 text-white rounded">Back</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="POST" enctype="multipart/form-data" @submit.prevent="submitData">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Driver Details
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Last Name</label>
                                        <input type="text" name="last_name" v-model="form.last_name" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Other Names</label>
                                        <input type="text" name="other_names" v-model="form.other_names" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Date of Birth</label>
                                        <input type="date" :max="new Date()" name="date_of_birth" v-model="form.date_of_birth" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">KRA PIN</label>
                                        <input type="text" name="kra_pin" v-model="form.kra_pin" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Driving License No.</label>
                                        <input type="text" name="license_no" v-model="form.license_no" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Driver Details
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Email Address</label>
                                        <input type="text" name="email_address" v-model="form.email_address" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>

                                <div class="w-full lg:w-6/12 px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Phone Number</label>
                                        <input type="text" name="phone_number" v-model="form.phone_number" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <div class="items-center">
                                <button :disabled="form.processing" class = "mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 font-bold rounded hover:shadow-lg transition duration-200 w-full">Update Driver</button>
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
    name: "EditDriver",
    components: {
        BreezeAuthenticatedLayout,
    },
    data(){
        return {
            driver: this.$page.props.driver,
            form: new useForm({
                last_name: "",
                other_names: "",
                kra_pin: "",
                phone_number: "",
                email_address: "",
                license_no: "",
                date_of_birth: ""
            })
        }
    },
    mounted(){
        this.form.last_name = this.driver.last_name
        this.form.other_names = this.driver.other_names
        this.form.kra_pin = this.driver.kra_pin
        this.form.phone_number = this.driver.phone_number
        this.form.email_address = this.driver.email_address
        this.form.license_no = this.driver.license_no
        this.form.date_of_birth = this.driver.date_of_birth
    },
    methods: {
        submitData: function(){
            this.form.put(`${this.$routes('drivers.update', this.driver.id)}`)
        }
    }
}
</script>

<style scoped>

</style>
