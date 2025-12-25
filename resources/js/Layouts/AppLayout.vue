<template>
    <sidebar-menu />

    <main class="app-main">
        <topbar />

        <slot />
    </main>

    <global-search-modal />
</template>

<script>
import GlobalSearchModal from '../components/Layouts/App/GlobalSearchModal.vue'
import SidebarMenu from '../components/Layouts/App/SidebarMenu.vue'
import Topbar from '../components/Layouts/App/Topbar.vue'

export default {
    components: { GlobalSearchModal, SidebarMenu, Topbar },

    mounted: function () {
        document.addEventListener('keydown', (e) => {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault()

                EventBus.emit('toggle_modal_global_search', true)
            } else if (e.key === 'Escape') {
                EventBus.emit('toggle_modal_global_search', false)
            }
        })
    },
}
</script>

<style lang="css">
body {
    display: flex;
    overflow: hidden;
}

#app {
    display: flex;
    width: 100%;
    height: 100%;
}

.app-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}
</style>