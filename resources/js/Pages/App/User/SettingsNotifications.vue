<template>
    <div class="settings-section">
        <h2 class="section-title">Notifications</h2>

        <p class="section-desc">Choisissez comment et quand vous souhaitez être notifié.</p>

        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Canaux</h3>
            </div>

            <table class="notif-table">
                <thead>
                    <tr>
                        <th style="padding-left: 1.5rem;">Type d'activité</th>
                        <th style="width: 80px; text-align: center;">Email</th>
                        <th style="width: 80px; text-align: center;">Push</th>
                        <th style="width: 80px; text-align: center; padding-right: 1.5rem;">Tchat</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="padding-left: 1.5rem;">
                            <div class="notif-label">Mentions & Commentaires</div>
                            <div class="notif-desc">Quand quelqu'un vous mentionne dans une note ou une tâche.</div>
                        </td>

                        <td align="center"><div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                        <td align="center"><div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                        <td align="center"><div class="toggle-switch" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                    </tr>

                    <tr>
                        <td style="padding-left: 1.5rem;">
                            <div class="notif-label">Assignation de tâche</div>
                            <div class="notif-desc">Quand une nouvelle tâche ou un ticket vous est attribué.</div>
                        </td>

                        <td align="center"><div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                        <td align="center"><div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                        <td align="center"><div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">Résumés Intelligents (Digests)</h3>
            </div>

            <div class="panel-body">
                <div class="form-grid">
                    <div class="form-group">
                        <div class="d-flex" style="justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <label class="form-label" style="margin-bottom: 0;">Récapitulatif Quotidien (Agenda)</label>
                            <div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div>
                        </div>

                        <div style="font-size: 0.75rem; color: var(--color-slate-500); margin-bottom: 0.75rem;">
                            Envoyé chaque matin pour préparer votre journée.
                        </div>

                        <!--<div class="custom-select-wrapper">
                            <div class="custom-select-trigger" onclick="this.nextElementSibling.classList.toggle('open'); event.stopPropagation();">
                                <span>07:00</span>

                                <svg style="width: 1rem; height: 1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

                            <div class="custom-select-options">
                                <div class="custom-option">03:00</div>
                                <div class="custom-option">04:00</div>
                                <div class="custom-option">05:00</div>
                                <div class="custom-option">06:00</div>
                                <div class="custom-option selected">07:00</div>
                                <div class="custom-option">08:00</div>
                            </div>
                        </div>-->
                    </div>

                    <div class="form-group">
                        <div class="d-flex" style="justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <label class="form-label" style="margin-bottom: 0;">Récapitulatif Hebdomadaire</label>
                            <div class="toggle-switch active" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div>
                        </div>

                        <div style="font-size: 0.75rem; color: var(--color-slate-500); margin-bottom: 0.75rem;">Synthèse de la semaine à venir.</div>

                        <!--<div class="custom-select-wrapper">
                            <div class="custom-select-trigger" onclick="this.nextElementSibling.classList.toggle('open'); event.stopPropagation();">
                                <span>Dimanche soir (19h)</span>

                                <svg style="width:1rem; height:1rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>

                            <div class="custom-select-options">
                                <div class="custom-option">Vendredi soir (18h)</div>
                                <div class="custom-option">Samedi matin (9h)</div>
                                <div class="custom-option selected">Dimanche soir (19h)</div>
                                <div class="custom-option">Lundi matin (7h)</div>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue'
import UserSettingsLayout from '@/Layouts/UserSettingsLayout.vue'

export default {
    layout: [ AppLayout, UserSettingsLayout ],

    props: [],

    data: function () {
        return {}
    },

    created: function () {},

    methods: {
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/components/user_settings.scss';

.notif-table {
    border-collapse: collapse;
    width: 100%;

    tr:last-child {
        td {
            border-bottom: none;
        }
    }

    th {
        text-align: left;
        padding: 0.75rem 0;
        color: var(--color-slate-500);
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        border-bottom: 1px solid var(--color-slate-200);
    }

    td {
        border-bottom: 1px solid var(--color-slate-100);
        padding: 1rem 0;
        vertical-align: middle;

        .notif-label {
            color: var(--color-slate-900);
            font-size: 0.875rem;
            font-weight: 600;
        }

        .notif-desc {
            color: var(--color-slate-500);
            font-size: 0.75rem;
        }
    }
}
</style>