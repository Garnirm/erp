<template>
    <div class="settings-layout">
        <nav class="settings-nav custom-scroll">
            <div class="settings-group-title">Général</div>

            <Link href="/user/settings" class="settings-link" :class="{ active: active_page === '/user/settings' }">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>

                Mon Profil
            </Link>

            <a href="#appearance" class="settings-link" :class="{ active: active_page === '/user/settings/appearance' }">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>

                Apparence
            </a>

            <div class="settings-group-title">Accès</div>

            <a href="#security" class="settings-link" :class="{ active: active_page === '/user/settings/security' }">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>

                Sécurité & Connexion
            </a>
    
            <a href="#notifications" class="settings-link" :class="{ active: active_page === '/user/settings/notifications' }">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>

                Notifications
            </a>
        </nav>

        <div class="settings-content custom-scroll">
            <div class="settings-container">
                <slot />
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: { Link },

    data: function () {
        return {
            active_page: null,
        }
    },

    created: function () {
        this.active_page = this.$page.url
    },
}
</script>

<style lang="scss" scoped>
.settings-layout {
    display: flex;
    height: 100%;
    overflow: hidden;

    .settings-nav {
        width: 16rem;
        padding: 2rem;
        border-right: 1px solid var(--color-slate-200);
        background: white;
        overflow-y: auto;
        flex-shrink: 0;

        .settings-group-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--color-slate-400);
            text-transform: uppercase;
            margin-bottom: 0.75rem;
            margin-top: 1.5rem;
            letter-spacing: 0.05em;

            &:first-child {
                margin-top: 0;
            }
        }

        .settings-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-slate-600);
            border-radius: var(--radius-lg);
            transition: all 0.2s;
            cursor: pointer;

            &:hover {
                background: var(--color-slate-50);
                color: var(--color-slate-900);
            }

            &.active {
                background: var(--color-primary-50);
                color: var(--color-primary-700);
                font-weight: 600;

                svg {
                    color: var(--color-primary-600);
                }
            }

            svg {
                width: 1.125rem;
                height: 1.125rem;
                color: var(--color-slate-400);
            }
        }
    }

    .settings-content {
        flex: 1;
        overflow-y: auto;
        padding: 2rem;
        background: var(--color-slate-50);

        .settings-container {
            max-width: 48rem;
            margin: 0 auto;
            padding-bottom: 4rem;
        }
    }
}
</style>