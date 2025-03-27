<template>
    <div class="mb-3">
        <!-- Hiển thị label nếu có truyền prop label -->
        <label v-if="label" :for="id" class="form-check-label">
            {{ label }}
        </label>

        <input
            :id="id"
            type="checkbox"
            :class="['form-check-input']"
            :checked="modelValue"
            @input="$emit('update:modelValue',  $event.target.checked)"
        />
    </div>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
    label: {
        type: String,
        default: "", // Nội dung cho label (nếu cần)
    },
    id: {
        type: String,
        default: "input-field", // ID của input, sẽ được sử dụng trong label
    },
});
defineEmits(["update:modelValue"]);
</script>

