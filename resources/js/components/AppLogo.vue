<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';

const name = usePage().props.name;
</script>

<template>
    <div
        class="flex aspect-square size-9 items-center justify-center rounded-xl bg-gradient-to-br from-red-700 via-red-800 to-amber-700 text-amber-300 shadow-sm border border-amber-400/30"
    >
        <AppLogoIcon class="size-5 text-amber-200" />
    </div>
    <div class="ml-2.5 grid flex-1 text-left text-sm leading-tight">
        <span class="truncate font-bold text-foreground tracking-tight">Sena High School</span>
        <span class="truncate text-[11px] font-semibold text-red-700 dark:text-amber-400">Admin Portal</span>
    </div>
</template>
