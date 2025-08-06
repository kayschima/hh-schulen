<script lang="ts" setup>
import { Link } from '@inertiajs/vue3';
</script>
<template>
    <footer class="m-2 w-full rounded-2xl border border-2 border-primary p-1 lg:p-4">
        <div class="mb-4 flex items-center justify-around text-sm">
            <Link class="hover:font-bold" href="/impressum">Impressum</Link>
            <Link class="hover:font-bold" href="/datenschutz">Datenschutz</Link>
            <a class="hover:font-bold" href="https://api.hamburg.de/datasets/v1/schulen" target="_blank">Datenquelle</a>
        </div>
        <div class="text-center text-xs">
            &copy; {{ new Date().getFullYear() }} Kay Markschies - Version 2.0 - open sourced under MIT licence <br />
            <br />
            visit us at
            <a class="hover:underline" href="https://github.com/kayschima/hh-schulen" target="_blank">
                Github (https://github.com/kayschima/hh-schulen) </a
            >.
            <br />
            App still in development - Data provided daily by <a href="https://api.hamburg.de/datasets/v1/schulen" target="_blank">hamburg.de </a>
        </div>
    </footer>
</template>
