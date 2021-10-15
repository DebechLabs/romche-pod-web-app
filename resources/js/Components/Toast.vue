<template>
    <div class="absolute flex max-w-xs w-full mt-4 mr-4 top-0 right-0 bg-white rounded shadow p-4">
        <div class="mr-2.5">
            <icon class="w-6 h-6 text-green-600" name="check"></icon>
        </div>
        <div class="flex-1 text-gray-800">
            Course Created
        </div>
        <div class="ml-2">
            <button class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                <icon name="x" class="w-6 h-6"></icon>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "Toast"
}
</script>

<style scoped>

</style>
