<template>
    <div class="modal-backdrop" v-if="opened">
        <div class="modal-panel">
            <div class="modal-header">
                <h3 class="modal-title">Configuration 2FA</h3>

                <button style="background: none; border: none; cursor: pointer;" @click="close">✕</button>
            </div>

            <div class="modal-body" style="text-align: center;">
                <div v-if="step === 1">
                    <div class="step-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                    </div>

                    <p style="margin-bottom: 1.5rem; color: var(--color-slate-600);">
                        Scannez ce code avec votre application d'authentification (Google Auth, Authy...).
                    </p>

                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=GifraneERP-User-2FA" style="margin-bottom: 1.5rem;" />

                    <button class="btn btn-primary" style="width: 100%; justify-content: center;" @click="nextStep()">J'ai scanné le code</button>
                </div>

                <div v-else-if="step === 2">
                    <div class="step-dots">
                        <span class="dot"></span>
                        <span class="dot active"></span>
                    </div>

                    <p style="margin-bottom: 1.5rem; color: var(--color-slate-600);">Entrez le code à 6 chiffres généré par l'application.</p>

                    <input type="text" class="form-control otp-input" placeholder="000 000" style="margin-bottom: 1.5rem;" />

                    <button class="btn btn-primary" style="width: 100%; justify-content: center;" @click="close">Vérifier et Activer</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            opened: false,

            step: 1,
        }
    },

    methods: {
        open: function () {
            this.opened = true
        },
        close: function () {
            this.opened = false
        },

        nextStep: function () {
            this.step = 2
        },
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/design/modal.scss';

.step-dots {
    display: flex;
    justify-content: center;
    gap: 0.5rem;
    margin-bottom: 1.5rem;

    .dot {
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 50%;
        background: var(--color-slate-200);

        &.active {
            background: var(--color-primary-600);
        }
    }
}

.otp-input {
    letter-spacing: 0.5rem;
    font-family: monospace;
    font-size: 1.5rem;
    text-align: center;
    font-weight: 600;
}
</style>