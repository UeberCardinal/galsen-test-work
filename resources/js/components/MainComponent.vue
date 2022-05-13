<template>
    <header-component/>
    <content-component/>
</template>

<script>
import HeaderComponent from "./HeaderComponent";
import ContentComponent from "./content/ContentComponent";
export default {
    name: "MainComponent",
    components: {ContentComponent, HeaderComponent}
}
</script>

<style scoped>

</style>
