<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import {
    Pagination,
    PaginationContent,
    PaginationEllipsis,
    PaginationFirst,
    PaginationItem,
    PaginationLast,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
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
    <Head title="Schulabfrage">
        <link href="https://rsms.me/" rel="preconnect" />
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" />
    </Head>
    <div class="mx-auto min-h-screen bg-background p-6 text-primary lg:max-w-7xl">
        <header class="m-2 w-full rounded-2xl border-2 border-primary p-8">
            <nav>
                <div>
                    <h1 class="text-3xl leading-tight font-bold tracking-tighter md:text-4xl lg:leading-[1.1]">Hamburger Schulen</h1>
                    <h2 class="text-lg leading-tight font-bold tracking-tighter md:text-xl lg:leading-[1.1]">
                        Finde Informationen zu Schulen in Hamburg
                    </h2>
                </div>
                <div class="mt-6">
                    <Input
                        v-model="suche"
                        autofocus
                        name="search"
                        placeholder="Suche nach Schulnamen, Adressen, Schulformen, Abschlüssen..."
                        type="search"
                    />
                </div>
            </nav>
        </header>
        <main class="m-2 w-full rounded-2xl border-2 border-primary p-1 lg:p-4">
            <Table>
                <TableCaption class="mb-2 text-xs"
                    >Seite {{ schools.current_page }} von {{ schools.last_page }} - insgesamt {{ schools.total }} Datensätze
                </TableCaption>
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
                    <TableRow v-for="school in schools.data" :key="school.id" class="p-1">
                        <TableCell class="p-1 text-right">
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="rounded-full px-2 py-1" variant="outline">...</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader class="mb-6">
                                        <DialogTitle>{{ school.schulname }}</DialogTitle>
                                    </DialogHeader>

                                    <form>
                                        <div class="grid grid-cols-2 gap-4 text-xs">
                                            <div class="font-bold">Schulnummer:</div>
                                            <div>{{ school.schul_id }}</div>
                                            <div class="font-bold">Schulname:</div>
                                            <div>{{ school.schulname }}</div>
                                            <div class="font-bold">Straße:</div>
                                            <div>{{ school.adresse_strasse_hausnr }}</div>
                                            <div class="font-bold">PLZ + Ort:</div>
                                            <div>{{ school.adresse_ort }}</div>
                                            <div class="font-bold">Telefon:</div>
                                            <div>{{ school.schul_telefonnr }}</div>
                                            <div class="font-bold">Fax:</div>
                                            <div>{{ school.fax }}</div>
                                            <div class="font-bold">Bezirk:</div>
                                            <div>{{ school.bezirk }}</div>
                                            <div class="font-bold">Rechtsform:</div>
                                            <div>{{ school.rechtsform }}</div>
                                            <div class="font-bold">Schultyp:</div>
                                            <div>{{ school.kapitelbezeichnung }}</div>

                                            <div class="font-bold whitespace-pre-wrap">Schulformen:</div>
                                            <div v-html="school.schulform?.split('|').join(',<br>')" />

                                            <div class="font-bold">Ganztagsform:</div>
                                            <div>{{ school.ganztagsform }}</div>

                                            <div class="font-bold whitespace-pre-wrap">Abschlüsse:</div>
                                            <div v-html="school.abschluss?.split('|').join(',<br>')" />
                                        </div>
                                    </form>
                                    <DialogFooter>
                                        <DialogClose as-child>
                                            <Button> Schließen</Button>
                                        </DialogClose>
                                    </DialogFooter>
                                </DialogContent>
                            </Dialog>
                        </TableCell>
                        <TableCell class="p-1 whitespace-pre-wrap">{{ school.schulname }}</TableCell>
                        <TableCell class="p-1">{{ school.schul_id }}</TableCell>
                        <TableCell class="p-1 whitespace-pre-wrap"
                            >{{ school.adresse_strasse_hausnr }},
                            {{ school.adresse_ort }}
                        </TableCell>
                        <TableCell class="p-1">{{ school.kapitelbezeichnung }}</TableCell>
                        <TableCell class="p-1">{{ school.bezirk }}</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
            <Pagination :items-per-page="schools.per_page" :total="schools.total" class="pt-4">
                <PaginationContent>
                    <Link :disabled="schools.current_page === 1" :href="schools.first_page_url" method="get" preserve-state>
                        <PaginationFirst :disabled="schools.current_page === 1" />
                    </Link>

                    <Link :disabled="schools.current_page === 1" :href="schools.prev_page_url ?? ''" method="get" preserve-state>
                        <PaginationPrevious :disabled="schools.current_page === 1" />
                    </Link>

                    <template v-for="(item, index) in schools.links.slice(1, -1)" :key="index">
                        <PaginationItem v-if="item.url" :is-active="item.active" :value="index" class="hidden lg:block">
                            <Link :href="item.url ?? '#'" method="get" preserve-state>
                                {{ item.label }}
                            </Link>
                        </PaginationItem>
                        <PaginationEllipsis v-else-if="item.label === '...'" />
                    </template>

                    <Link :disabled="schools.current_page === schools.last_page" :href="schools.next_page_url ?? ''" method="get" preserve-state>
                        <PaginationNext :disabled="schools.current_page === schools.last_page" />
                    </Link>

                    <Link :disabled="schools.current_page === schools.last_page" :href="schools.last_page_url" method="get" preserve-state>
                        <PaginationLast :disabled="schools.current_page === schools.last_page" />
                    </Link>
                </PaginationContent>
            </Pagination>
        </main>
        <Footer />
    </div>
</template>
