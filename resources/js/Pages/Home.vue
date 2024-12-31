<script setup>
import {Head, Link} from '@inertiajs/vue3'
import SchoolEntry from "@/Components/SchoolEntry.vue";

defineProps({
    schools: Object,
    search: String
})

</script>

<template>
    <Head title="Hamburger Schulen"/>
    <Head content="Tagesaktuelle Daten von Hamburger Schulen" meta="description"/>

    <div class="max-w-7xl mx-auto">
        <header class="bg-slate-900 my-4 p-4 text-white rounded-t-lg">
            <form action="/" class="px-4 flex space-x-8 items-center" method="get">
                <h1 class="text-3xl font-bold">
                    <a href="/">Hamburger&nbsp;Schulen </a>
                </h1>
                <input :value="search" class="p-2 w-full rounded border border-gray-300 text-slate-950" name="search"
                       placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..." type="search">
                <button type="submit">Suchen</button>
            </form>
        </header>
        <main class="px-4 text-xs">
            <div class="mt-2 flex justify-center">
                <Link v-for="link in schools.links"
                      :class="['px-3 py-1 border', { 'text-slate-500': !link.url, 'font-bold bg-slate-500 text-white': link.active }]"
                      :href="link.url??'#'"
                      v-html="link.label"/>
            </div>
            <table class="w-full mt-2 bg-white">
                <thead>
                <tr class="text-left">
                    <th class="py-2 px-4 border-b"></th>
                    <th class="py-2 px-4 border-b">Schulnr.</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Adresse + Ort</th>
                    <th class="py-2 px-4 border-b">Schultyp</th>
                    <th class="py-2 px-4 border-b">Bezirk</th>
                </tr>
                </thead>
                <tbody>
                <SchoolEntry v-for="school in schools.data" :school="school"/>
                </tbody>
            </table>
            <div>
                <p class="my-2 font-bold text-center text-slate-500">
                    Zeige {{ schools.from }} bis {{ schools.to }} von {{ schools.total }} Schulen
                </p>
            </div>

        </main>
        <footer class="bg-slate-950 p-4 text-slate-100 text-center rounded-b-lg">
            <div class="mb-4 flex items-center justify-around text-sm">
                <a href="#">Impressum</a>
                <a href="#">Datenschutz</a>
                <a href="https://api.hamburg.de/datasets/v1/schulen"
                   target="_blank">Datenquelle</a>
            </div>
            <div class="text-xs">
                &copy; {{ new Date().getFullYear() }} Kay Markschies, data provided by
                <a href="https://api.hamburg.de/datasets/v1/schulen"
                   target="_blank">hamburg.de
                </a>
            </div>
        </footer>
    </div>
</template>

<style scoped>

</style>
