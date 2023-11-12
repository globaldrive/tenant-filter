<template>
    <div>

        <Head title="Настройки" />

        <Heading class="mb-6">Настройки</Heading>

        <Card class="flex items-center justify-center h-10">
            <span class="pr-2">
                Активный фильтр тенанта:
            </span>
            
            <div class="">
                <select 
                  v-model="selected" 
                  @change="onChange(selected)"
                  class="block form-control form-select form-select-bordered"
                >
                    <option 
                      :value="false"
                      disabled
                    >
                      Не выбран
                    </option>
                    <option v-for="tenant in tenants" :value="tenant.id">
                        {{ tenant.slug }}
                    </option>
                </select>
                <svg class="flex-shrink-0 pointer-events-none form-select-arrow" xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6"><path class="fill-current" d="M8.292893.292893c.390525-.390524 1.023689-.390524 1.414214 0 .390524.390525.390524 1.023689 0 1.414214l-4 4c-.390525.390524-1.023689.390524-1.414214 0l-4-4c-.390524-.390525-.390524-1.023689 0-1.414214.390525-.390524 1.023689-.390524 1.414214 0L5 3.585786 8.292893.292893z"></path></svg>
            </div>
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
