<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import {
    Award,
    Check,
    Globe,
    HelpCircle,
    Image as ImageIcon,
    Info,
    Layers,
    MapPin,
    Phone,
    Save,
    School,
    Sparkles,
    Upload,
    UserCheck,
    Users,
} from '@lucide/vue';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

const props = defineProps<{
    settings: Record<string, string>;
    imageUrls: Record<string, string>;
    activeTab?: string;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Site & Hero Content', href: '/dashboard/site-settings' },
];

const activeTab = ref(props.activeTab || 'general');

// Previews for file uploads
const crestPreview = ref<string | null>(props.imageUrls.crest_url || null);
const heroPreview = ref<string | null>(props.imageUrls.hero_image || null);
const headmasterPreview = ref<string | null>(props.imageUrls.headmaster_image || null);

const form = useForm({
    // General
    school_name: props.settings.school_name || 'SENA HIGH SCHOOL',
    school_tagline: props.settings.school_tagline || 'Entebbe • Seek knowledge, serve humanity',
    school_motto: props.settings.school_motto || 'Seek knowledge, serve humanity',
    crest_url: props.settings.crest_url || '',
    crest_file: null as File | null,
    announcement_badge: props.settings.announcement_badge || 'Admissions Open',
    announcement_text: props.settings.announcement_text || 'Enrollment ongoing for Senior 1 & Senior 5 — Academic Year 2025',
    campus_location: props.settings.campus_location || 'Entebbe, Uganda',
    uneb_center_no: props.settings.uneb_center_no || 'UNEB Centre No: U2488 / MoES Registered',

    // Contact
    phone_primary: props.settings.phone_primary || '+256 (0) 414 321 000',
    phone_secondary: props.settings.phone_secondary || '+256 (0) 701 445 220',
    email_primary: props.settings.email_primary || 'admissions@senahighentebbe.sc.ug',
    address_full: props.settings.address_full || 'Entebbe Municipality, Off Kampala-Entebbe Highway, Wakiso District, Uganda',

    // Hero Section
    hero_badge: props.settings.hero_badge || 'Excellence in Secondary Education Since 2004',
    hero_title_highlight: props.settings.hero_title_highlight || 'Intellectual Leaders',
    hero_title_prefix: props.settings.hero_title_prefix || 'Nurturing',
    hero_title_suffix: props.settings.hero_title_suffix || '& Moral Integrity in Entebbe',
    hero_paragraph: props.settings.hero_paragraph || 'Embracing our noble motto — "Seek knowledge, serve humanity". Sena High School offers world-class UNEB O-Level & A-Level education, modern STEM laboratories, arts, and vibrant lakeside campus life.',
    hero_image: props.settings.hero_image || '',
    hero_file: null as File | null,
    hero_badge_corner: props.settings.hero_badge_corner || 'Top Academic Performer',
    hero_card_title: props.settings.hero_card_title || 'Center of Scholarly Distinction',
    hero_card_desc: props.settings.hero_card_desc || 'Fully accredited by UNEB & Ministry of Education and Sports.',

    // Stats
    stat1_value: props.settings.stat1_value || '100%',
    stat1_label: props.settings.stat1_label || 'Division 1 & 2 Pass Rate',
    stat2_value: props.settings.stat2_value || '25+',
    stat2_label: props.settings.stat2_label || 'Clubs, Arts & Sports',
    stat3_value: props.settings.stat3_value || '1 : 14',
    stat3_label: props.settings.stat3_label || 'Teacher-Student Ratio',
    stat4_value: props.settings.stat4_value || 'Eco-Campus',
    stat4_label: props.settings.stat4_label || 'Lakeside Environment',

    // Headmaster Welcome
    headmaster_name: props.settings.headmaster_name || 'Mr. K. Ronald Musisi',
    headmaster_title: props.settings.headmaster_title || 'Headteacher & Director of Studies, Sena High School',
    headmaster_experience: props.settings.headmaster_experience || '20+ Years Educational Leadership',
    headmaster_qualifications: props.settings.headmaster_qualifications || 'B.Ed (Hons), M.Ed Educ Admin',
    headmaster_image: props.settings.headmaster_image || '',
    headmaster_file: null as File | null,
    headmaster_section_title: props.settings.headmaster_section_title || 'Building Foundations for Lifelong Knowledge, Leadership & Selfless Service',
    headmaster_quote: props.settings.headmaster_quote || 'At Sena High School Entebbe, our mission transcends academic excellence. We empower young men and women to discover their intellectual identity while grounding their character in empathy, fear of God, and unconditional service to society.',
    headmaster_welcome_text: props.settings.headmaster_welcome_text || 'Nestled along the calm breezes of Entebbe, our campus provides a peaceful sanctuary away from city distractions. Here, students engage with state-of-the-art sciences, rich humanistic arts, and vibrant extracurricular pursuits governed by our guiding compass: Seek knowledge, serve humanity.',
    headmaster_card1_title: props.settings.headmaster_card1_title || 'Academic Rigor',
    headmaster_card1_desc: props.settings.headmaster_card1_desc || 'Uncompromising UNEB syllabus mastery with individual student mentoring.',
    headmaster_card2_title: props.settings.headmaster_card2_title || 'Moral Integrity',
    headmaster_card2_desc: props.settings.headmaster_card2_desc || 'Instilling ethical values, personal discipline, and respect for diversity.',
    headmaster_card3_title: props.settings.headmaster_card3_title || 'Humanity Service',
    headmaster_card3_desc: props.settings.headmaster_card3_desc || 'Active community outreach, environmental stewardship, and civic empathy.',

    // Admissions
    admissions_title: props.settings.admissions_title || 'Start Your Journey at Sena High School',
    admissions_subtitle: props.settings.admissions_subtitle || 'We welcome applications from motivated boys and girls seeking academic excellence, moral grounding, and purposeful leadership.',
    admissions_s1_status: props.settings.admissions_s1_status || 'Ongoing',
    admissions_s5_status: props.settings.admissions_s5_status || 'Forms Available',
    admissions_transfer_status: props.settings.admissions_transfer_status || 'Subject to Interview',
    admissions_bursary_title: props.settings.admissions_bursary_title || 'Bursaries & Academic Merit Scholarships',
    admissions_bursary_desc: props.settings.admissions_bursary_desc || 'Special partial scholarships are awarded to students scoring Aggregate 4 to 6 in PLE and Division 1 (Aggregate 8–18 in UCE).',
    admissions_hotline: props.settings.admissions_hotline || '+256 (0) 701 445 220 / +256 (0) 772 341 890',
});

const onCrestFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.crest_file = file;
        crestPreview.value = URL.createObjectURL(file);
    }
};

const onHeroFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.hero_file = file;
        heroPreview.value = URL.createObjectURL(file);
    }
};

const onHeadmasterFileChange = (e: Event) => {
    const target = e.target as HTMLInputElement;
    if (target.files && target.files[0]) {
        const file = target.files[0];
        form.headmaster_file = file;
        headmasterPreview.value = URL.createObjectURL(file);
    }
};

const submitSettings = () => {
    form.post('/dashboard/site-settings', {
        preserveScroll: true,
    });
};
</script>

<template>

    <Head title="Site & Hero Content Settings" />

    <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
        <!-- Top Action Bar -->
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Site & Hero Content Manager</h1>
                <p class="text-sm text-muted-foreground">Manage branding, hero visuals, headmaster welcome, and contact
                    information.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" :disabled="form.processing"
                    class="inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-2.5 text-xs font-bold text-primary-foreground shadow-md transition-all hover:bg-primary/90 disabled:opacity-50"
                    @click="submitSettings">
                    <Save class="h-4 w-4" />
                    <span>{{ form.processing ? 'Saving...' : 'Save All Changes' }}</span>
                </button>
            </div>
        </div>

        <div v-if="form.recentlySuccessful"
            class="flex items-center gap-2 rounded-xl border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm font-semibold text-emerald-700 dark:text-emerald-400">
            <Check class="h-5 w-5" />
            <span>All content settings and uploaded media have been published successfully!</span>
        </div>

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-2 border-b border-border/60 pb-3">
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold transition-all"
                :class="activeTab === 'general' ? 'bg-primary text-primary-foreground shadow-xs' : 'text-muted-foreground hover:bg-muted'"
                @click="activeTab = 'general'">
                <School class="h-4 w-4" />
                <span>Branding & Header</span>
            </button>
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold transition-all"
                :class="activeTab === 'hero' ? 'bg-primary text-primary-foreground shadow-xs' : 'text-muted-foreground hover:bg-muted'"
                @click="activeTab = 'hero'">
                <Sparkles class="h-4 w-4" />
                <span>Hero Section & Stats</span>
            </button>
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold transition-all"
                :class="activeTab === 'headmaster' ? 'bg-primary text-primary-foreground shadow-xs' : 'text-muted-foreground hover:bg-muted'"
                @click="activeTab = 'headmaster'">
                <Users class="h-4 w-4" />
                <span>Headmaster Welcome</span>
            </button>
            <button type="button"
                class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-xs font-semibold transition-all"
                :class="activeTab === 'contact' ? 'bg-primary text-primary-foreground shadow-xs' : 'text-muted-foreground hover:bg-muted'"
                @click="activeTab = 'contact'">
                <Phone class="h-4 w-4" />
                <span>Contact & Location</span>
            </button>
        </div>

        <!-- TAB 1: BRANDING & GENERAL -->
        <div v-if="activeTab === 'general'" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <!-- School Crest Upload -->
                <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-5">
                    <h3 class="text-base font-bold text-foreground">Official School Crest</h3>
                    <p class="text-xs text-muted-foreground">Displayed on the top header, hero badge, and footer.</p>

                    <div
                        class="mt-5 flex flex-col items-center gap-4 rounded-xl border border-dashed border-border/80 bg-muted/20 p-6 text-center">
                        <div
                            class="relative flex h-28 w-28 items-center justify-center overflow-hidden rounded-xl border border-border/80 bg-white p-2 shadow-md">
                            <img v-if="crestPreview" :src="crestPreview" alt="School Crest"
                                class="h-full w-full object-contain" />
                            <School v-else class="h-12 w-12 text-muted-foreground/40" />
                        </div>

                        <div>
                            <label
                                class="cursor-pointer inline-flex items-center gap-2 rounded-lg bg-secondary px-4 py-2 text-xs font-semibold text-secondary-foreground shadow-xs hover:bg-secondary/80">
                                <Upload class="h-3.5 w-3.5" />
                                <span>Upload New Crest Image</span>
                                <input type="file" accept="image/*" class="hidden" @change="onCrestFileChange" />
                            </label>
                            <p class="mt-1.5 text-[11px] text-muted-foreground">PNG, JPG, WEBP or SVG (Max 10MB)</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-foreground">Or Direct Image URL</label>
                        <input v-model="form.crest_url" type="text" placeholder="https://..."
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>
                </div>

                <!-- School Name & Tagline Form -->
                <div class="space-y-4 rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-7">
                    <h3 class="text-base font-bold text-foreground">General School Identity</h3>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">School Name</label>
                            <input v-model="form.school_name" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Campus Location Label</label>
                            <input v-model="form.campus_location" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">School Motto</label>
                        <input v-model="form.school_motto" type="text"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Header Subtitle Tagline</label>
                        <input v-model="form.school_tagline" type="text"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">UNEB Centre & MoES Accreditation
                            Text</label>
                        <input v-model="form.uneb_center_no" type="text"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div class="border-t border-border/50 pt-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Top Announcement
                            Ticker</h4>
                        <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Badge Text</label>
                                <input v-model="form.announcement_badge" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-semibold text-foreground">Ticker Message</label>
                                <input v-model="form.announcement_text" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: HERO SECTION & STATS -->
        <div v-if="activeTab === 'hero'" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <!-- Hero Main Photo Upload -->
                <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-5">
                    <h3 class="text-base font-bold text-foreground">Hero Showcase Image</h3>
                    <p class="text-xs text-muted-foreground">The primary highlight photo displayed in the hero section.
                    </p>

                    <div
                        class="mt-5 flex flex-col items-center gap-4 rounded-xl border border-dashed border-border/80 bg-muted/20 p-5 text-center">
                        <div
                            class="relative aspect-video w-full overflow-hidden rounded-xl border border-border bg-muted shadow-sm">
                            <img v-if="heroPreview" :src="heroPreview" alt="Hero Preview"
                                class="h-full w-full object-cover" />
                            <ImageIcon v-else class="m-auto h-12 w-12 text-muted-foreground/40" />
                        </div>

                        <div>
                            <label
                                class="cursor-pointer inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-xs font-semibold text-primary-foreground shadow-xs hover:bg-primary/90">
                                <Upload class="h-3.5 w-3.5" />
                                <span>Upload New Hero Photo</span>
                                <input type="file" accept="image/*" class="hidden" @change="onHeroFileChange" />
                            </label>
                            <p class="mt-1.5 text-[11px] text-muted-foreground">High resolution landscape photo (16:9
                                recommended)</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-foreground">Or Direct Image URL</label>
                        <input v-model="form.hero_image" type="text" placeholder="https://..."
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Corner Badge Ribbon</label>
                            <input v-model="form.hero_badge_corner" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Overlay Card Title</label>
                            <input v-model="form.hero_card_title" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                    </div>
                </div>

                <!-- Hero Text Copy -->
                <div class="space-y-4 rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-7">
                    <h3 class="text-base font-bold text-foreground">Hero Headlines & Paragraph</h3>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Top Pill Tag</label>
                        <input v-model="form.hero_badge" type="text"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Headline Prefix</label>
                            <input v-model="form.hero_title_prefix" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Highlighted Word(s)</label>
                            <input v-model="form.hero_title_highlight" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Headline Suffix</label>
                            <input v-model="form.hero_title_suffix" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Hero Subtitle Paragraph</label>
                        <textarea v-model="form.hero_paragraph" rows="3"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                    </div>

                    <!-- 4 Quick Stats -->
                    <div class="border-t border-border/50 pt-4">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">4 Quick Key
                            Statistics</h4>
                        <div class="mt-3 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <div class="rounded-lg border border-border/60 bg-muted/20 p-2.5">
                                <label class="block text-[10px] font-bold text-muted-foreground">Stat 1 Value</label>
                                <input v-model="form.stat1_value" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-bold text-primary" />
                                <label class="mt-1.5 block text-[10px] font-bold text-muted-foreground">Stat 1
                                    Label</label>
                                <input v-model="form.stat1_label" type="text"
                                    class="mt-0.5 w-full rounded border border-border bg-background px-2 py-1 text-[11px]" />
                            </div>

                            <div class="rounded-lg border border-border/60 bg-muted/20 p-2.5">
                                <label class="block text-[10px] font-bold text-muted-foreground">Stat 2 Value</label>
                                <input v-model="form.stat2_value" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-bold text-sky-600" />
                                <label class="mt-1.5 block text-[10px] font-bold text-muted-foreground">Stat 2
                                    Label</label>
                                <input v-model="form.stat2_label" type="text"
                                    class="mt-0.5 w-full rounded border border-border bg-background px-2 py-1 text-[11px]" />
                            </div>

                            <div class="rounded-lg border border-border/60 bg-muted/20 p-2.5">
                                <label class="block text-[10px] font-bold text-muted-foreground">Stat 3 Value</label>
                                <input v-model="form.stat3_value" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-bold text-primary" />
                                <label class="mt-1.5 block text-[10px] font-bold text-muted-foreground">Stat 3
                                    Label</label>
                                <input v-model="form.stat3_label" type="text"
                                    class="mt-0.5 w-full rounded border border-border bg-background px-2 py-1 text-[11px]" />
                            </div>

                            <div class="rounded-lg border border-border/60 bg-muted/20 p-2.5">
                                <label class="block text-[10px] font-bold text-muted-foreground">Stat 4 Value</label>
                                <input v-model="form.stat4_value" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-bold text-sky-600" />
                                <label class="mt-1.5 block text-[10px] font-bold text-muted-foreground">Stat 4
                                    Label</label>
                                <input v-model="form.stat4_label" type="text"
                                    class="mt-0.5 w-full rounded border border-border bg-background px-2 py-1 text-[11px]" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: HEADMASTER WELCOME -->
        <div v-if="activeTab === 'headmaster'" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
                <!-- Headmaster Photo Upload -->
                <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-5">
                    <h3 class="text-base font-bold text-foreground">Headmaster Official Portrait</h3>
                    <p class="text-xs text-muted-foreground">High quality portrait photograph.</p>

                    <div
                        class="mt-5 flex flex-col items-center gap-4 rounded-xl border border-dashed border-border/80 bg-muted/20 p-5 text-center">
                        <div
                            class="relative h-72 w-56 overflow-hidden rounded-xl border border-border bg-muted shadow-md">
                            <img v-if="headmasterPreview" :src="headmasterPreview" alt="Headmaster Portrait"
                                class="h-full w-full object-cover" />
                            <Users v-else class="m-auto h-12 w-12 text-muted-foreground/40" />
                        </div>

                        <div>
                            <label
                                class="cursor-pointer inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-xs font-semibold text-primary-foreground shadow-xs hover:bg-primary/90">
                                <Upload class="h-3.5 w-3.5" />
                                <span>Upload Portrait Photo</span>
                                <input type="file" accept="image/*" class="hidden" @change="onHeadmasterFileChange" />
                            </label>
                            <p class="mt-1.5 text-[11px] text-muted-foreground">PNG, JPG or WEBP (Max 10MB)</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs font-semibold text-foreground">Or Direct Image URL</label>
                        <input v-model="form.headmaster_image" type="text" placeholder="https://..."
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div class="mt-4 space-y-3">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Headmaster Name</label>
                            <input v-model="form.headmaster_name" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Title / Role</label>
                            <input v-model="form.headmaster_title" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Leadership Years</label>
                                <input v-model="form.headmaster_experience" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Academic Credentials</label>
                                <input v-model="form.headmaster_qualifications" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Headmaster Speech & Value Cards -->
                <div class="space-y-4 rounded-2xl border border-border/60 bg-card p-6 shadow-xs lg:col-span-7">
                    <h3 class="text-base font-bold text-foreground">Welcome Speech & Core Pillars</h3>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Section Title</label>
                        <input v-model="form.headmaster_section_title" type="text"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Featured Quote (Blockquote)</label>
                        <textarea v-model="form.headmaster_quote" rows="3"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs italic focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Full Welcome Message</label>
                        <textarea v-model="form.headmaster_welcome_text" rows="3"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                    </div>

                    <!-- 3 Pillars -->
                    <div class="border-t border-border/50 pt-4 space-y-3">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">3 Core
                            Institutional Value Cards</h4>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div class="rounded-lg border border-border/60 bg-muted/20 p-3">
                                <label class="block text-[10px] font-bold text-muted-foreground">Card 1 Title</label>
                                <input v-model="form.headmaster_card1_title" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-semibold" />
                                <label class="mt-2 block text-[10px] font-bold text-muted-foreground">Card 1
                                    Description</label>
                                <textarea v-model="form.headmaster_card1_desc" rows="2"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-[11px]"></textarea>
                            </div>

                            <div class="rounded-lg border border-border/60 bg-muted/20 p-3">
                                <label class="block text-[10px] font-bold text-muted-foreground">Card 2 Title</label>
                                <input v-model="form.headmaster_card2_title" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-semibold" />
                                <label class="mt-2 block text-[10px] font-bold text-muted-foreground">Card 2
                                    Description</label>
                                <textarea v-model="form.headmaster_card2_desc" rows="2"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-[11px]"></textarea>
                            </div>

                            <div class="rounded-lg border border-border/60 bg-muted/20 p-3">
                                <label class="block text-[10px] font-bold text-muted-foreground">Card 3 Title</label>
                                <input v-model="form.headmaster_card3_title" type="text"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-xs font-semibold" />
                                <label class="mt-2 block text-[10px] font-bold text-muted-foreground">Card 3
                                    Description</label>
                                <textarea v-model="form.headmaster_card3_desc" rows="2"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1 text-[11px]"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 4: CONTACT & LOCATION -->
        <div v-if="activeTab === 'contact'" class="space-y-6">
            <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs max-w-4xl">
                <h3 class="text-base font-bold text-foreground">Contact & Physical Campus Location</h3>
                <p class="text-xs text-muted-foreground">Displayed in the header, admissions hotline section, and
                    footer.</p>

                <div class="mt-5 space-y-4">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Primary Telephone</label>
                            <input v-model="form.phone_primary" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Secondary / Admissions
                                Hotline</label>
                            <input v-model="form.phone_secondary" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Official Email Address</label>
                        <input v-model="form.email_primary" type="email"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-foreground">Full Physical Address</label>
                        <textarea v-model="form.address_full" rows="3"
                            class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Save Button -->
        <div class="flex items-center justify-end gap-3 border-t border-border/60 pt-4">
            <button type="button" :disabled="form.processing"
                class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-3 text-xs font-bold text-primary-foreground shadow-md transition-all hover:bg-primary/90 disabled:opacity-50"
                @click="submitSettings">
                <Save class="h-4 w-4" />
                <span>{{ form.processing ? 'Saving...' : 'Save All Changes' }}</span>
            </button>
        </div>
    </div>
</template>
