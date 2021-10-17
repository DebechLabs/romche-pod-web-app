<template>
    <Head title="Clients" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Clients
                </h2>

                <Link :href="$routes('clients.add')" class="ml-auto px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded hover:shadow-lg transition duration-200">Add Client</Link>
            </div>
        </template>

        <div class="py-12">
            <div class="min-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="w-full">
                                        <thead>
                                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b">
<!--                                                <th class="px-4 py-3">#</th>-->
                                                <th class="px-4 py-3">Client Name</th>
<!--                                                <th class="px-4 py-3">Client Short Name</th>-->
                                                <th class="px-4 py-3">Goods Description</th>
                                                <th class="px-4 py-3">KRA PIN</th>
                                                <th class="px-4 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="client in clients" class="text-gray-700 border-b">
<!--                                                <td class="px-4 py-3 border">{{ client.id }}</td>-->
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                            <img class="object-cover w-full h-full rounded-full" :src="`${client.client_logo}`" alt="" loading="lazy" />
                                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold text-black">{{ client.client_name }}</p>
                                                            <p class="text-xs text-gray-600">{{ client.short_name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
<!--                                                <td class="px-4 py-3 border"></td>-->
                                                <td class="px-4 py-3">{{ client.goods_description }}</td>
                                                <td class="px-4 py-3">{{ client.kra_pin }}</td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center justify-center">
                                                        <Link class="mr-2" :href="$routes('clients.edit', client.id)"><icon name="pencil-alt"></icon></Link>
                                                        <button class="mr-2" @click="deleteClient(client.id)"><icon name="trash"></icon></button>
                                                        <button><icon name="truck"></icon></button>
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
import Button from "@/Components/Button";
import { useForm } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Button,
        BreezeAuthenticatedLayout,
    },
    data(){
        return {
            clients : this.$page.props.clients
        }
    },
    mounted(){
        // this.getClients()
    },
    methods: {
        getClients: function () {
            axios.get("/api/clients")
                .then(res => {
                    this.clients =res.data
                })
        },
        deleteClient: function (id) {
            this.$swal({
                title: "Delete Client",
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

                    form.delete(`/clients/${id}`)
                }
            })
        }
    }
}
</script>
