<template>
    <div class="ms-container" :class="{ 'is-open': isOpen, 'is-focused': isFocused }">
        <div class="ms-control is-single" @click="toggleDropdown">
            <div class="ms-single-display" :class="{ 'is-placeholder': !modelValue }">
                {{ singleLabel || placeholder }}
            </div>

            <div class="ms-chevron" :class="{ 'is-open': isOpen }">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
        </div>

        <div class="ms-dropdown" v-if="isOpen" @click.stop>
            <div class="ms-search-container">
                <input ref="dropdownInput" type="text" class="ms-input in-dropdown" placeholder="Rechercher..."
                    v-model="searchQuery" @keydown="handleKeydown" />
            </div>

            <ul class="ms-list" ref="optionsList">
                <li v-for="(opt, index) in filteredOptions" :key="opt.value" class="ms-option"
                    :class="{
                        'is-selected': isSelected(opt.value),
                        'is-highlighted': index === highlightedIndex,
                    }"
                    @click="selectOption(opt)"
                    @mouseenter="highlightedIndex = index"
                >
                    <span>{{ opt.label }}</span>

                    <svg class="ms-option-check icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </li>

                <div v-if="filteredOptions.length === 0" class="ms-no-results">
                    Aucun résultat pour "{{ searchQuery }}"
                </div>
            </ul>

            <div class="ms-footer" v-if="enable_add">
                <button class="ms-btn-add" type="button" @click="addNewEntity">
                    <svg class="icon" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>

                    <span v-if="searchQuery && filteredOptions.length === 0">Ajouter "{{ searchQuery }}"</span>
                    <span v-else>Ajouter une nouvelle entité</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: [ Array, String, Number, Object ],
            default: () => [],
        },
        options: { type: Array, required: true },
        placeholder: { type: String, default: 'Sélectionner...' },
        enable_add: { type: Boolean, default: true },
    },

    emits: [ 'update:modelValue', 'add-option' ],

    data: function () {
        return {
            isOpen: false,
            isFocused: false,
            searchQuery: '',
            highlightedIndex: -1,

            localOptions: [],
        }
    },

    created: function () {
        this.localOptions = [ ...this.options ]
    },

    mounted: function () {
        document.addEventListener('click', this.handleClickOutside)
    },

    beforeUnmount: function () {
        document.removeEventListener('click', this.handleClickOutside)
    },

    watch: {
        options: {
            handler: function (newVal) {
                this.localOptions = [ ...newVal ]
            },
            deep: true,
        },

        searchQuery: function () {
            this.highlightedIndex = 0
        },
    },

    computed: {
        filteredOptions: function () {
            if (!this.searchQuery) {
                return this.localOptions
            }

            const query = this.searchQuery.toLowerCase()

            return this.localOptions.filter((opt) => opt.label.toLowerCase().includes(query))
        },

        singleLabel: function () {
            const selected = this.localOptions.find((opt) => opt.value === this.modelValue)

            return selected ? selected.label : ''
        },
    },

    methods: {
        toggleDropdown: function () {
            if (this.isOpen) {
                this.closeDropdown()
            } else {
                this.openDropdown()
            }
        },

        openDropdown: function () {
            this.isOpen = true
            this.highlightedIndex = -1

            this.$nextTick(() => this.$refs.dropdownInput?.focus())
        },

        closeDropdown: function () {
            this.isOpen = false
            this.highlightedIndex = -1
            this.searchQuery = ''
            this.isFocused = false
        },

        handleClickOutside: function (e) {
            if (this.$el && !this.$el.contains(e.target)) {
                this.closeDropdown()
            }
        },

        selectOption: function (option) {
            this.$emit('update:modelValue', option.value)

            this.closeDropdown()
        },

        isSelected: function (optionValue) {
            return this.modelValue === optionValue
        },

        handleKeydown: function (e) {
            const optionsCount = this.filteredOptions.length

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault()

                    if (!this.isOpen) {
                        this.openDropdown()
                    }

                    this.highlightedIndex = (this.highlightedIndex + 1) % optionsCount

                    this.scrollToHighlighted()

                    break
                case 'ArrowUp':
                    e.preventDefault()

                    if (!this.isOpen) {
                        this.openDropdown()
                    }

                    this.highlightedIndex = (this.highlightedIndex - 1 + optionsCount) % optionsCount

                    this.scrollToHighlighted()

                    break
                case 'Enter':
                    e.preventDefault()

                    if (this.highlightedIndex >= 0 && this.filteredOptions[this.highlightedIndex]) {
                        this.selectOption(this.filteredOptions[this.highlightedIndex])
                    } else if (this.searchQuery) {
                        this.addNewEntity()
                    }

                    break
                case 'Escape':
                    this.closeDropdown()

                    break
            }
        },

        scrollToHighlighted: function () {
            this.$nextTick(() => {
                const list = this.$refs.optionsList
                const highlightedEl = list?.children[this.highlightedIndex]

                if (highlightedEl) {
                    highlightedEl.scrollIntoView({ block: 'nearest' })
                }
            })
        },

        addNewEntity: function () {
            const label = this.searchQuery.trim()

            if (!label) {
                return
            }

            const existing = this.localOptions.find((opt) => opt.label.toLowerCase() === label.toLowerCase())

            if (existing) {
                this.selectOption(existing)
            } else {
                const newValue = `new_${Date.now()}`
                const newOption = { value: newValue, label: label }

                this.localOptions.push(newOption)

                this.selectOption(newOption)

                this.$emit('add-option', newOption)
            }
        },
    },
}
</script>

<style lang="scss" scoped>
@use '@scss/design/select.scss';
</style>