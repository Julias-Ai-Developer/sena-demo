<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed, onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { login } from '@/routes';

interface GalleryPhoto {
    id?: number;
    title: string;
    category: string;
    category_label?: string;
    categoryLabel?: string;
    description: string;
    image_path?: string;
    image_url?: string;
    image?: string;
    alt?: string;
    alt_text?: string;
    span_class?: string;
    spanClass?: string;
}

interface Program {
    id?: number;
    tag: string;
    title: string;
    description: string;
    features: string[];
    link_label?: string;
    linkLabel?: string;
    link_url?: string;
    linkUrl?: string;
    icon?: string;
    accent_bar?: string;
    accentBar?: string;
    icon_bg?: string;
    iconBg?: string;
    icon_color?: string;
    iconColor?: string;
    label_color?: string;
    labelColor?: string;
    link_color?: string;
    linkColor?: string;
}

const props = withDefaults(
    defineProps<{
        settings?: Record<string, string>;
        programs?: Program[];
        gallery?: GalleryPhoto[];
        admissionRequirements?: string[];
    }>(),
    {
        settings: () => ({}),
        programs: () => [],
        gallery: () => [],
        admissionRequirements: () => [],
    },
);

const defaultCrestUrl =
    'https://lh3.googleusercontent.com/aida-public/AB6AXuDGUnAR6QXR0-zZ44q-gmCSmncd26DxTatrmrUhWWrq1fr9qMKOg-7PIYhuDLSP1qQLg8peh_ckDnkFk3m4_xFpKTtKJo9p7GfhK2YcUxJvy4B3tVWEdfWfg5EFAjQ9JRTGYmapGfQzcUKSZmS88tghDRecTdbSmiax1y_LDITLuTn6RnFxXXzjNwztuwA2ZQLBxsUAoLFBzh36FTo3ypWxHzx_o5cSxekbau5p742pK_dJvfc0RDuZaw38prmZGiKGTw';
const defaultHeadmasterUrl =
    'https://lh3.googleusercontent.com/aida-public/AB6AXuD8mlabocA3NzF5sKDOxsB0skzQp2tWulni4XRit9p0PmPwL-BvvIIOkSzSkbQ4SbkuoD4W2yxIHZZZfL4wOSNob-8JZ5qlQHREP1_RkKgACSDn2-FDLjPww05lSEnPAQf9E_xLyWP57vCNWJ48V8Bi7nPh3MY7rpxJKkOTxcjXgb26cs9hN_KJezlF_D_hYYy96DwXsho4dJYk_nbzv12xMGVSwfnbFRrrkofnJEBlDMAWdKNbnD25';
const defaultHeroUrl =
    'https://lh3.googleusercontent.com/aida-public/AB6AXuBTBymSuR9XvA4AH1OVOVuQ66YTadBK-4iA4Q7mviYIPyu4N-yyr16oakW9Uquhpt-UOapFWlfNsf7PD0M3AA1A0yUqPr7OCUl9sol84x0z4MT8Z2xa6MKRLMwA2EJBoHbyK88Vb2yAF7Va4diO1MVUYaOqWtlQidEOqC0L4f2K9ShuyRgcHqwKoCEQysNQh52hK7nApHWna7I2VfLpg6Koz-VCoxI9HmYXC-SBF5vFzl3rLRMBZdq-';

// Computed dynamic settings with robust fallbacks
const crestUrl = computed(() => props.settings.crest_url || defaultCrestUrl);
const heroUrl = computed(() => props.settings.hero_image || defaultHeroUrl);
const headmasterUrl = computed(() => props.settings.headmaster_image || defaultHeadmasterUrl);

const schoolName = computed(() => props.settings.school_name || 'SENA HIGH SCHOOL');
const schoolTagline = computed(() => props.settings.school_tagline || 'Entebbe • Seek knowledge, serve humanity');
const schoolMotto = computed(() => props.settings.school_motto || 'Seek knowledge, serve humanity');
const announcementBadge = computed(() => props.settings.announcement_badge || 'Admissions Open');
const announcementText = computed(() => props.settings.announcement_text || 'Enrollment ongoing for Senior 1 & Senior 5 — Academic Year 2025');
const campusLocation = computed(() => props.settings.campus_location || 'Entebbe, Uganda');
const phonePrimary = computed(() => props.settings.phone_primary || '+256 (0) 414 321 000');
const phoneSecondary = computed(() => props.settings.phone_secondary || '+256 (0) 701 445 220');
const emailPrimary = computed(() => props.settings.email_primary || 'admissions@senahighentebbe.sc.ug');
const addressFull = computed(() => props.settings.address_full || 'Entebbe Municipality, Off Kampala-Entebbe Highway, Wakiso District, Uganda');
const unebCenterNo = computed(() => props.settings.uneb_center_no || 'UNEB Centre No: U2488 / MoES Registered');

// Hero Content
const heroBadge = computed(() => props.settings.hero_badge || 'Excellence in Secondary Education Since 2004');
const heroTitlePrefix = computed(() => props.settings.hero_title_prefix || 'Nurturing');
const heroTitleHighlight = computed(() => props.settings.hero_title_highlight || 'Intellectual Leaders');
const heroTitleSuffix = computed(() => props.settings.hero_title_suffix || '& Moral Integrity in Entebbe');
const heroParagraph = computed(() => props.settings.hero_paragraph || 'Embracing our noble motto — "Seek knowledge, serve humanity". Sena High School offers world-class UNEB O-Level & A-Level education, modern STEM laboratories, arts, and vibrant lakeside campus life.');
const heroBadgeCorner = computed(() => props.settings.hero_badge_corner || 'Top Academic Performer');
const heroCardTitle = computed(() => props.settings.hero_card_title || 'Center of Scholarly Distinction');
const heroCardDesc = computed(() => props.settings.hero_card_desc || 'Fully accredited by UNEB & Ministry of Education and Sports.');

// Stats
const stat1Value = computed(() => props.settings.stat1_value || '100%');
const stat1Label = computed(() => props.settings.stat1_label || 'Division 1 & 2 Pass Rate');
const stat2Value = computed(() => props.settings.stat2_value || '25+');
const stat2Label = computed(() => props.settings.stat2_label || 'Clubs, Arts & Sports');
const stat3Value = computed(() => props.settings.stat3_value || '1 : 14');
const stat3Label = computed(() => props.settings.stat3_label || 'Teacher-Student Ratio');
const stat4Value = computed(() => props.settings.stat4_value || 'Eco-Campus');
const stat4Label = computed(() => props.settings.stat4_label || 'Lakeside Environment');

