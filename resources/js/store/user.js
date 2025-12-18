// State
var user = {}

// Getters
function get_user (state) {
    return state.user
}

// Mutations
function load_user (state, user) {
    state.user = user
}

function set_lang (state, lang) {
    state.user.lang = lang
}

// Export
export const stateUser = { user }
export const gettersUser = { get_user }
export const mutationsUser = { load_user, set_lang }
