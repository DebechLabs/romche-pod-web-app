<template>
    <div class="relative inline-block border-gray-100">
        <input accept="image/*" type="file" class="hidden" ref="file" @change="change"/>
        <img :src="src" class="w-full h-full object-cover " />
        <div class="absolute top-0 h-full w-full bg-black bg-opacity-25 flex items-center justify-center">
            <button type="button" @click="browse" class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <icon name="camera" class="h-6 w-6"></icon>
            </button>

            <button v-if="this.file" type="button" @click="remove" class="rounded-full hover:bg-white hover:bg-opacity-25 p-2 focus:outline-none text-white transition duration-200">
                <icon name="x" class="h-6 w-6"></icon>
            </button>
        </div>
    </div>
</template>

<script>
import Icon from "@/Components/Icon"
export default {
    name: "AvatarUpload",
    components: {Icon},
    props: {
        value: File
    },
    data(){
        let defaultImage = "/images/default.png"
        return {
            src: defaultImage,
            defaultImage: defaultImage,
            file: null
        }
    },
    methods: {
        browse(){
            this.$refs.file.click()
        },
        remove(){
            this.file = null
            this.src = this.defaultImage
            this.$emit('update:modelValue', null)
        },
        change(e){
            this.file = e.target.files[0]
            this.$emit('update:modelValue', this.file)
            let reader = new FileReader()
            reader.readAsDataURL(this.file)
            reader.onload = (e) =>  {
                this.src = e.target.result
            }
        }
    }
}
</script>

<style scoped>

</style>