// Headmaster
const headmasterName = computed(() => props.settings.headmaster_name || 'Mr. K. Ronald Musisi');
const headmasterTitle = computed(() => props.settings.headmaster_title || 'Headteacher & Director of Studies, Sena High School');
const headmasterExperience = computed(() => props.settings.headmaster_experience || '20+ Years Educational Leadership');
const headmasterQualifications = computed(() => props.settings.headmaster_qualifications || 'B.Ed (Hons), M.Ed Educ Admin');
const headmasterSectionTitle = computed(() => props.settings.headmaster_section_title || 'Building Foundations for Lifelong Knowledge, Leadership & Selfless Service');
const headmasterQuote = computed(() => props.settings.headmaster_quote || 'At Sena High School Entebbe, our mission transcends academic excellence. We empower young men and women to discover their intellectual identity while grounding their character in empathy, fear of God, and unconditional service to society.');
const headmasterWelcomeText = computed(() => props.settings.headmaster_welcome_text || 'Nestled along the calm breezes of Entebbe, our campus provides a peaceful sanctuary away from city distractions. Here, students engage with state-of-the-art sciences, rich humanistic arts, and vibrant extracurricular pursuits governed by our guiding compass: Seek knowledge, serve humanity.');
const headmasterCard1Title = computed(() => props.settings.headmaster_card1_title || 'Academic Rigor');
const headmasterCard1Desc = computed(() => props.settings.headmaster_card1_desc || 'Uncompromising UNEB syllabus mastery with individual student mentoring.');
const headmasterCard2Title = computed(() => props.settings.headmaster_card2_title || 'Moral Integrity');
const headmasterCard2Desc = computed(() => props.settings.headmaster_card2_desc || 'Instilling ethical values, personal discipline, and respect for diversity.');
const headmasterCard3Title = computed(() => props.settings.headmaster_card3_title || 'Humanity Service');
const headmasterCard3Desc = computed(() => props.settings.headmaster_card3_desc || 'Active community outreach, environmental stewardship, and civic empathy.');

// Admissions
const admissionsTitle = computed(() => props.settings.admissions_title || 'Start Your Journey at Sena High School');
const admissionsSubtitle = computed(() => props.settings.admissions_subtitle || 'We welcome applications from motivated boys and girls seeking academic excellence, moral grounding, and purposeful leadership.');
const admissionsS1Status = computed(() => props.settings.admissions_s1_status || 'Ongoing');
const admissionsS5Status = computed(() => props.settings.admissions_s5_status || 'Forms Available');
const admissionsTransferStatus = computed(() => props.settings.admissions_transfer_status || 'Subject to Interview');
const admissionsBursaryTitle = computed(() => props.settings.admissions_bursary_title || 'Bursaries & Academic Merit Scholarships');
const admissionsBursaryDesc = computed(() => props.settings.admissions_bursary_desc || 'Special partial scholarships are awarded to students scoring Aggregate 4 to 6 in PLE and Division 1 (Aggregate 8–18 in UCE).');
const admissionsHotline = computed(() => props.settings.admissions_hotline || '+256 (0) 701 445 220 / +256 (0) 772 341 890');

const navLinks = [
    { label: 'About', href: '#about' },
    { label: 'Academics', href: '#academics' },
    { label: 'Campus & Facilities', href: '#campus-gallery' },
    { label: 'Admissions', href: '#admissions' },
    { label: 'Contact', href: '#contact' },
];

const filters = [
    { label: 'All Highlights', value: 'all' },
    { label: 'Academics', value: 'academics' },
    { label: 'Sports & Games', value: 'sports' },
    { label: 'Arts & Culture', value: 'arts' },
    { label: 'Campus Grounds', value: 'campus' },
];

// Dynamic programs list with fallback
const displayedPrograms = computed(() => {
    if (props.programs && props.programs.length > 0) {
        return props.programs.map((p) => ({
            tag: p.tag,
            title: p.title,
            description: p.description,
            features: p.features || [],
            linkLabel: p.link_label || p.linkLabel || 'View Subject Combinations',
            linkUrl: p.link_url || p.linkUrl || '#admissions',
            icon: p.icon || 'auto_stories',
            accentBar: p.accent_bar || p.accentBar || 'bg-primary',
            iconBg: p.icon_bg || p.iconBg || 'bg-primary-fixed',
            iconColor: p.icon_color || p.iconColor || 'text-primary',
            labelColor: p.label_color || p.labelColor || 'text-primary',
            linkColor: p.link_color || p.linkColor || 'text-primary group-hover:text-surface-tint',
        }));
    }
    return [
        {
            tag: 'UCE • Senior 1 - 4',
            title: 'Lower Secondary Curriculum',
            description:
                'Competence-based curriculum focusing on practical problem solving, critical thinking, research projects, and broad foundational science and arts mastery.',
            features: [
                'Integrated Science & Maths',
                'French, Kiswahili & English Lit',
                'Performing Arts & Physical Educ',
            ],
            linkLabel: 'View UCE Subject Combinations',
            linkUrl: '#admissions',
            icon: 'auto_stories',
            accentBar: 'bg-primary',
            iconBg: 'bg-primary-fixed',
            iconColor: 'text-primary',
            labelColor: 'text-primary',
            linkColor: 'text-primary group-hover:text-surface-tint',
        },
        {
            tag: 'UACE • Senior 5 - 6',
            title: 'Advanced STEM & Sciences',
            description:
                'Pioneering preparation for Medicine, Engineering, Computing, and Agri-technology with rigorous daily hands-on wet labs and digital simulation.',
            features: [
                'PCB / BCM (Medical & Biological)',
                'PCM / PEM (Engineering Fields)',
                'Sub-ICT & Applied Mathematics',
            ],
            linkLabel: 'Explore Science Laboratories',
            linkUrl: '#admissions',
            icon: 'biotech',
            accentBar: 'bg-secondary',
            iconBg: 'bg-secondary-fixed',
            iconColor: 'text-secondary',
            labelColor: 'text-secondary',
            linkColor: 'text-secondary',
        },
    ];
});

// Dynamic gallery photos list with fallback
const displayedPhotos = computed(() => {
    if (props.gallery && props.gallery.length > 0) {
        return props.gallery.map((g) => ({
            title: g.title,
            category: g.category,
            categoryLabel: g.category_label || g.categoryLabel || 'Campus Grounds',
            description: g.description || '',
            image: g.image_url || g.image_path || g.image || defaultHeroUrl,
            alt: g.alt_text || g.alt || g.title,
            spanClass: g.span_class || g.spanClass || 'lg:col-span-4',
        }));
    }
    return [
        {
            title: 'Memorial Reference Library',
            category: 'academics',
            categoryLabel: 'Academics',
            description: 'Over 15,000 catalogued curriculum texts and high-speed digital research terminals.',
            image: defaultHeroUrl,
            alt: 'Library',
            spanClass: 'lg:col-span-7',
        },
    ];
});

// Dynamic admission requirements list with fallback
const displayedRequirements = computed(() => {
    if (props.admissionRequirements && props.admissionRequirements.length > 0) {
        return props.admissionRequirements;
    }
    return [
        'Certified PLE or UCE UNEB result slip / pass slip or equivalent transcripts.',
        'Original recommendation letter from previous head of school.',
        'Copy of birth certificate & 4 recent colored passport-sized photographs.',
        'Medical assessment report from an authorized clinic or hospital.',
    ];
});

