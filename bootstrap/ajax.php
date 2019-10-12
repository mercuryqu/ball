<?php

/**
 * show wap home modules
 */
if (! function_exists('wap_home_modules')) {
    function wap_home_modules($modules)
    {
        $html = '';
        foreach ($modules as $module)
        {
            // topics banner
            if($module->type == 0 && $module->topics->count() > 0) {
                foreach($module->topics as $topic)
                {
                    $style = explode(',', $topic->style);
                    $html .= '<a href="' . route("wap.topics.show", $topic) .'">';
                    $html .= '<div class="conten_con_img margins" style="background-image: url(' . $topic->banner . ');background-repeat: no-repeat;">';
//                    if (count($style) == 3) {
//                        $html .= '<h1 style="margin: 0.3rem;position: relative;top: 0.3rem;font-family: ' . $style[0] .'; font-size: ' . $style[1] . '; color: ' . $style[2] .';">' . $topic->title . '</h1>';
//                    } else {
//                        $html .= '<h1>' . $topic->title . '</h1>';
//                    }
                    $html .= '</div>';
                    $html .= '</a>';
                }
            } elseif ($module->type == 1 && $module->apps->count() > 0) {
                $html .= '<div class="Recommend Recommendlp margins">';
                $html .= '<h2 class="Recommend_h2">' . $module->name . '</h2>';
                $html .= '<div class="swiper-container horse">';
                $html .= '<div class="swiper-wrapper">';
                foreach($module->apps->chunk(5) as $apps) {
                    $html .= '<div class="swiper-slide blue-slide">';
                    $html .= wap_apps_list($apps);
                    $html .= '</div>';
                }

                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            } elseif ($module->type == 2 && $module->topics->count() > 0) {
                foreach($module->topics as $topic)
                {
                    $style = explode(',', $topic->style);
                    $html .= '<div class="conten_con_imgs margins" style="background: url(' . $topic->banner . ') no-repeat;background-repeat: no-repeat; background-size: 100%;">';
                    $html .= '<div class="conten_con_topimg">';
                    $html .= '<a href="' . route("wap.topics.show_pull", $topic) .'">';
                    $html .= '<div class="conten_con_topimgs">';
//                    if (count($style) == 3) {
//                        $html .= '<h1 style="font-family: ' . $style[0] .'; font-size: ' . $style[1] . '; color: ' . $style[2] .';">' . $topic->title . '</h1>';
//                    } else {
//                        $html .= '<h1>' . $topic->title . '</h1>';
//                    }
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                    if($topic->apps->count() > 0) {
                        $html .= '<div class="conten_con_buttom">';
                        $html .= '<div class="swiper-container horse_race_lamp" data-module=module_' . $topic->id .'">';
                        $html .= '<div class="swiper-wrapper">';
                        foreach($topic->apps as $key=>$app)
                        {
                            $html .= '<a href="' . route('wap.apps.show', $app) . '" class="swiper-slide">';
                            $html .= '<div class="horse_list">';
                            $html .= '<img src="' . $app->logo . '">';
                            $html .= '</div>';
                            $html .= '</a>';
                        }
                        $html .= '</div>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                }
            } elseif($module->type == 3 && $module->apps->count() > 0) {
                $html .= '<div class="Recommendnew conten_con_imgss margins" data-id="' . $module->id . '" id="module_' . $module->id . '">';
                $html .= '<h2 class="Recommend_h2 Recommend_h2_new" data-id="' . $module->id . '">' . $module->name . '</h2>';
                foreach($module->apps as $key=>$app)
                {
                    if ($key <= 3) {
                        $html .= '<div class="napes">';
                        $html .= '<div class="nape_lefts">';
                        $html .= '<img class="logo-img" src="';
                        $html .= $app->logo ? $app->logo : '';
                        $html .= '"/>';
                        $html .= '</div>';
                        $html .= '<div class="nape_rights_spam clearfix">';
                        $html .= '<div class="nape_rights">';
                        $html .= '<h6 class="limit-name">' . $app->name . '</h6>';
                        $html .= '<p class="limit-name">' . $app->slogan . '</p>';
                        $html .= '</div>';
                        $html .= '<span class="macks" style="display:table;overflow:hidden;" onclick="show_code(\'';
                        $html .= $app->name . '\',' . '\'';
                        $html .= $app->code  ? $app->code : '/statics/wap/images/code_default.png';
                        $html .= '\') "><p style="vertical-align:middle;display:table-cell;">体验</p></span>';
                        $html .= '</div>';
                        $html .= '</div>';
                    }
                }
                $html .= '</div>';
            } else {
                $html .= '<p>暂无数据！</p>';
            }
        }

        return $html;
    }
}

/**
 * show wap apps list
 */
if (! function_exists('wap_apps_list')) {
    function wap_apps_list($apps)
    {
        $html = '';
        foreach($apps as $app)
        {
            $html .= '<div class="napes">';
            $html .= '<a target="_top" href="' . route('wap.apps.show', $app) . '">';
            $html .= '<div class="nape_lefts">';
            $html .= '<img class="logo-img" src="';
            $html .= $app->logo ? $app->logo : '';
            $html .= '"/>';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '<div class="nape_rights_spam clearfix">';
            $html .= '<a target="_top" href="' . route('wap.apps.show', $app) . '">';
            $html .= '<div class="nape_rights">';
            $html .= '<h6 class="limit-name">' . $app->name . '</h6>';
            $html .= '<p class="limit-name">' . $app->slogan . '</p>';
            $html .= '</div>';
            $html .= '</a>';
            $html .= '<span class="macks" style="display:table;overflow:hidden;" onclick="show_code(\'';
            $html .= $app->name . '\',' . '\'';
            $html .= $app->code  ? $app->code : '/statics/wap/images/code_default.png';
            $html .= '\') "><p style="vertical-align:middle;display:table-cell;">体验</p></span>';
            $html .= '</div>';
            $html .= '</div>';
        }

        return $html;
    }
}