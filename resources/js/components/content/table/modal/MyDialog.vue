<template>
    <div v-if="show" @click="hideDialog" class="modal-dial">
        <div @click.stop   class="dialog">
            <div class="content__dialog">
                <form action="">
                    <label><strong>Дата</strong></label>
                    <my-input
                        v-model="this.entry.date"
                    />
                    <label style="margin-top: 10px;"><strong>Целое число</strong></label>
                    <my-input
                        v-model="this.entry.value"
                        type="text"
                    />
                    <my-button
                        @click.prevent="submitEditEntry"
                        style="margin-top: 10px;">
                        Save</my-button>
                </form>

            </div>
        </div>
    </div>

</template>

<script>
import MyInput from "../../ui/MyInput";
import MyButton from "../../ui/MyButton";
import axios from "axios";
export default {
    name: "MyDialog",
    components: {MyButton, MyInput},
    props: {
        show: {
            type: Boolean,
            default: false,
        },
        entry: {
            type: Object,
            required: true,
        }
    },
    methods: {
        hideDialog() {
            this.$emit('update:show', false)
        },
       async submitEditEntry(){
            console.log(this.entry)
           try {
               const response = await axios.put('api/entry/'+this.entry.id, this.entry)
               this.hideDialog()
               console.log(response)
           } catch (e) {
               console.log(e)
           }


       }
    },



}
</script>

<style scoped>
.modal-dial {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;

}
.dialog {
    position: fixed;
    top: 200px;
    right: 200px;
    background-color: gainsboro;
    border-radius: 10px;
}
.content__dialog {
    padding: 20px;
}

</style>
