<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 37,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 38,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 39,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 40,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 41,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 42,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 43,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 44,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 45,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 46,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 47,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 48,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 49,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 50,
                'title' => 'expense_create',
            ],
            [
                'id'    => 51,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 52,
                'title' => 'expense_show',
            ],
            [
                'id'    => 53,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 54,
                'title' => 'expense_access',
            ],
            [
                'id'    => 55,
                'title' => 'income_create',
            ],
            [
                'id'    => 56,
                'title' => 'income_edit',
            ],
            [
                'id'    => 57,
                'title' => 'income_show',
            ],
            [
                'id'    => 58,
                'title' => 'income_delete',
            ],
            [
                'id'    => 59,
                'title' => 'income_access',
            ],
            [
                'id'    => 60,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 61,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 62,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 63,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 64,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 65,
                'title' => 'setting_create',
            ],
            [
                'id'    => 66,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 67,
                'title' => 'setting_show',
            ],
            [
                'id'    => 68,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 69,
                'title' => 'setting_access',
            ],
            [
                'id'    => 70,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 71,
                'title' => 'product_favorite_access',
            ],
            [
                'id'    => 72,
                'title' => 'product_rate_show',
            ],
            [
                'id'    => 73,
                'title' => 'product_rate_delete',
            ],
            [
                'id'    => 74,
                'title' => 'product_rate_access',
            ],
            [
                'id'    => 75,
                'title' => 'offer_create',
            ],
            [
                'id'    => 76,
                'title' => 'offer_edit',
            ],
            [
                'id'    => 77,
                'title' => 'offer_show',
            ],
            [
                'id'    => 78,
                'title' => 'offer_delete',
            ],
            [
                'id'    => 79,
                'title' => 'offer_access',
            ],
            [
                'id'    => 80,
                'title' => 'offer_management_access',
            ],
            [
                'id'    => 81,
                'title' => 'offer_rate_show',
            ],
            [
                'id'    => 82,
                'title' => 'offer_rate_delete',
            ],
            [
                'id'    => 83,
                'title' => 'offer_rate_access',
            ],
            [
                'id'    => 84,
                'title' => 'offer_favorite_access',
            ],
            [
                'id'    => 85,
                'title' => 'order_create',
            ],
            [
                'id'    => 86,
                'title' => 'order_edit',
            ],
            [
                'id'    => 87,
                'title' => 'order_show',
            ],
            [
                'id'    => 88,
                'title' => 'order_delete',
            ],
            [
                'id'    => 89,
                'title' => 'order_access',
            ],
            [
                'id'    => 90,
                'title' => 'slider_create',
            ],
            [
                'id'    => 91,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 92,
                'title' => 'slider_show',
            ],
            [
                'id'    => 93,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 94,
                'title' => 'slider_access',
            ],
            [
                'id'    => 95,
                'title' => 'service_create',
            ],
            [
                'id'    => 96,
                'title' => 'service_edit',
            ],
            [
                'id'    => 97,
                'title' => 'service_show',
            ],
            [
                'id'    => 98,
                'title' => 'service_delete',
            ],
            [
                'id'    => 99,
                'title' => 'service_access',
            ],
            [
                'id'    => 100,
                'title' => 'product_cart_access',
            ],
            [
                'id'    => 101,
                'title' => 'district_create',
            ],
            [
                'id'    => 102,
                'title' => 'district_edit',
            ],
            [
                'id'    => 103,
                'title' => 'district_show',
            ],
            [
                'id'    => 104,
                'title' => 'district_delete',
            ],
            [
                'id'    => 105,
                'title' => 'district_access',
            ],
            [
                'id'    => 106,
                'title' => 'city_create',
            ],
            [
                'id'    => 107,
                'title' => 'city_edit',
            ],
            [
                'id'    => 108,
                'title' => 'city_show',
            ],
            [
                'id'    => 109,
                'title' => 'city_delete',
            ],
            [
                'id'    => 110,
                'title' => 'city_access',
            ],
            [
                'id'    => 111,
                'title' => 'cities_and_district_access',
            ],
            [
                'id'    => 112,
                'title' => 'link_create',
            ],
            [
                'id'    => 113,
                'title' => 'link_edit',
            ],
            [
                'id'    => 114,
                'title' => 'link_show',
            ],
            [
                'id'    => 115,
                'title' => 'link_delete',
            ],
            [
                'id'    => 116,
                'title' => 'link_access',
            ],
            [
                'id'    => 117,
                'title' => 'offer_cart_access',
            ],
            [
                'id'    => 118,
                'title' => 'supplier_create',
            ],
            [
                'id'    => 119,
                'title' => 'supplier_edit',
            ],
            [
                'id'    => 120,
                'title' => 'supplier_show',
            ],
            [
                'id'    => 121,
                'title' => 'supplier_delete',
            ],
            [
                'id'    => 122,
                'title' => 'supplier_access',
            ],
            [
                'id'    => 123,
                'title' => 'delegate_create',
            ],
            [
                'id'    => 124,
                'title' => 'delegate_edit',
            ],
            [
                'id'    => 125,
                'title' => 'delegate_show',
            ],
            [
                'id'    => 126,
                'title' => 'delegate_delete',
            ],
            [
                'id'    => 127,
                'title' => 'delegate_access',
            ],
            [
                'id'    => 128,
                'title' => 'client_create',
            ],
            [
                'id'    => 129,
                'title' => 'client_edit',
            ],
            [
                'id'    => 130,
                'title' => 'client_show',
            ],
            [
                'id'    => 131,
                'title' => 'client_delete',
            ],
            [
                'id'    => 132,
                'title' => 'client_access',
            ],
            [
                'id'    => 133,
                'title' => 'money_request_create',
            ],
            [
                'id'    => 134,
                'title' => 'money_request_edit',
            ],
            [
                'id'    => 135,
                'title' => 'money_request_show',
            ],
            [
                'id'    => 136,
                'title' => 'money_request_delete',
            ],
            [
                'id'    => 137,
                'title' => 'money_request_access',
            ],
            [
                'id'    => 138,
                'title' => 'target_create',
            ],
            [
                'id'    => 139,
                'title' => 'target_edit',
            ],
            [
                'id'    => 140,
                'title' => 'target_show',
            ],
            [
                'id'    => 141,
                'title' => 'target_delete',
            ],
            [
                'id'    => 142,
                'title' => 'target_access',
            ],
            [
                'id'    => 143,
                'title' => 'delegates_managment_access',
            ],
            [
                'id'    => 144,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
