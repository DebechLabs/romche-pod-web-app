<template>
    <transition name="slide-fade">
        <div v-if="flash && visible && !popstate" class="absolute flex max-w-xs w-full mt-12 mr-4 top-0 right-0 bg-white rounded shadow p-4">
            <div class="mr-2.5">
                <icon class="w-6 h-6 text-green-600" name="check" v-if="flash.type === 'success'"></icon>
                <icon class="w-6 h-6 text-red-600" name="x-circle" v-else-if="flash.type === 'error'"></icon>
            </div>
            <div class="flex-1 text-gray-800">
                {{ flash.message }}
            </div>
            <div class="ml-2">
                <button @click="visible = false" class="align-top text-gray-500 hover:text-gray-700 focus:outline-none focus:text-indigo-600">
                    <icon name="x" class="w-6 h-6"></icon>
                </button>
            </div>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Toast",
    props: {
        flash: Object,
        popstate: Boolean
    },
    data(){
        return {
            visible: false,
            timeout: null
        }
    },
    watch:{
        flash: {
            deep: true,
            immediate: true,
            handler(){
                this.visible = true
                if (this.timeout){
                    clearTimeout(this.timeout)
                }
                this.timeout = setTimeout(() => this.visible = false, 1000)
            }
        }
    }
}
</script>

<style>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.4s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(150px);
    opacity: 0;
}
</style>
