<?php

namespace App\Services;

use \Encore\Admin\Admin;

class AdminControllerAssets {

    /**
     * JS и CSS файлы, используемые в большинстве контроллеров в админке
     */
    public function addAssets()
    {
        $admin = new Admin();

        $admin::js(asset('/vendor/laravel-admin/AdminLTE/plugins/iCheck/icheck.min.js'));
        $admin::css(asset('/vendor/laravel-admin/AdminLTE/plugins/iCheck/all.css'));

        $admin::js(asset('/vendor/laravel-admin/AdminLTE/plugins/select2/select2.full.min.js'));
        $admin::css(asset('/vendor/laravel-admin/AdminLTE/plugins/select2/select2.min.css'));
    }

}
