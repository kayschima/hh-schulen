<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <footer class="bg-slate-950 mx-1 p-4 text-slate-100 text-center rounded-b-lg">
        <div class="mb-4 flex items-center justify-around text-xs">
            <Link class="hover:font-bold" href="/impressum">Impressum</Link>
            <Link class="hover:font-bold" href="/datenschutz">Datenschutz</Link>
            <a class="hover:font-bold" href="https://api.hamburg.de/datasets/v1/schulen"
               target="_blank">Datenquelle</a>
        </div>
        <div class="text-xs">
            &copy; {{ new Date().getFullYear() }} Kay Markschies - Version 0.7<br>App still in development - Data
            provided daily by
            <a href="https://api.hamburg.de/datasets/v1/schulen"
               target="_blank">hamburg.de
            </a>
        </div>
    </footer>
</template>

<style scoped>

</style>
