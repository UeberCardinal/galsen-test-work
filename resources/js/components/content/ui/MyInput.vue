<template>
    <input
        :value="modelValue"
        @input="updateInput"
        class="form-control"
        style="width: 175px"
        type="date"
    >
</template>

<script>
export default {
    name: "MyInput",
    props: {
        modelValue: [String, Number]
    },
    methods: {
        updateInput(event) {
            this.$emit('update:modelValue', event.target.value)
        }
    }
}
</script>

<style scoped>

</style>
