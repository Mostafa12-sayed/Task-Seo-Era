import axios from 'axios';
window.axios = axios;
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//
//
// window.Pusher = Pusher;
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     encrypted: true,
//     forceTLS: true
// });
//
// window.Echo.private('admin.notifications')
//     .listen('.post-created', (e) => {
//         console.log('📣 New post created:', e.post);
//
//         // Example: show notification popup
//         alert(`New post titled "${e.post.title}" was just added!`);
//     });

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
