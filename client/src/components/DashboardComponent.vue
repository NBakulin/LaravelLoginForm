<template>
    <div class="text-xl form">
        Dashboard
    </div>
</template>

<script>
export default {
    name: "DashboardComponent",
    data() {
        return {

        };
    },
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
p {
    margin-top: 0.25em;
    margin-bottom: 0;
}
input, label {
    display:block;
}
input {
    width: 100%;
    box-sizing: border-box;
    height: 1.75rem;
}
label {
    margin-top: 0.25rem;
}
button{
    display:block;
    width: 100%;
    height: 1.75rem;
}
label {
    text-align: left !important;
}
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
