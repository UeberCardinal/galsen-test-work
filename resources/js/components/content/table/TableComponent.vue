<template>
    <div class="w-100">
        <my-dialog :entry="currentEntry"  v-model:show="dialogVisible"/>
        <table class="table table-dark">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Value</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
          <table-item
              :entries="entries"
              @remove="removeEntry"
              @edit="editEntry"
          />
            </tbody>
        </table>
        <div class="d-flex mt-2">
            <div class="d-flex">
                <div style="margin-right: 10px;"  class="btn btn-dark" @click="changePage('dec')">Prev</div>
                <div  class="btn btn-dark" @click="changePage('inc')">Next</div>
            </div>
            <div class="select">
                <label>Количество entry в таблице</label>
                <my-select @numberOfPage="numberPerPage"/>
            </div>
        </div>

    </div>

</template>

<script>
import axios from "axios";
import TableItem from "./TableItem";
import MyDialog from "./modal/MyDialog";
import MySelect from "../ui/MySelect";


export default {
    name: "TableComponent",
    components: {MySelect, MyDialog, TableItem},
    data() {
        return {
            entries: {
                required: true,
                type: Array,
            },
            page: 1,
            lastPage: 0,
            numberPerPage: 5,
            dialogVisible: false,
            currentEntry: {
                type: Object,
            }
        }

    },
    methods: {
        async getEntries() {
            try {
                const response = await axios.get('api/entry', {
                    params: {
                        'page': this.page,
                        'per_page': this.numberPerPage

                    }
                })
                console.log(response)
                this.entries = response.data
                this.nextPage = response.data.links.next
                this.prevPage = response.data.links.prev
                this.lastPage = response.data.meta.last_page
            } catch (e) {
                console.log(e)
            }

        },
        changePage(nextOrPrev) {
            if (nextOrPrev === 'inc' && this.page < this.lastPage) {
                this.page += 1
            } else if (nextOrPrev === 'dec' && this.page > 1) {
                this.page -= 1
            }
            this.getEntries()
        },
       async removeEntry(entry){
            if (confirm('Вы точно хотите удалить запись?')){
                try {
                    const sendRequest = await axios.delete('api/entry/'+entry.id)
                } catch (e) {
                    console.log(e)
                }
                await this.getEntries()
                this.$emit('updateChart')
            }
        },
        editEntry(entry) {
            this.dialogVisible = true
            this.currentEntry = entry
        },
    },
    mounted() {
        console.log(this.numberPerPage)
        this.getEntries()
    },


}
</script>

<style scoped>
.table.table-dark {
    margin: 0;
    height: 100%;
}

.table td, th {
    text-align: center;
    vertical-align: middle;
}
.btn:hover {
    color: orange;
}
.select {
    margin-left: 10px;
}

</style>
