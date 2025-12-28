<template>
    <div class="settings-section">
        <h2 class="section-title">Apparence & Région</h2>

        <p class="section-desc">Personnalisez votre expérience visuelle et vos préférences régionales.</p>

        <div class="panel">
            <Form method="POST" disableWhileProcessing @submit.prevent="form.post('/user/settings/appearance')">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="form-label">Thème de l'interface</label>

                        <div class="theme-grid">
                            <div class="theme-card" @click="selectTheme('system')" :class="{ active: form.theme === 'system' }">
                                <div class="theme-preview"></div>
                                <span class="theme-label">Système</span>
                            </div>

                            <div class="theme-card" @click="selectTheme('clear')" :class="{ active: form.theme === 'clear' }">
                                <div class="theme-preview" style="background: #fff; border: 1px solid #e2e8f0;"></div>
                                <span class="theme-label">Clair</span>
                            </div>

                            <div class="theme-card dark" @click="selectTheme('dark')" :class="{ active: form.theme === 'dark' }">
                                <div class="theme-preview"></div>
                                <span class="theme-label">Sombre</span>
                            </div>
                        </div>
                    </div>

                    <hr style="border: 0; border-top: 1px solid var(--color-slate-100); margin: 2rem 0;">

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Langue</label>

                            <Select v-model="form.lang" :options="langs" :enable_add="false" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Format de date</label>

                            <Select v-model="form.date_format" :options="date_formats" :enable_add="false" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Pays</label>

                            <Select v-model="form.country" :options="countries" :enable_add="false" />
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fuseau Horaire</label>

                            <Select v-model="form.timezone" :options="timezones" :enable_add="false" />
                        </div>
                        
                        <div class="form-group form-full">
                            <label class="form-label" style="margin-bottom: 1rem;">Accessibilité & Densité</label>

                            <div class="d-flex" style="flex-direction: column; gap: 1rem;">
                                <div class="d-flex" style="justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 500;">Mode Compact</div>
                                        <div style="font-size: 0.75rem; color: var(--color-slate-500);">Réduit l'espacement pour afficher plus de données.</div>
                                    </div>

                                    <div class="toggle-switch" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div>
                                </div>

                                <div class="d-flex" style="justify-content: space-between; align-items: center;">
                                    <div>
                                        <div style="font-size: 0.875rem; font-weight: 500;">Réduire les animations</div>
                                        <div style="font-size: 0.75rem; color: var(--color-slate-500);">Minimise les mouvements pour plus de confort.</div>
                                    </div>

                                    <div class="toggle-switch" onclick="toggleSwitch(this)"><div class="toggle-knob"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </Form>
        </div>
    </div>
</template>

<script>
import { Form, useForm } from '@inertiajs/vue3'

import AppLayout from '@/Layouts/AppLayout.vue'
import UserSettingsLayout from '@/Layouts/UserSettingsLayout.vue'

import Select from '../../../components/UI/Select.vue'

export default {
    components: { Form, Select },

    layout: [ AppLayout, UserSettingsLayout ],

    props: [
        'date_formats', 'timezones', 'countries', 'langs', 'user_timezone', 'user_country', 'user_lang', 'user_date_format',
    ],

    data: function () {
        return {
            form: useForm({
                theme: 'system',
                timezone: null,
                lang: null,
                country: null,
                date_format: null,
            }),

            label_lang: null,
        }
    },

    created: function () {
        this.form.timezone = this.user_timezone
        this.form.country = this.user_country
        this.form.lang = this.user_lang
        this.form.date_format = this.user_date_format

        this.label_lang = this.langs.find((lang) => lang.value === this.form.lang).label
    },

    methods: {
        selectTheme: function (theme) {
            this.form.theme = theme
        },
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/components/user_settings.scss';

.theme-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(3, 1fr);

    .theme-card {
        border: 2px solid var(--color-slate-200);
        border-radius: var(--radius-lg);
        padding: 1rem;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s;

        &:hover {
            border-color: var(--color-slate-300);
        }

        &.active {
            border-color: var(--color-primary-600);
            background: var(--color-primary-50);
        }

        &.dark {
            .theme-preview {
                background: #1e293b;
            }
        }

        .theme-preview {
            height: 4rem;
            background: var(--color-slate-100);
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            overflow: hidden;
            position: relative;
        }

        .theme-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--color-slate-700);
        }
    }
}
</style>