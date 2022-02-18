<template>
<div class="">
    <label class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <div class=" relative rounded-md shadow-sm">

        <input ref="inputRef" :value="formattedValue" type="text" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full 
        pr-12 sm:text-sm border-gray-300 rounded-sm" placeholder="0.00" :readonly="readonly" />

    </div>
</div>
</template>

<script>
import {
    useCurrencyInput
} from 'vue-currency-input'
export default {
     props: {
        label: {
            type: String,
            default: ""
        },
        readonly:{
            type: Boolean,
            default:false
        }
    },
    setup() {
        const {
            formattedValue,
            inputRef
        } = useCurrencyInput({
            currency: 'BRL'
        })
        return {
            inputRef,
            formattedValue
        }
    }
}
</script>

<style>
</style>