import { createApp } from 'vue'

import i18n from './i18n/home'

var app = createApp({})

app.config.devtools = false

app.use(i18n)

app.mount('#app')

window.Vue = app
