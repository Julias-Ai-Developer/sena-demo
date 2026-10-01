<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    BookOpen,
    Globe,
    GraduationCap,
    Image,
    Inbox,
    LayoutGrid,
    Settings,
} from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Overview',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Site & Hero Content',
        href: '/dashboard/site-settings',
        icon: Settings,
    },
    {
        title: 'Academic Programs',
        href: '/dashboard/programs',
        icon: GraduationCap,
    },
    {
        title: 'Media & Campus Gallery',
        href: '/dashboard/gallery',
        icon: Image,
    },
    {
        title: 'Admissions & Intake',
        href: '/dashboard/admissions',
        icon: BookOpen,
    },
    {
        title: 'Parent Inquiries',
        href: '/dashboard/inquiries',
        icon: Inbox,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'View Public Website',
        href: '/',
        icon: Globe,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
