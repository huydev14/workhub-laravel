import axios from 'axios';

const api = axios.create({
    baseURL: '/api/v1',
    withCredentials: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
});

export const fetchCsrfToken = async () => {
    await axios.get('/sanctum/csrf-cookie', {
        baseURL: '/',
        withCredentials: true,
    });
};

export default api;
