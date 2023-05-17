<template>
    <div>

        <Head title="Настройки" />

        <Heading class="mb-6">Настройки</Heading>

        <Card class="flex items-center justify-center" style="min-height: 300px">
            <span class="pr-2">
                Активный фильтр тенанта:
            </span>
            <select v-model="selected" @change="onChange(selected)">
                <option :value="false">Не выбран</option>
                <option v-for="tenant in tenants" :value="tenant.id">
                    {{ tenant.slug }}
                </option>
            </select>

        </Card>
    </div>
</template>

<script>

export default {
    data() {
        return {
            selected: 0,
            tenants: [],
        }
    },
    mounted() {
        this.getRoutes();
    },
    methods: {
        getRoutes() {
            Nova.request().get('/nova-vendor/tenant-filter/tenants').then(response => {
                this.tenants = response.data.tenants;
                this.selected = response.data.globalTenantFilter;
            });
        },
        onChange(event) {
            Nova.request().post('/nova-vendor/tenant-filter/set-global-tenant-filter', {globalTenantFilter:event}).then();
        }
    },
}
</script>

<style>
/* Scoped Styles */
</style>
