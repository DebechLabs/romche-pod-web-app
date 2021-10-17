<template>
    <Head title="Edit Client" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex-1">
                    Edit Client: <i>{{ $page.props.client.client_name }}</i>
                </h2>

                <Link :href="$routes('clients')" class="bg-green-500 font-bold px-3 py-2 text-white rounded">Back</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form method="PUT" enctype="multipart/form-data" @submit.prevent="submitData">
                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Client Details
                            </h6>
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-1/3 px-4">
                                    <div class="relative w-full mb-3">
                                        <avatar-upload class="h-40 w-40 rounded-full overflow-hidden" :defaultVal="$page.props.client.client_logo" v-model="form.logo"></avatar-upload>
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                        </progress>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-wrap">
                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Client Name</label>
                                        <input type="text" name="client_name" v-model="form.client_name" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap">
                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Client Address</label>
                                        <textarea cols="6" name="address" v-model="form.address" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150"></textarea>
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
                                        <label class="block uppercase text-blueGray-600 mb-2">Short Name / Alias</label>
                                        <input type="text" name="short_name" v-model="form.short_name" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap">
                                <div class="w-full px-4">
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-blueGray-600 mb-2">Goods Desctription</label>
                                        <input type="text" name="goods_description" v-model="form.goods_description" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
                                Contact Persons
                            </h6>
                            <div v-if="form.contact_persons.length < 1">
                                <div class="bg-gray-100 px-10 py-16">
                                    <h3 class="font-bold text-center ">There are no contact persons added. <a class="cursor-pointer text-blue-400" @click="addContactPerson">Add One</a></h3>
                                </div>
                            </div>
                            <div v-else>
                                <button type="button" class="text-white rounded bg-blue-500 px-2 py-1 mb-2" @click="addContactPerson">Add Contact Person</button>
                                <contact-person v-for="(person, index) in form.contact_persons" v-model="form.contact_persons[index]" :id="person.id" @remove="removeRow(person.id)"></contact-person>
                            </div>

                            <div class="items-center">
                                <button :disabled="form.processing" class = "mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 font-bold rounded hover:shadow-lg transition duration-200 w-full">Update Client</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>

import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import ContactPerson from "@/Pages/Clients/ContactPerson";
import AvatarUpload from "@/Components/AvatarUpload";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        AvatarUpload,
        ContactPerson,
        BreezeAuthenticatedLayout,
    },
    name: "EditClient",
    data(){
        return{
            form: useForm({
                logo: null,
                client_name: "",
                address: "",
                short_name: "",
                kra_pin: "",
                goods_description: "",
                contact_persons: []
            })
        }
    },
    mounted(){
        let clientDetails = this.$page.props.client;
        this.form.client_name = clientDetails.client_name
        this.form.address = clientDetails.address
        this.form.short_name = clientDetails.short_name
        this.form.kra_pin = clientDetails.kra_pin
        this.form.goods_description = clientDetails.goods_description
        this.form.contact_persons = (clientDetails.contact_person !== "null" && clientDetails.contact_person) ? JSON.parse(clientDetails.contact_person) : []
    },
    methods: {
        addContactPerson: function () {
            this.form.contact_persons.push({
                id: this.generateRandomId(),
                name: "",
                email: "",
                phone: ""
            })
        },
        submitData: function (event){
            this.form.post(`/clients/${this.$page.props.client.id}`, {
                _method: 'put',
                logo: this.form.logo,
                preseveScroll: true,
                onSuccess: () => {
                    this.form.reset()
                }
            })
        },
        generateRandomId: function () {
            return Math.random().toString(36).substr(7)
        },
        removeRow: function (id) {
            let row = this.form.contact_persons.find((item) => {
                return item.id === id
            })

            let index = this.form.contact_persons.indexOf(row)
            this.form.contact_persons.splice(index, 1)
        }
    }
}
</script>

<style scoped>

</style>
