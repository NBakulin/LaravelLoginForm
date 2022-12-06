<template>
    <div v-if="signupMode" id="signup" class="text-xl form">
        <form @submit.prevent="register">
            <h1 class="">
                Register
            </h1>
                <label for="userName">User name</label>
                <input name="userName" v-model="name" placeholder="Nikita" class="w-80">
                <div>
                    <p v-for="nameError in nameErrors" :key="nameError" class="text-md text-red">
                        {{ nameError }}
                    </p>
                </div>

                <label for="email">Email</label>
                <input name="email" v-model="email" placeholder="nk.bakulin@gmail.com" class="w-80">
                <div>
                    <p v-for="emailError in emailErrors" :key="emailError" class="text-md text-red">
                        {{ emailError }}
                    </p>
                </div>

                <label for="password">Password</label>
                <input name="password" v-model="password" placeholder="password" type="password" class="w-80">
                <div>
                    <p v-for="passwordError in passwordErrors" :key="passwordError" class="text-md text-red">
                        {{ passwordError }}
                    </p>
                </div>

            <button class="mt-8 w-80"> Register </button>
            <a @click="signupMode = !signupMode" class="pointer text-md">
                Already registered? Proceed to Login
            </a>
        </form>
    </div>
    <div v-else class="text-xl form">
        <form @submit.prevent="login">
            <h1 class="">
                Login
            </h1>
            <label for="email">Email</label>
            <input name="email" v-model="email" placeholder="nk.bakulin@gmail.com" class="w-80">

            <label for="password">Password</label>
            <input name="password" v-model="password" placeholder="password" type="password" class="w-80">

            <button class="mt-8 w-80"> Login </button>
            <a @click="signupMode = !signupMode" class="pointer text-md">
                You are new? Proceed to Sign Up
            </a>
        </form>
    </div>
</template>
<script>
export default {
    name: "App",
    data() {
        return {
            email: "",
            emailErrors: [],
            name: "",
            nameErrors: [],
            password: "",
            passwordErrors: [],
            signupMode: true,
        };
    },
    methods: {
        async register() {
            const { name, email, password } = this;

            const data = await this.$axios.post('/api/register',{
                name,
                password,
                email,
            }).catch((error) => {
                    const jsonResponse = JSON.parse(error.response.data);
                    this.emailErrors = jsonResponse.email;
                    this.nameErrors = jsonResponse.name;
                    this.passwordErrors = jsonResponse.password;

                    return Promise.resolve(error)
                }
            );

            console.log(data)
        },
        async login() {
            const { email, password } = this;

            const data = await this.$axios.post('/api/login',{
                password,
                email,
            }).catch((error) => {
                    const jsonResponse = JSON.parse(error.response.data);
                    this.emailErrors = jsonResponse.email;
                    this.nameErrors = jsonResponse.name;
                    this.passwordErrors = jsonResponse.password;

                    return Promise.reject(error)
                }
            );
            console.log(data)

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
