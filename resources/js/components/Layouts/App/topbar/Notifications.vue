<template>
    <button class="icon-btn has-notif" @click="toggleNotifications">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
    </button>

    <div class="notification-panel" v-if="toggle_notifications">
        <div class="notif-header">
            <span class="notif-title">Notifications (3)</span>
            <span class="notif-mark-read">Tout marquer comme lu</span>
        </div>

        <div class="notif-list">
            <div class="notif-item unread">
                <div class="notif-icon warning">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>

                <div class="notif-content">
                    <h4>Stock critique : Vis M4</h4>
                    <p>Le stock de l'entrepôt principal est passé sous le seuil d'alerte (50 unités).</p>
                    <div class="notif-time">Il y a 10 min</div>
                </div>
            </div>

            <div class="notif-item unread">
                <div class="notif-icon info">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <div class="notif-content">
                    <h4>Nouveau Ticket Support</h4>
                    <p>Client "TechCorp" a ouvert un ticket #9923 : Problème de facturation.</p>
                    <div class="notif-time">Il y a 45 min</div>
                </div>
            </div>

            <div class="notif-item">
                <div class="notif-icon success">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <div class="notif-content">
                    <h4>Export Terminé</h4>
                    <p>Votre export comptable Q3 2024 est prêt à être téléchargé.</p>
                    <div class="notif-time">Il y a 2h</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            toggle_notifications: false,
        }
    },

    methods: {
        toggleNotifications: function () {
            this.toggle_notifications = !this.toggle_notifications
        },
    },
}
</script>

<style lang="scss" scoped>
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

    &.has-notif {
        position: relative;

        &::after {
            content: '';
            position: absolute;
            top: 0.5rem;
            right: 0.6rem;
            width: 0.5rem;
            height: 0.5rem;
            background-color: var(--color-danger-600);
            border: 2px solid white;
            border-radius: 50%;
        }
    }
}

.notification-panel {
    position: absolute;
    top: 3.5rem;
    right: 0;
    width: 24rem;
    background: white;
    border: 1px solid var(--color-slate-200);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-lg);
    z-index: 60;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: slideDown 0.2s ease-out;
}

.notif-header {
    padding: 1rem;
    border-bottom: 1px solid var(--color-slate-100);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.notif-title {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--color-slate-900);
}

.notif-mark-read {
    font-size: 0.75rem;
    color: var(--color-primary-600);
    cursor: pointer;
}

.notif-list {
    max-height: 20rem;
    overflow-y: auto;
}

.notif-item {
    padding: 1rem;
    border-bottom: 1px solid var(--color-slate-50);
    display: flex;
    gap: 0.75rem;
    transition: background 0.2s;
    cursor: pointer;

    &:hover {
        background-color: var(--color-slate-50);
    }

    &:last-child {
        border-bottom: none;
    }

    &.unread {
        background-color: var(--color-primary-50);
    }
}

.notif-icon {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;

    &.info {
        background-color: var(--color-primary-100);
        color: var(--color-primary-600);
    }

    &.warning {
        background-color: var(--color-warning-100);
        color: var(--color-warning-600);
    }

    &.success {
        background-color: var(--color-success-100);
        color: var(--color-success-600);
    }
}

.notif-content h4 {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--color-slate-900);
    margin-bottom: 0.125rem;
}

.notif-content p {
    font-size: 0.75rem;
    color: var(--color-slate-600);
    line-height: 1.4;
}

.notif-time {
    font-size: 0.7rem;
    color: var(--color-slate-400);
    margin-top: 0.25rem;
}
</style>