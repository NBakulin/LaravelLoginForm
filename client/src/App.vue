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
