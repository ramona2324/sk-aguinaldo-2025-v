<script setup lang="ts">
import TextLink from '@/components/TextLink.vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Users, UserCheck } from 'lucide-vue-next';
</script>

<template>
    <AuthBase title="Choose Registration Type" description="Select how you want to register with SK Aguinaldo">
        <Head title="Register" />

        <div class="flex flex-col gap-6">
            <div class="grid gap-4 md:grid-cols-2">
                <!-- SK Official Card -->
                <Link :href="route('register.official')" class="block transition-transform hover:scale-105">
                    <Card class="h-full cursor-pointer border-2 hover:border-primary/50 hover:shadow-md">
                        <CardHeader class="text-center">
                            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                                <UserCheck class="h-8 w-8 text-green-600 dark:text-green-400" />
                            </div>
                            <CardTitle class="text-xl">SK Official</CardTitle>
                            <CardDescription class="text-center">
                                Register as a Sangguniang Kabataan official to manage and oversee youth programs
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-2 text-sm text-muted-foreground">
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Manage SK programs</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Administrative access</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Organize community events</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </Link>

                <!-- SK Member Card -->
                <Link :href="route('register.member')" class="block transition-transform hover:scale-105">
                    <Card class="h-full cursor-pointer border-2 hover:border-primary/50 hover:shadow-md">
                        <CardHeader class="text-center">
                            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                                <Users class="h-8 w-8 text-blue-600 dark:text-blue-400" />
                            </div>
                            <CardTitle class="text-xl">SK Member</CardTitle>
                            <CardDescription class="text-center">
                                Register as a Sangguniang Kabataan member to participate in youth activities and programs
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-2 text-sm text-muted-foreground">
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Participate in SK programs</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Earn Points</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-1.5 w-1.5 rounded-full bg-current"></div>
                                    <span>Redeem Rewards</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </Link>
            </div>

            <div class="text-center text-sm text-muted-foreground">
                Already have an account?
                <TextLink :href="route('login')" class="underline underline-offset-4">Log in</TextLink>
            </div>
        </div>
    </AuthBase>
</template>
