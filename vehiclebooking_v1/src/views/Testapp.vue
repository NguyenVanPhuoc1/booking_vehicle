<template>
    <FileDrop />
</template>
<script lang="ts" setup>
import {defineAsyncComponent} from "vue"

const FileDrop = defineAsyncComponent(()=>import("@/components/ImageUploader.vue"))
</script>