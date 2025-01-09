<script setup>
import {Head, Link, router} from '@inertiajs/vue3'
import {ref} from "vue";
import {watchDebounced} from "@vueuse/core";
import SchoolEntry from "@/Components/SchoolEntry.vue";
import MobileSchoolEntry from "@/Components/MobileSchoolEntry.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    schools: Object
})

const suche = ref('')

watchDebounced(suche, () => {
    let url = new URL(window.location.href)
    if (suche.value) {
        url.searchParams.append('search', suche.value)
        url.searchParams.set('page', 1)
    } else {
        url.searchParams.delete('search')
        url.searchParams.delete('page')
    }

    router.visit(url.toString(), {
            preserveScroll: true,
            preserveState: true
        }
    )
}, {debounce: 350, maxWait: 5000})

</script>

<template>
    <Head title="Hamburger Schulen - Home"/>
    <Head content="Tagesaktuelle Daten von Hamburger Schulen" meta="description"/>

    <div class="max-w-7xl mx-auto">
        <header class="bg-slate-900 mx-1 my-4 p-4 text-white rounded-t-lg flex items-center space-x-4">
            <h1 class="text-xl font-bold hover:font-extrabold">
                <a href="/">Hamburger&nbsp;Schulen </a>
            </h1>
            <input v-model="suche" class="p-2 text-sm w-full rounded border border-gray-300 text-slate-950"
                   name="search"
                   placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..." type="search">
        </header>
        <main class="px-4 text-xs">
            <div class="mt-2 flex justify-center">
                <Link v-for="link in schools.links"
                      :class="['text-xs px-1 md:px-3 py-1 border', { 'text-slate-500': !link.url, 'font-bold bg-slate-500 text-white': link.active }]"
                      :href="link.url??'#'"
                      v-html="link.label"/>
            </div>
            <!--            Desktop view-->
            <table class="hidden md:block mt-2 bg-white">
                <thead>
                <tr class="text-left">
                    <th class="py-2 px-4 border-b w-1/12"></th>
                    <th class="py-2 px-4 border-b w-1/12">Schulnr.</th>
                    <th class="py-2 px-4 border-b w-2/12">Name</th>
                    <th class="py-2 px-4 border-b w-4/12">Adresse + Ort</th>
                    <th class="py-2 px-4 border-b w-2/12">Schultyp</th>
                    <th class="py-2 px-4 border-b w-2/12">Bezirk</th>
                </tr>
                </thead>
                <tbody>
                <SchoolEntry v-for="school in schools.data" :school="school"/>
                </tbody>
            </table>

            <!--                        Mobile view-->
            <table class="md:hidden w-full mt-2 bg-white">
                <thead>
                <tr class="text-left">
                    <th class="py-2 px-4 border-b"></th>
                    <th class="py-2 px-4 border-b">Schulnr.</th>
                    <th class="py-2 px-4 border-b">Schule</th>
                </tr>
                </thead>
                <tbody>
                <MobileSchoolEntry v-for="school in schools.data" :school="school"/>
                </tbody>
            </table>
            <div>
                <p class="my-2 font-bold text-center text-slate-500">
                    Zeige {{ schools.from }} bis {{ schools.to }} von {{ schools.total }} Schulen
                </p>
            </div>

        </main>
        <Footer/>
    </div>
</template>

<style scoped>

</style>
