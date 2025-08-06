<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import SchoolDetailRow from '@/components/SchoolDetailRow.vue';
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
                        placeholder="Suche nach Schulnamen, Adressen, Stadtteile, Bezirke, Schulformen, Abschlüssen, Fremdsprachen..."
                        type="search"
                    />
                </div>
            </nav>
        </header>
        <main class="m-2 w-full rounded-2xl border-2 border-primary p-1 lg:p-4">
            <Table>
                <TableCaption class="mb-2 text-xs lg:mb-0"
                    >Seite {{ schools.current_page }} von {{ schools.last_page }} - insgesamt {{ schools.total }} Datensätze
                </TableCaption>
                <TableHeader>
                    <TableRow>
                        <TableHead></TableHead>
                        <TableHead>Name</TableHead>
                        <TableHead>Adresse + Ort</TableHead>
                        <TableHead>Schultyp</TableHead>
                        <TableHead>Stadtteil<br />(Bezirk)</TableHead>
                        <TableHead>Homepage</TableHead>
                        <TableHead>Sozialindex</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody class="text-xs lg:text-sm">
                    <TableRow v-for="school in schools.data" :key="school.id" class="p-1">
                        <TableCell class="px-1 py-1 text-right lg:px-2">
                            <Dialog>
                                <DialogTrigger as-child>
                                    <Button class="rounded-full px-2 py-1" variant="outline">...</Button>
                                </DialogTrigger>
                                <DialogContent>
                                    <DialogHeader class="mb-6">
                                        <DialogTitle>{{ school.schulname }}</DialogTitle>
                                    </DialogHeader>

                                    <form>
                                        <div class="grid grid-cols-2 gap-x-2 gap-y-2 text-xs lg:text-sm">
                                            <SchoolDetailRow :data="school.schulname" :title="'Schulname:'" />
                                            <SchoolDetailRow :data="school.schul_id" :title="'Schulnummer:'" />
                                            <SchoolDetailRow :data="school.adresse_strasse_hausnr" :title="'Straße:'" />
                                            <SchoolDetailRow :data="school.adresse_ort" :title="'PLZ + Ort:'" />
                                            <SchoolDetailRow :data="school.schul_telefonnr" :title="'Telefon:'" />
                                            <SchoolDetailRow :data="school.fax" :title="'Fax:'" />
                                            <SchoolDetailRow :data="school.stadtteil" :title="'Stadtteil:'" />
                                            <SchoolDetailRow :data="school.bezirk" :title="'Bezirk:'" />
                                            <SchoolDetailRow :data="school.rechtsform" :title="'Rechtsform:'" />
                                            <SchoolDetailRow :data="school.kapitelbezeichnung" :title="'Schultyp:'" />
                                            <SchoolDetailRow :data="school.schulform?.split('|').join(',<br>')" :title="'Schulformen:'" />
                                            <SchoolDetailRow :data="school.ganztagsform" :title="'Ganztagsform:'" />
                                            <SchoolDetailRow :data="school.abschluss?.split('|').join(',<br>')" :title="'Abschlüsse:'" />
                                            <SchoolDetailRow :data="school.fremdsprache?.split('|').join(',<br>')" :title="'Fremdsprachen:'" />
                                            <SchoolDetailRow :data="school.sozialindex" :title="'Sozialindex:'" />
                                            <SchoolDetailRow :data="school.anzahl_schueler" :title="'Anzahl Schüler:'" />
                                            <SchoolDetailRow :href="school.homepage" :target="'_homepage'" :title="'Homepage:'" />
                                            <SchoolDetailRow
                                                :href="school.schulinspektion_link"
                                                :target="'_schulinspektion'"
                                                :title="'Bericht Schulinspektion:'"
                                            />
                                            <SchoolDetailRow
                                                :href="'http://maps.google.com/?q=' + school.coordinate_2 + '+' + school.coordinate_1"
                                                :target="'_google_maps'"
                                                :title="'Google Maps:'"
                                            />
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
                        <TableCell class="px-1 py-1 whitespace-pre-wrap lg:px-2">{{ school.schulname }}</TableCell>
                        <TableCell class="px-1 py-1 whitespace-pre-wrap lg:px-2"
                            >{{ school.adresse_strasse_hausnr }},
                            {{ school.adresse_ort }}
                        </TableCell>
                        <TableCell class="px-1 py-1 lg:px-2">{{ school.kapitelbezeichnung }}</TableCell>
                        <TableCell class="px-1 py-1 lg:px-2">{{ school.stadtteil }}<br />({{ school.bezirk }})</TableCell>
                        <TableCell class="px-1 py-1 lg:px-2">
                            <Button :disabled="!school.homepage" class="px-2 py-1 text-xs" variant="outline">
                                <a :href="school.homepage" target="_homepage"> Link </a>
                            </Button>
                        </TableCell>
                        <TableCell class="px-1 py-1 lg:px-2">{{ school.sozialindex }}</TableCell>
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
