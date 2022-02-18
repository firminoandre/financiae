<template>
<div>
    <label :for="`x-${type}-${label}`" class="block text-sm font-medium text-gray-700">{{ label }}</label>
    <input :type="type" :value="modelValue" @input="(event) => $emit('update:modelValue', event.target.value)" :id="`x-${type}-${label}`" :placeholder="placeholder" 
    class="mt-1 block w-full border border-gray-300 rounded-sm shadow-sm py-2 px-3 
    focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" :readonly="readonly" />
</div>
</template>

<script>
export default {
    props: {
        modelValue: String,
        label: {
            type: String,
            default: ""
        },
        placeholder: {
            type: String,
            default: ""
        },
        type: {
            type: String,
            default: "text"
        },
        readonly:{
            type: Boolean,
            default:false
        }
    }
}
</script>

<style>
</style>