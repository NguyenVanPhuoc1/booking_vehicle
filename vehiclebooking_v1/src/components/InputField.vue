<template>
    <div class="mb-3">
        <!-- Hiển thị label nếu có truyền prop label -->
        <label v-if="label" :for="id" class="form-label">
            {{ label }}
        </label>

        <input
            :id="id"
            :type="type"
            :class="['form-control', { 'is-invalid': error }, $attrs.class]"
            :value="modelValue"
            :placeholder="placeholder"
            :required="required"
            :autocomplete="autocomplete"
            :readonly="readonly"    
            @input="$emit('update:modelValue',  $event.target.value)"
        />

        <!-- Hiển thị thông báo lỗi nếu có -->
        <div v-if="error" class="invalid-feedback">
            {{ error[0] }}
        </div>
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        default: "", // Nội dung cho label (nếu cần)
    },
    id: {
        type: String,
        default: "input-field", // ID của input, sẽ được sử dụng trong label
    },
    type: {
        type: String,
        default: "text",
    },
    placeholder: {
        type: String,
        default: "Enter text",
    },
    required: {
        type: Boolean,
        default: false,
    },
    autocomplete: {
        type: String,
        default: "off",
    },
    readonly: {
        type: Boolean,
        default: false,
    },
    error: {
        type: [String, Array],
        default: "",
    },
    inheritAttrs: false,
});
defineEmits(["update:modelValue"]);
</script>

<style scoped>

</style>
