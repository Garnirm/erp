<template>
    <div class="settings-section">
        <h2 class="section-title">Sécurité</h2>

        <p class="section-desc">Protégez votre compte et surveillez les accès.</p>

        <div class="panel">
            <div class="panel-body">
                <div class="d-flex" style="justify-content: space-between; align-items: center;">
                    <div>
                        <h3 class="panel-title">Mot de passe</h3>

                        <p style="font-size: 0.875rem; color: var(--color-slate-500); margin-top: 0.25rem;">Dernière modification il y a 3 mois.</p>
                    </div>

                    <button class="btn btn-white" onclick="alert('Email de réinitialisation envoyé à jean...@gifrane.drk')">
                        <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>

                        M'envoyer un email de reset
                    </button>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-body">
                <div class="d-flex" style="justify-content: space-between; align-items: start;">
                    <div style="flex: 1;">
                        <h3 class="panel-title d-flex" style="align-items: center; gap: 0.5rem;">
                            Double Authentification (2FA)

                            <span style="font-size: 0.7rem; background: var(--color-slate-100); color: var(--color-slate-600); padding: 2px 6px; border-radius: 4px;">Désactivé</span>
                        </h3>

                        <p style="font-size: 0.875rem; color: var(--color-slate-500); margin-top: 0.5rem; max-width: 30rem;">
                            Sécurisez votre compte en demandant un code supplémentaire lors de la connexion.
                        </p>
                    </div>

                    <button class="btn btn-primary" @click="openTwoAuthModal()">Activer 2FA</button>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header" style="margin-bottom: 1.25rem;">
                <h3 class="panel-title">Historique de connexion</h3>
            </div>

            <div class="panel-body" style="padding: 0;">
                <table class="sec-table">
                    <thead>
                        <tr>
                            <th style="padding-left: 1.5rem;">Date</th>
                            <th>Appareil</th>
                            <th>Lieu</th>
                            <th>IP</th>
                            <th>Statut</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="padding-left: 1.5rem;">Aujourd'hui, 09:41</td>
                            <td>Chrome (Win)</td>
                            <td>Paris, FR</td>
                            <td class="font-mono">192.168.1.45</td>
                            <td><span class="status-dot success"></span> Succès</td>
                        </tr>

                        <tr>
                            <td style="padding-left: 1.5rem;">Hier, 18:20</td>
                            <td>Safari (iOS)</td>
                            <td>Lyon, FR</td>
                            <td class="font-mono">88.12.43.11</td>
                            <td><span class="status-dot success"></span> Succès</td>
                        </tr>

                        <tr>
                            <td style="padding-left: 1.5rem;">22 Oct, 14:00</td>
                            <td>Firefox (Mac)</td>
                            <td>Marseille, FR</td>
                            <td class="font-mono">92.168.10.1</td>
                            <td><span class="status-dot error"></span> Échec</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Sessions Actives</h3>
            </div>

            <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
                <div class="session-item">
                    <div class="d-flex" style="gap: 1rem; align-items: center;">
                        <div class="session-icon">
                            <svg style="width: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>

                        <div class="session-details">
                            <h4>Chrome sur Windows</h4>

                            <div class="session-meta">
                                <span>192.168.1.45</span> • <span class="session-current">Cette session</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="session-item">
                    <div class="d-flex" style="gap: 1rem; align-items: center;">
                        <div class="session-icon">
                            <svg style="width: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>

                        <div class="session-details">
                            <h4>Safari sur iPhone 13</h4>

                            <div class="session-meta">
                                <span>88.12.43.11</span> • <span>Il y a 2 jours</span> • <span>Paris, FR</span>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-danger-soft btn-sm" @click="openRevokeModal()">Révoquer</button>
                </div>
            </div>
        </div>
    </div>

    <enable-two-auth-modal ref="two_auth_modal" />
    <revoke-session-modal ref="revoke_session_modal" />
</template>

<script>
import EnableTwoAuthModal from '@cmp/App/User/SettingsSecurity/EnableTwoAuthModal.vue'
import RevokeSessionModal from '@cmp/App/User/SettingsSecurity/RevokeSessionModal.vue'

import AppLayout from '@/Layouts/AppLayout.vue'
import UserSettingsLayout from '@/Layouts/UserSettingsLayout.vue'

export default {
    components: { EnableTwoAuthModal, RevokeSessionModal },

    layout: [ AppLayout, UserSettingsLayout ],

    props: [],

    data: function () {
        return {}
    },

    created: function () {},

    methods: {
        openTwoAuthModal: function () {
            this.$refs.two_auth_modal.open()
        },
        openRevokeModal: function () {
            this.$refs.revoke_session_modal.open()
        },
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/components/user_settings.scss';

.sec-table {
    font-size: 0.875rem;
    text-align: left;
    width: 100%;

    td {
        border-bottom: 1px solid var(--color-slate-100);
        color: var(--color-slate-700);
        padding: 0.75rem 0;

        &.font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .status-dot {
            display: inline-block;
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            margin-right: 0.5rem;

            &.error {
                background: var(--color-danger-600);
            }

            &.success {
                background: var(--color-success-600);
            }
        }
    }

    th {
        color: var(--color-slate-500);
        font-weight: 500;
        font-size: 0.75rem;
        text-transform: uppercase;
        padding-bottom: 0.75rem;
    }
}

.session-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 1px solid var(--color-slate-100);

    &:last-child {
        border-bottom: none;
    }

    .session-icon {
        width: 2.5rem;
        height: 2.5rem;
        background: var(--color-slate-100);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-slate-500);
    }

    .session-details {
        h4 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-slate-900);
        }

        .session-meta {
            font-size: 0.75rem;
            color: var(--color-slate-500);
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-top: 0.125rem;

            .session-current {
                background: var(--color-success-100);
                color: var(--color-success-600);
                padding: 0.1rem 0.4rem;
                border-radius: 99px;
                font-weight: 600;
                font-size: 0.7rem;
            }
        }
    }
}
</style>