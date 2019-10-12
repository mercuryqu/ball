<?php

return [
    // app create page remove categories
    'remove_categories' => [1, 2],

    'wechat_share' => [
        // wechat app_id
        'app_id' => 'wxf1688d81cf5818b7',

        // wechat app_secret
        'app_secret' => '446e7a57e08977ef51b216b4be02087a',
        'ticket_token_expire_time' => '7100',

        'get_jsapi_ticket_url' => 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi',
        'get_access_token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential',
    ],
];