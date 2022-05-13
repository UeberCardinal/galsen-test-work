<template>
    <tr
        :key="entry.id"
        v-for="entry of entries.data"
    >
        <td scope="row">{{ entry.id }}</td>
        <td>{{ entry.date }}</td>
        <td>{{ entry.value }}</td>
        <td>
            <i
                class="fa-solid fa-pen-to-square"
               @click="$emit('edit', entry)"
            ></i>
            <i
                @click="$emit('remove', entry)"
                class="fa-solid fa-trash"></i>
        </td>
    </tr>
</template>

<script>
export default {
    name: "TableItem",
    emits: ['remove', 'edit'],
    props: {
        entries: {
            type: Object,
            required: true,
        }
    }
}
</script>

<style scoped>
.fa-solid {
    margin-right: 10px;
    font-size: 16px;
    cursor: pointer;
}

.fa-solid:hover {
    margin-right: 10px;
    font-size: 16px;
    color: orange;
}

td {
    text-align: center;
    vertical-align: middle;
}
</style>
