<template>
    <Head title="Clients" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clients
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="p-6 bg-white border-b border-gray-200 sm:rounded-lg" v-for="client in clients">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    data(){
        return {
            clients : []
        }
    },
    mounted(){
        this.getClients()
    },
    methods: {
        getClients: function () {
            axios.get("/api/clients")
                .then(res => {
                    this.clients =res.data
                })
        }
    }
}
</script>
