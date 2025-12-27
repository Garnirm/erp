<template>
    <div class="sidebar-footer">
        <div class="user-profile" @click="toggleUserMenu">
            <img :src="'https://ui-avatars.com/api/?name='+user_initiales+'&background=c7d2fe&color=3730a3'" class="user-avatar" alt="User">

            <div class="user-info">
                <div class="user-name">{{ user_fullname }}</div>
                <div class="user-role">Responsable Produit</div>
            </div>

            <svg style="color: var(--color-slate-400); width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>

        <div class="user-dropdown-menu" v-if="toggle_user_menu">
            <div class="dropdown-item">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>

                Documentation API
            </div>

            <div class="dropdown-item">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>

                Support
            </div>

            <div class="dropdown-item">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>

                Changelog
            </div>

            <Link href="/user/settings" class="dropdown-item">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>

                Préférences
            </Link>

            <div style="border-top: 1px solid var(--color-slate-100); margin: 0.25rem 0;"></div>

            <a href="/logout" class="dropdown-item danger">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Déconnexion
            </a>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    components: { Link },

    data: function () {
        return {
            toggle_user_menu: false,
            user_fullname: null,
            user_initiales: 'U+U',
        }
    },

    created: function () {
        this.user_fullname = this.$page.props.sidebar_fullname

        let split_fullname = this.user_fullname.split(' ')

        this.user_initiales = split_fullname[0][0]+'+'+split_fullname[1][0]
    },

    methods: {
        toggleUserMenu: function () {
            this.toggle_user_menu = !this.toggle_user_menu
        },
    },
}
</script>

<style lang="scss" scoped>
.sidebar-footer {
    padding: 1rem; border-top: 1px solid var(--color-slate-100); position: relative;

    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem;
        border-radius: var(--radius-lg);
        cursor: pointer;
        transition: background-color 0.2s;

        &:hover {
            background-color: var(--color-slate-50);
        }

        .user-avatar {
            width: 2.25rem;
            height: 2.25rem;
            border-radius: 50%;
            background-color: var(--color-slate-200);
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-slate-900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--color-slate-500);
        }
    }

    .user-dropdown-menu {
        position: absolute;
        bottom: 100%;
        left: 1rem;
        right: 1rem;
        margin-bottom: 0.5rem;
        background: white;
        border: 1px solid var(--color-slate-200);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        padding: 0.5rem;
        z-index: 1;
        animation: slideUp 0.2s ease-out;
    }
}
</style>