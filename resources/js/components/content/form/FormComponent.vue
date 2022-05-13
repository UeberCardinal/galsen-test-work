<template>
    <div class="form__div">
        <form action="">
            <div class="form__elem">
                <div class="elem">
                    <div><label><strong>Дата</strong></label></div>
                    <div>
                        <my-input
                            :value="date"
                            @input="dateInput"
                        />
                    </div>
                </div>
                <div class="elem">
                    <div><label><strong>Целое число</strong></label></div>
                    <div>
                        <my-input
                            type="text"
                            :value="number"
                            @input="numberInput"
                        />
                    </div>
                </div>
                <div class="elem">
                   <my-button
                       v-on:click="$emit('updateTable')"
                       @click="sendToDataBase"
                       v-on:click.prevent.stop
                       type="submit"
                   > Add</my-button>
                </div>
            </div>
        </form>
    </div>

</template>

<script>
import axios from 'axios';
import MyInput from "../ui/MyInput";
import MyButton from "../ui/MyButton";
export default {
    name: "FormComponent",
    components: {MyButton, MyInput},
    data() {
        return {
            date: '',
            number: '',
        }
    },
    methods: {
        numberInput(event) {
            this.number = event.target.value
        },
        dateInput(event) {
            this.date = event.target.value
        },
        async sendToDataBase() {
            const data = {
                'date': this.date,
                'value': this.number,
            }
            try {
                const response = await axios.post('api/entry', data)
                this.$emit('alert', 'alertSuccess')
                this.date = ''
                this.number = ''
            } catch (e) {
                console.log('error', e)
                this.$emit('alert', 'alertError')
            }
            this.$emit('updateChart')
        },

    }
}
</script>

<style scoped>
.form__div {
    background-color: #F5F5F5;
    width: max-content;
    padding: 30px;
    border-radius: 3px;
    border: 2px lightgrey solid;
    box-shadow: rgba(14,5,30,0.5);
    margin-right: 20px;

}

.form__elem {
    display: block;
}

.elem {
    margin-top:15px;
}


.elem input {
    border-radius: 6px;
    border: 0.5px darkslategrey solid;
}

</style>
