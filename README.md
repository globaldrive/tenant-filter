# tenant-fIlter добавляет страницу настройки тенанта и сохраняет выбранный параметр в сессии

1)подключается в NovaServiceProvider

use Gd\TenantFilter\TenantFilter;

public function tools()
    {
        return [
            new TenantFilter,
        ];
    }
2) пример использования в фильтрах

public function default()
    {
        if (Session::get('globalTenantFilter')) {
            return Session::get('globalTenantFilter');
        }
    }
