import { route } from 'ziggy-js';
import { usePage } from '@inertiajs/vue3';

export const $route = (name, params = {}, absolute = false) => {
    const { Ziggy } = usePage().props;
    return route(name, params, absolute, Ziggy)
}