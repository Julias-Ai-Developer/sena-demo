<script setup lang="ts">
import { Head, router, useForm } from '@inertiajs/vue3';
import {
    Check,
    CheckCircle2,
    Edit2,
    GraduationCap,
    Plus,
    Trash2,
    X,
} from '@lucide/vue';
import { ref } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { BreadcrumbItem } from '@/types';

interface Program {
    id: number;
    tag: string;
    title: string;
    description: string;
    features: string[];
    link_label: string;
    link_url: string;
    icon: string;
    accent_bar: string;
    icon_bg: string;
    icon_color: string;
    label_color: string;
    link_color: string;
    order_index: number;
    is_active: boolean;
}

const props = defineProps<{
    programs: Program[];
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Academic Programs', href: '/dashboard/programs' },
];

const showModal = ref(false);
const editingProgram = ref<Program | null>(null);
const featureInput = ref('');

const form = useForm({
    tag: '',
    title: '',
    description: '',
    features: [] as string[],
    link_label: 'View Subject Combinations',
    link_url: '#admissions',
    icon: 'auto_stories',
    accent_bar: 'bg-primary',
    icon_bg: 'bg-primary-fixed',
    icon_color: 'text-primary',
    label_color: 'text-primary',
    link_color: 'text-primary',
    order_index: 0,
    is_active: true,
});

const openCreateModal = () => {
    editingProgram.value = null;
    form.reset();
    form.clearErrors();
    form.features = ['Core UNEB Subjects', 'Modern Laboratories', 'Expert Faculty'];
    form.order_index = props.programs.length + 1;
    form.is_active = true;
    showModal.value = true;
};

const openEditModal = (prog: Program) => {
    editingProgram.value = prog;
    form.clearErrors();
    form.tag = prog.tag;
    form.title = prog.title;
    form.description = prog.description;
    form.features = Array.isArray(prog.features) ? [...prog.features] : [];
    form.link_label = prog.link_label || 'View Subject Combinations';
    form.link_url = prog.link_url || '#admissions';
    form.icon = prog.icon || 'auto_stories';
    form.accent_bar = prog.accent_bar || 'bg-primary';
    form.icon_bg = prog.icon_bg || 'bg-primary-fixed';
    form.icon_color = prog.icon_color || 'text-primary';
    form.label_color = prog.label_color || 'text-primary';
    form.link_color = prog.link_color || 'text-primary';
    form.order_index = prog.order_index;
    form.is_active = Boolean(prog.is_active);
    showModal.value = true;
};

const addFeature = () => {
    if (featureInput.value.trim()) {
        form.features.push(featureInput.value.trim());
        featureInput.value = '';
    }
};

const removeFeature = (index: number) => {
    form.features.splice(index, 1);
};

const submitProgram = () => {
    if (editingProgram.value) {
        form.put(`/dashboard/programs/${editingProgram.value.id}`, {
            onSuccess: () => {
                showModal.value = false;
            },
        });
    } else {
        form.post('/dashboard/programs', {
            onSuccess: () => {
                showModal.value = false;
            },
        });
    }
};

const deleteProgram = (prog: Program) => {
    if (confirm(`Are you sure you want to delete "${prog.title}"?`)) {
        router.delete(`/dashboard/programs/${prog.id}`);
    }
};
</script>

