<template>
    <gmap-map
        :center="center"
        :zoom="4"
    >
        <gmap-marker
            :key="index"
            v-for="(m, index) in markers"
            :position="m.position"
            :label="m.label"
            :icon="m.icon"
            :clickable="true"
            :draggable="true"
            @click="center=m.position"
        ></gmap-marker>
        <gmap-polyline v-bind:path.sync="path" v-bind:options="{ strokeColor:'#008000'}">
        </gmap-polyline>
    </gmap-map>
</template>

<script>
/////////////////////////////////////////
// New in 0.4.0
import * as VueGoogleMaps from 'vue2-google-maps';
import Vue from 'vue';
import {EventBus} from "../event-bus";

Vue.use(VueGoogleMaps, {
    load: {
        key: 'YOUR_API_TOKEN',
        v: 'OPTIONAL VERSION NUMBER',
        // libraries: 'places', //// If you need to use place input
    }
});

export default {
    data() {
        return {
            bus: EventBus,
            center: {lat: 43.902782, lng: 12.496366},
            zoom: 8,
            markers: [],
            path: [],
            vehicles: [],
            currentVehicle: 'VIN00000000000001'
        }
    },
    mounted() {
        this.bus.$on('positions', positions => {
            this.markers = []
            this.path = []
            this.vehicles = []

            for (const [vehicle, data] of Object.entries(positions)) {
                this.vehicles.push(vehicle)

                let last_item = data.items[data.items.length - 1]

                this.markers.push({
                    position: {lat: last_item.lat, lng: last_item.lon},
                    icon: '/img/truck-icon.png',
                    label: {
                        color: '#000000',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        text: vehicle,
                        labelOrigin: {x: 9, y: 9}
                    }
                })
            }
            positions[this.currentVehicle].items.forEach(el => {
                if (el.lat != -1 && el.lon != -1) {
                    this.path.push({lat: el.lat, lng: el.lon})
                }
            })
        })
        this.bus.$on('selectVehicle', vehicle => this.currentVehicle = vehicle)
    }
}
</script>
