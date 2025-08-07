<script lang="ts" setup>
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
import { Link } from '@inertiajs/vue3';

defineProps({
    schoolPaginationItems: Object,
});
</script>

<template>
    <Pagination :items-per-page="schoolPaginationItems.per_page" :total="schoolPaginationItems.total" class="pt-4">
        <PaginationContent>
            <Link :disabled="schoolPaginationItems.current_page === 1" :href="schoolPaginationItems.first_page_url" method="get" preserve-state>
                <PaginationFirst :disabled="schoolPaginationItems.current_page === 1" />
            </Link>

            <Link :disabled="schoolPaginationItems.current_page === 1" :href="schoolPaginationItems.prev_page_url ?? ''" method="get" preserve-state>
                <PaginationPrevious :disabled="schoolPaginationItems.current_page === 1" />
            </Link>

            <template v-for="(item, index) in schoolPaginationItems.links.slice(1, -1)" :key="index">
                <PaginationItem v-if="item.url" :is-active="item.active" :value="index" class="hidden lg:block">
                    <Link :href="item.url ?? '#'" method="get" preserve-state>
                        {{ item.label }}
                    </Link>
                </PaginationItem>
                <PaginationEllipsis v-else-if="item.label === '...'" />
            </template>

            <Link
                :disabled="schoolPaginationItems.current_page === schoolPaginationItems.last_page"
                :href="schoolPaginationItems.next_page_url ?? ''"
                method="get"
                preserve-state
            >
                <PaginationNext :disabled="schoolPaginationItems.current_page === schoolPaginationItems.last_page" />
            </Link>

            <Link
                :disabled="schoolPaginationItems.current_page === schoolPaginationItems.last_page"
                :href="schoolPaginationItems.last_page_url"
                method="get"
                preserve-state
            >
                <PaginationLast :disabled="schoolPaginationItems.current_page === schoolPaginationItems.last_page" />
            </Link>
        </PaginationContent>
    </Pagination>
</template>

<style scoped></style>
