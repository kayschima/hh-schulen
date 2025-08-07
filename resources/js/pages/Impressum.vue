<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import { Head, router } from '@inertiajs/vue3';
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
    <Head title="Impressum">
        <link href="https://rsms.me/" rel="preconnect" />
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" />
    </Head>
    <div class="mx-auto min-h-screen bg-background p-6 text-primary lg:max-w-7xl">
        <Header />
        <main class="m-2 w-full rounded-2xl border border-2 border-primary p-2 lg:p-4">
            <h2 class="text-lg font-bold">Impressum</h2>
            <p class="mt-4">
                Angaben gemäß § 5 TMG<br />
                Kay Markschies<br />
                Flottkamp 114<br />
                24568 Kaltenkirchen<br />
                <br />
                E-Mail: kayschima@web.de
            </p>
            <p class="mt-4">
                Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV:<br />
                Kay Markschies<br />
                Flottkamp 114<br />
                24568 Kaltenkirchen<br />
            </p>
            <p class="mt-4">
                <span class="font-bold underline">Haftungsausschluss: <br /></span>
                Haftung für Inhalte<br />
                Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte
                können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach
                den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte
                oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen.
                Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt.
                Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden
                von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
            </p>
            <p class="mt-4">
                <span class="font-bold underline">Haftung für Links<br /></span>

                Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese
                fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber
                der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft.
                Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten
                ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir
                derartige Links umgehend entfernen.
            </p>
            <p class="mt-4">
                <span class="font-bold underline">Urheberrecht<br /></span>

                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die
                Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der
                schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht
                kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte
                Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung
                aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte
                umgehend entfernen.
            </p>
        </main>
        <Footer />
    </div>
</template>
