<template>
    <div class="text-xl form">
        <clock-component></clock-component>
    </div>
</template>

<script>
import ClockComponent from "@/components/ClockComponent";

export default {
    name: "DashboardComponent",
    components: { ClockComponent },
    mounted() {
        this.checkAuthentication();
    },
    methods: {
        async checkAuthentication() {
            let config = {
                headers: {
                    'Authorization': 'Bearer ' + this.$cookies.get('token') ?? '',
                }
            };

            const data = await this.$axios.get('/api/is-authenticated', config).catch((error) => {
                    return Promise.resolve(error)
                }
            );

            if (data.status === undefined || data.status !== 200) {
                this.changeMode('login');
            }
        },
        changeMode(newMode) {
            this.$emit('modeChanged', newMode)
            this.$router.push({path: newMode});
        },
    },
};
</script>

<style>
    .form {
        justify-content: center;
        display: flex;
        height: 100%;
        align-items: center;
    }

    .text-xl {
        font-size: 1.25rem;
        line-height: 2rem;
    }
</style>
