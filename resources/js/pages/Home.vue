<script lang="ts" setup>
import Footer from '@/components/Footer.vue';
import Header from '@/components/Header.vue';
import SchoolDetailDialog from '@/components/SchoolDetailDialog.vue';
import SchoolPagination from '@/components/SchoolPagination.vue';
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
    <div class="mx-auto min-h-screen bg-background p-6 text-primary lg:max-w-7xl">
        <Header />
        <main class="m-2 w-full rounded-2xl border-2 border-primary p-2 lg:p-4">
            <div class="mb-4">
                <Input
                    v-model="suche"
                    autofocus
                    name="search"
                    placeholder="Suche nach Schulnamen, Adressen, Stadtteile, Bezirke, Schulformen, Abschlüssen, Fremdsprachen, usw. (durch Leerzeichen getrennt)"
                    type="search"
                />
            </div>
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
                            <SchoolDetailDialog :schoolDetails="school" />
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

            <SchoolPagination :school-pagination-items="schools" />
        </main>
        <Footer />
    </div>
</template>
