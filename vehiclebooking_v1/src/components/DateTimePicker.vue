<template>
    <div class="mb-3">
        <a-date-picker class="w-100" 
        :class="{ 'is-invalid': error }" 
        :value="modelValue" 
        @change="handleChange" />
        <div v-if="error" class="invalid-feedback"> 
            {{ error[0] }}
        </div>
    </div>
</template>
<script setup>
//date time trong ant design vue
import { defineProps, defineEmits } from "vue";
const props = defineProps({
    error : {
        type: [String, Array],
        default: "",
    },
    modelValue: {
        type: String,
        default: null,
    },
});
//quy ước đặt tên trong vue 3
const emit = defineEmits(["update:modelValue"]);
const handleChange =(value) => {
    // console.log('ngay' + value);
    emit("update:modelValue", value);
};
</script>