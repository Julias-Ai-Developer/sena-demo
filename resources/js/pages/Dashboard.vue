<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {
    ArrowUpRight,
    BookOpen,
    CheckCircle2,
    Eye,
    Globe,
    GraduationCap,
    Image as ImageIcon,
    Inbox,
    Plus,
    School,
    Settings,
    Users,
} from '@lucide/vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

interface Stats {
    total_programs: number;
    active_programs: number;
    total_photos: number;
    active_photos: number;
    total_requirements: number;
    total_inquiries: number;
    new_inquiries: number;
    contacted_inquiries: number;
}

interface Inquiry {
    id: number;
    student_name: string;
    parent_name: string;
    parent_phone: string;
    parent_email: string;
    class_level: string;
    boarding_status: string;
    status: string;
    created_at: string;
}

interface GalleryItem {
    id: number;
    title: string;
    category_label: string;
    image_url: string;
    is_active: boolean;
}

const props = defineProps<{
    stats: Stats;
    recentInquiries: Inquiry[];
    recentGallery: GalleryItem[];
    settings: Record<string, string>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'CMS Dashboard',
        href: '/dashboard',
    },
];

const formatDate = (dateStr: string) => {
    if (!dateStr) return '';
    const date = new Date(dateStr);
    return date.toLocaleDateString('en-GB', {
        day: 'numeric',
        month: 'short',
        year: 'numeric',
    });
};
</script>

