<template>
    <div id="clock">
        <p class="time">{{ dashboardTime }}</p>
    </div>
    <div>
        <vue-timepicker format="HH:mm:ss" placeholder="Select Time" v-model="simpleStringValue" class="time-picker"></vue-timepicker>
        <button class="" @click="updateClock"> Update Time </button>
    </div>
</template>

<script>
    import VueTimepicker from 'vue3-timepicker/src/VueTimepicker.vue'

    export default {
        name: "ClockComponent",
        components: { VueTimepicker},
        data() {
            return {
                dashboardTime: '- -:- -:- -',
                time: 0,
                lastUpdateTimeStamp: 0,
                simpleStringValue: '14:30:00',
            };
        },
        mounted() {
            this.getClock();
            setInterval(this.updateTime, 1000);
            this.updateTime();
        },
        methods: {
            zeroPadding(num, digit) {
                let zero = '';
                for (let i = 0; i < digit; i++) {
                    zero += '0';
                }
                return (zero + num).slice(-digit);
            },
            updateTime() {
                if (this.time) {
                    let timeStamp = this.time * 1000 + Date.now() - this.lastUpdateTimeStamp * 1000;
                    let currentTime = new Date(timeStamp);
                    this.dashboardTime = this.zeroPadding(currentTime.getHours(), 2) + ':' + this.zeroPadding(currentTime.getMinutes(), 2) + ':' + this.zeroPadding(currentTime.getSeconds(), 2);
                }
            },
            async getClock() {
                let config = {
                    headers: {
                        'Authorization': 'Bearer ' + this.$cookies.get('token') ?? '',
                    }
                };
                const data = await this.$axios.get('/api/clock', config).catch((error) => {
                        return Promise.resolve(error)
                    }
                );

                this.time = data.data.clock.time ?? 0;
                this.lastUpdateTimeStamp = data.data.clock.last_update_timestamp ?? 0;
            },
            async updateClock() {
                let config = {
                    headers: {
                        'Authorization': 'Bearer ' + this.$cookies.get('token') ?? '',
                    }
                };

                const dateString = (new Date()).toISOString().split('T')[0] + 'T' + this.simpleStringValue;
                const timeStamp = Math.floor(new Date(dateString).getTime() / 1000);
                const data = await this.$axios.put(
                    '/api/clock',
                    { 'time': timeStamp },
                    config
                ).catch((error) => {
                        return Promise.resolve(error)
                    }
                );

                this.time = data.data.clock.time ?? '';
                this.lastUpdateTimeStamp = data.data.clock.last_update_timestamp ?? '';
            },
        },
    };
</script>

<style>
    #clock {
        font-family: 'Arial', monospace;
        text-align: center;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .time {
        letter-spacing: 0.05em;
        font-size: 80px;
        padding: 5px 0;
    }

    .time-picker {
        margin-bottom: 1rem;
    }

</style>
