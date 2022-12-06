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
                    this.$cookies.set("token", data.data.token, '1d');
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
.pointer {
    cursor: pointer;
}
.text-xl {
    font-size: 1.25rem;
    line-height: 2rem;
}
.text-md {
    font-size: 1rem;
    line-height: 1.5rem;
}
.text-red {
    color: rgb(225 29 72);
}
.mt-8 {
    margin-top: 2rem;
}
.w-80 {
    width: 20rem;
}
</style>