<template>

    <Head title="Sena CMS Dashboard" />

    <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
        <!-- Header Welcome Card -->
        <div
            class="relative overflow-hidden rounded-2xl border border-border/70 bg-gradient-to-r from-red-950 via-neutral-900 to-sky-950 p-6 text-white shadow-xl lg:p-8">
            <div class="relative z-10 flex flex-col justify-between gap-6 md:flex-row md:items-center">
                <div class="space-y-2">
                    <div
                        class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-sky-200 backdrop-blur-md">
                        <School class="h-3.5 w-3.5" />
                        <span>{{ settings.school_name || 'Sena High School' }} Entebbe</span>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                        Website Content Management System
                    </h1>
                    <p class="max-w-2xl text-sm text-neutral-300">
                        Update website copy, upload campus photos, manage curriculum programs, and respond to incoming
                        prospective student admissions inquiries.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <a href="/" target="_blank"
                        class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-xs font-semibold text-neutral-900 shadow-md transition-all duration-150 hover:bg-neutral-100 hover:shadow-lg">
                        <Globe class="h-4 w-4 text-sky-600" />
                        <span>Open Live Website</span>
                        <ArrowUpRight class="h-3.5 w-3.5 opacity-60" />
                    </a>
                    <Link href="/dashboard/site-settings"
                        class="inline-flex items-center gap-2 rounded-xl bg-white/10 px-4 py-2.5 text-xs font-semibold text-white backdrop-blur-md transition-all duration-150 hover:bg-white/20">
                        <Settings class="h-4 w-4" />
                        <span>Edit Site Info</span>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <Link href="/dashboard/inquiries"
                class="group relative overflow-hidden rounded-xl border border-border/60 bg-card p-5 shadow-xs transition-all hover:border-primary hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Admissions
                        Inquiries</span>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-sky-500/10 text-sky-600 dark:bg-sky-500/20 dark:text-sky-400">
                        <Inbox class="h-5 w-5" />
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-foreground">{{ stats.total_inquiries }}</span>
                    <span v-if="stats.new_inquiries > 0"
                        class="rounded-full bg-amber-500/15 px-2 py-0.5 text-xs font-bold text-amber-700 dark:text-amber-400">
                        {{ stats.new_inquiries }} new
                    </span>
                </div>
                <p class="mt-1 text-xs text-muted-foreground">Prospective student applications</p>
            </Link>

            <Link href="/dashboard/programs"
                class="group relative overflow-hidden rounded-xl border border-border/60 bg-card p-5 shadow-xs transition-all hover:border-primary hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Academic
                        Programs</span>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                        <GraduationCap class="h-5 w-5" />
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-foreground">{{ stats.total_programs }}</span>
                    <span class="text-xs text-muted-foreground">active syllabi</span>
                </div>
                <p class="mt-1 text-xs text-muted-foreground">UCE O-Level & UACE A-Level</p>
            </Link>

            <Link href="/dashboard/gallery"
                class="group relative overflow-hidden rounded-xl border border-border/60 bg-card p-5 shadow-xs transition-all hover:border-primary hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Campus Gallery
                        Media</span>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-400">
                        <ImageIcon class="h-5 w-5" />
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-foreground">{{ stats.total_photos }}</span>
                    <span class="text-xs text-muted-foreground">photos published</span>
                </div>
                <p class="mt-1 text-xs text-muted-foreground">Labs, Sports, Arts & Grounds</p>
            </Link>

            <Link href="/dashboard/admissions"
                class="group relative overflow-hidden rounded-xl border border-border/60 bg-card p-5 shadow-xs transition-all hover:border-primary hover:shadow-md">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-wider text-muted-foreground">Admissions
                        Requirements</span>
                    <div
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-purple-500/10 text-purple-600 dark:bg-purple-500/20 dark:text-purple-400">
                        <BookOpen class="h-5 w-5" />
                    </div>
                </div>
                <div class="mt-3 flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-foreground">{{ stats.total_requirements }}</span>
                    <span class="text-xs text-muted-foreground">listed criteria</span>
                </div>
                <p class="mt-1 text-xs text-muted-foreground">Entry guidelines & bursaries</p>
            </Link>
        </div>

        <!-- Quick Action Shortcuts -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <Link href="/dashboard/site-settings?tab=general"
                class="flex items-center gap-3 rounded-xl border border-border/50 bg-card p-4 transition-all hover:border-primary/60 hover:bg-muted/30">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-red-600/10 text-red-600 dark:bg-red-500/20 dark:text-red-400">
                    <School class="h-5 w-5" />
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-foreground">Update Crest & Tagline</h4>
                    <p class="text-xs text-muted-foreground">School motto, crest badge & contact</p>
                </div>
            </Link>

            <Link href="/dashboard/site-settings?tab=hero"
                class="flex items-center gap-3 rounded-xl border border-border/50 bg-card p-4 transition-all hover:border-primary/60 hover:bg-muted/30">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-sky-600/10 text-sky-600 dark:bg-sky-500/20 dark:text-sky-400">
                    <Globe class="h-5 w-5" />
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-foreground">Hero Banner & Stats</h4>
                    <p class="text-xs text-muted-foreground">Headline, main photo & 4 pass stats</p>
                </div>
            </Link>

            <Link href="/dashboard/site-settings?tab=headmaster"
                class="flex items-center gap-3 rounded-xl border border-border/50 bg-card p-4 transition-all hover:border-primary/60 hover:bg-muted/30">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-600/10 text-amber-600 dark:bg-amber-500/20 dark:text-amber-400">
                    <Users class="h-5 w-5" />
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-foreground">Headmaster Desk</h4>
                    <p class="text-xs text-muted-foreground">Portrait photo, speech & values</p>
                </div>
            </Link>

            <Link href="/dashboard/gallery"
                class="flex items-center gap-3 rounded-xl border border-border/50 bg-card p-4 transition-all hover:border-primary/60 hover:bg-muted/30">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-600/10 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-400">
                    <Plus class="h-5 w-5" />
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-foreground">Upload New Photo</h4>
                    <p class="text-xs text-muted-foreground">Add lab, sports, or campus media</p>
                </div>
            </Link>
        </div>

        <!-- Two Column Layout: Recent Inquiries & Recent Gallery -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <!-- Recent Inquiries -->
            <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-7">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-foreground">Recent Admission Inquiries</h3>
                        <p class="text-xs text-muted-foreground">Submitted via public website application form</p>
                    </div>
                    <Link href="/dashboard/inquiries" class="text-xs font-semibold text-primary hover:underline">
                        View All ({{ stats.total_inquiries }}) →
                    </Link>
                </div>

                <div v-if="recentInquiries.length > 0" class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="border-b border-border/60 text-muted-foreground">
                            <tr>
                                <th class="pb-2 font-medium">Student Name</th>
                                <th class="pb-2 font-medium">Parent Contact</th>
                                <th class="pb-2 font-medium">Level</th>
                                <th class="pb-2 font-medium">Status</th>
                                <th class="pb-2 font-medium">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border/40">
                            <tr v-for="inquiry in recentInquiries" :key="inquiry.id"
                                class="transition-colors hover:bg-muted/30">
                                <td class="py-3 font-semibold text-foreground">
                                    {{ inquiry.student_name }}
                                    <span class="block text-[10px] font-normal text-muted-foreground">{{
                                        inquiry.boarding_status }}</span>
                                </td>
                                <td class="py-3">
                                    <div>{{ inquiry.parent_name }}</div>
                                    <div class="text-[10px] text-muted-foreground">{{ inquiry.parent_phone }}</div>
                                </td>
                                <td class="py-3 font-medium text-foreground">
                                    {{ inquiry.class_level }}
                                </td>
                                <td class="py-3">
                                    <span v-if="inquiry.status === 'new'"
                                        class="rounded-full bg-amber-500/15 px-2 py-0.5 text-[10px] font-bold text-amber-700 dark:text-amber-400">
                                        New
                                    </span>
                                    <span v-else-if="inquiry.status === 'contacted'"
                                        class="rounded-full bg-sky-500/15 px-2 py-0.5 text-[10px] font-bold text-sky-700 dark:text-sky-400">
                                        Contacted
                                    </span>
                                    <span v-else-if="inquiry.status === 'enrolled'"
                                        class="rounded-full bg-emerald-500/15 px-2 py-0.5 text-[10px] font-bold text-emerald-700 dark:text-emerald-400">
                                        Enrolled
                                    </span>
                                    <span v-else
                                        class="rounded-full bg-neutral-500/15 px-2 py-0.5 text-[10px] font-bold text-neutral-600 dark:text-neutral-400">
                                        Closed
                                    </span>
                                </td>
                                <td class="py-3 text-muted-foreground">
                                    {{ formatDate(inquiry.created_at) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div v-else class="flex flex-col items-center justify-center py-10 text-center">
                    <Inbox class="h-10 w-10 text-muted-foreground/40" />
                    <p class="mt-2 text-sm font-medium text-foreground">No inquiries yet</p>
                    <p class="text-xs text-muted-foreground">Inquiries submitted on the website will appear here in
                        real-time.</p>
                </div>
            </div>

            <!-- Recent Gallery Preview -->
            <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-5">
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-foreground">Campus Gallery Preview</h3>
                        <p class="text-xs text-muted-foreground">Latest media published on the website</p>
                    </div>
                    <Link href="/dashboard/gallery" class="text-xs font-semibold text-primary hover:underline">
                        Manage Gallery →
                    </Link>
                </div>

                <div v-if="recentGallery.length > 0" class="grid grid-cols-2 gap-3">
                    <div v-for="photo in recentGallery" :key="photo.id"
                        class="group relative aspect-video overflow-hidden rounded-lg border border-border/60 bg-muted">
                        <img :src="photo.image_url" :alt="photo.title"
                            class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent p-2.5 flex flex-col justify-end text-white">
                            <span class="text-[9px] font-bold uppercase tracking-wider text-sky-300">{{
                                photo.category_label }}</span>
                            <p class="line-clamp-1 text-xs font-semibold">{{ photo.title }}</p>
                        </div>
                    </div>
                </div>
                <div v-else class="flex flex-col items-center justify-center py-10 text-center">
                    <ImageIcon class="h-10 w-10 text-muted-foreground/40" />
                    <p class="mt-2 text-sm font-medium text-foreground">No photos uploaded</p>
                    <Link href="/dashboard/gallery" class="mt-2 text-xs font-semibold text-primary underline">
                        Upload your first photo
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
