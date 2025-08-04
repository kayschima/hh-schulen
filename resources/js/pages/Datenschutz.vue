<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import { Button } from '@/components/ui/button';
import { Head, Link, router } from '@inertiajs/vue3';
import { watchDebounced } from '@vueuse/core';
import { ref } from 'vue';

defineProps({
    schools: Object,
});

const suche = ref('');

watchDebounced(
    suche,
    () => {
        const url = new URL(window.location.href);
        if (suche.value) {
            url.searchParams.append('search', suche.value);
            url.searchParams.set('page', '1');
        } else {
            url.searchParams.delete('search');
            url.searchParams.delete('page');
        }

        router.visit(url.toString(), {
            preserveScroll: true,
            preserveState: true,
        });
    },
    { debounce: 350, maxWait: 5000 },
);
</script>

<template>
    <Head title="Datenschutz">
        <link href="https://rsms.me/" rel="preconnect" />
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" />
    </Head>
    <div class="mx-auto min-h-screen bg-background p-6 text-primary lg:max-w-7xl">
        <header class="m-2 w-full rounded-2xl border border-2 border-primary p-8">
            <nav>
                <div>
                    <h1 class="text-3xl leading-tight font-bold tracking-tighter md:text-4xl lg:leading-[1.1]">Hamburger Schulen</h1>
                    <h2 class="text-lg leading-tight font-bold tracking-tighter md:text-xl lg:leading-[1.1]">
                        Finde Informationen zu Schulen in Hamburg
                    </h2>
                </div>
                <div class="mt-6">
                    <Link href="/">
                        <Button variant="outline">zur Startseite</Button>
                    </Link>
                </div>
            </nav>
        </header>
        <main class="m-2 w-full rounded-2xl border border-2 border-primary p-1 lg:p-4">
            <h2 class="text-lg font-bold">Datenschutz</h2>
            <p class="mt-4">
                Datenschutz hat einen besonders hohen Stellenwert für den Betreiber. Eine Nutzung dieser Internetseiten ist grundsätzlich ohne jede
                Angabe personenbezogener Daten möglich.
            </p>
            <p class="mt-4">
                <span class="font-bold underline">Server-Log-Dateien<br /></span>
                Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien, die Ihr Browser automatisch
                an uns übermittelt. Dies sind:
            </p>
            <ul class="list-inside list-disc">
                <li>Browsertyp und Browserversion</li>
                <li>verwendetes Betriebssystem</li>
                <li>Referrer URL</li>
                <li>Hostname des zugreifenden Rechners</li>
                <li>Uhrzeit der Serveranfrage</li>
                <li>IP-Adresse</li>
            </ul>
            <br />
            <p>
                Eine Zusammenführung dieser Daten mit anderen Datenquellen wird nicht vorgenommen. Die Erfassung dieser Daten erfolgt auf Grundlage
                von Art. 6 Abs. 1 lit. f DSGVO. Der Websitebetreiber hat ein berechtigtes Interesse an der technisch fehlerfreien Darstellung und der
                Optimierung seiner Website – hierzu müssen die Server-Log-Files erfasst werden.
            </p>
        </main>
        <Footer />
    </div>
</template>
