<template>
    <div class="flex flex-wrap">
        <div v-for="service in Object.keys(services)" class="w-full md:w-1/2 xl:w-1/4 p-3">
            <!--Metric Card-->
            <div class="bg-white border rounded shadow p-2">
                <div class="flex flex-row items-center">
                    <div class="flex-shrink pr-4">
                        <div class="rounded p-3" :class="services[service] ? 'bg-green-600' : 'bg-red-500'"><i
                            class="fa fa-cog fa-2x fa-fw fa-inverse"></i></div>
                    </div>
                    <div class="flex-1 text-right md:text-center">
                        <h5 class="font-bold uppercase text-gray-500">{{ service }}</h5>
                        <div v-if="services[service]">
                            <h3 class="font-bold text-3xl">OK <span class="text-green-500"><i
                                class="fas fa-caret-up"></i></span>

                            </h3>
                            <div v-if="canBeManaged(service)">
                                <button @click="kill(service)"
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-red-500 hover:border-red-600 hover:bg-red-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                    <span class="mr-2">Kill</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div v-else>
                            <h3 class="font-bold text-3xl">KO <span class="text-red-500"><i
                                class="fas fa-caret-down"></i></span></h3>
                            <div v-if="canBeManaged(service)">
                                <button @click="start(service)"
                                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                    <span class="mr-2">Start</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentcolor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Metric Card-->
        </div>
    </div>

</template>

<script>
import {EventBus} from "../event-bus";

export default {
    name: "Widgets",
    data() {
        return {
            bus: EventBus,
            services: [],
            loading: false,
            manageableServices: ['injector', 'ETL_L1', 'ETL_L2', 'ETL_L3']
        }
    },
    mounted() {
        this.getData()
        setInterval(this.getData, 5000);
    },
    methods: {
        getData: function () {
            axios
                .get('/status')
                .then(response => this.update(response.data))
        },

        update: function (data) {
            this.services = data
        },

        start: function (service) {
            axios
                .post('/service', {service: service})
                .then(response => this.update(response.data))
        },

        kill: function (service) {
            axios
                .delete('/service', {headers: {}, data: {service: service}})
                .then(response => this.update(response.data))
        },

        canBeManaged: function(service) {
            for(var i = 0; i < this.manageableServices.length; i++) {
                if (this.manageableServices[i] == service) {
                    return true
                }
            }

            return false
        }
    }
}
</script>

<style scoped>

</style>
