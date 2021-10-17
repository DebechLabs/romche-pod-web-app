<template>
    <div class="w-full">
        <table>
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b">
                    <th class="px-4 py-3" :key="`head-${column}`" v-for="column in columns">{{ column }}</th>
                </tr>
            </thead>
            <tbody>
            <tr v-for="row in rows" :key="`row-${row.id}`" class="text-gray-700 border-b">
                <td class="px-4 py-3">{{ driver.email_address }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "RomcheTable",
    props: {
        columns: Array,
        rows: Array
    }
}
</script>

<style scoped>

</style>
