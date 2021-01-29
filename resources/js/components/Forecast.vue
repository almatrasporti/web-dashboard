<template>
    <div class="mb-2">
        <div class="flex flex-row">
            <div class="w-full">
                <div class="flex flex-col">
                    <span class="pr-2 font-bold">Time series:</span>
                    <div class="w-full">
                        <textarea cols="100" rows="6" id="input_data" v-model="input_string"
                                  style="width: 100%"></textarea>
                    </div>
                </div>

                <div v-if="processing" class="flex flex-row">
                    <img src="/img/spinner.gif" style="width: 32px;">
                    <span class="pl-2 my-auto">Predicting data...</span>
                </div>
                <div v-else>
                    <button
                        class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center"
                        @click="forecast">Predict
                    </button>
                    <span class="pr-2" v-text="predicted_value"></span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Forecast",
    data() {
        return {
            data: [],
            input_string: '12660,11880,11100,9100,7600,6050,4500,5600,6000,6400,6575,6750,6925,7100,6775,6450,6125,5200,5433,5666,6125,5670,5215,4760,4305,3850,5725,7600,8166,9325',
            predicted_value: null,
            processing: false
        }
    },
    mounted() {

    },
    methods: {
        forecast() {
            this.processing = true
            this.data = this.input_string.split(",").map(val => parseFloat(val.trim()))

            axios
                .post(process.env.MIX_PREDICTION_SERVICE, {
                    "values": this.data,
                }, {
                    headers: {
                        // Overwrite Axios's automatically set Content-Type
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    this.predicted_value = response.data.prediction
                    this.processing = false
                })
                .catch(error => {
                    this.predicted_value = error
                    this.processing = false
                })
        }
    }
}
</script>

<style scoped>

</style>
