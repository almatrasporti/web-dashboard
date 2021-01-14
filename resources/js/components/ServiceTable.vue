<template>
    <table class="w-full p-5 text-gray-700">
        <thead>
        <tr>
            <th class="text-left text-blue-900">Service</th>
            <th class="text-left text-blue-900">Status</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="service in Object.keys(services)">
            <td>{{ service }}</td>
            <td>
                <span v-if="services[service]" class="bg-green-400 m-1 p-2">OK</span>
                <span v-else class="bg-red-400 text-white m-1 p-2">KO</span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>

import { EventBus } from "../event-bus";

export default {
    name: "VehicleTable",
    data () {
        return {
            bus: EventBus,
            services: [],
        }
    },
    mounted() {
        this.getData()
        setInterval(this.getData, 5000);
    },
    methods: {
        getData: function() {
            axios
                .get('/status')
                .then(response => this.update(response.data))
        },

        update: function (data) {
            this.services = data
        }
    }
}
</script>

<style scoped>

</style>
