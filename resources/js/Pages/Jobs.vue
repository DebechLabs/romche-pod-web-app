<template>
    <Head title="Jobs" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="flex flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Jobs
                </h2>

                <Link :href="$routes('jobs.create')" class="ml-auto px-4 py-1 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded hover:shadow-lg transition duration-200">Create Job</Link>
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
                                            <th class="px-2 py-3">Tracking No.</th>
                                            <th class="px-2 py-3">Client</th>
                                            <th class="px-2 py-3">Driver</th>
                                            <th class="px-2 py-3">Pickup & Destination</th>
                                            <th class="px-2 py-3">Goods Description</th>
                                            <th class="px-2 py-3">Status</th>
                                            <th class="px-2 py-3">Created At</th>
                                            <th class="px-2 py-3"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="job in jobs" :key="`job-${job.id}`" class="text-gray-700 border-b">
                                                <td class="px-2 py-3">
                                                    {{ job.tracking_number }}
                                                </td>
                                                <td class="px-2 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div class="relative w-8 h-8 mr-3 rounded-full md:block">
                                                            <img class="object-cover w-full h-full rounded-full" :src="job.client.client_logo" alt="" loading="lazy" />
                                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold text-black">{{ job.client.client_name }}</p>
                                                            <p class="text-xs text-gray-600">{{ job.client.short_name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-2 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold text-black">{{ job.driver.driver_name }}</p>
                                                            <p class="text-xs text-gray-600">{{ job.driver.phone_number }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-2 py-3">{{ job.pickup }} to {{ job.destination }}</td>
                                                <td class="px-4 py-3">{{ job.goods_description }}</td>
                                                <td class="px-4 py-3">
                                                    <span v-if="job.status === 'created'" class="bg-yellow-200 px-1 py-0.5 text-xs text-gray rounded">Created</span>
                                                    <span v-else-if="job.status === 'picked-up'" class="bg-blue-200 px-1 py-0.5 text-xs text-gray rounded">PickedUp</span>
                                                    <span v-else-if="job.status === 'delivered'" class="bg-green-200 px-1 py-0.5 text-xs text-gray rounded">Delivered</span>
                                                    <span v-else-if="job.status === 'canceled'" class="bg-red-200 px-1 py-0.5 text-xs text-gray rounded">Canceled</span>
                                                </td>
                                                <td class="px-4 py-3">{{ job.date_created }}</td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center justify-center">
                                                        <Link class="mr-2" :href="$routes('jobs.edit', job.id)"><icon name="pencil-alt"></icon></Link>
                                                        <button class="mr-2" @click="deleteJob(job.id)"><icon name="trash"></icon></button>
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
            jobs: this.$page.props.jobs
        }
    },
    methods: {
        deleteJob: function (id) {
            let _this = this
            this.$swal({
                title: "Delete Job",
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

                        form.delete(_this.$routes("jobs.destroy", id))
                    }
                })
        }
    }
}
</script>
