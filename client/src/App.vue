<template>
    <div v-if="signupMode" id="signup" class="text-xl form">
        <form>
            <h1 class="">
                Register
            </h1>
                <label for="userName">User name</label>
                <input name="userName" v-model="name" placeholder="Nikita" class="w-80">

                <label for="email">Email</label>
                <input name="email" v-model="email" placeholder="nk.bakulin@gmail.com" class="w-80">

                <label for="password">Password</label>
                <input name="password" v-model="password" placeholder="password" type="password" class="w-80">
            <button @click="register" class="mt-8 w-80"> Register </button>
            <a @click="signupMode = !signupMode" class="pointer text-md">
                Already registered? Proceed to Login
            </a>
        </form>
    </div>
    <div v-else class="text-xl form">
        <form>
            <h1 class="">
                Login
            </h1>
            <label for="email">Email</label>
            <input name="email" v-model="email" placeholder="nk.bakulin@gmail.com" class="w-80">

            <label for="password">Password</label>
            <input name="password" v-model="password" placeholder="password" type="password" class="w-80">

            <button @click="login" class="mt-8 w-80"> Login </button>
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
            name: "",
            password: "",
            signupMode: true,
        };
    },
    methods: {
        async register() {
            const { name, email, password } = this;
            const res = await fetch(
                "http://127.0.0.1:8000/api/register",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        name,
                        password,
                        email,
                    })
                }
            );
            const data = await res.json();
            console.log(data);
        },
        async login() {
            const { email, password } = this;
            const res = await fetch(
                "http://127.0.0.1:8000/api/login",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        password,
                        email,
                    })
                }
            );
            const data = await res.json();
            console.log(data);
        }
    },
};
</script>

<style>
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
    .mt-8 {
        margin-top: 2rem;
    }
    .w-80 {
        width: 20rem;
    }
</style>
