<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
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
    <Head title="Schulabfrage">
        <link href="https://rsms.me/" rel="preconnect" />
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" />
    </Head>
    <div class="mx-auto bg-background p-6 text-primary lg:max-w-7xl">
        <header class="m-2 w-full rounded-2xl border border-2 border-primary p-8">
            <nav>
                <div>
                    <h1 class="text-3xl leading-tight font-bold tracking-tighter md:text-4xl lg:leading-[1.1]">Hamburger Schulen</h1>
                    <h2 class="text-lg leading-tight font-bold tracking-tighter md:text-xl lg:leading-[1.1]">
                        Finde Informationen zu Schulen in Hamburg
                    </h2>
                </div>
                <div class="mt-6">
                    <Input v-model="suche" name="search" placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..." type="search" />
                </div>
            </nav>
        </header>
        <main class="m-2 w-full rounded-2xl border border-2 border-primary p-8">
            <Table>
                <TableCaption>Seite {{ schools.current_page }} von {{ schools.last_page }} - insgesamt {{ schools.total }} Datensätze </TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead>Schulnummer</TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Adresse + Ort</TableHead>
                        <TableHead>Schultyp</TableHead>
                        <TableHead>Bezirk</TableHead>
                        <TableHead class="text-right"></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="school in schools.data" :key="school.id">
                        <TableCell>{{ school.schul_id }}</TableCell>
                        <TableCell>{{ school.schulname }}</TableCell>
                        <TableCell>{{ school.adresse_strasse_hausnr }}, {{ school.adresse_ort }}</TableCell>
                        <TableCell>{{ school.kapitelbezeichnung }}</TableCell>
                        <TableCell>{{ school.bezirk }}</TableCell>
                        <TableCell class="text-right">
                            <Button as="a" class="rounded-full" size="sm" variant="outline">...</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </main>
        <footer class="m-2 w-full rounded-2xl border border-2 border-primary p-8"></footer>
    </div>
</template>
