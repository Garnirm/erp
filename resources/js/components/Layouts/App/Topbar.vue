<template>
    <header class="app-header">
        <div class="header-left">
            <company-selector />

            <button class="header-search-btn" @click="toggleSearchModal()">
                <svg class="icon-sm" style="margin-right: 0.75rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <span>Rechercher...</span>
                <span class="kbd-shortcut">Ctrl K</span>
            </button>
        </div>

        <div class="header-right">
            <button class="icon-btn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>

            <notifications />

            <small>© 2026 Gifrane ERP v1.0.0</small>
        </div>
    </header>
</template>

<script>
import CompanySelector from './topbar/CompanySelector.vue'
import Notifications from './topbar/Notifications.vue'

export default {
    components: { CompanySelector, Notifications },

    methods: {
        toggleSearchModal: function () {
            EventBus.emit('toggle_modal_global_search', true)
        },
    },
}
</script>

<style lang="scss" scoped>
.app-header {
    height: var(--header-height);
    background-color: white;
    border-bottom: 1px solid var(--color-slate-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 2rem;
    position: sticky;
    top: 0;
    z-index: 1;

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-search-btn {
        position: relative;
        width: 20rem;
        height: 2.25rem;
        background-color: var(--color-slate-50);
        border: 1px solid var(--color-slate-200);
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        padding: 0 0.75rem;
        cursor: pointer;
        color: var(--color-slate-500);
        transition: border-color 0.2s;

        &:hover {
            border-color: var(--color-slate-300);
        }
    }

    .kbd-shortcut {
        margin-left: auto;
        background-color: white;
        border: 1px solid var(--color-slate-200);
        border-radius: 4px;
        padding: 0.1rem 0.4rem;
        font-size: 0.7rem;
        font-weight: 500;
        color: var(--color-slate-500);
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
    }

    .icon-btn {
        width: 2.25rem;
        height: 2.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: var(--color-slate-500);
        transition: all 0.2s;
        background: transparent;
        border: none;

        &:hover {
            background-color: var(--color-slate-50);
            color: var(--color-slate-700);
        }
    }
}
</style>