const classLevels = [
    { value: 'S1', label: 'Senior One (S.1)' },
    { value: 'S2', label: 'Senior Two (S.2)' },
    { value: 'S3', label: 'Senior Three (S.3)' },
    { value: 'S4', label: 'Senior Four (S.4)' },
    { value: 'S5-Science', label: 'Senior Five (S.5 - Sciences / STEM)' },
    { value: 'S5-Arts', label: 'Senior Five (S.5 - Arts / Humanities)' },
];

// --- Gallery filtering + lightbox -------------------------------------------

const activeFilter = ref('all');
const visiblePhotos = computed(() =>
    activeFilter.value === 'all'
        ? displayedPhotos.value
        : displayedPhotos.value.filter((photo) => photo.category === activeFilter.value),
);

const lightboxOpen = ref(false);
const lightboxIndex = ref(0);
const lightboxPhoto = computed(
    () => visiblePhotos.value[lightboxIndex.value] ?? null,
);

const showLightbox = (index: number) => {
    lightboxIndex.value = index;
    lightboxOpen.value = true;
};

const closeLightbox = () => {
    lightboxOpen.value = false;
};

const prevPhoto = () => {
    if (!visiblePhotos.value.length) return;
    lightboxIndex.value =
        (lightboxIndex.value - 1 + visiblePhotos.value.length) %
        visiblePhotos.value.length;
};

const nextPhoto = () => {
    if (!visiblePhotos.value.length) return;
    lightboxIndex.value =
        (lightboxIndex.value + 1) % visiblePhotos.value.length;
};

const onKeydown = (event: KeyboardEvent) => {
    if (!lightboxOpen.value) return;
    if (event.key === 'Escape') {
        closeLightbox();
    } else if (event.key === 'ArrowLeft') {
        prevPhoto();
    } else if (event.key === 'ArrowRight') {
        nextPhoto();
    }
};

watch(activeFilter, () => {
    lightboxIndex.value = 0;
});

onMounted(() => window.addEventListener('keydown', onKeydown));
onBeforeUnmount(() => window.removeEventListener('keydown', onKeydown));

// --- Inquiry form ------------------------------------------------------------

const inquiryForm = useForm({
    student_name: '',
    parent_name: '',
    parent_phone: '',
    parent_email: '',
    class_level: '',
    boarding_status: 'Boarding',
    message: '',
    consent: true,
});

const submitted = ref(false);

const submitInquiry = () => {
    inquiryForm.post('/inquiries', {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true;
        },
    });
};

const resetInquiry = () => {
    inquiryForm.reset();
    submitted.value = false;
};

const scrollTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
};
</script>

