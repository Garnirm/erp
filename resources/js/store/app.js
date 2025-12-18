import { createStore } from 'vuex'

import { stateI18n, gettersI18n, mutationsI18n } from './i18n'

import { stateUser, gettersUser, mutationsUser } from './user'

export default createStore({
    modules: {
        i18n: {
            namespaced: true,
            state: stateI18n,
            getters: gettersI18n,
            mutations: mutationsI18n,
        },
        user: {
            namespaced: true,
            state: stateUser,
            getters: gettersUser,
            mutations: mutationsUser,
        },
    }
})
