<template>
    <div class="modal-backdrop" v-if="opened">
        <div class="modal-panel">
            <div class="modal-header">
                <h3 class="modal-title">Révoquer la session ?</h3>
            </div>

            <div class="modal-body">
                <p style="color: var(--color-slate-600); line-height: 1.5;">
                    Vous êtes sur le point de déconnecter l'appareil <strong>Safari sur iPhone 13</strong>. L'utilisateur devra se reconnecter.
                </p>

                <div class="modal-checkbox">
                    <input type="checkbox" id="security-alert-check">

                    <label for="security-alert-check">
                        Je ne reconnais pas cette connexion
                        <span style="display: block; font-weight: 400; font-size: 0.75rem; color: var(--color-danger-600); opacity: 0.8;">
                            Ceci changera votre mot de passe et alertera les administrateurs.
                        </span>
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-white" @click="close">Annuler</button>
                <button class="btn btn-danger" @click="close">Révoquer</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            opened: false,
        }
    },

    methods: {
        open: function () {
            this.opened = true
        },
        close: function () {
            this.opened = false
        },
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/design/modal.scss';
</style>