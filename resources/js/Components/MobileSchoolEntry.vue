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
        <td class="py-1 px-4">
            <p v-html="school.schulname"></p>
            &#8611; {{ school.kapitelbezeichnung }}<br>
            &#8611; {{ school.bezirk }}<br>
        </td>
    </tr>
    <tr v-if="isExpanded" class="border-b">
        <td></td>
        <td class="py-1 px-4 bg-slate-200 rounded-xl" colspan="2">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Rechtsform:</p>
                    <p v-text="school.rechtsform"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Schulformen:</p>
                    <p v-html="school.schulform?.split('|').join(',<br>')"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Ganztagsform:</p>
                    <p v-text="school.ganztagsform"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Abschlüsse:</p>
                    <p v-html="school.abschluss?.split('|').join(',<br>')"/>
                </div>
                <div class="bg-slate-50 p-2 rounded-xl shadow-md shadow-slate-300">
                    <p class="font-bold pr-2 underline">Adresse:</p>
                    <p>
                        {{ school.adresse_strasse_hausnr }}<br>
                        {{ school.adresse_ort }}
                    </p>
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
