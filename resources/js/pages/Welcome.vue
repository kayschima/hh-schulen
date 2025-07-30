<script lang="ts" setup>
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Schulabfrage">
        <link href="https://rsms.me/" rel="preconnect" />
        <link href="https://rsms.me/inter/inter.css" rel="stylesheet" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] lg:justify-center lg:p-8 dark:bg-[#0a0a0a]">
        <header class="mb-6 w-full max-w-[335px] text-sm not-has-[nav]:hidden lg:max-w-4xl">
            <nav class="flex items-center justify-end gap-4"></nav>
        </header>
        <div class="flex w-full items-center justify-center opacity-100 transition-opacity duration-750 lg:grow starting:opacity-0">
            <main class="flex w-full max-w-[335px] flex-col-reverse overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div>
                    <h1 class="text-3xl leading-tight font-bold tracking-tighter md:text-4xl lg:leading-[1.1]">Hamburger Schulen</h1>
                    <h2 class="text-lg leading-tight font-bold tracking-tighter md:text-xl lg:leading-[1.1]">
                        Finde Informationen zu Schulen in Hamburg
                    </h2>
                </div>
            </main>
        </div>
        <div class="hidden h-14.5 lg:block"></div>
    </div>
</template>
