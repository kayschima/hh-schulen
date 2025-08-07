<script lang="ts" setup>
import SchoolDetailRow from '@/components/SchoolDetailRow.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogClose, DialogContent, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';

defineProps({
    schoolDetails: Object,
});
</script>

<template>
    <div>
        <Dialog>
            <DialogTrigger as-child>
                <Button class="rounded-full px-2 py-1" title="Details" variant="outline">...</Button>
            </DialogTrigger>
            <DialogContent>
                <DialogHeader class="mb-6">
                    <DialogTitle>{{ schoolDetails.schulname }}</DialogTitle>
                </DialogHeader>

                <form>
                    <div class="grid grid-cols-2 gap-x-2 gap-y-2 text-xs lg:text-sm">
                        <SchoolDetailRow :data="schoolDetails.schulname" :title="'Schulname:'" />
                        <SchoolDetailRow :data="schoolDetails.schul_id" :title="'Schulnummer:'" />
                        <SchoolDetailRow :data="schoolDetails.adresse_strasse_hausnr" :title="'Straße:'" />
                        <SchoolDetailRow :data="schoolDetails.adresse_ort" :title="'PLZ + Ort:'" />
                        <SchoolDetailRow :data="schoolDetails.schul_telefonnr" :title="'Telefon:'" />
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
                </form>
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
