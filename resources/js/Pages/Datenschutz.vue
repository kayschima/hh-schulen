<script setup>
import {Head} from '@inertiajs/vue3'
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <Head title="Hamburger Schulen- Datenschutz"/>
    <Head content="Tagesaktuelle Daten von Hamburger Schulen" meta="description"/>

    <div class="max-w-7xl mx-auto">
        <header class="bg-slate-900 mx-1 my-4 p-4 text-white rounded-t-lg flex items-center space-x-4">
            <h1 class="text-xl font-bold hover:font-extrabold">
                <a href="/">Hamburger&nbsp;Schulen</a>
            </h1>
        </header>
        <main class="px-4 pb-4 text-xs">
            <h2 class="text-lg font-bold">Datenschutz</h2>
            <p class="mt-4">
                Datenschutz hat einen besonders hohen Stellenwert für den Betreiber. Eine
                Nutzung dieser Internetseiten ist grundsätzlich ohne jede Angabe personenbezogener
                Daten möglich.
            </p>
            <p class="mt-4">
                <span class="underline font-bold">Server-Log-Dateien<br></span>
                Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten
                Server-Log-Dateien, die Ihr Browser automatisch an uns übermittelt. Dies sind:
            </p>
            <ul class="list-disc list-inside">
                <li>Browsertyp und Browserversion</li>
                <li>verwendetes Betriebssystem</li>
                <li>Referrer URL</li>
                <li>Hostname des zugreifenden Rechners</li>
                <li>Uhrzeit der Serveranfrage</li>
                <li>IP-Adresse</li>
            </ul>
            <br>
            <p>
                Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen. Die Erfassung dieser
                Daten erfolgt auf Grundlage von Art. 6 Abs. 1 lit. f DSGVO. Der Websitebetreiber hat ein berechtigtes
                Interesse an der technisch fehlerfreien Darstellung und der Optimierung seiner Website – hierzu müssen
                die Server-Log-Files erfasst werden.
            </p>
        </main>
        <Footer/>
    </div>
</template>

<style scoped>

</style>
