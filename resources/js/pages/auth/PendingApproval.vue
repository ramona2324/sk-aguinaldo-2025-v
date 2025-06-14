<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { Clock, Mail, RefreshCw } from 'lucide-vue-next';

const checkStatus = () => {
    router.reload({ only: ['auth'] });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <AuthBase title="Account Pending Approval" description="Your SK Official account is awaiting approval from the administrator">
        <Head title="Pending Approval" />

        <div class="flex flex-col gap-6">
            <Card class="border-amber-200 bg-amber-50 dark:border-amber-800 dark:bg-amber-950/20">
                <CardHeader class="text-center">
                    <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/20">
                        <Clock class="h-8 w-8 text-amber-600 dark:text-amber-400" />
                    </div>
                    <CardTitle class="text-xl text-amber-800 dark:text-amber-200">Approval Pending</CardTitle>
                    <CardDescription class="text-amber-700 dark:text-amber-300">
                        Your SK Official account registration has been submitted successfully
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div class="rounded-lg bg-white p-4 dark:bg-gray-900/50">
                        <h3 class="mb-2 font-medium text-gray-900 dark:text-gray-100">What happens next?</h3>
                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                            <li class="flex items-start gap-2">
                                <div class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500"></div>
                                <span>A superadmin will review your registration request</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500"></div>
                                <span>You will receive an email notification once approved</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="mt-1.5 h-1.5 w-1.5 rounded-full bg-amber-500"></div>
                                <span>After approval, you'll have access to the SK Official dashboard</span>
                            </li>
                        </ul>
                    </div>

                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4 dark:border-blue-800 dark:bg-blue-950/20">
                        <div class="flex items-start gap-3">
                            <Mail class="mt-0.5 h-5 w-5 text-blue-600 dark:text-blue-400" />
                            <div>
                                <h4 class="font-medium text-blue-800 dark:text-blue-200">Need help?</h4>
                                <p class="text-sm text-blue-700 dark:text-blue-300">
                                    If you have questions about your application, please contact the SK Aguinaldo administration office.
                                </p>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <div class="flex flex-col gap-3 sm:flex-row">
                <Button @click="checkStatus" variant="outline" class="flex-1">
                    <RefreshCw class="mr-2 h-4 w-4" />
                    Check Status
                </Button>
                <Button @click="logout" variant="secondary" class="flex-1">
                    Logout
                </Button>
            </div>
        </div>
    </AuthBase>
</template>