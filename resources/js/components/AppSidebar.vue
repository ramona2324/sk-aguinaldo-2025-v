<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, Folder, Shield, Users, UserCheck, Calendar, FileText, Settings, BarChart3 } from 'lucide-vue-next';
import { computed } from 'vue';
import AppLogo from './AppLogo.vue';

const page = usePage();
const auth = computed(() => page.props.auth);

// Dynamic dashboard configuration based on user type
const dashboardConfig = computed(() => {
    const userType = auth.value.user?.user_type;

    switch (userType) {
        case 'superadmin':
            return {
                title: 'Super Admin Dashboard',
                href: '/superadmin/dashboard',
                icon: Shield,
            };
        case 'official':
            return {
                title: 'SK Official Dashboard',
                href: '/official/dashboard',
                icon: UserCheck,
            };
        case 'member':
        default:
            return {
                title: 'Member Dashboard',
                href: '/dashboard',
                icon: Users,
            };
    }
});

// Dynamic main navigation items based on user type
const mainNavItems = computed((): NavItem[] => {
    const userType = auth.value.user?.user_type;

    const items: NavItem[] = [
        {
            title: dashboardConfig.value.title,
            href: dashboardConfig.value.href,
            icon: dashboardConfig.value.icon,
        },
    ];

    // Add role-specific navigation items
    if (userType === 'superadmin') {
        items.push(
            {
                title: 'Pending Approvals',
                href: '/pending/approvals',
                icon: UserCheck,
            },
            {
                title: 'User Management',
                // href: '/superadmin/users',
                href: '#',
                icon: Users,
            },
            {
                title: 'System Settings',
                // href: '/superadmin/settings',
                href: '#',
                icon: Settings,
            },
            {
                title: 'Reports & Analytics',
                // href: '/superadmin/reports',
                href: '#',
                icon: BarChart3,
            }
        );
    } else if (userType === 'official') {
        items.push(
            {
                title: 'SK Programs',
                href: '/official/programs',
                icon: Calendar,
            },
            {
                title: 'Member Management',
                href: '/official/members',
                icon: Users,
            },
            {
                title: 'Documents',
                href: '/official/documents',
                icon: FileText,
            },
            {
                title: 'Reports',
                href: '/official/reports',
                icon: BarChart3,
            }
        );
    } else if (userType === 'member') {
        items.push(
            {
                title: 'My Programs',
                href: '/member/programs',
                icon: Calendar,
            },
            {
                title: 'Documents',
                href: '/member/documents',
                icon: FileText,
            },
            {
                title: 'Profile',
                href: '/member/profile',
                icon: Users,
            }
        );
    }

    return items;
});

// const mainNavItems: NavItem[] = [
//     {
//         title: 'Dashboard',
//         href: '/dashboard',
//         icon: LayoutGrid,
//     },
// ];

const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];

// const footerNavItems: NavItem[] = [
//     {
//         title: 'Github Repo',
//         href: 'https://github.com/laravel/vue-starter-kit',
//         icon: Folder,
//     },
//     {
//         title: 'Documentation',
//         href: 'https://laravel.com/docs/starter-kits#vue',
//         icon: BookOpen,
//     },
// ];

// Dynamic logo link based on user type
const logoHref = computed(() => dashboardConfig.value.href);
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="logoHref">
                            <AppLogo />
                        </Link>
<!--                        <Link :href="route('dashboard')">-->
<!--                            <AppLogo />-->
<!--                        </Link>-->
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
