<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <!-- School Crest: Crimson shield + golden torch + open book -->
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 64 64"
        :class="className"
        v-bind="$attrs"
    >
        <!-- Shield body -->
        <path
            d="M32 3 L56 13 L56 34 C56 48 45 57.5 32 61 C19 57.5 8 48 8 34 L8 13 Z"
            fill="currentColor"
            opacity="0.18"
        />
        <path
            d="M32 3 L56 13 L56 34 C56 48 45 57.5 32 61 C19 57.5 8 48 8 34 L8 13 Z"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linejoin="round"
        />

        <!-- Open book pages -->
        <path d="M17 40 L17 28 Q24.5 24 32 26 Q39.5 24 47 28 L47 40 Q39.5 36 32 38 Q24.5 36 17 40 Z"
              fill="currentColor" opacity="0.55"/>
        <!-- Book spine -->
        <line x1="32" y1="26" x2="32" y2="40" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>

        <!-- Torch handle -->
        <rect x="30" y="30" width="4" height="15" rx="2" fill="currentColor" opacity="0.8"/>

        <!-- Torch cup -->
        <path d="M27 30 Q32 27.5 37 30 L35.5 33.5 Q32 32 28.5 33.5 Z" fill="currentColor" opacity="0.9"/>

        <!-- Flame -->
        <path d="M32 13 C32 13 27 19.5 27 24.5 C27 28 29.5 30 32 30 C34.5 30 37 28 37 24.5 C37 19.5 32 13 32 13 Z"
              fill="currentColor" opacity="0.9"/>
        <!-- Inner flame glow -->
        <path d="M32 17 C32 17 29 22 29 25.5 C29 27.5 30.5 29 32 29 Z"
              fill="white" opacity="0.3"/>
    </svg>
</template>
