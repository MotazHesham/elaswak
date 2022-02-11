<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'approved'                 => 'Approved',
            'approved_helper'          => ' ',
            'last_name'                => 'Last Name',
            'last_name_helper'         => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'district'                 => 'District',
            'district_helper'          => ' ',
            'city'                     => 'City',
            'city_helper'              => ' ',
            'zip_code'                 => 'Zip Code',
            'zip_code_helper'          => ' ',
            'address'                  => 'Address',
            'address_helper'           => ' ',
            'user_type'                => 'User Type',
            'user_type_helper'         => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
        ],
    ],
    'productManagement' => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'productCategory' => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'productTag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'product' => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'category'           => 'Categories',
            'category_helper'    => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'active'             => 'Active',
            'active_helper'      => ' ',
            'supplier'           => 'Supplier',
            'supplier_helper'    => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'expenseManagement' => [
        'title'          => 'المصاريف',
        'title_singular' => 'المصاريف',
    ],
    'expenseCategory' => [
        'title'          => 'تصنيف النفقات',
        'title_singular' => 'تصنيف المصاريف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incomeCategory' => [
        'title'          => 'تصنيفات الإيراد',
        'title_singular' => 'الإيراد حسب التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
        ],
    ],
    'expense' => [
        'title'          => 'المصروفات',
        'title_singular' => 'المصروف',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'expense_category'        => 'Expense Category',
            'expense_category_helper' => ' ',
            'entry_date'              => 'Entry Date',
            'entry_date_helper'       => ' ',
            'amount'                  => 'Amount',
            'amount_helper'           => ' ',
            'description'             => 'Description',
            'description_helper'      => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated At',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted At',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'income' => [
        'title'          => 'الإيرادات',
        'title_singular' => 'الإيرادات',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'income_category'        => 'Income Category',
            'income_category_helper' => ' ',
            'entry_date'             => 'Entry Date',
            'entry_date_helper'      => ' ',
            'amount'                 => 'Amount',
            'amount_helper'          => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated At',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted At',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'expenseReport' => [
        'title'          => 'تقرير شهري',
        'title_singular' => 'تقرير شهري',
        'reports'        => [
            'title'             => 'التقارير',
            'title_singular'    => 'تقرير',
            'incomeReport'      => 'تقرير الإيرادات',
            'incomeByCategory'  => 'الإيراد حسب التصنيف',
            'expenseByCategory' => 'المصروف حسب التصنيف',
            'income'            => 'الإيرادات',
            'expense'           => 'المصروف',
            'profit'            => 'ربح',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'email'                       => 'البريد الألكتروني',
            'email_helper'                => ' ',
            'phone'                       => 'الجوال',
            'phone_helper'                => ' ',
            'address'                     => 'العنوان',
            'address_helper'              => ' ',
            'facebook'                    => 'Facebook',
            'facebook_helper'             => ' ',
            'instagram'                   => 'Instagram',
            'instagram_helper'            => ' ',
            'whatsapp'                    => 'Whatsapp',
            'whatsapp_helper'             => ' ',
            'about_us'                    => 'About Us',
            'about_us_helper'             => ' ',
            'created_at'                  => 'Created at',
            'created_at_helper'           => ' ',
            'updated_at'                  => 'Updated at',
            'updated_at_helper'           => ' ',
            'deleted_at'                  => 'Deleted at',
            'deleted_at_helper'           => ' ',
            'terms_and_conditions'        => 'Terms And Conditions',
            'terms_and_conditions_helper' => ' ',
            'discount'                    => 'Discount',
            'discount_helper'             => ' ',
        ],
    ],
    'generalSetting' => [
        'title'          => 'General Settings',
        'title_singular' => 'General Setting',
    ],
    'productFavorite' => [
        'title'          => 'Product Favorites',
        'title_singular' => 'Product Favorite',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'productRate' => [
        'title'          => 'Product Rates',
        'title_singular' => 'Product Rate',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'rate'              => 'Rate',
            'rate_helper'       => ' ',
            'review'            => 'Review',
            'review_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'offer' => [
        'title'          => 'Offers',
        'title_singular' => 'Offer',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'category'           => 'Categories',
            'category_helper'    => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'products'           => 'Products',
            'products_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'active'             => 'Active',
            'active_helper'      => ' ',
            'supplier'           => 'Supplier',
            'supplier_helper'    => ' ',
            'start_date'         => 'Start Date',
            'start_date_helper'  => ' ',
            'end_date'           => 'End Date',
            'end_date_helper'    => ' ',
        ],
    ],
    'offerManagement' => [
        'title'          => 'Offer Management',
        'title_singular' => 'Offer Management',
    ],
    'offerRate' => [
        'title'          => 'Offer Rates',
        'title_singular' => 'Offer Rate',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'offer'             => 'Offer',
            'offer_helper'      => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'rate'              => 'Rate',
            'rate_helper'       => ' ',
            'review'            => 'Review',
            'review_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'offerFavorite' => [
        'title'          => 'Offer Favorites',
        'title_singular' => 'Offer Favorite',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'offer'             => 'Offer',
            'offer_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'order' => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'user'                   => 'User',
            'user_helper'            => ' ',
            'first_name'             => 'First Name',
            'first_name_helper'      => ' ',
            'last_name'              => 'Last Name',
            'last_name_helper'       => ' ',
            'phone'                  => 'Phone',
            'phone_helper'           => ' ',
            'email'                  => 'email',
            'email_helper'           => ' ',
            'zip_code'               => 'Zip Code',
            'zip_code_helper'        => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'products'               => 'Products',
            'products_helper'        => ' ',
            'offers'                 => 'Offers',
            'offers_helper'          => ' ',
            'payment_type'           => 'Payment Type',
            'payment_type_helper'    => ' ',
            'payment_status'         => 'Payment Status',
            'payment_status_helper'  => ' ',
            'delivery_status'        => 'Delivery Status',
            'delivery_status_helper' => ' ',
            'cancel_reason'          => 'Cancel Reason',
            'cancel_reason_helper'   => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'discount_code'          => 'Discount Code',
            'discount_code_helper'   => ' ',
            'district'               => 'District',
            'district_helper'        => ' ',
            'city'                   => 'City',
            'city_helper'            => ' ',
        ],
    ],
    'slider' => [
        'title'          => 'Sliders',
        'title_singular' => 'Slider',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'slider'            => 'Slider',
            'slider_helper'     => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'active'            => 'Active',
            'active_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'service' => [
        'title'          => 'Services',
        'title_singular' => 'Service',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'productCart' => [
        'title'          => 'Product Carts',
        'title_singular' => 'Product Cart',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'product'           => 'Product',
            'product_helper'    => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'district' => [
        'title'          => 'Districts',
        'title_singular' => 'District',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name In Arabic',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name In English',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'city' => [
        'title'          => 'Cities',
        'title_singular' => 'City',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'name_ar'              => 'Name Ar',
            'name_ar_helper'       => ' ',
            'name_en'              => 'Name En',
            'name_en_helper'       => ' ',
            'district'             => 'District',
            'district_helper'      => ' ',
            'delivery'             => 'Delivery',
            'delivery_helper'      => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'delivery_cost'        => 'Delivery Cost',
            'delivery_cost_helper' => ' ',
        ],
    ],
    'citiesAndDistrict' => [
        'title'          => 'Cities And Districts',
        'title_singular' => 'Cities And District',
    ],
    'link' => [
        'title'          => 'Links',
        'title_singular' => 'Link',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'offerCart' => [
        'title'          => 'Offer Carts',
        'title_singular' => 'Offer Cart',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'offer'             => 'Offer',
            'offer_helper'      => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'supplier' => [
        'title'          => 'Suppliers',
        'title_singular' => 'Supplier',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'company_name'             => 'Company Name',
            'company_name_helper'      => ' ',
            'commerical_num'           => 'Commerical Num',
            'commerical_num_helper'    => ' ',
            'commerical_expiry'        => 'Commerical Expiry',
            'commerical_expiry_helper' => ' ',
            'licence_num'              => 'Licence Num',
            'licence_num_helper'       => ' ',
            'licence_expiry'           => 'Licence Expiry',
            'licence_expiry_helper'    => ' ',
        ],
    ],
    'delegate' => [
        'title'          => 'Delegates',
        'title_singular' => 'Delegate',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'discount_code'        => 'Discount Code',
            'discount_code_helper' => ' ',
            'user'                 => 'User',
            'user_helper'          => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'facebook'             => 'Facebook',
            'facebook_helper'      => ' ',
            'instagram'            => 'Instagram',
            'instagram_helper'     => ' ',
            'youtube'              => 'Youtube',
            'youtube_helper'       => ' ',
        ],
    ],
    'client' => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
