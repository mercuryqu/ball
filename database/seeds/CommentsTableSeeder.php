<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $comments = factory(\App\Models\Comment::class)->times(30)->make();
//        \App\Models\Comment::insert($comments->toArray());

//        $comment = \App\Models\Comment::find(30);
//        $comment->is_reply = 1;
//        $comment->save();


        // 被评论的小程序ID(用英文状态下逗号隔开)
        $apps = [
            1,6,7,14,18,19,23,24,33,41,47,75,102,103,112,123,156,157,159,160,165,174,177,178,201,240,260,284,354,356,357,358,362,363,364,367,368,369,370,371,377,378,379,380,381,382,383,384,385,386,387,388,389,390,
            391,392,393,394,395,396,399,406,407,408,409,410,411,412,413,414,415,114,145,151,183,184,186,187,188,189,190,218,221,227,255,266,267,270,271,274,277,280,291,299,302,372,373,374,375,397,398,459,478,480,
            489,527,540,551,552,553,554
        ];

        // 评论内容（用英文状态下引号和逗号隔开）
        $comments = [
            '这个小程序不错',
            '很好用',
            '这个小程序挺实用的',
            '功能很多，挺好用的',
            '很方便，很实用',
            '功能方面还是不错的',
            '点个赞，很赞的小程序',
            '好软件，不烦恼',
            '逼格很高',
            '操作、界面都很不错',
            '很方便的小程序，很好用',
            '不错不错哦，很喜欢',
            '希望应用能能有更多惊喜，有些功能挺实用',
            '还有好多需要完善的，但是看出用心了啊，这个应用可以赞一个',
            '上手还是比较简单的，比较简洁',
            '哈哈，我觉得不错',
            '设计感很强，可以可以',
            '这款小程序，很强',
            '很棒 喜欢这款软件',
            '表扬下，再多提升一下性能',
            '一直在用，强力推荐',
            '非常棒，力挺',
            '非常不错哦，一直在用，一直在关注',
            '好用，非常方便',
            '还是不错的，五星好评',
            '不说啥了，五星',
            '设计棒，功能强，操作简单',
            '希望可以更好',
            '不用不知道，这么好用',
            '各方面都很满意的小程序不多了',
            '推荐大家使用，亲身体验',
            '感觉很不错，有待加强',
            '更新更新，期待',
            '功能再多点就更好了',
            '好！',
            '简单的赞美已经不能表达我心中的喜悦',
            '话不多说，好~！',
            '将心比心，很好用',
            '好不好用，用过才知道',
            '朋友都说不错，我也来下载试试',
            '刚用了下，感觉不错',
            '比之前用的好多了',
            '很有意思',
            '你怎么能那么棒',
            '哇~可以的',
            '此处省略999句赞美的话',
            '我只想用一个字来概括这个小程序给我的感觉：好！',
            '你为何如此优秀',
            '你这么优秀，不要骄傲，加油',
            '一直在期待，没有失望过',
            '麻烦给设计师加个鸡腿',
            '细节很到位',
            '功能很齐全',
            '起码在视觉感上，我喜欢这个小程序',
            '一直在用，因为好用',
            '找不到形容词来夸你',
            '总之就是好',
            '会推荐朋友用的，感觉不错',
            'YES',
            'You\'re great',
            'good',
            'It\'s perfect',
            'Fabulous',
            '很GOOD',
            'very good',
            'Why are you so good',
            '世界如此美好，只因有你',
            '不错，很好用，期待完善',
            '简单，方便，实用',
            '给你99分，你会骄傲么',
            '继续优秀，不要停',
            '繁世中停下脚步，只为多看你一眼',
            '你的光芒闪瞎了我的眼',
            '优秀~',
            '完美~',
            '来来来，继续优秀',
            '你怎么那么棒！',
            '众多程序扰乱眼，你却脱颖而出',
            '界面看着很舒服',
            '操作很简单，很好用',
            '很强666',
            '有了你，别的都卸载了',
            '繁琐什么的，不存在的',
            'goodgoodgood',
            '好好好',
            '非常的好，棒~！',
            '    0 . 0    好的不要不要的',
            '方便，便捷',
            '不用下载APP，很方便',
            '掌声送给你',
            '用了之后，心里给你点了个赞',
            '表示很好用',
            '为了表示这个小程序很好，我多打几个字让你们看到我~啊啊啊啊啊！！！！！',
            '我还是比较喜欢的，各方面都还不错',
            '你们觉得好不好，我不知道，我知道的就是我觉得还是不错的',
            '这个小程序666哦~',
            '设计师你很棒棒哦~！',
            '各方面都很好，细节细致，赞！',
            '我很中意',
            '赞呦~',
            '黑凤梨~',
            '用着很顺手',
            '用的顺心，用的开心',
            '完美',
            'Beautiful and practical',
            '已经用上了，不错的很方便',
            '好东西大家一起分享',
            '超级好用！页面很简洁，是我喜欢的',
            '不错不错，超级好用',
            '不错，很便民',
            '我的天，这么好的小程序怎么才推荐',
            '快让我找个词来夸夸你',
            '天啊，你怎么那么棒~',
            '你怎么如此便捷',
            '不多见的小程序，很优秀',
            '麻雀虽小五脏俱全',
            '内在美，外在也不差',
            '表里如一，完美~',
            '支持一下',
            '赞一下',
            '给你个大拇指',
            '如此清新脱俗的小程序，在茫茫人海中遇见了你',
            '良心产品，很方便',
            '很实用',
            '超级好用耶',
            '非常良心的小程序',
            '这软件太好用了，实用，准确，五星好评都不够！',
            '墙裂推荐！！！',
            '用起来真是方便啊',
            '方便实用！！！',
            '很好用的打分小程序，五星好评。^_^',
            '功能很齐全，内容很详细，很不错 ',
            '灰常好用，赞赞赞赞\(≧▽≦)/',
            '神器啊，好用',
            '小确幸',
            '不错不错。赞！',
            '哇塞！居然被我找到了这么全面的小程序。',
            '体验棒棒的！',
            '奈斯~！！',
            '挺不错的，非常喜欢呢',
            '来过~',
            '牛逼啊！',
            '十分喜欢。',
            '希望这款小程序后续能够推出更多的功能。5星走起',
            '简单粗暴!棒！',
            '厉害厉害',
            '值得推荐',
            '这个还不错诶，设计挺美观的',
            '我觉得会火',
            '不错，简洁大方！还能分享',
            '个人认为这个软件还是不错的',
            '简直不能更爱这个软件了',
            '好好哦，超喜欢❤️',
            '真的挺好的，大家都试试',
            '大家可以尝试一下 ^_^',
            '非常nice',
            'nice！',
            '顶一个',
            '顶一个啊',
            '哈哈哈哈哈哈哈哈哈哈哈哈哈哈~~！！！',
            '界面极简，我喜欢的风格！',
            '可能是史上最省心、最优雅的小程序。',
            '沙发~',
            '新版本太给了！',
            '简单好用，非常专业。',
            '非常精美的一款小程序',
            '这个小程序让我眼界大开',
            '简单，直观，颜值高',
            '好好用',
            '使用了一下，用起来还不错。',
            '简约，方便，直入主题，很方便的小程序',
            '方便快捷！很好用哟',
            '好棒棒！',
            '简洁，好用，好看。喜欢。',
            '竟然有这么个好用的小程序，真是方便。',
            '赞！正合用',
            '支持支持',
            '留个脚印',
            '好用又方便。',
            '好使~',
            '超级实用的工具',
            '沙发 哈哈！',
            '用起来很方便，而且免费',
            '我来点赞！',
            '很不错，用起来很简单，没有那么多奇奇怪怪的选项。棒棒哒',
            '很nice，用起来很顺手',
            '内容挺实用的',
            '我擦，厉害了，方便了，不用下APP了',
            '之前懒得下载app，现在有了小程序方便多了',
            '好用不多说，谁用谁知道',
            '界面简洁，功能简单',
            '厉害厉害，真的好用，审美一流',
            '海报挺好看的，操作简单，已经推荐给朋友',
            '阔以，很不错！',
            '还可以，简单易用，很好',
            '超级喜欢，点赞赞赞赞',
            '感觉好极了',
            '太强势这个程序，我的眼睛！！！',
            '好用的不行，简洁不简单，靠谱的小程序，推荐给朋友好几次了ᕕ(ᐛ)ᕗ',
            '很好！心诚则灵！',
            '蛮好用的',
            '不错的app',
            '哇！這軟件出小程序嘍！',
            '用过的最好的程序，没有之一',
            '你值得拥有',
            '简单纯粹生活必备',
            '和APP一样好用',
            '一级棒',
            '不错，可以省时省力',
            '支持，加油，期待更加完善的版本',
            '体验很流畅，简单便捷',
            '正需要这样的小程序',
            '朋友介绍用的，哈哈哈哈哈哈哈，给个好评',
            '不得了，这个神器，很棒~！',
            '这个可以有，我喜欢！',
            '好厉害的样子。',
            '感谢！',
            'Good~~~~~~~',
            '挺實用的！',
            '实用小程序，人人必备啊',
            '内容精彩，很喜欢',
            '好评！',
            '不错的小程序，祝越来越好',
            '相当方便，谢谢',
            '非常不错的小程序 很棒很棒 而且界面真的很精美呢！',
            '又一个消磨时间的好去处',
            '必须好评！界面很精美，功能很强大！',
            '看介绍不错，我先用用，如果真的好，我给朋友们推荐，加油吧。总之我喜欢',
            '用了下，感觉是不错的',
            '小程序中的战斗机',
            '没词夸了，好',
            '@.@棒',
            '-3-喜欢',
            '很走心的程序员啊',
            '给程序员加鸡腿',
            '程序员给你赞一个',
            '终于找到你~',
            '等你更新哈，舒心',
            '用的舒心啊',
            '用着就是舒心',
            '舒服',
            '你的光芒太耀眼',
            '体验的感觉很棒，好东西',
            '好东西啊~',
            '小程序中千里挑一啊',
            '哪哪都觉得好！',
            '用过都说好',
            '很喜欢，很满意 ',
            '这程序很是个满意啊',
            '必属精品',
            '精品小程序',
            '没的说，好评',
            '用过很多同类型的小程序，这个用的感觉最好',
            '好就一个字，我只说一次',
            '优秀的不行',
            '这个小程序光芒很是耀眼啊',
            '谁都不服就服你了',
            '这么方便的小程序还有谁',
            '还是这个实用',
            '还是你好用',
            '感觉你是最棒的',
            '这个风格我很是喜欢啊',
            '这么优秀的我，喜欢上这么优秀的你了',
            '喜欢上你，请你不要骄傲，继续努力',
            '用了这个不想用别的了',
            '同类型的小程序还有比这个好用的么',
            '没谁了，以后就用你了',
            '力挺你，程序员继续加油，做出更好的',
            '外表？内在？不，你两者皆有',
            '你做的这么优秀，你让别的小程序还怎么活啊',
            '这个视觉感，这个操作感，很中意',
            '这个小程序很犀利啊',
            '猴赛雷',
            '萨瓦迪卡',
            '哇哇哇哇哇哇哇哇哇哇哇~好',
            '这么好用的小程序不能被埋没了',
            '解决了我燃眉之急',
            '啦啦啦啦啦啦，就是你啦！',
            '这款小程序中散发的气质，深深的吸引着我',
            '精品啊~精品啊~！',
            '用一用,乐开怀啊',
            '内容很丰富',
            '内容丰富，很喜欢',
            '借你的地方，表扬一下你',
            '手动赞',
            '好用，希望你们都能发现哈',
            '挺好用的，大家也试试。',
            '小程序还是不错的，但毕竟是新平台，还需要适应吧',
            '非常好的小程序 功能很齐全 技术也过硬 推荐使用 收藏了',
            '页面设计很漂亮',
            '非常惊艳的小程序',
            '真心不错的小程序，以后必然是趋势',
            '超级好用啊，留着留着了',
            '功能强大，分类清晰，页面流畅，推荐！！！',
            '不错的小程序，墙裂安利给大家',
            '功能很齐全、页面很漂脸、收藏了！',
            '小程序交互做的很棒 页面也很清新',
            '操作简单，真是利器啊',
            '对于我们来说就是及时雨，大大的赞',
            '实用性很强！收藏了',
            '内容很详细、准确，页面看起来也很舒服，使用很方便，赞！',
            '感觉可以很方便 没见过这么好玩的小程序呢 [认真脸]',
            '发现了个好东西',
            '我不能藏私啊，推荐给你们',
            '好用，创新模式，棒棒哒',
            '的确很给力',
            '很给力啊，这个真的棒',
            '完美！详实全面，好用',
            '朋友都在问我为啥不用下APP',
            '小清新啊',
            '介面流畅好操作',
            '不想下载app的话,可以使用小程序好方便啊！',
            '推荐使用，都来看看哈',
            '高品质小程序',
            '分享给朋友了，朋友很喜欢',
            '感觉不错，试用一下先',
            '直接在微信就能用，真方便',
            '便捷，喜欢啊',
            '天啊，我要哭了，太方便了word的天！！！',
            '吵鸡方便',
            '牛逼狠狠得不要不要的！吵鸡方便',
            '快上车',
            '挺不错的....生活方便不少...可以一试啊',
            '反应速度很快，',
            '郑心甚悦',
            '我要雨露均沾',
            '撒拉嘿呦~',
            '以前一直在用APP ，自从发现小程序，，就没用过了',
            '百用不厌',
            '请继续散发你的光芒，加油！',
            '发现新大陆~~~',
            '鼓掌鼓掌！！',
            '呱唧呱唧。',
            '春风十里不如你~',
            '小程序在质量上没的说啊',
            '扫个码就能用，真的是方便',
            '看来手机空间可以腾出来很多了',
            '夸你的词都在......里',
            '强势推荐，非常好用',
            'OJ8K~',
            '很给力的小程序，很好用',
            '用心了，功能齐全',
            '找到自己想要的了',
            '顶顶顶，希望越来越火哈',
            '第一次用这个，方便。推荐！',
            '不知道怎么说，就是挺好用的',
            '借楼推荐~！！',
            '业界良心~！',
            '超赞哦~大家都来试试！',
            '稳定性不错，很喜欢',
            '不占内存，不麻烦，好东西~！',
            '主要是不占内存，我很喜欢',
            '简单，方便，便捷，就这，就已经很好了',
            '我的天啊，简直是方便的一批',
        ];


        $all_comments = [];
        foreach ($apps as $app_id) {
            $rand_comment_count = rand(2, 5);
            $rand_comment_keys = array_rand($comments, $rand_comment_count);
            $rand_comments = [];
            foreach($rand_comment_keys as $key) {
                $rand_star = rand(3, 5);
                $rand_member = rand(129, 328);
                $time = rand(1526895540, 1527500412);   // 2018/5/21 17:39:00 - 2018/5/28 17:40:12
                $rand_time = date('Y-m-d H:i:s', $time);

                $rand_comments['star'] = $rand_star;
                $rand_comments['body'] = $comments[$key];
                $rand_comments['member_id'] = $rand_member;
                $rand_comments['app_id'] = $app_id;
                $rand_comments['is_reply'] = 0;
                $rand_comments['status'] = 1;
                $rand_comments['created_at'] = $rand_time;
                $rand_comments['updated_at'] = $rand_time;
                $all_comments[] = $rand_comments;
            }
        }

        $all_unique_comments = array_sequence($all_comments, 'created_at', 'SORT_ASC');

        \App\Models\Comment::insert($all_unique_comments);
    }
}
