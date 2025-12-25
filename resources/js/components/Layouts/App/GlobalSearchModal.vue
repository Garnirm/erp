<template>
    <div class="search-modal-backdrop" id="search-modal" v-if="toggle">
        <div class="search-modal" v-click-outside="hideModal">
            <div class="search-modal-input-wrapper">
                <svg style="color: var(--color-primary-600);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" class="search-modal-input" placeholder="Rechercher une commande, un client, un employé..." ref="search-input">
                <span class="kbd-shortcut">ESC</span>
            </div>

            <div class="search-results custom-scroll">
                <div class="result-group-title">Récemment consulté</div>

                <div class="result-item">
                    <svg class="result-icon icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>

                    <span>Facture #F-2024-889</span>
                    <span style="margin-left: auto; font-size: 0.75rem; color: var(--color-slate-400);">Finance</span>
                </div>

                <div class="result-item">
                    <svg class="result-icon icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>

                    <span>Alice Bernard (RH)</span>
                    <span style="margin-left: auto; font-size: 0.75rem; color: var(--color-slate-400);">Contacts</span>
                </div>

                <div class="result-group-title">Actions Rapides</div>

                <div class="result-item">
                    <svg class="result-icon icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>

                    <span>Créer un nouveau client</span>
                </div>

                <div class="result-item">
                    <svg class="result-icon icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>

                    <span>Créer une note de frais</span>
                </div>
            </div>

            <div style="padding: 0.5rem 1rem; background: var(--color-slate-50); border-top: 1px solid var(--color-slate-100); font-size: 0.75rem; color: var(--color-slate-400); text-align: right;">
                Sélectionner <span class="kbd-shortcut">↵</span> &nbsp; Naviguer <span class="kbd-shortcut">↑↓</span>
            </div>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'click-outside-vue3'

export default {
    directives: { clickOutside: vClickOutside.directive },

    data: function () {
        return {
            toggle: false,
        }
    },

    created: function () {
        EventBus.on('toggle_modal_global_search', (toggle) => this.toggleModal(toggle))
    },

    methods: {
        hideModal: function () {
            if (this.toggle) {
                this.toggleModal(false)
            }
        },
        toggleModal: function (toggle) {
            this.toggle = toggle

            if (this.toggle) {
                this.$nextTick(() => setTimeout(() => this.$refs['search-input'].focus(), 100))
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.search-modal-backdrop {
    align-items: flex-start;
    backdrop-filter: blur(2px);
    background-color: rgba(15, 23, 42, 0.4);
    display: flex;
    inset: 0;
    justify-content: center;
    padding-top: 10vh;
    position: fixed;
    z-index: 100;

    .search-modal {
        width: 100%;
        max-width: 40rem;
        background: white;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        animation: slideDown 0.2s ease-out;

        .search-modal-input-wrapper {
            padding: 1rem;
            border-bottom: 1px solid var(--color-slate-100);
            display: flex;
            align-items: center;
            gap: 1rem;

            .search-modal-input {
                flex: 1;
                border: none;
                font-size: 1.125rem;
                outline: none;
                color: var(--color-slate-900);
            }
        }

        .search-results {
            padding: 0.5rem;
            max-height: 60vh;
            overflow-y: auto;

            .result-group-title {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
                font-weight: 600;
                color: var(--color-slate-400);
                text-transform: uppercase;
                margin-top: 0.5rem;
            }

            .result-item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 0.75rem;
                border-radius: 0.5rem;
                cursor: pointer;
                color: var(--color-slate-700);

                &:hover {
                    background-color: var(--color-primary-50);
                    color: var(--color-primary-700);

                    .result-icon {
                        color: var(--color-primary-600);
                    }
                }

                .result-icon {
                    color: var(--color-slate-400);
                }
            }
        }
    }
}
</style>