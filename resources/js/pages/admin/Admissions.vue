<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import {
    Award,
    BookOpen,
    Check,
    CheckCircle2,
    Edit2,
    Plus,
    Save,
    Trash2,
    X,
} from '@lucide/vue';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

interface Requirement {
    id: number;
    requirement_text: string;
    order_index: number;
    is_active: boolean;
}

const props = defineProps<{
    requirements: Requirement[];
    settings: Record<string, string>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Admissions & Intake', href: '/dashboard/admissions' },
];

const showReqModal = ref(false);
const editingReq = ref<Requirement | null>(null);

const reqForm = useForm({
    requirement_text: '',
    order_index: 0,
    is_active: true,
});

const settingsForm = useForm({
    admissions_title: props.settings.admissions_title || 'Start Your Journey at Sena High School',
    admissions_subtitle: props.settings.admissions_subtitle || 'We welcome applications from motivated boys and girls seeking academic excellence, moral grounding, and purposeful leadership.',
    admissions_s1_status: props.settings.admissions_s1_status || 'Ongoing',
    admissions_s5_status: props.settings.admissions_s5_status || 'Forms Available',
    admissions_transfer_status: props.settings.admissions_transfer_status || 'Subject to Interview',
    admissions_bursary_title: props.settings.admissions_bursary_title || 'Bursaries & Academic Merit Scholarships',
    admissions_bursary_desc: props.settings.admissions_bursary_desc || 'Special partial scholarships are awarded to students scoring Aggregate 4 to 6 in PLE and Division 1 (Aggregate 8–18 in UCE).',
    admissions_hotline: props.settings.admissions_hotline || '+256 (0) 701 445 220 / +256 (0) 772 341 890',
});

const openAddReqModal = () => {
    editingReq.value = null;
    reqForm.reset();
    reqForm.order_index = props.requirements.length + 1;
    reqForm.is_active = true;
    showReqModal.value = true;
};

const openEditReqModal = (req: Requirement) => {
    editingReq.value = req;
    reqForm.requirement_text = req.requirement_text;
    reqForm.order_index = req.order_index;
    reqForm.is_active = Boolean(req.is_active);
    showReqModal.value = true;
};

const submitReq = () => {
    if (editingReq.value) {
        reqForm.put(`/dashboard/admissions/${editingReq.value.id}`, {
            onSuccess: () => {
                showReqModal.value = false;
            },
        });
    } else {
        reqForm.post('/dashboard/admissions', {
            onSuccess: () => {
                showReqModal.value = false;
            },
        });
    }
};

const deleteReq = (req: Requirement) => {
    if (confirm('Delete this admission requirement?')) {
        router.delete(`/dashboard/admissions/${req.id}`);
    }
};

const submitSettings = () => {
    settingsForm.post('/dashboard/site-settings', {
        preserveScroll: true,
    });
};
</script>

