<script lang="ts" setup>
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
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
                    <Input v-model="suche" name="search" placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..." type="search" />
                </div>
            </nav>
        </header>
        <main class="m-2 w-full rounded-2xl border border-2 border-primary p-8">
            <Table>
                <TableCaption>Seite {{ schools.current_page }} von {{ schools.last_page }} - insgesamt {{ schools.total }} Datensätze </TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead></TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Schulnummer</TableHead>
                        <TableHead>Adresse + Ort</TableHead>
                        <TableHead>Schultyp</TableHead>
                        <TableHead>Bezirk</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="school in schools.data" :key="school.id">
                        <TableCell class="text-right">
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="rounded-full" variant="outline">...</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <form>
                                        <DialogHeader class="mb-6">
                                            <DialogTitle>{{ school.schulname }}</DialogTitle>
                                        </DialogHeader>

                                        <Table class="mb-6">
                                            <TableBody>
                                                <TableRow>
                                                    <TableCell class="font-bold">Schulnummer:</TableCell>
                                                    <TableCell>{{ school.schul_id }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Schulname:</TableCell>
                                                    <TableCell>{{ school.schulname }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Straße:</TableCell>
                                                    <TableCell>{{ school.adresse_strasse_hausnr }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">PLZ + Ort:</TableCell>
                                                    <TableCell>{{ school.adresse_ort }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Telefon:</TableCell>
                                                    <TableCell>{{ school.schul_telefonnr }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Fax:</TableCell>
                                                    <TableCell>{{ school.fax }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Bezirk:</TableCell>
                                                    <TableCell>{{ school.bezirk }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Rechtsform:</TableCell>
                                                    <TableCell>{{ school.rechtsform }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Schultyp:</TableCell>
                                                    <TableCell>{{ school.kapitelbezeichnung }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Schulformen:</TableCell>
                                                    <TableCell v-html="school.schulform?.split('|').join(',<br>')" />
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Ganztagsform:</TableCell>
                                                    <TableCell>{{ school.ganztagsform }}</TableCell>
                                                </TableRow>
                                                <TableRow>
                                                    <TableCell class="font-bold">Abschlüsse:</TableCell>
                                                    <TableCell v-html="school.abschluss?.split('|').join(',<br>')" />
                                                </TableRow>
                                            </TableBody>
                                        </Table>

                                        <DialogFooter>
                                            <DialogClose as-child>
                                                <Button> Schließen</Button>
                                            </DialogClose>
                                        </DialogFooter>
                                    </form>
                                </DialogContent>
                            </Dialog>
                        </TableCell>
                        <TableCell>{{ school.schulname }}</TableCell>
                        <TableCell>{{ school.schul_id }}</TableCell>
                        <TableCell>{{ school.adresse_strasse_hausnr }}, {{ school.adresse_ort }}</TableCell>
                        <TableCell>{{ school.kapitelbezeichnung }}</TableCell>
                        <TableCell>{{ school.bezirk }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </main>
        <footer class="m-2 w-full rounded-2xl border border-2 border-primary p-8"></footer>
    </div>
</template>
