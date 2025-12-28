<template>
    <div class="ms-container" :class="{ 'is-open': isOpen, 'is-focused': isFocused }">
        <div class="ms-control" @click="toggleDropdown">
            <div v-for="chip in selectedChips" :key="chip.value" class="ms-chip" @click.stop>
                <span>{{ chip.label }}</span>

                <span class="ms-chip-remove" @click="removeChip(chip.value)">
                    <svg viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </span>
            </div>

            <input ref="mainInput" type="text" class="ms-input" :placeholder="selectedChips.length === 0 ? placeholder : ''"
                v-model="searchQuery" @focus="isFocused = true; openDropdown()" @keydown="handleKeydown" />
        </div>

        <div class="ms-dropdown" v-if="isOpen" @click.stop>
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

            return this.localOptions.filter(opt => opt.label.toLowerCase().includes(query))
        },

        selectedChips: function () {
            if (!Array.isArray(this.modelValue)) {
                return []
            }

            return this.modelValue
                .map((val) => this.localOptions.find(opt => opt.value === val))
                .filter(Boolean)
        }
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

            this.$nextTick(() => {
                this.$refs.mainInput?.focus()
            })
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
            const newValue = [ ...this.modelValue ]
            const index = newValue.indexOf(option.value)

            if (index === -1) {
                newValue.push(option.value)
            } else {
                newValue.splice(index, 1)
            }

            this.$emit('update:modelValue', newValue)

            this.searchQuery = ''
            this.$refs.mainInput?.focus()
        },

        isSelected: function (optionValue) {
            return Array.isArray(this.modelValue) && this.modelValue.includes(optionValue)
        },

        removeChip: function (value) {
            const newValue = this.modelValue.filter((v) => v !== value)

            this.$emit('update:modelValue', newValue)
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
                case 'Backspace':
                    if (!this.searchQuery && this.modelValue.length > 0) {
                        this.removeChip(this.modelValue[this.modelValue.length - 1])
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