<template>
    <Login v-if="mode === 'login'" @modeChanged="updateMode"/>
    <Signup v-if="mode === 'signup'" @modeChanged="updateMode"/>
    <Dashboard v-if="mode === 'dashboard'" @modeChanged="updateMode"/>
</template>

<script>
import Login from "@/components/LoginComponent";
import Signup from "@/components/SignupComponent";
import Dashboard from "@/components/DashboardComponent";

export default {
    name: "App",
    components: { Dashboard, Signup, Login },
    data() {
        const allowedModes = ['login', 'signup', 'dashboard'];
        let initialMode = window.location.pathname.slice(1);
        if (!allowedModes.includes(initialMode)) {
            initialMode = 'login';
        }

        return {
            mode: initialMode,
        };
    },
    methods: {
        updateMode(newMode) {
            this.mode = newMode;
        },
    },
};
</script>

<style>
button{
    display:block;
    width: 100%;
    height: 1.75rem;
}
body {
    font-family: 'Arial', monospace;
}
input {
    width: 100%;
    box-sizing: border-box;
    height: 1.75rem;
}
p {
    margin-top: 0.25em;
    margin-bottom: 0;
}
.pointer {
    cursor: pointer;
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
.text-md {
    font-size: 1rem;
    line-height: 1.5rem;
}
.text-red {
    color: rgb(225 29 72);
}
</style>
