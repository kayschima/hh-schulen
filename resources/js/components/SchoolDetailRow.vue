<script lang="ts" setup>
import { Button } from '@/components/ui/button';

defineProps({
    title: String,
    data: String,
    href: String,
    target: String,
});
</script>

<template>
    <div v-if="href || data" class="border-b-1 font-bold" v-text="title" />
    <div v-if="data" class="border-b-1" v-html="data" />
    <div v-if="href" class="border-b-1">
        <Button class="px-2 py-1 text-xs" variant="outline">
            <a :href="href" class="hover:underline" target="target"> Link </a>
        </Button>
    </div>
</template>

<style scoped></style>
