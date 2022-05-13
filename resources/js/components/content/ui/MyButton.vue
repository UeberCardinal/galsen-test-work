<template>
    <button class="btn btn-dark">
        <slot></slot>
    </button>
</template>

<script>
export default {
    name: "MyButton",
}
</script>

<style scoped>
button {
    border-radius: 6px;
    border: none;
}
button:hover {
    color: orange;
}
</style>
