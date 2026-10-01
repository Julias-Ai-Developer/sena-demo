<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { home } from '@/routes';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-gradient-to-br from-red-950/20 via-background to-amber-950/10 p-6 md:p-10"
    >
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-6">
                <div class="flex flex-col items-center gap-3">
                    <Link
                        :href="home()"
                        class="flex flex-col items-center gap-2 font-medium"
                    >
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-red-700 via-red-800 to-amber-700 text-amber-300 shadow-md border border-amber-400/40"
                        >
                            <AppLogoIcon class="size-7 text-amber-200" />
                        </div>
                    </Link>
                    <div class="space-y-1 text-center">
                        <h2 class="text-xs font-bold uppercase tracking-widest text-red-700 dark:text-amber-400">Sena High School</h2>
                        <h1 class="text-xl font-bold tracking-tight text-foreground">{{ title }}</h1>
                        <p class="text-center text-xs text-muted-foreground">
                            {{ description }}
                        </p>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
