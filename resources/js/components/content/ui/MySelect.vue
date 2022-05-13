<template>
    <select @change="testChange" >
        <option :key="numb.key"  v-for="numb in numberPerPage">
            {{ numb }}
        </option>
    </select>
</template>

<script>
import TableComponent from "../table/TableComponent";
export default {
    name: "MySelect",
    data(){
        return {
            numberPerPage: 15
        }
    },
    methods: {
        testChange(event){
            console.log(event.target.value)
            this.$emit('numberOfPage', event.target.value)
            TableComponent.methods.getEntries()
        }
    }
}
</script>

<style scoped>

</style>
