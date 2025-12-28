<template>
    <div class="settings-section">
        <h2 class="section-title">Mon Profil</h2>

        <p class="section-desc">
            Gérez vos informations personnelles.<br>
            <span class="text-slate-400">Dernière mise à jour : {{ last_update }}</span>
        </p>

        <div class="info-box">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>

            <div>
                <p><strong>Information Importante</strong></p>
                <p style="margin-top: 0.25rem;">Les informations ci-dessous sont synchronisées avec votre fiche employé dans le module SIRH. Toute modification sera visible par votre manager et l'équipe RH.</p>
            </div>
        </div>

        <div class="panel">
            <Form method="POST">
                <input type="hidden" name="_token" :value="csrf_token" />

                <div class="panel-body">
                    <div class="avatar-upload">
                        <img src="https://ui-avatars.com/api/?name=Jean+Dupont&background=c7d2fe&color=3730a3&size=128" alt="Avatar" class="avatar-preview">

                        <div>
                            <button class="upload-btn">Changer la photo</button>
                            <div class="upload-hint">JPG, GIF ou PNG. 1MB max.</div>
                        </div>
                    </div>

                    <div class="form-grid" style="margin-top: 2rem;">
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" class="form-control" v-model="data_firstname" name="firstname">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" class="form-control" v-model="data_lastname" name="lastname">
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">Email Professionnel</label>
                            <input type="email" class="form-control" :value="email" disabled>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Téléphone Mobile</label>
                            <input type="tel" class="form-control" placeholder="+33 6 12 34 56 78">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Titre / Poste</label>
                            <input type="text" class="form-control" value="Responsable Produit" disabled>
                            <div style="font-size: 0.75rem; color: var(--color-slate-500); margin-top: 0.25rem;">Géré par le service RH.</div>
                        </div>

                        <div class="form-group form-full">
                            <label class="form-label">Signature Email (CRM)</label>

                            <div class="rte-toolbar">
                                <div class="rte-btn"><strong>B</strong></div>
                                <div class="rte-btn"><em>I</em></div>
                                <div class="rte-btn"><u>U</u></div>
                            </div>

                            <div class="rte-content" contenteditable="true">
                                Cordialement,<br>
                                <strong>Jean Dupont</strong><br>
                                Gifrane SA
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
            </Form>
        </div>
    </div>
</template>

<script>
import { Form } from '@inertiajs/vue3'

import AppLayout from '@/Layouts/AppLayout.vue'
import UserSettingsLayout from '@/Layouts/UserSettingsLayout.vue'

export default {
    components: { Form },

    inject: [ 'csrf_token' ],

    layout: [ AppLayout, UserSettingsLayout ],

    props: [ 'last_update', 'firstname', 'lastname', 'email' ],

    data: function () {
        return {
            data_firstname: null,
            data_lastname: null,
        }
    },

    created: function () {
        this.data_firstname = this.firstname
        this.data_lastname = this.lastname
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/components/user_settings.scss';
</style>