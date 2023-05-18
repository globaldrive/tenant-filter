<template>
    <div>

        <Head title="Настройки" />

        <Heading class="mb-6">Настройки</Heading>

        <Card class="flex items-center justify-center h-10">
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
            selected: false,
            tenants: [],
        }
    },
    mounted() {
        this.getTenants();
        this.getSelectedTanant();
    },
    methods: {
        getTenants() {
            Nova.request().get('/nova-vendor/tenant-filter/tenants').then(response => {
                this.tenants = response.data;
            });
        },
        getSelectedTanant() {
            Nova.request().get('/nova-vendor/tenant-filter/tenants/globalTenantFilter').then(response => {
                this.selected = response.data.tenant_id;
            });
        },
        onChange(event) {
            Nova.request().post('/nova-vendor/tenant-filter/tenants/globalTenantFilter', {tenant_id:event}).then();
        }
    },
}
</script>
