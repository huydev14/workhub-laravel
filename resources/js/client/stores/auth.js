import { defineStore } from 'pinia';
import api from '../services/api';
import axios from 'axios';
import router from '../router';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: JSON.parse(localStorage.getItem('user')) || null,
        token: localStorage.getItem('access_token') || null,
    }),

    getters: {
        isLoggedIn: (state) => !!state.token,
    },

    actions: {
        setupWatcher() {
            this.$subscribe(
                (mutation, state) => {
                    console.log('Pinia changed, syncing to LocalStorage...');
                    if (state.token) {
                        localStorage.setItem('access_token', state.token);
                    } else {
                        localStorage.removeItem('access_token');
                    }

                    if (state.user) {
                        localStorage.setItem('user', JSON.stringify(state.user));
                    } else {
                        localStorage.removeItem('user');
                    }
                },
                {
                    detached: true,
                },
            );
        },
        async login(credentials) {
            const response = await api.post('/login', credentials);
            if (response.data.success) {
                const { access_token, user } = response.data.data;
                this.token = access_token;
                this.user = user;
            }
            return response.data;
        },

        async silentRefresh() {
            try {
                const res = await axios.post(
                    '/refresh',
                    {},
                    {
                        baseURL: '/api/v1',
                        withCredentials: true,
                    },
                );
                const { access_token, user } = res.data.data;

                this.token = access_token;
                this.user = user;

                return true;
            } catch (error) {
                this.forceLogout();
                return false;
            }
        },

        async logout() {
            try {
                await api.post('/logout');
            } finally {
                this.forceLogout();
                router.push({ name: 'Login' });
            }
        },

        forceLogout() {
            this.user = null;
            this.token = null;

            if (router.currentRoute.value.name !== 'Login') {
                router.push({ name: 'Login' });
            }
        },
    },
});
