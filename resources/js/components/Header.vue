<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="m-2 w-full rounded-2xl border-2 border-primary p-4">
        <nav class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h1 class="text-3xl leading-tight font-bold tracking-tighter md:text-4xl lg:leading-[1.1]">Hamburger Schulen</h1>
                <h2 class="text-lg leading-tight font-bold tracking-tighter md:text-xl lg:leading-[1.1]">
                    Finde Informationen zu Schulen in Hamburg
                </h2>
            </div>
            <div class="flex items-center justify-end space-x-4 text-sm lg:space-x-8 lg:text-base">
                <Link class="hover:font-bold" href="/">Home</Link>
                <Link class="hover:font-bold" href="/impressum">Impressum</Link>
                <Link class="hover:font-bold" href="/datenschutz">Datenschutz</Link>
                <a class="hover:font-bold" href="https://api.hamburg.de/datasets/v1/schulen" target="_blank">Datenquelle</a>
            </div>
        </nav>
    </header>
</template>

<style scoped></style>