<template>

    <Head title="Admissions & Requirements Management" />

    <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-foreground">Admissions & Enrollment Configuration</h1>
                <p class="text-sm text-muted-foreground">Manage intake schedules, document requirements, and scholarship
                    notices.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
            <!-- Left Column: Intake Schedule & Scholarship Settings -->
            <div class="space-y-6 lg:col-span-6">
                <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs">
                    <div class="flex items-center justify-between border-b border-border/50 pb-3">
                        <h3 class="text-base font-bold text-foreground">Intake Schedule & Statuses</h3>
                        <button type="button" :disabled="settingsForm.processing"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-primary px-3.5 py-1.5 text-xs font-bold text-primary-foreground shadow-xs hover:bg-primary/90 disabled:opacity-50"
                            @click="submitSettings">
                            <Save class="h-3.5 w-3.5" />
                            <span>Save Settings</span>
                        </button>
                    </div>

                    <form class="mt-4 space-y-4" @submit.prevent="submitSettings">
                        <div>
                            <label class="block text-xs font-semibold text-foreground">Section Title</label>
                            <input v-model="settingsForm.admissions_title" type="text"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-foreground">Section Subtitle</label>
                            <textarea v-model="settingsForm.admissions_subtitle" rows="2"
                                class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                        </div>

                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                            <div>
                                <label class="block text-[11px] font-semibold text-foreground">Senior 1 Status</label>
                                <input v-model="settingsForm.admissions_s1_status" type="text" placeholder="Ongoing"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1.5 text-xs font-medium text-primary" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-foreground">Senior 5 Status</label>
                                <input v-model="settingsForm.admissions_s5_status" type="text"
                                    placeholder="Forms Available"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1.5 text-xs font-medium text-secondary" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-semibold text-foreground">Transfers Status</label>
                                <input v-model="settingsForm.admissions_transfer_status" type="text"
                                    placeholder="Interview"
                                    class="mt-1 w-full rounded border border-border bg-background px-2 py-1.5 text-xs font-medium" />
                            </div>
                        </div>

                        <div class="border-t border-border/50 pt-4 space-y-3">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-muted-foreground">Scholarships &
                                Hotline</h4>
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Bursary Card Title</label>
                                <input v-model="settingsForm.admissions_bursary_title" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Bursary Eligibility
                                    Details</label>
                                <textarea v-model="settingsForm.admissions_bursary_desc" rows="2"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-foreground">Admissions Helpline
                                    Phone(s)</label>
                                <input v-model="settingsForm.admissions_hotline" type="text"
                                    class="mt-1 w-full rounded-lg border border-border bg-background px-3 py-2 text-xs focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Required Documents / Application Checklist -->
            <div class="space-y-6 lg:col-span-6">
                <div class="rounded-2xl border border-border/60 bg-card p-6 shadow-xs">
                    <div class="flex items-center justify-between border-b border-border/50 pb-3">
                        <div>
                            <h3 class="text-base font-bold text-foreground">Application Requirements Checklist</h3>
                            <p class="text-xs text-muted-foreground">Bullet points required from prospective applicants.
                            </p>
                        </div>
                        <button type="button"
                            class="inline-flex items-center gap-1.5 rounded-lg bg-secondary px-3 py-1.5 text-xs font-bold text-secondary-foreground shadow-xs hover:bg-secondary/80"
                            @click="openAddReqModal">
                            <Plus class="h-3.5 w-3.5" />
                            <span>Add Item</span>
                        </button>
                    </div>

                    <div class="mt-4 space-y-2.5">
                        <div v-for="req in requirements" :key="req.id"
                            class="flex items-start justify-between gap-3 rounded-xl border border-border/60 bg-muted/20 p-3 text-xs">
                            <div class="flex items-start gap-2">
                                <CheckCircle2 class="h-4 w-4 shrink-0 text-secondary mt-0.5" />
                                <span class="font-medium text-foreground leading-relaxed">{{ req.requirement_text
                                    }}</span>
                            </div>
                            <div class="flex shrink-0 items-center gap-1">
                                <button type="button"
                                    class="rounded-md p-1 text-muted-foreground hover:bg-muted hover:text-primary"
                                    @click="openEditReqModal(req)">
                                    <Edit2 class="h-3.5 w-3.5" />
                                </button>
                                <button type="button"
                                    class="rounded-md p-1 text-muted-foreground hover:bg-red-500/10 hover:text-red-600"
                                    @click="deleteReq(req)">
                                    <Trash2 class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Requirement Modal -->
    <div v-if="showReqModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm">
        <div class="admin-modal w-full max-w-md">
            <div class="admin-modal-header">
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10">
                        <BookOpen class="h-4 w-4 text-primary" />
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-foreground">
                            {{ editingReq ? 'Edit Requirement' : 'Add Admission Requirement' }}
                        </h3>
                        <p class="text-xs text-muted-foreground">{{ editingReq ? 'Update the requirement text below' : 'Define a new document or condition' }}</p>
                    </div>
                </div>
                <button type="button" class="flex h-8 w-8 items-center justify-center rounded-full text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"
                    @click="showReqModal = false">
                    <X class="h-4 w-4" />
                </button>
            </div>

            <form class="admin-modal-body space-y-5" @submit.prevent="submitReq">
                <div>
                    <label class="mb-1.5 block">Requirement Text <span class="text-red-500">*</span></label>
                    <textarea v-model="reqForm.requirement_text" required rows="4"
                        placeholder="e.g. Certified PLE or UCE UNEB result slip / pass slip..."></textarea>
                    <p v-if="reqForm.errors.requirement_text" class="mt-1 text-xs text-red-500">{{ reqForm.errors.requirement_text }}</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="mb-1.5 block">Display Order</label>
                        <input v-model.number="reqForm.order_index" type="number" />
                    </div>
                    <div class="flex items-end pb-1.5">
                        <label class="inline-flex cursor-pointer items-center gap-2.5" style="width:auto">
                            <input v-model="reqForm.is_active" type="checkbox"
                                style="width:auto;padding:0;border-radius:4px;box-shadow:none" class="h-4 w-4" />
                            <span class="text-sm font-semibold">Active</span>
                        </label>
                    </div>
                </div>
            </form>

            <div class="admin-modal-footer">
                <button type="button"
                    class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold hover:bg-muted transition-colors"
                    @click="showReqModal = false">
                    Cancel
                </button>
                <button type="button" :disabled="reqForm.processing"
                    class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-bold text-primary-foreground shadow-md hover:bg-primary/90 disabled:opacity-50 transition-colors"
                    @click="submitReq">
                    {{ reqForm.processing ? 'Saving...' : (editingReq ? 'Update' : 'Save Requirement') }}
                </button>
            </div>
        </div>
    </div>

</template>
