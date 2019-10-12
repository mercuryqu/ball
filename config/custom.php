<?php

return [
    // telephone regex
    'telephone_regex' => '/^1[345789][0-9]{9}$/',

    // app's logo save path
    'app_logos_save_path' => 'uploads/apps/logos/',
    'app_logos_max_size' => '20',
    'app_logos_width' => '100',
    'app_logos_height' => '100',

    // app's code save path
    'app_codes_save_path' => 'uploads/apps/codes/',
    'app_codes_max_size' => '30',
    'app_codes_width' => '200',
    'app_codes_height' => '200',

    // app's image save path
    'app_images_save_path' => 'uploads/apps/images/',
    'app_images_max_size' => '100',
    'app_images_width' => '420',
    'app_images_height' => '750',

    // topic's picture save path
    'topic_banners_save_path' => 'uploads/topics/banners/',
    'topic_pictures_save_path' => 'uploads/topics/pictures/',

    // category's icon save path
    'category_icons_save_path' => 'uploads/categories/icons/',
    'category_icons_max_size' => '10',
    'category_icons_width' => '70',
    'category_icons_height' => '70',

    // sms config
    'sms_url' => 'http://api.it-china.cn:8860/',
    'sms_custom_code' => '301529',
    'sms_password' => '5R2TPXWKYS',
    'sms_sp_code' => '',
    'sms_prefix' => '【球小栈】',

    // sms expire times(s)
    'sms_expire_time' => 1020,
    'sms_rand_code' => rand(100000, 999999),

    // default member avatar
    'member_default_name_prefix' => '球小栈_',
    'member_default_name_suffix' => base_convert(uniqid(), 8, 8),
    'member_default_avatar' => '/statics/wap/images/account-light.png',
    'member_default_status' => 1,   // default normal

    // ad's image save path
    'ad_images_save_path' => 'uploads/ads/images/',
    'ad_images_max_size' => '100',
    'ad_images_width' => '750',
    'ad_images_height' => '500',

    // default sort
    'default_sort' => 0,
];