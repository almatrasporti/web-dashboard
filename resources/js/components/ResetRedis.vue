<template>
    <a href="#"
       @click="resetRedis"
       class="block py-1 md:py-3 pl-1 align-middle text-gray-500 no-underline hover:text-gray-900 border-b-2 border-white hover:border-pink-500">
        <i class="fas fa-recycle fa-fw mr-3"></i><span class="pb-1 md:pb-0 text-sm">Reset real-time data</span>
    </a>
</template>

<script>
export default {
    name: "ResetRedis",

    methods: {
        resetRedis: function() {
            axios
                .delete('/reset')
                .then(response => {})
        }
    }
}
</script>

<style scoped>

</style>
