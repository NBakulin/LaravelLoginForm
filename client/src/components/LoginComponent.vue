<template>
    <div class="text-xl form">
        <form @submit.prevent="login">
            <h1 class="">
                Login
            </h1>
            <label for="email">Email</label>
            <input name="email" v-model="email" placeholder="nk.bakulin@gmail.com" class="w-80">

            <label for="password">Password</label>
            <input name="password" v-model="password" placeholder="password" type="password" class="w-80">

            <div>
                <p v-if="loginError" class="text-md text-red">
                    {{ loginError.error }}
                </p>
            </div>

            <button class="mt-8 w-80"> Login </button>
            <a @click="changeMode('signup')" class="pointer text-md">
                You are new? Proceed to Sign Up
            </a>
        </form>
    </div>
</template>

<script>
    export default {
        name: "LoginComponent",
        data() {
            return {
                email: "",
                password: "",
                loginError: null,
            };
        },
        methods: {
            async login() {
                const { email, password } = this;

                const data = await this.$axios.post('/api/login',{
                    password,
                    email,
                }).catch((error) => {
                        this.loginError = error.response.data;

                        return Promise.reject(error)
                    }
                );

                if (data.status === 200) {
                    this.$cookies.set('token', data.data.token, '1d');
                    this.changeMode('dashboard');
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
input, label {
    display:block;
}
label {
    margin-top: 0.25rem;
}
label {
    text-align: left !important;
}
.mt-8 {
    margin-top: 2rem;
}
.w-80 {
    width: 20rem;
}
</style>