<template>
    <Head :title="schoolName + ' Entebbe | Seek knowledge, serve humanity'">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block"
            rel="stylesheet"
        />
    </Head>

    <div
        class="school-theme bg-background font-body-md text-body-md text-on-surface antialiased selection:bg-primary-fixed selection:text-on-primary-fixed"
    >
        <!-- TOP ANNOUNCEMENT BAR -->
        <aside
            aria-label="Announcement"
            class="bg-inverse-surface px-margin py-1.5 text-xs text-inverse-on-surface"
        >
            <div
                class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-2"
            >
                <div class="flex items-center gap-2">
                    <span
                        class="inline-flex items-center justify-center bg-primary px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-on-primary"
                    >
                        {{ announcementBadge }}
                    </span>
                    <span class="font-label-sm text-label-sm">
                        {{ announcementText }}
                    </span>
                </div>
                <div class="flex items-center gap-4 text-[12px] opacity-90">
                    <span class="flex items-center gap-1">
                        <span
                            class="material-symbols-outlined text-[15px] text-secondary-fixed-dim"
                            >location_on</span
                        >
                        {{ campusLocation }}
                    </span>
                    <span class="hidden items-center gap-1 md:inline-flex">
                        <span
                            class="material-symbols-outlined text-[15px] text-secondary-fixed-dim"
                            >call</span
                        >
                        {{ phonePrimary }}
                    </span>
                    <Link
                        class="flex items-center gap-0.5 font-semibold text-secondary-fixed hover:text-white"
                        :href="login()"
                        >Portal Login
                        <span class="material-symbols-outlined text-[14px]"
                            >arrow_forward</span
                        ></Link
                    >
                </div>
            </div>
        </aside>

        <!-- GLASSMORPHIC TOP NAVIGATION BAR -->
        <header
            class="bg-surface/85 sticky top-0 z-50 border-b border-outline-variant/40 shadow-sm backdrop-blur-md transition-all duration-200 ease-in-out"
        >
            <div
                class="mx-auto flex h-20 max-w-7xl items-center justify-between px-margin"
            >
                <a class="group flex items-center gap-3.5 text-left" href="#">
                    <div
                        class="flex h-12 w-12 items-center justify-center overflow-hidden border border-outline-variant/40 bg-surface-container-lowest p-1 shadow-sm transition-transform duration-200 group-hover:scale-105"
                    >
                        <img
                            :alt="schoolName + ' Crest Badge'"
                            class="crest-glow h-full w-full object-contain"
                            :src="crestUrl"
                        />
                    </div>
                    <div>
                        <span
                            class="block font-headline-sm text-headline-sm font-bold leading-snug tracking-tight text-on-surface"
                            >{{ schoolName }}</span
                        >
                        <span
                            class="block font-label-sm text-label-sm font-semibold uppercase tracking-wider text-secondary"
                            >{{ schoolTagline }}</span
                        >
                    </div>
                </a>
                <nav class="hidden items-center gap-7 lg:flex">
                    <a
                        v-for="link in navLinks"
                        :key="link.href"
                        :href="link.href"
                        class="pb-1 font-label-lg text-label-lg text-on-surface transition-colors duration-150 hover:text-primary"
                        >{{ link.label }}</a
                    >
                </nav>
                <div class="flex items-center gap-3">
                    <a
                        class="flex items-center gap-2 bg-primary px-5 py-2.5 font-label-lg text-label-lg text-on-primary shadow-sm transition-all duration-150 hover:bg-surface-tint hover:shadow"
                        href="#admissions"
                    >
                        <span>Apply Now</span>
                        <span class="material-symbols-outlined text-base"
                            >school</span
                        >
                    </a>
                </div>
            </div>
        </header>

        <!-- HERO SECTION -->
        <section
            class="lake-gradient relative overflow-hidden border-b border-surface-variant/70 pb-20 pt-12"
        >
            <div class="mx-auto max-w-7xl px-margin">
                <div
                    class="grid grid-cols-1 items-center gap-10 lg:grid-cols-12"
                >
                    <div class="space-y-6 lg:col-span-7">
                        <div
                            class="inline-flex items-center gap-2 border border-secondary/30 bg-surface-container-high px-3.5 py-1 text-secondary shadow-xs"
                        >
                            <span
                                class="material-symbols-outlined text-base text-primary"
                                >verified</span
                            >
                            <span class="font-label-md text-label-md font-semibold"
                                >{{ heroBadge }}</span
                            >
                        </div>
                        <h1
                            class="text-balance font-display-lg text-display-lg font-bold leading-tight text-on-surface"
                        >
                            {{ heroTitlePrefix }}
                            <span class="italic text-primary"
                                >{{ heroTitleHighlight }}</span
                            >
                            {{ heroTitleSuffix }}
                        </h1>
                        <p
                            class="max-w-2xl font-body-lg text-body-lg leading-relaxed text-on-surface/85"
                        >
                            {{ heroParagraph }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            <a
                                class="flex items-center gap-2 bg-primary px-7 py-3.5 font-label-lg text-label-lg text-on-primary shadow-md transition-all duration-150 hover:bg-surface-tint hover:shadow-lg"
                                href="#admissions"
                            >
                                <span>Apply for 2025 Admissions</span>
                                <span
                                    class="material-symbols-outlined text-base"
                                    >arrow_forward</span
                                >
                            </a>
                            <a
                                class="flex items-center gap-2 border-2 border-secondary bg-surface-container-lowest/90 px-6 py-3.5 font-label-lg text-label-lg text-secondary backdrop-blur-sm transition-all duration-150 hover:bg-secondary-fixed/30"
                                href="#campus-gallery"
                            >
                                <span
                                    class="material-symbols-outlined text-base"
                                    >explore</span
                                >
                                <span>Schedule Campus Visit</span>
                            </a>
                        </div>
                        <div
                            class="grid grid-cols-2 gap-3 border-t border-outline-variant/30 pt-6 sm:grid-cols-4"
                        >
                            <div
                                class="bg-surface-container-lowest border border-outline-variant/30 p-3 text-center shadow-xs"
                            >
                                <div
                                    class="font-headline-md text-headline-md font-bold text-primary"
                                >
                                    {{ stat1Value }}
                                </div>
                                <div
                                    class="font-label-sm text-label-sm font-medium text-on-surface-variant"
                                >
                                    {{ stat1Label }}
                                </div>
                            </div>
                            <div
                                class="bg-surface-container-lowest border border-outline-variant/30 p-3 text-center shadow-xs"
                            >
                                <div
                                    class="font-headline-md text-headline-md font-bold text-secondary"
                                >
                                    {{ stat2Value }}
                                </div>
                                <div
                                    class="font-label-sm text-label-sm font-medium text-on-surface-variant"
                                >
                                    {{ stat2Label }}
                                </div>
                            </div>
                            <div
                                class="bg-surface-container-lowest border border-outline-variant/30 p-3 text-center shadow-xs"
                            >
                                <div
                                    class="font-headline-md text-headline-md font-bold text-primary"
                                >
                                    {{ stat3Value }}
                                </div>
                                <div
                                    class="font-label-sm text-label-sm font-medium text-on-surface-variant"
                                >
                                    {{ stat3Label }}
                                </div>
                            </div>
                            <div
                                class="bg-surface-container-lowest border border-outline-variant/30 p-3 text-center shadow-xs"
                            >
                                <div
                                    class="font-headline-md text-headline-md font-bold text-secondary"
                                >
                                    {{ stat4Value }}
                                </div>
                                <div
                                    class="font-label-sm text-label-sm font-medium text-on-surface-variant"
                                >
                                    {{ stat4Label }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative lg:col-span-5">
                        <div
                            class="relative border border-outline-variant/40 bg-surface-container-lowest p-3 shadow-xl"
                        >
                            <div
                                class="group relative h-[420px] overflow-hidden"
                            >
                                <img
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    :src="heroUrl"
                                    :alt="heroCardTitle"
                                />
                                <div
                                    class="absolute inset-x-4 bottom-4 flex items-center gap-4 border border-white/60 bg-surface/90 p-4 shadow-lg backdrop-blur-md"
                                >
                                    <div
                                        class="flex h-12 w-12 shrink-0 items-center justify-center bg-white p-1 shadow-sm"
                                    >
                                        <img
                                            :alt="schoolName + ' Crest'"
                                            class="h-full w-full object-contain"
                                            :src="crestUrl"
                                        />
                                    </div>
                                    <div>
                                        <h4
                                            class="font-title-md text-title-md font-bold text-on-surface"
                                        >
                                            {{ heroCardTitle }}
                                        </h4>
                                        <p
                                            class="font-body-sm text-body-sm text-on-surface-variant"
                                        >
                                            {{ heroCardDesc }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="absolute -right-3 -top-3 flex items-center gap-1.5 bg-primary px-3.5 py-1.5 font-label-md text-label-md font-bold text-on-primary shadow-md"
                            >
                                <span class="material-symbols-outlined text-sm"
                                    >military_tech</span
                                >
                                <span>{{ heroBadgeCorner }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- HEADTEACHER'S WELCOME & INSTITUTIONAL VALUES -->
        <section
            id="about"
            class="border-b border-surface-variant/40 bg-surface-container-low py-20"
        >
            <div class="mx-auto max-w-7xl px-margin">
                <div
                    class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12"
                >
                    <div class="lg:col-span-5">
                        <div
                            class="relative border border-outline-variant/30 bg-surface-container-lowest p-6 shadow-md"
                        >
                            <div class="relative mb-5 h-96 overflow-hidden">
                                <img
                                    class="h-full w-full object-cover"
                                    :src="headmasterUrl"
                                    :alt="headmasterName"
                                />
                                <div
                                    class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-inverse-surface/90 to-transparent p-4 text-white"
                                >
                                    <p
                                        class="font-title-lg text-title-lg font-bold"
                                    >
                                        {{ headmasterName }}
                                    </p>
                                    <p
                                        class="font-body-sm text-body-sm text-secondary-fixed"
                                    >
                                        {{ headmasterTitle }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between border-t border-outline-variant/20 pt-2 text-xs text-on-surface-variant"
                            >
                                <span class="flex items-center gap-1 font-semibold"
                                    ><span
                                        class="material-symbols-outlined text-primary text-sm"
                                        >verified_user</span
                                    >
                                    {{ headmasterExperience }}</span
                                >
                                <span class="font-medium italic text-secondary"
                                    >{{ headmasterQualifications }}</span
                                >
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6 lg:col-span-7">
                        <div
                            class="inline-flex items-center gap-2 font-label-lg text-label-lg font-bold uppercase tracking-wider text-secondary"
                        >
                            <span class="material-symbols-outlined text-base"
                                >history_edu</span
                            >
                            <span>Welcome from the Headmaster's Desk</span>
                        </div>
                        <h2
                            class="font-headline-lg text-headline-lg font-bold leading-tight text-on-surface"
                        >
                            {{ headmasterSectionTitle }}
                        </h2>
                        <blockquote
                            class="my-4 border-l-4 border-primary bg-surface-container-lowest/60 p-4 pl-5 font-headline-sm text-headline-sm italic text-on-surface/90"
                        >
                            "{{ headmasterQuote }}"
                        </blockquote>
                        <p
                            class="font-body-md text-body-md leading-relaxed text-on-surface-variant"
                        >
                            {{ headmasterWelcomeText }}
                        </p>
                        <div class="grid grid-cols-1 gap-4 pt-4 sm:grid-cols-3">
                            <div
                                class="border border-outline-variant/30 bg-surface-container-lowest p-4 transition-colors hover:border-primary"
                            >
                                <span
                                    class="material-symbols-outlined mb-2 text-3xl text-primary"
                                    >menu_book</span
                                >
                                <h4
                                    class="mb-1 font-title-md text-title-md font-bold text-on-surface"
                                >
                                    {{ headmasterCard1Title }}
                                </h4>
                                <p
                                    class="font-body-sm text-body-sm text-on-surface-variant"
                                >
                                    {{ headmasterCard1Desc }}
                                </p>
                            </div>
                            <div
                                class="border border-outline-variant/30 bg-surface-container-lowest p-4 transition-colors hover:border-secondary"
                            >
                                <span
                                    class="material-symbols-outlined mb-2 text-3xl text-secondary"
                                    >shield</span
                                >
                                <h4
                                    class="mb-1 font-title-md text-title-md font-bold text-on-surface"
                                >
                                    {{ headmasterCard2Title }}
                                </h4>
                                <p
                                    class="font-body-sm text-body-sm text-on-surface-variant"
                                >
                                    {{ headmasterCard2Desc }}
                                </p>
                            </div>
                            <div
                                class="border border-outline-variant/30 bg-surface-container-lowest p-4 transition-colors hover:border-primary"
                            >
                                <span
                                    class="material-symbols-outlined mb-2 text-3xl text-primary"
                                    >volunteer_activism</span
                                >
                                <h4
                                    class="mb-1 font-title-md text-title-md font-bold text-on-surface"
                                >
                                    {{ headmasterCard3Title }}
                                </h4>
                                <p
                                    class="font-body-sm text-body-sm text-on-surface-variant"
                                >
                                    {{ headmasterCard3Desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ACADEMIC EXCELLENCE & CURRICULUM -->
        <section id="academics" class="bg-surface py-20">
            <div class="mx-auto max-w-7xl px-margin">
                <div class="mx-auto mb-14 max-w-3xl text-center">
                    <span
                        class="mb-2 block font-label-lg text-label-lg font-bold uppercase tracking-wider text-primary"
                        >Holistic Academic Programs</span
                    >
                    <h2
                        class="font-headline-lg text-headline-lg font-bold text-on-surface"
                    >
                        Equipping Scholars for 21st-Century Triumph
                    </h2>
                    <div
                        class="mx-auto mb-4 mt-3 h-1 w-16 rounded-full bg-secondary"
                    ></div>
                    <p
                        class="font-body-md text-body-md text-on-surface-variant"
                    >
                        Fully licensed and registered with the Uganda National
                        Examinations Board (UNEB). Our curriculum harmonizes
                        intellectual curiosity, practical science application,
                        digital literacy, and linguistic fluency.
                    </p>
                </div>
                <div
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4"
                >
                    <div
                        v-for="program in displayedPrograms"
                        :key="program.title"
                        class="group flex flex-col justify-between overflow-hidden border border-outline-variant/40 bg-surface-container-lowest shadow-sm transition-all hover:shadow-md"
                    >
                        <div class="h-2" :class="program.accentBar"></div>
                        <div class="flex-1 p-6">
                            <div
                                class="mb-4 flex h-10 w-10 items-center justify-center font-bold"
                                :class="[program.iconBg, program.iconColor]"
                            >
                                <span class="material-symbols-outlined">{{
                                    program.icon
                                }}</span>
                            </div>
                            <span
                                class="font-label-sm text-label-sm font-bold uppercase tracking-wider"
                                :class="program.labelColor"
                                >{{ program.tag }}</span
                            >
                            <h3
                                class="mb-3 mt-1 font-title-lg text-title-lg font-bold text-on-surface"
                            >
                                {{ program.title }}
                            </h3>
                            <p
                                class="mb-4 font-body-sm text-body-sm text-on-surface-variant"
                            >
                                {{ program.description }}
                            </p>
                            <ul
                                class="space-y-1.5 text-xs font-medium text-on-surface/90"
                            >
                                <li
                                    v-for="item in program.features"
                                    :key="item"
                                    class="flex items-center gap-1.5"
                                >
                                    <span
                                        class="material-symbols-outlined text-secondary text-sm"
                                        >check_circle</span
                                    >
                                    {{ item }}
                                </li>
                            </ul>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a
                                class="inline-flex items-center gap-1 text-xs font-semibold group-hover:underline"
                                :class="program.linkColor"
                                :href="program.linkUrl || '#admissions'"
                                >{{ program.linkLabel }} →</a
                            >
                        </div>
                    </div>
                </div>
                <div
                    class="mt-12 flex flex-col items-center justify-between gap-6 border border-outline-variant/30 bg-surface-container-high/50 p-6 md:flex-row"
                >
                    <div class="flex items-center gap-4">
                        <div
                            class="bg-surface-container-lowest p-3 text-primary shadow-xs"
                        >
                            <span
                                class="material-symbols-outlined text-3xl"
                                >psychology</span
                            >
                        </div>
                        <div>
                            <h4
                                class="font-title-md text-title-md font-bold text-on-surface"
                            >
                                Equipped for National Distinction
                            </h4>
                            <p
                                class="font-body-sm text-body-sm text-on-surface-variant"
                            >
                                Fully-stocked Chemistry, Physics, and Biology
                                laboratories inspected to international
                                standards.
                            </p>
                        </div>
                    </div>
                    <div class="flex shrink-0 items-center gap-3">
                        <a
                            class="bg-primary px-4 py-2 text-xs font-semibold text-on-primary transition-colors hover:bg-surface-tint"
                            href="#admissions"
                            >Inquire About Curriculum Details</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <!-- CAMPUS GALLERY -->
        <section
            id="campus-gallery"
            class="border-b border-surface-variant/40 bg-surface-container-low py-20"
        >
            <div class="mx-auto max-w-7xl px-margin">
                <div
                    class="mb-10 flex flex-col justify-between gap-4 md:flex-row md:items-end"
                >
                    <div>
                        <span
                            class="mb-1 block font-label-lg text-label-lg font-bold uppercase tracking-wider text-secondary"
                            >Campus Life &amp; Scenery</span
                        >
                        <h2
                            class="font-headline-lg text-headline-lg font-bold text-on-surface"
                        >
                            Vibrant Moments by Lake Victoria
                        </h2>
                        <p
                            class="mt-1 font-body-md text-body-md text-on-surface-variant"
                        >
                            Glimpses into student daily life, laboratory
                            experiments, sporting glory, and creative arts.
                        </p>
                    </div>
                    <div
                        aria-label="Gallery category filters"
                        class="flex flex-wrap items-center gap-2"
                        role="tablist"
                    >
                        <button
                            v-for="filter in filters"
                            :key="filter.value"
                            type="button"
                            role="tab"
                            :aria-selected="activeFilter === filter.value"
                            class="px-3.5 py-1.5 text-xs transition-all duration-200"
                            :class="
                                activeFilter === filter.value
                                    ? 'bg-primary font-semibold text-on-primary shadow-sm ring-1 ring-primary'
                                    : 'border border-outline-variant/30 bg-surface-container-lowest font-medium text-on-surface hover:bg-surface-container'
                            "
                            @click="activeFilter = filter.value"
                        >
                            {{ filter.label }}
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:grid-cols-12">
                    <div
                        v-for="(photo, index) in visiblePhotos"
                        :key="photo.title + index"
                        class="gallery-item group relative h-72 cursor-pointer select-none overflow-hidden border border-outline-variant/30 bg-surface-container-lowest shadow-xs transition-transform duration-300 md:h-80"
                        :class="photo.spanClass"
                        role="button"
                        tabindex="0"
                        @click="showLightbox(index)"
                        @keydown.enter="showLightbox(index)"
                    >
                        <img
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            :src="photo.image"
                            :alt="photo.alt"
                        />
                        <div
                            class="absolute inset-0 flex items-center justify-center bg-inverse-surface/30 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                        >
                            <span
                                class="flex h-12 w-12 scale-75 items-center justify-center bg-surface-container-lowest/90 text-primary shadow-lg transition-transform duration-300 group-hover:scale-100"
                            >
                                <span
                                    class="material-symbols-outlined text-2xl"
                                    >zoom_in</span
                                >
                            </span>
                        </div>
                        <div
                            class="pointer-events-none absolute inset-0 flex flex-col justify-end bg-gradient-to-t from-inverse-surface/90 via-inverse-surface/20 to-transparent p-5 text-white"
                        >
                            <div class="mb-1 flex items-center justify-between">
                                <span
                                    class="bg-primary px-2 py-0.5 text-[10px] font-bold uppercase text-on-primary"
                                    >{{ photo.categoryLabel }}</span
                                >
                                <span
                                    class="flex items-center gap-1 text-[11px] text-surface-variant opacity-0 transition-opacity duration-200 group-hover:opacity-100"
                                    ><span
                                        class="material-symbols-outlined text-xs"
                                        >fullscreen</span
                                    >
                                    Preview</span
                                >
                            </div>
                            <h4 class="font-title-md text-title-md font-bold">
                                {{ photo.title }}
                            </h4>
                            <p
                                class="line-clamp-1 font-body-sm text-body-sm text-surface-variant"
                            >
                                {{ photo.description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-8 text-center">
                    <a
                        class="inline-flex items-center gap-2 font-label-lg text-label-lg font-bold text-secondary hover:underline"
                        href="#admissions"
                    >
                        <span class="material-symbols-outlined text-lg"
                            >videocam</span
                        >
                        <span
                            >Request an in-person physical tour of Sena High
                            School campus</span
                        >
                    </a>
                </div>
            </div>
        </section>

        <!-- LIGHTBOX MODAL -->
        <Teleport to="body">
            <div
                v-if="lightboxOpen"
                class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6"
                role="dialog"
                aria-modal="true"
            >
                <div
                    class="absolute inset-0 bg-inverse-surface/80 backdrop-blur-md"
                    @click="closeLightbox"
                ></div>
                <div
                    class="relative z-10 flex w-full max-w-4xl flex-col overflow-hidden border border-outline-variant/40 bg-surface-container-lowest shadow-2xl"
                >
                    <div
                        class="flex items-center justify-between border-b border-outline-variant/30 bg-surface-container-low px-5 py-3.5"
                    >
                        <div class="flex items-center gap-2.5">
                            <span
                                class="inline-block h-2.5 w-2.5 rounded-full bg-primary"
                            ></span>
                            <span
                                class="font-label-sm text-label-sm font-bold uppercase tracking-wider text-secondary"
                                >{{ lightboxPhoto?.categoryLabel }}</span
                            >
                            <span class="text-xs text-on-surface-variant"
                                >• {{ lightboxIndex + 1 }} of
                                {{ visiblePhotos.length }}</span
                            >
                        </div>
                        <button
                            aria-label="Close modal"
                            class="flex h-8 w-8 items-center justify-center text-on-surface-variant transition-colors hover:bg-surface-container hover:text-primary focus:outline-none focus:ring-2 focus:ring-primary"
                            @click="closeLightbox"
                        >
                            <span class="material-symbols-outlined text-xl"
                                >close</span
                            >
                        </button>
                    </div>
                    <div
                        class="relative flex aspect-video w-full items-center justify-center overflow-hidden bg-inverse-surface sm:h-[420px]"
                    >
                        <img
                            v-if="lightboxPhoto"
                            :key="lightboxPhoto.image"
                            :src="lightboxPhoto.image"
                            :alt="lightboxPhoto.title"
                            class="h-full w-full select-none object-contain transition-all duration-300"
                        />
                        <button
                            aria-label="Previous photo"
                            class="absolute left-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center bg-surface-container-lowest/80 text-on-surface shadow-md backdrop-blur-sm transition-all duration-150 hover:bg-surface-container-lowest hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            @click.stop="prevPhoto"
                        >
                            <span
                                class="material-symbols-outlined text-2xl"
                                >chevron_left</span
                            >
                        </button>
                        <button
                            aria-label="Next photo"
                            class="absolute right-3 top-1/2 flex h-11 w-11 -translate-y-1/2 items-center justify-center bg-surface-container-lowest/80 text-on-surface shadow-md backdrop-blur-sm transition-all duration-150 hover:bg-surface-container-lowest hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            @click.stop="nextPhoto"
                        >
                            <span
                                class="material-symbols-outlined text-2xl"
                                >chevron_right</span
                            >
                        </button>
                    </div>
                    <div
                        class="flex flex-col justify-between gap-4 border-t border-outline-variant/30 bg-surface-container-lowest p-5 sm:flex-row sm:items-center sm:p-6"
                    >
                        <div class="space-y-1">
                            <h3
                                class="font-headline-sm text-headline-sm font-bold text-on-surface"
                            >
                                {{ lightboxPhoto?.title }}
                            </h3>
                            <p
                                class="max-w-2xl font-body-sm text-body-sm text-on-surface-variant"
                            >
                                {{ lightboxPhoto?.description }}
                            </p>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <a
                                class="flex items-center gap-1.5 bg-primary px-4 py-2 font-label-md text-label-md text-on-primary shadow-sm transition-colors hover:bg-surface-tint"
                                href="#admissions"
                                @click="closeLightbox"
                            >
                                <span>Inquire for Admission</span>
                                <span
                                    class="material-symbols-outlined text-sm"
                                    >arrow_forward</span
                                >
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </Teleport>

        <!-- ADMISSIONS & INQUIRIES -->
        <section id="admissions" class="bg-surface py-20">
            <div class="mx-auto max-w-7xl px-margin">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
                    <div class="space-y-6 lg:col-span-5">
                        <div>
                            <span
                                class="mb-1 block font-label-lg text-label-lg font-bold uppercase tracking-wider text-primary"
                                >Admissions &amp; Enrollment</span
                            >
                            <h2
                                class="font-headline-lg text-headline-lg font-bold leading-tight text-on-surface"
                            >
                                {{ admissionsTitle }}
                            </h2>
                            <p
                                class="mt-2 font-body-md text-body-md text-on-surface-variant"
                            >
                                {{ admissionsSubtitle }}
                            </p>
                        </div>
                        <div
                            class="space-y-3 border border-outline-variant/30 bg-surface-container-low p-5"
                        >
                            <h4
                                class="flex items-center gap-2 font-title-md text-title-md font-bold text-on-surface"
                            >
                                <span
                                    class="material-symbols-outlined text-primary"
                                    >event_available</span
                                >
                                <span
                                    >Intake Schedule (Academic Year
                                    2025)</span
                                >
                            </h4>
                            <div class="space-y-2 text-xs">
                                <div
                                    class="flex items-center justify-between border-b border-outline-variant/20 pb-2"
                                >
                                    <span class="font-semibold text-on-surface"
                                        >Senior 1 Admissions (PLE Entry)</span
                                    >
                                    <span
                                        class="bg-primary-fixed px-2 py-0.5 font-bold text-on-primary-fixed"
                                        >{{ admissionsS1Status }}</span
                                    >
                                </div>
                                <div
                                    class="flex items-center justify-between border-b border-outline-variant/20 pb-2"
                                >
                                    <span class="font-semibold text-on-surface"
                                        >Senior 5 Intake (UCE
                                        Graduates)</span
                                    >
                                    <span
                                        class="bg-secondary-fixed px-2 py-0.5 font-bold text-on-secondary-fixed"
                                        >{{ admissionsS5Status }}</span
                                    >
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold text-on-surface"
                                        >Continuing Transfers (S.2 &amp;
                                        S.3)</span
                                    >
                                    <span class="text-on-surface-variant"
                                        >{{ admissionsTransferStatus }}</span
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <h4
                                class="font-title-md text-title-md font-bold text-on-surface"
                            >
                                Required for Application:
                            </h4>
                            <div
                                class="space-y-2 text-xs font-medium text-on-surface-variant"
                            >
                                <div
                                    v-for="requirement in displayedRequirements"
                                    :key="requirement"
                                    class="flex items-start gap-2"
                                >
                                    <span
                                        class="material-symbols-outlined mt-0.5 shrink-0 text-base text-secondary"
                                        >check_circle</span
                                    >
                                    <span>{{ requirement }}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="border border-tertiary-container/40 bg-tertiary-fixed/30 p-4"
                        >
                            <div
                                class="mb-1 flex items-center gap-2 text-xs font-bold text-on-tertiary-fixed"
                            >
                                <span
                                    class="material-symbols-outlined text-base"
                                    >military_tech</span
                                >
                                <span
                                    >{{ admissionsBursaryTitle }}</span
                                >
                            </div>
                            <p class="text-xs text-on-tertiary-container">
                                {{ admissionsBursaryDesc }}
                            </p>
                        </div>
                        <div
                            class="flex items-center gap-3 pt-2 text-xs text-on-surface"
                        >
                            <span
                                class="bg-surface-container p-2 text-secondary"
                            >
                                <span
                                    class="material-symbols-outlined text-xl"
                                    >support_agent</span
                                >
                            </span>
                            <div>
                                <p class="font-bold">
                                    Admissions Hotline (Entebbe Campus):
                                </p>
                                <p class="text-sm font-bold text-primary">
                                    {{ admissionsHotline }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7">
                        <div
                            class="relative border border-outline-variant/40 bg-surface-container-lowest p-8 shadow-lg"
                        >
                            <div
                                class="mb-6 border-b border-outline-variant/30 pb-4"
                            >
                                <h3
                                    class="font-title-lg text-title-lg font-bold text-on-surface"
                                >
                                    Online Admission Inquiry
                                </h3>
                                <p
                                    class="font-body-sm text-body-sm text-on-surface-variant"
                                >
                                    Fill in the prospective scholar's
                                    particulars below. Our admissions registrar
                                    will respond within 24 hours.
                                </p>
                            </div>
                            <form
                                v-if="!submitted"
                                class="space-y-4"
                                @submit.prevent="submitInquiry"
                            >
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="student_name"
                                            >Student Full Name *</label
                                        >
                                        <input
                                            id="student_name"
                                            v-model="inquiryForm.student_name"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            placeholder="e.g., Aheebwa Joshua"
                                            required
                                            type="text"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="parent_name"
                                            >Parent / Guardian Name *</label
                                        >
                                        <input
                                            id="parent_name"
                                            v-model="inquiryForm.parent_name"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            placeholder="e.g., Dr. / Mrs. Sarah Mukasa"
                                            required
                                            type="text"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="parent_phone"
                                            >Parent WhatsApp / Telephone *</label
                                        >
                                        <input
                                            id="parent_phone"
                                            v-model="inquiryForm.parent_phone"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            placeholder="+256 700 000 000"
                                            required
                                            type="tel"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="parent_email"
                                            >Email Address *</label
                                        >
                                        <input
                                            id="parent_email"
                                            v-model="inquiryForm.parent_email"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            placeholder="parent@example.com"
                                            required
                                            type="email"
                                        />
                                    </div>
                                </div>
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="class_level"
                                            >Class of Interest *</label
                                        >
                                        <select
                                            id="class_level"
                                            v-model="inquiryForm.class_level"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            required
                                        >
                                            <option disabled value="">
                                                Select Entry Level
                                            </option>
                                            <option
                                                v-for="level in classLevels"
                                                :key="level.value"
                                                :value="level.value"
                                            >
                                                {{ level.label }}
                                            </option>
                                        </select>
                                    </div>
                                    <div>
                                        <label
                                            class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                            for="boarding_status"
                                            >Boarding / Day Scholar *</label
                                        >
                                        <select
                                            id="boarding_status"
                                            v-model="inquiryForm.boarding_status"
                                            class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                            required
                                        >
                                            <option value="Boarding">
                                                Full Boarding Section
                                                (Recommended)
                                            </option>
                                            <option value="Day">
                                                Day Scholar (Entebbe Residents)
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="mb-1 block font-label-md text-label-md font-semibold text-on-surface"
                                        for="message"
                                        >Questions, Previous Scores, or Specific
                                        Needs</label
                                    >
                                    <textarea
                                        id="message"
                                        v-model="inquiryForm.message"
                                        class="w-full border border-outline-variant bg-surface-container-lowest px-3.5 py-2.5 text-xs text-on-surface focus:border-secondary focus:outline-none focus:ring-1 focus:ring-secondary"
                                        placeholder="Please mention PLE/UCE aggregates, talent in music/sports, or specific subjects of interest..."
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="flex items-center gap-2 pt-1">
                                    <input
                                        id="consent"
                                        v-model="inquiryForm.consent"
                                        class="h-4 w-4 border-outline text-primary focus:ring-primary"
                                        required
                                        type="checkbox"
                                    />
                                    <label
                                        class="text-[12px] text-on-surface-variant"
                                        for="consent"
                                        >I agree that Sena High School may
                                        contact me regarding enrollment and
                                        school visits.</label
                                    >
                                </div>
                                <div class="pt-2">
                                    <button
                                        :disabled="inquiryForm.processing"
                                        class="flex w-full items-center justify-center gap-2 bg-primary py-3 font-label-lg text-label-lg font-bold text-on-primary shadow transition-all duration-150 hover:bg-surface-tint disabled:opacity-50"
                                        type="submit"
                                    >
                                        <span>{{ inquiryForm.processing ? 'Submitting Application...' : 'Submit Application / Inquiry' }}</span>
                                        <span
                                            class="material-symbols-outlined text-base"
                                            >send</span
                                        >
                                    </button>
                                </div>
                            </form>
                            <div
                                v-else
                                class="flex flex-col items-center gap-3 py-12 text-center"
                            >
                                <span
                                    class="material-symbols-outlined text-5xl text-secondary"
                                    >mark_email_read</span
                                >
                                <h4
                                    class="font-title-lg text-title-lg font-bold text-on-surface"
                                >
                                    Thank you for your inquiry!
                                </h4>
                                <p
                                    class="max-w-md font-body-md text-body-md text-on-surface-variant"
                                >
                                    Thank you for inquiring at {{ schoolName }}
                                    Entebbe. Our Admissions Office has received your request and will contact
                                    you via phone and email.
                                </p>
                                <button
                                    class="font-label-md text-label-md font-semibold text-primary underline-offset-2 hover:underline"
                                    type="button"
                                    @click="resetInquiry"
                                >
                                    Submit another inquiry
                                </button>
                            </div>
                            <div
                                class="mt-4 flex items-center justify-between border-t border-outline-variant/20 pt-4 text-[11px] text-on-surface-variant"
                            >
                                <span class="flex items-center gap-1"
                                    ><span
                                        class="material-symbols-outlined text-secondary text-sm"
                                        >lock</span
                                    >
                                    Data protected &amp; private</span
                                >
                                <span
                                    >Physical application forms also available
                                    at main school gate.</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- INSTITUTIONAL FOOTER -->
        <footer
            id="contact"
            class="border-t border-outline/20 bg-inverse-surface text-inverse-on-surface"
        >
            <div class="mx-auto w-full max-w-7xl px-margin py-space-xl">
                <div
                    class="grid grid-cols-1 gap-10 border-b border-surface-variant/20 pb-12 md:grid-cols-2 lg:grid-cols-12"
                >
                    <div class="space-y-4 lg:col-span-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center bg-white p-1 shadow-sm"
                            >
                                <img
                                    :alt="schoolName + ' Crest Badge'"
                                    class="h-full w-full object-contain"
                                    :src="crestUrl"
                                />
                            </div>
                            <div>
                                <span
                                    class="block font-headline-md text-headline-md font-bold tracking-tight text-inverse-on-surface"
                                    >{{ schoolName }}</span
                                >
                                <span
                                    class="text-xs font-semibold uppercase tracking-wider text-secondary-fixed"
                                    >{{ campusLocation }}</span
                                >
                            </div>
                        </div>
                        <p
                            class="font-body-sm text-body-sm leading-relaxed text-surface-variant"
                        >
                            A premier Ugandan educational sanctuary empowering
                            scholars with academic mastery, moral courage, and
                            dedicated community service.
                        </p>
                        <div class="pt-1">
                            <span
                                class="block text-xs font-semibold text-secondary-fixed"
                                >School Motto:</span
                            >
                            <p
                                class="font-headline-sm text-sm italic text-tertiary-fixed"
                            >
                                "{{ schoolMotto }}"
                            </p>
                        </div>
                    </div>
                    <div class="space-y-3 lg:col-span-2">
                        <h4
                            class="border-l-2 border-primary pl-2 font-title-md text-title-md font-bold text-white"
                        >
                            Curriculum
                        </h4>
                        <ul
                            class="space-y-2 text-xs font-body-sm text-surface-variant"
                        >
                            <li v-for="prog in displayedPrograms" :key="prog.title">
                                <a
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    href="#academics"
                                    >{{ prog.title }}</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-3 lg:col-span-3">
                        <h4
                            class="border-l-2 border-secondary pl-2 font-title-md text-title-md font-bold text-white"
                        >
                            Institutional
                        </h4>
                        <ul
                            class="space-y-2 text-xs font-body-sm text-surface-variant"
                        >
                            <li>
                                <a
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    href="#admissions"
                                    >Admissions Policy</a
                                >
                            </li>
                            <li>
                                <a
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    href="#campus-gallery"
                                    >Campus Tour &amp; Visits</a
                                >
                            </li>
                            <li>
                                <a
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    href="#admissions"
                                    >School Calendar 2025</a
                                >
                            </li>
                            <li>
                                <Link
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    :href="login()"
                                    >Parent Portal Login</Link
                                >
                            </li>
                            <li>
                                <a
                                    class="transition-colors duration-150 hover:text-secondary-fixed"
                                    href="#about"
                                    >Board of Governors &amp;
                                    Administration</a
                                >
                            </li>
                        </ul>
                    </div>
                    <div class="space-y-3 lg:col-span-3">
                        <h4
                            class="border-l-2 border-primary pl-2 font-title-md text-title-md font-bold text-white"
                        >
                            Entebbe Campus
                        </h4>
                        <div class="space-y-2.5 text-xs text-surface-variant">
                            <p class="flex items-start gap-2">
                                <span
                                    class="material-symbols-outlined mt-0.5 shrink-0 text-base text-secondary-fixed"
                                    >location_on</span
                                >
                                <span>{{ addressFull }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span
                                    class="material-symbols-outlined shrink-0 text-base text-secondary-fixed"
                                    >call</span
                                >
                                <span>{{ phonePrimary }} / {{ phoneSecondary }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span
                                    class="material-symbols-outlined shrink-0 text-base text-secondary-fixed"
                                    >mail</span
                                >
                                <span>{{ emailPrimary }}</span>
                            </p>
                            <p class="flex items-center gap-2">
                                <span
                                    class="material-symbols-outlined shrink-0 text-base text-secondary-fixed"
                                    >verified</span
                                >
                                <span>{{ unebCenterNo }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center justify-between gap-4 pt-8 text-xs text-surface-variant md:flex-row"
                >
                    <p>
                        © 2024 {{ schoolName }} Entebbe. {{ schoolMotto }}. All rights reserved. Entebbe, Uganda.
                    </p>
                    <div class="flex items-center gap-6">
                        <a class="transition-colors hover:text-white" href="#"
                            >Privacy Policy</a
                        >
                        <a class="transition-colors hover:text-white" href="#"
                            >Academic Terms</a
                        >
                        <a class="transition-colors hover:text-white" href="#"
                            >MoES Accreditation</a
                        >
                        <a
                            class="flex items-center gap-1 text-secondary-fixed hover:text-white"
                            href="#"
                            @click.prevent="scrollTop"
                        >
                            <span class="material-symbols-outlined text-sm"
                                >arrow_upward</span
                            >
                            Back to Top
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
.material-symbols-outlined {
    font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    display: inline-block;
    vertical-align: middle;
    line-height: 1;
}

.crest-glow {
    filter: drop-shadow(0 4px 12px rgba(175, 16, 26, 0.25));
}

.lake-gradient {
    background:
        radial-gradient(
            circle at 85% 15%,
            rgba(80, 217, 254, 0.12) 0%,
            rgba(249, 249, 255, 0) 65%
        );
}

/* Gallery entrance animation when the filter changes. */
.gallery-item {
    animation: card-entrance 0.4s ease;
}

@keyframes card-entrance {
    from {
        opacity: 0;
        transform: translateY(12px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>