<template>
        <Head title="Academic Programs Manager" />

        <div class="flex flex-1 flex-col gap-6 p-4 sm:p-6 lg:p-8">
            <!-- Header Action Bar -->
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-foreground">Academic Programs & Syllabi</h1>
                    <p class="text-sm text-muted-foreground">Manage curriculum levels (UCE O-Level, UACE A-Level Sciences & Arts, Vocational Hubs).</p>
                </div>
                <button
                    type="button"
                    class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-xs font-bold text-primary-foreground shadow-md transition-all hover:bg-primary/90"
                    @click="openCreateModal"
                >
                    <Plus class="h-4 w-4" />
                    <span>Add New Program</span>
                </button>
            </div>

            <!-- Program Cards Grid -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div
                    v-for="prog in programs"
                    :key="prog.id"
                    class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-border/60 bg-card shadow-xs transition-all hover:border-primary/50 hover:shadow-lg"
                    :class="{ 'opacity-60': !prog.is_active }"
                >
                    <!-- Top accent bar -->
                    <div class="h-2.5 bg-primary"></div>

                    <div class="flex flex-1 flex-col p-6">
                        <div class="mb-3 flex items-center justify-between">
                            <span class="rounded-md bg-primary/10 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-primary">
                                {{ prog.tag }}
                            </span>
                            <span v-if="!prog.is_active" class="text-[10px] font-bold text-amber-600">Draft</span>
                        </div>

                        <h3 class="text-base font-bold text-foreground">{{ prog.title }}</h3>
                        <p class="mt-2 text-xs text-muted-foreground line-clamp-3 leading-relaxed">{{ prog.description }}</p>

                        <!-- Feature bullets -->
                        <div class="mt-4 flex-1 space-y-1.5 border-t border-border/50 pt-3">
                            <div
                                v-for="(feat, idx) in prog.features"
                                :key="idx"
                                class="flex items-start gap-1.5 text-xs text-foreground/90"
                            >
                                <CheckCircle2 class="h-3.5 w-3.5 shrink-0 text-secondary mt-0.5" />
                                <span>{{ feat }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer actions -->
                    <div class="flex items-center justify-between border-t border-border/50 bg-muted/20 px-6 py-3">
                        <span class="text-[11px] font-semibold text-primary">{{ prog.link_label }}</span>
                        <div class="flex items-center gap-1">
                            <button
                                type="button"
                                class="rounded-lg p-1.5 text-muted-foreground hover:bg-muted hover:text-primary"
                                @click="openEditModal(prog)"
                            >
                                <Edit2 class="h-4 w-4" />
                            </button>
                            <button
                                type="button"
                                class="rounded-lg p-1.5 text-muted-foreground hover:bg-red-500/10 hover:text-red-600"
                                @click="deleteProgram(prog)"
                            >
                                <Trash2 class="h-4 w-4" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create / Edit Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 p-4 backdrop-blur-sm"
        >
            <div class="admin-modal w-full max-w-2xl">
                <div class="admin-modal-header">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary/10">
                            <GraduationCap class="h-4 w-4 text-primary" />
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-foreground">
                                {{ editingProgram ? 'Edit Academic Program' : 'Create New Academic Program' }}
                            </h3>
                            <p class="text-xs text-muted-foreground">{{ editingProgram ? 'Update the program details below' : 'Define a new curriculum program' }}</p>
                        </div>
                    </div>
                    <button
                        type="button"
                        class="flex h-8 w-8 items-center justify-center rounded-full text-muted-foreground hover:bg-muted hover:text-foreground transition-colors"
                        @click="showModal = false"
                    >
                        <X class="h-4 w-4" />
                    </button>
                </div>

                <form class="admin-modal-body space-y-5" @submit.prevent="submitProgram">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block">Program Level Tag <span class="text-red-500">*</span></label>
                            <input
                                v-model="form.tag"
                                type="text"
                                required
                                placeholder="e.g. UCE • Senior 1 - 4"
                            />
                        </div>
                        <div>
                            <label class="mb-1.5 block">Program Title <span class="text-red-500">*</span></label>
                            <input
                                v-model="form.title"
                                type="text"
                                required
                                placeholder="e.g. Lower Secondary Curriculum"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="mb-1.5 block">Description <span class="text-red-500">*</span></label>
                        <textarea
                            v-model="form.description"
                            required
                            rows="3"
                            placeholder="Competence-based curriculum focusing on practical problem solving..."
                        ></textarea>
                    </div>

                    <!-- Key Feature Bullet Points -->
                    <div>
                        <label class="mb-1.5 block">Key Feature Bullets</label>
                        <div class="flex gap-2">
                            <input
                                v-model="featureInput"
                                type="text"
                                placeholder="Add a feature point (e.g. PCB / BCM Medical track)..."
                                @keydown.enter.prevent="addFeature"
                            />
                            <button
                                type="button"
                                class="shrink-0 rounded-xl bg-secondary px-4 py-2 text-sm font-semibold text-secondary-foreground hover:bg-secondary/80 transition-colors"
                                style="width:auto"
                                @click="addFeature"
                            >
                                Add
                            </button>
                        </div>

                        <div class="mt-2 space-y-1.5">
                            <div
                                v-for="(feat, idx) in form.features"
                                :key="idx"
                                class="flex items-center justify-between rounded-xl border border-border/70 bg-muted/30 px-4 py-2 text-sm"
                            >
                                <span class="font-medium text-foreground">{{ feat }}</span>
                                <button
                                    type="button"
                                    class="ml-2 shrink-0 rounded-lg p-1 text-muted-foreground hover:bg-red-500/10 hover:text-red-600 transition-colors"
                                    @click="removeFeature(idx)"
                                >
                                    <X class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block">Call to Action Link Label</label>
                            <input
                                v-model="form.link_label"
                                type="text"
                                placeholder="e.g. View UCE Subject Combinations"
                            />
                        </div>
                        <div>
                            <label class="mb-1.5 block">Material Icon Name</label>
                            <input
                                v-model="form.icon"
                                type="text"
                                placeholder="auto_stories, biotech, account_balance, developer_board"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block">Display Order Index</label>
                            <input
                                v-model.number="form.order_index"
                                type="number"
                            />
                        </div>
                        <div class="flex items-end pb-1">
                            <label class="inline-flex cursor-pointer items-center gap-2.5" style="width:auto">
                                <input
                                    v-model="form.is_active"
                                    type="checkbox"
                                    style="width:auto;padding:0;border-radius:4px;box-shadow:none"
                                    class="h-4 w-4"
                                />
                                <span class="text-sm font-semibold">Active & Published</span>
                            </label>
                        </div>
                    </div>
                </form>

                <div class="admin-modal-footer">
                    <button
                        type="button"
                        class="rounded-xl border border-border px-5 py-2.5 text-sm font-semibold hover:bg-muted transition-colors"
                        @click="showModal = false"
                    >
                        Cancel
                    </button>
                    <button
                        type="button"
                        :disabled="form.processing"
                        class="inline-flex items-center gap-2 rounded-xl bg-primary px-6 py-2.5 text-sm font-bold text-primary-foreground shadow-md hover:bg-primary/90 disabled:opacity-50 transition-colors"
                        @click="submitProgram"
                    >
                        <Check class="h-4 w-4" />
                        <span>{{ form.processing ? 'Saving...' : (editingProgram ? 'Update Program' : 'Create Program') }}</span>
                    </button>
                </div>
            </div>
        </div>

</template>
