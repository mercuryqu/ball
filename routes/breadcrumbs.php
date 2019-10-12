<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/**
 * Home Page
 */
Breadcrumbs::register('admin.home', function ($breadcrumbs) {
    $breadcrumbs->push('首页', route('admin.home'));
});

/**
 * Apps modules
 */
Breadcrumbs::register('admin.apps', function ($breadcrumbs) {
    $breadcrumbs->push('小程序管理', route('admin.apps.index'));
});
Breadcrumbs::register('admin.apps.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.apps');
    $breadcrumbs->push('小程序列表', route('admin.apps.index'));
});
Breadcrumbs::register('admin.apps.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.apps');
    $breadcrumbs->push('添加小程序', route('admin.apps.create'));
});
Breadcrumbs::register('admin.apps.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.apps');
    $breadcrumbs->push('编辑小程序', route('admin.apps.edit', $app->id));
});

/**
 * Topics modules
 */
Breadcrumbs::register('admin.topics', function ($breadcrumbs) {
    $breadcrumbs->push('专题管理', route('admin.topics.index'));
});
Breadcrumbs::register('admin.topics.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.topics');
    $breadcrumbs->push('专题列表', route('admin.topics.index'));
});
Breadcrumbs::register('admin.topics.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.topics');
    $breadcrumbs->push('添加专题', route('admin.topics.create'));
});
Breadcrumbs::register('admin.topics.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.topics');
    $breadcrumbs->push('编辑专题', route('admin.topics.edit', $app->id));
});

/**
 * Members modules
 */
Breadcrumbs::register('admin.members', function ($breadcrumbs) {
    $breadcrumbs->push('会员管理', route('admin.members.index'));
});
Breadcrumbs::register('admin.members.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.members');
    $breadcrumbs->push('会员列表', route('admin.members.index'));
});
Breadcrumbs::register('admin.members.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.members');
    $breadcrumbs->push('添加会员', route('admin.members.create'));
});
Breadcrumbs::register('admin.members.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.members');
    $breadcrumbs->push('编辑会员', route('admin.members.edit', $app->id));
});

/**
 * Ad_positions modules
 */
Breadcrumbs::register('admin.ad_positions', function ($breadcrumbs) {
    $breadcrumbs->push('广告位管理', route('admin.ad_positions.index'));
});
Breadcrumbs::register('admin.ad_positions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.ad_positions');
    $breadcrumbs->push('广告位列表', route('admin.ad_positions.index'));
});
Breadcrumbs::register('admin.ad_positions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.ad_positions');
    $breadcrumbs->push('添加广告位', route('admin.ad_positions.create'));
});
Breadcrumbs::register('admin.ad_positions.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.ad_positions');
    $breadcrumbs->push('编辑广告位', route('admin.ad_positions.edit', $app->id));
});

/**
 * Comments modules
 */
Breadcrumbs::register('admin.comments', function ($breadcrumbs) {
    $breadcrumbs->push('评论管理', route('admin.comments.index'));
});
Breadcrumbs::register('admin.comments.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.comments');
    $breadcrumbs->push('评论列表', route('admin.comments.index'));
});
Breadcrumbs::register('admin.comments.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.comments');
    $breadcrumbs->push('添加评论', route('admin.comments.create'));
});
Breadcrumbs::register('admin.comments.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.comments');
    $breadcrumbs->push('编辑评论', route('admin.comments.edit', $app->id));
});

/**
 * Replies modules
 */
Breadcrumbs::register('admin.replies', function ($breadcrumbs) {
    $breadcrumbs->push('回复管理', route('admin.replies.index'));
});
Breadcrumbs::register('admin.replies.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.replies');
    $breadcrumbs->push('回复列表', route('admin.replies.index'));
});
Breadcrumbs::register('admin.replies.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.replies');
    $breadcrumbs->push('添加回复', route('admin.replies.create'));
});
Breadcrumbs::register('admin.replies.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.replies');
    $breadcrumbs->push('编辑回复', route('admin.replies.edit', $app->id));
});

/**
 * Replies modules
 */
Breadcrumbs::register('admin.sms', function ($breadcrumbs) {
    $breadcrumbs->push('短信记录', route('admin.sms.index'));
});
Breadcrumbs::register('admin.sms.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.sms');
    $breadcrumbs->push('短信列表', route('admin.sms.index'));
});

/**
 * Categories modules
 */
