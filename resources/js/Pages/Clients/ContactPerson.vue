<template>
    <div class="mb-3">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/3 px-4">
                <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 mb-2">Name</label>
                    <input type="text" v-model="$attrs['modelValue'].name" name="name" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                </div>
            </div>
            <div class="w-full lg:w-1/3 px-4">
                <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 mb-2">Email Address</label>
                    <input type="email" v-model="$attrs['modelValue'].email" name="email_address" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                </div>
            </div>
            <div class="w-full lg:w-1/3 px-4">
                <div class="relative w-full mb-3">
                    <label class="block uppercase text-blueGray-600 mb-2">Phone Number</label>
                    <input type="text" v-model="$attrs['modelValue'].phone" name="phone" class="border-gray-100 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                </div>
            </div>
        </div>
        <div class="px-4">
            <a class="bg-red-500 px-2 py-1 rounded text-white shadow-sm cursor-pointer" @click="removeRow">Remove</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ContactPerson",
    props: {
        'value' : { type: null, default: null },
        id: {type: null, default: null}
    },
    data(){
        return{
            model: {
                id: this.id,
                name: "",
                email: "",
                phone: ""
            }
        }
    },
    mounted(){
        console.log(this.value)
    },
    methods: {
        updateModel: function (){
            this.$emit('update:modelValue', this.model)
        },
        removeRow: function (){
            this.$emit('remove')
        }
    }
}
</script>

<style scoped>

</style>
