<script setup>
import {Head, Link} from '@inertiajs/vue3'

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
                <h1 class="text-3xl font-bold">Hamburger&nbsp;Schulen</h1>
                <input :value="search" class="p-2 w-full rounded border border-gray-300 text-slate-950" name="search"
                       placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..." type="search">
                <button type="submit">Suchen</button>
            </form>
        </header>
        <main class="p-4 text-xs">
            <div class="mt-4 flex justify-center">
                <Link v-for="link in schools.links"
                      :class="['px-3 py-1 border', { 'text-slate-500': !link.url, 'font-bold bg-slate-500 text-white': link.active }]"
                      :href="link.url??'#'"
                      v-html="link.label"/>
            </div>
            <table class="w-full mt-4 bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Schulnr.</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Adresse + Ort</th>
                    <th class="py-2 px-4 border-b">Telefon</th>
                    <th class="py-2 px-4 border-b">Bezirk</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="school in schools.data">
                    <td class="py-2 px-4 border-b" v-text="school.schul_id"/>
                    <td class="py-2 px-4 border-b" v-text="school.schulname"/>
                    <td class="py-2 px-4 border-b">
                        <span v-text="school.adresse_strasse_hausnr"/>,
                        <span v-text="school.adresse_ort"/>
                    </td>
                    <td class="py-2 px-4 border-b" v-text="school.schul_telefonnr"/>
                    <td class="py-2 px-4 border-b" v-text="school.bezirk"/>
                </tr>
                </tbody>
            </table>
            <div>
                <p class="mt-4 font-bold text-center text-slate-500">
                    Zeige {{ schools.from }} bis {{ schools.to }} von {{ schools.total }} Schulen
                </p>
            </div>

        </main>
        <footer class="bg-gray-800 p-4 text-white text-center">
            <div class="mb-4 flex items-center justify-around">
                <a class="text-white" href="#">Impressum</a>
                <a class="text-white" href="#">Datenschutz</a>
                <a class="text-white" href="https://api.hamburg.de/datasets/v1/schulen" target="_blank">Datenquelle</a>
            </div>
            <div class="text-xs">
                &copy; {{ new Date().getFullYear() }} Kay Markschies <br>
                Data provided by <a class="text-white" href="https://api.hamburg.de/datasets/v1/schulen"
                                    target="_blank">hamburg.de</a>
            </div>
        </footer>
    </div>
</template>

<style scoped>

</style>
