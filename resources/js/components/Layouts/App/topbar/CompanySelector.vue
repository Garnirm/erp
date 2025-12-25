<template>
    <div class="context-wrapper">
        <button class="context-selector" @click="toggleCompanySelector">
            <div class="context-logo">G</div>

            <span>{{ active_company }}</span>

            <svg style="width: 1rem; height: 1rem; color: var(--color-slate-500); margin-left: auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div class="context-menu" v-if="toggle_company_selector">
            <div class="dropdown-item" v-for="cl in companies_list" :key="cl.id">
                <div class="context-logo">{{ cl.name[0] }}</div> {{ cl.name }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            companies_list: [],

            toggle_company_selector: false,
        }
    },

    computed: {
        active_company: function () {
            return this.companies_list.find((company) => company?.active)?.name
        },
    },

    created: function () {
        this.companies_list = this.$page.props.topbar_companies_list
    },

    methods: {
        toggleCompanySelector: function () {
            this.toggle_company_selector = !this.toggle_company_selector
        },
    },
}
</script>

<style lang="scss" scoped>
.context-wrapper {
    position: relative;

    .context-selector {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0.75rem;
        background-color: white;
        border: 1px solid var(--color-slate-200);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--color-slate-700);
        cursor: pointer;
        transition: all 0.2s;
        min-width: 14rem;

        &:hover {
            border-color: var(--color-slate-300);
            background-color: var(--color-slate-50);
        }
    }

    .context-logo {
        min-width: 1.25rem;
        width: 1.25rem;
        height: 1.25rem;
        background-color: var(--color-primary-600);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .context-menu {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        height: fit-content;
        margin-top: 0.5rem;
        max-height: 300px;
        background: white;
        border: 1px solid var(--color-slate-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        padding: 0.5rem;
        z-index: 1;
        overflow: hidden;
        overflow-y: auto;
        animation: slideUp 0.2s ease-out;
    }
}
</style>