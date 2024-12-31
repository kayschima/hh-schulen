<script setup>
import ExpandIcon from "@/Components/ExpandIcon.vue";
import {ref} from "vue";

defineProps({
    school: Object
})
const isExpanded = ref(false)
</script>

<template>
    <tr :class="!isExpanded ? 'border-b':''">
        <td class="py-1 px-4">
            <ExpandIcon :isExpanded="isExpanded" @click="isExpanded=!isExpanded"/>
        </td>
        <td class="py-1 px-4" v-text="school.schul_id"/>
        <td class="py-1 px-4" v-text="school.schulname"/>
        <td class="py-1 px-4">
            <span v-text="school.adresse_strasse_hausnr"/>,
            <span v-text="school.adresse_ort"/>
        </td>
        <td class="py-1 px-4" v-text="school.kapitelbezeichnung"/>
        <td class="py-1 px-4" v-text="school.bezirk"/>
    </tr>
    <tr v-if="isExpanded" class="border-b">
        <td></td>
        <td class="py-1 px-4 bg-slate-200 rounded-xl" colspan="5">
            <div class="grid grid-cols-4 gap-4">
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Rechtsform:</p>
                    <p v-text="school.rechtsform"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Schulformen:</p>
                    <p v-html="school.schulform?.split('|').join('<br>')"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Ganztagsform:</p>
                    <p v-text="school.ganztagsform"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Abschlüsse:</p>
                    <p v-html="school.abschluss?.split('|').join('<br>')"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Telefon:</p>
                    <p v-html="school.schul_telefonnr"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Fax:</p>
                    <p v-html="school.fax"/>
                </div>
            </div>
        </td>
    </tr>
</template>

<style scoped>

</style>
