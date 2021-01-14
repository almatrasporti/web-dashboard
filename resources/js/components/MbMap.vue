<template>
    <MglMap :mapboxGl="mapbox-gl" :accessToken="accessToken" :mapStyle="mapStyle" />
</template>

<script>
import Mapbox from "mapbox-gl";
import { MglMap } from "vue-mapbox";

export default {
    components: {
        MglMap
    },
    data() {
        return {
            accessToken: "pk.eyJ1Ijoicm9iZXJ0b2dhbGxlYSIsImEiOiJjanBvNXF0bGwwYWRiNDNtbGs1aWN5c2xpIn0.kLd_6nzeTKbRkbZH-m3iqA", // your access token. Needed if you using Mapbox maps
            mapStyle: 'mapbox://styles/mapbox/streets-v11' // your map style
        };
    },

    created() {
        // We need to set mapbox-gl library here in order to use it in template
        this.mapbox = Mapbox;
    }
};
</script>
