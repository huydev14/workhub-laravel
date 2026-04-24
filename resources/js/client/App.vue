<template>
    <div>
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore();

onMounted(() => {
    authStore.setupWatcher();
});
</script>
