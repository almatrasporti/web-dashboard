<template>
    <div class="mb-2">
        <div class="flex">
            <div class="w-1/2 w-1/2">
                <span class="pr-2">Vehicle selection:</span>
                <select @change="selectVehicle">
                    <option v-for="vehicle in vehicles" :selected="vehicle == selectedVehicle">{{ vehicle }}</option>
                </select>
            </div>
            <div class="w-1/2">
                <div class="flex">
                    <span class="pr-2" >Show last:</span>
                    <input class="w-1/6" type="text" :value="numPoints" @change="setNumPoints"/>
                    <span class="pr-2">points</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {EventBus} from "../event-bus";

export default {
    name: "VehicleSelect",
    data() {
        return {
            bus: EventBus,
            selectedVehicle: null,
            vehicles: [],
            numPoints: 512,
        }
    },
    mounted() {
        this.bus.$on('positions', positions => {
            this.vehicles = []
            for (const [vehicle, data] of Object.entries(positions)) {
                this.vehicles.push(vehicle)
            }
        })
    },
    methods: {
        selectVehicle(evt) {
            this.selectedVehicle = evt.target.value
            EventBus.$emit('selectVehicle', this.selectedVehicle);
        },
        setNumPoints(evt) {
            this.numPoints = evt.target.value
            EventBus.$emit('numPoints', this.numPoints);
        }
    }
}
</script>

<style scoped>

</style>
