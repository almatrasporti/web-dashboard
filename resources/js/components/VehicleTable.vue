<template>
    <table class="w-full p-5 text-gray-700">
        <thead>
        <tr>
            <th class="text-left text-blue-900">Name</th>
            <th class="text-left text-blue-900"># records</th>
        </tr>
        </thead>

        <tbody>
        <tr v-for="vehicle in vehicles">
            <td>{{ vehicle }}</td>
            <td>{{ data[vehicle].count }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>

import { EventBus} from "../event-bus";

export default {
    name: "VehicleTable",
    data () {
        return {
            bus: EventBus,
            vehicles: [],
            data: [],
            numVehicles: 0,
            numPoints: 512
        }
    },
    mounted() {
        this.getData()
        setInterval(this.getData, 5000);
        EventBus.$on("numPoints", numPoints => this.numPoints = numPoints)
    },
    methods: {
        getData: function() {
            axios
                .get('/data?numPoints=' + this.numPoints)
                .then(response => this.update(response.data))
        },

        update: function (data) {
            this.vehicles = Object.keys(data)
            this.numVehicles = this.vehicles.length
            this.data = data
            EventBus.$emit('numVehicles', this.numVehicles);
            EventBus.$emit('positions', this.data);
        }
    }
}
</script>

<style scoped>

</style>