Breadcrumbs::register('admin.categories', function ($breadcrumbs) {
    $breadcrumbs->push('分类管理', route('admin.categories.index'));
});
Breadcrumbs::register('admin.categories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push('分类列表', route('admin.categories.index'));
});
Breadcrumbs::register('admin.categories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push('添加分类', route('admin.categories.create'));
});
Breadcrumbs::register('admin.categories.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.categories');
    $breadcrumbs->push('编辑分类', route('admin.categories.edit', $app->id));
});

/**
 * Ads modules
 */
Breadcrumbs::register('admin.ads', function ($breadcrumbs) {
    $breadcrumbs->push('广告管理', route('admin.ads.index'));
});
Breadcrumbs::register('admin.ads.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.ads');
    $breadcrumbs->push('广告列表', route('admin.ads.index'));
});
Breadcrumbs::register('admin.ads.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.ads');
    $breadcrumbs->push('添加广告', route('admin.ads.create'));
});
Breadcrumbs::register('admin.ads.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.ads');
    $breadcrumbs->push('编辑广告', route('admin.ads.edit', $app->id));
});

/**
 * Keywords modules
 */
Breadcrumbs::register('admin.keywords', function ($breadcrumbs) {
    $breadcrumbs->push('关键词管理', route('admin.keywords.index'));
});
Breadcrumbs::register('admin.keywords.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.keywords');
    $breadcrumbs->push('关键词列表', route('admin.keywords.index'));
});
Breadcrumbs::register('admin.keywords.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.keywords');
    $breadcrumbs->push('添加关键词', route('admin.keywords.create'));
});
Breadcrumbs::register('admin.keywords.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.keywords');
    $breadcrumbs->push('编辑关键词', route('admin.keywords.edit', $app->id));
});

/**
 * Modules modules
 */
Breadcrumbs::register('admin.modules', function ($breadcrumbs) {
    $breadcrumbs->push('模块管理', route('admin.modules.index'));
});
Breadcrumbs::register('admin.modules.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.modules');
    $breadcrumbs->push('模块列表', route('admin.modules.index'));
});
Breadcrumbs::register('admin.modules.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.modules');
    $breadcrumbs->push('添加模块', route('admin.modules.create'));
});
Breadcrumbs::register('admin.modules.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.modules');
    $breadcrumbs->push('编辑模块', route('admin.modules.edit', $app->id));
});

/**
 * Modulegables modules
 */
Breadcrumbs::register('admin.modulegables', function ($breadcrumbs) {
    $breadcrumbs->push('模块关联管理', route('admin.modulegables.index'));
});
Breadcrumbs::register('admin.modulegables.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.modulegables');
    $breadcrumbs->push('模块关联列表', route('admin.modulegables.index'));
});
Breadcrumbs::register('admin.modulegables.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.modulegables');
    $breadcrumbs->push('编辑模块关联', route('admin.modulegables.edit', $app->id));
});

/**
 * AppCategory modules
 */
Breadcrumbs::register('admin.app_category', function ($breadcrumbs) {
    $breadcrumbs->push('小程序和分类关联管理', route('admin.app_category.index'));
});
Breadcrumbs::register('admin.app_category.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.app_category');
    $breadcrumbs->push('小程序和分类关联列表', route('admin.app_category.index'));
});
Breadcrumbs::register('admin.app_category.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.app_category');
    $breadcrumbs->push('编辑小程序和分类关联', route('admin.app_category.edit', $app->id));
});

/**
 * AppTopic modules
 */
Breadcrumbs::register('admin.app_topic', function ($breadcrumbs) {
    $breadcrumbs->push('小程序和专题关联管理', route('admin.app_topic.index'));
});
Breadcrumbs::register('admin.app_topic.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.app_topic');
    $breadcrumbs->push('小程序和专题关联列表', route('admin.app_topic.index'));
});
Breadcrumbs::register('admin.app_topic.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.app_topic');
    $breadcrumbs->push('编辑小程序和专题关联', route('admin.app_topic.edit', $app->id));
});

/**
 * Settings modules
 */
Breadcrumbs::register('admin.settings', function ($breadcrumbs) {
    $breadcrumbs->push('设置管理', route('admin.settings.index'));
});
Breadcrumbs::register('admin.settings.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.settings');
    $breadcrumbs->push('设置列表', route('admin.settings.index'));
});
Breadcrumbs::register('admin.settings.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.settings');
    $breadcrumbs->push('添加设置', route('admin.settings.create'));
});
Breadcrumbs::register('admin.settings.edit', function ($breadcrumbs, $app) {
    $breadcrumbs->parent('admin.settings');
    $breadcrumbs->push('编辑设置', route('admin.settings.edit', $app->id));
});