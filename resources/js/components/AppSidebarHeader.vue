<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ExternalLink } from '@lucide/vue';
import Breadcrumbs from '@/components/Breadcrumbs.vue';
import { SidebarTrigger } from '@/components/ui/sidebar';
import type { BreadcrumbItem } from '@/types';

withDefaults(
    defineProps<{
        breadcrumbs?: BreadcrumbItem[];
    }>(),
    {
        breadcrumbs: () => [],
    },
);
</script>

<template>
    <header
        class="flex h-16 shrink-0 items-center justify-between gap-2 border-b border-border/60 bg-background/80 px-6 backdrop-blur-md transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4"
    >
        <div class="flex items-center gap-2">
            <SidebarTrigger class="-ml-1 text-muted-foreground hover:text-foreground" />
            <template v-if="breadcrumbs && breadcrumbs.length > 0">
                <Breadcrumbs :breadcrumbs="breadcrumbs" />
            </template>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="/"
                target="_blank"
                class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 dark:border-red-900/50 bg-red-50/50 dark:bg-red-950/30 px-3 py-1.5 text-xs font-semibold text-red-800 dark:text-red-300 transition-colors hover:bg-red-100 dark:hover:bg-red-900/50"
            >
                <span>Live Website</span>
                <ExternalLink class="h-3.5 w-3.5" />
            </a>
        </div>
    </header>
</template>
