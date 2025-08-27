<script lang="ts" setup>
import SchoolDetailRow from '@/components/SchoolDetailRow.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { ScrollArea } from '@/components/ui/scroll-area';

defineProps({
    schoolDetails: Object,
});
</script>

<template>
    <div>
        <Dialog class="min-w-1/2">
            <DialogTrigger as-child>
                <Button class="rounded-full px-2 py-1" title="Details" variant="outline">...</Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader>
                    <DialogTitle class="mx-4 rounded-lg border px-4 py-2">
                        <h1 class="text-xl font-bold" v-text="schoolDetails.schulname" />

                        <div v-text="schoolDetails.adresse_strasse_hausnr" />
                        <div v-text="schoolDetails.adresse_ort" />
                        <div>Tel.: {{ schoolDetails.schul_telefonnr }}</div>
                    </DialogTitle>
                </DialogHeader>
                <ScrollArea class="h-[400px] w-full p-2 lg:h-[600px]">
                    <div class="grid grid-cols-2 gap-x-2 gap-y-2 text-xs lg:text-sm">
                        <SchoolDetailRow :data="schoolDetails.schul_id" :title="'Schulnummer:'" />
                        <SchoolDetailRow :data="schoolDetails.fax" :title="'Fax:'" />
                        <SchoolDetailRow :data="schoolDetails.stadtteil" :title="'Stadtteil:'" />
                        <SchoolDetailRow :data="schoolDetails.bezirk" :title="'Bezirk:'" />
                        <SchoolDetailRow :data="schoolDetails.rechtsform" :title="'Rechtsform:'" />
                        <SchoolDetailRow :data="schoolDetails.kapitelbezeichnung" :title="'Schultyp:'" />
                        <SchoolDetailRow :data="schoolDetails.schulform?.split('|').join(',<br>')" :title="'Schulformen:'" />
                        <SchoolDetailRow :data="schoolDetails.ganztagsform" :title="'Ganztagsform:'" />
                        <SchoolDetailRow :data="schoolDetails.abschluss?.split('|').join(',<br>')" :title="'Abschlüsse:'" />
                        <SchoolDetailRow :data="schoolDetails.fremdsprache?.split('|').join(',<br>')" :title="'Fremdsprachen:'" />
                        <SchoolDetailRow :data="schoolDetails.sozialindex" :title="'Sozialindex:'" />
                        <SchoolDetailRow :data="schoolDetails.anzahl_schueler" :title="'Anzahl Schüler:'" />
                        <SchoolDetailRow :href="schoolDetails.homepage" :target="'_homepage'" :title="'Homepage:'" />
                        <SchoolDetailRow
                            :href="schoolDetails.schulinspektion_link"
                            :target="'_schulinspektion'"
                            :title="'Bericht Schulinspektion:'"
                        />
                        <SchoolDetailRow
                            :href="'http://maps.google.com/?q=' + schoolDetails.coordinate_2 + '+' + schoolDetails.coordinate_1"
                            :target="'_google_maps'"
                            :title="'Google Maps:'"
                        />
                    </div>
                </ScrollArea>

                <DialogFooter>
                    <DialogClose as-child>
                        <Button> Schließen</Button>
                    </DialogClose>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </div>
</template>

<style scoped></style>
