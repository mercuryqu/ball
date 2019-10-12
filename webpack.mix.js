const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Admin
mix.styles([
	'resources/assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css',
	'resources/assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css',
	'resources/assets/adminlte/bower_components/Ionicons/css/ionicons.min.css',
	'resources/assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css',
	'resources/assets/adminlte/dist/css/AdminLTE.min.css',
	'resources/assets/adminlte/dist/css/skins/skin-blue.min.css',
	'resources/assets/adminlte/dist/css/skins/_all-skins.min.css',
	'resources/assets/adminlte/plugins/iCheck/square/blue.css',
	'resources/assets/adminlte/plugins/daterangepicker/daterangepicker.css',
	'resources/assets/adminlte/plugins/wangEditor/release/wangEditor.min.css'
], 'public/statics/admin/css/vendor.css');

mix.sass('resources/assets/admin/sass/app.scss', 'public/statics/admin/css/app.css');

mix.copy('resources/assets/adminlte/bower_components/bootstrap/fonts', 'public/statics/admin/fonts');
mix.copy('resources/assets/adminlte/bower_components/font-awesome/fonts', 'public/statics/admin/fonts');
mix.copy('resources/assets/adminlte/plugins/wangEditor/release/fonts', 'public/statics/admin/fonts');
mix.copy('resources/assets/adminlte/bower_components/Ionicons/fonts', 'public/statics/admin/fonts');
mix.copy('resources/assets/adminlte/dist/img', 'public/statics/admin/img');
mix.copy('resources/assets/adminlte/plugins/iCheck/square/blue.png', 'public/statics/admin/css');

mix.scripts([
	'resources/assets/adminlte/bower_components/jquery/dist/jquery.min.js',
    'resources/assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js',
    'resources/assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
    'resources/assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
    'resources/assets/adminlte/bower_components/fastclick/lib/fastclick.js',
	'resources/assets/adminlte/dist/js/adminlte.min.js',
    'resources/assets/adminlte/plugins/iCheck/icheck.min.js',
    'resources/assets/adminlte/plugins/daterangepicker/moment.min.js',
    'resources/assets/adminlte/plugins/daterangepicker/daterangepicker.js',
    'resources/assets/adminlte/plugins/wangEditor/release/wangEditor.min.js',
    //'resources/assets/adminlte/plugins/layer-v3.1.1/layer/layer.js',
    'resources/assets/adminlte/dist/js/demo.js'
], 'public/statics/admin/js/vendor.js');

mix.scripts([
    'resources/assets/admin/js/app.js'
], 'public/statics/admin/js/app.js');

// Wap error
/*mix.styles([
    'resources/assets/wap/statics/css/base.css',
    'resources/assets/wap/statics/css/dropload.css',
    'resources/assets/wap/statics/css/swiper.min.css',
    'resources/assets/wap/statics/css/home.css',
    'resources/assets/wap/statics/css/apps-create.css',
    'resources/assets/wap/statics/css/apps-show.css',
    'resources/assets/wap/statics/css/auth-login.css',
    'resources/assets/wap/statics/css/categories-index.css',
    'resources/assets/wap/statics/css/categories-show.css',
    'resources/assets/wap/statics/css/comments-create.css',
    'resources/assets/wap/statics/css/comments-index.css',
    'resources/assets/wap/statics/css/members-show.css',
    'resources/assets/wap/statics/css/search.css',
    'resources/assets/wap/statics/css/topic-show-pull.css',
    'resources/assets/wap/statics/css/topic-show.css'
], 'public/statics/wap/css/app.css');

mix.scripts([
    'resources/assets/wap/statics/js/jquery-1.10.1.min.js',
    'resources/assets/wap/statics/js/config.js',
    'resources/assets/wap/statics/js/base.js',
    'resources/assets/wap/statics/js/swiper.min.js',
    'resources/assets/wap/statics/js/clipboard.min.js',
    'resources/assets/wap/statics/js/dropload.min.js',
    'resources/assets/wap/statics/js/layer.js',
    'resources/assets/wap/statics/js/NativeShare.js',
    'resources/assets/wap/statics/js/rem.js',
    'resources/assets/wap/statics/js/apps-create.js',
    'resources/assets/wap/statics/js/apps-show.js',
    'resources/assets/wap/statics/js/auth-login.js',
    'resources/assets/wap/statics/js/categories-index.js',
    'resources/assets/wap/statics/js/home.js',
    'resources/assets/wap/statics/js/search.js',
    'resources/assets/wap/statics/js/topics-show.js'
], 'public/statics/wap/js/app.js');*/

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');
