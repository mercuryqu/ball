<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\Jssdk;
use App\Helpers\WapStatus;
use App\Helpers\WebStatus;
use App\Models\App;
use App\Models\AppCategory;
use App\Models\Category;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AppsController extends WapBaseController
{
    /**
     * Define a new resource var
     */
    protected $app;
    protected $category;
    protected $comment;
    protected $app_logo_save_path;
    protected $app_logos_max_size;
    protected $app_logos_width;
    protected $app_logos_height;
    protected $app_codes_save_path;
    protected $app_codes_max_size;
    protected $app_codes_width;
    protected $app_codes_height;
    protected $app_images_save_path;
    protected $app_images_max_size;
    protected $app_images_width;
    protected $app_images_height;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\App  $app
     * @param  \App\Models\Category  $category
     * @param  \App\Models\Comment  $comment
     */
    public function __construct(App $app, Category $category, Comment $comment)
    {
        $this->app = $app;
        $this->category = $category;
        $this->comment = $comment;
        $this->app_logo_save_path = config('custom.app_logos_save_path');
        $this->app_logos_max_size = config('custom.app_logos_max_size');
        $this->app_logos_width = config('custom.app_logos_width');
        $this->app_logos_height = config('custom.app_logos_height');
        $this->app_codes_save_path = config('custom.app_codes_save_path');
        $this->app_codes_max_size = config('custom.app_codes_max_size');
        $this->app_codes_width = config('custom.app_codes_width');
        $this->app_codes_height = config('custom.app_codes_height');
        $this->app_images_save_path = config('custom.app_images_save_path');
        $this->app_images_max_size = config('custom.app_images_max_size');
        $this->app_images_width = config('custom.app_images_width');
        $this->app_images_height = config('custom.app_images_height');

        // Only login member can visit pages
        $this->middleware('wap.auth', [
            'except' => ['show', 'comments']
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        // upload logo_file
        if ($request->hasFile('logo_file')) {
            $image = $request->file('logo_file');
            if (! $image->isValid()) {
                return $this->apiShow(WebStatus::IMAGE_UPLOAD_FAILED_CODE, WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_logo_path = upload_image($image, $this->app_logo_save_path, $this->app_logos_width, $this->app_logos_height);
            $request->merge(['logo' => $full_logo_path]);
        }

        // upload code_file
        if ($request->hasFile('code_file')) {
            $code = $request->file('code_file');
            if (! $code->isValid()) {
                return $this->apiShow(WebStatus::IMAGE_UPLOAD_FAILED_CODE, WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_code_path = upload_image($code, $this->app_codes_save_path, $this->app_codes_width, $this->app_codes_height);
            $request->merge(['code' => $full_code_path]);
        }

        $request->merge(['member_id' => $request->session()->get('member')->id]);

        // save app info
        $result = $this->app->create($request->except(['_token', 'categories', 'logo_file', 'code_file', 'image_files']));

        // save app_images info
        $images_array = [];
        if ($request->hasFile('image_files')) {
            $images = $request->file('image_files');
            foreach ($images as $image) {
                if (! $image->isValid()) {
                    return $this->apiShow(WebStatus::IMAGE_UPLOAD_FAILED_CODE, WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
                }

                $full_image_path = upload_image($image, $this->app_images_save_path, $this->app_images_width, $this->app_images_height);
                $now_time = Carbon::now();
                $images_array[] = [
                    'app_id' => $result->id,
                    'url' => $full_image_path,
                    'created_at' => $now_time,
                    'updated_at' => $now_time,
                ];
            }
        }

        // insert images url to images table
        if (count($images_array) > 0) {
            \App\Models\Image::insert($images_array);
        }

        // save app_categories info
        $categories = explode(',', $request->input('categories'));
        $result->categories()->attach($categories);

        if (! $result) {
            return $this->apiShow(WebStatus::CREATE_FAILED_CODE, WebStatus::CREATE_FAILED_MESSAGE);
        }

        return $this->apiShow(WebStatus::CREATE_SUCCESS_CODE, WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Guide page.
     *
     * @return \Illuminate\Http\Response
     */
    public function guide()
    {
        return view('wap.apps.guide');
    }

    /**
     * Preview page.
     *
     * @return \Illuminate\Http\Response
     */
    public function preview()
    {
        return view('wap.apps.preview');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $first_level_categories = $this->category->getAfterRemoveCategories();
        return view('wap.apps.create', compact('first_level_categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        $app = $app->whereStatus(1)
                    ->findOrFail($app->id);

        $app->increment('view_count', 1);

        $commentsQuery = $app->comments()
                        ->whereStatus(1);

        $comments = $commentsQuery
                    ->latest()
                    ->limit(3)
                    ->get();

        $comment_count = $commentsQuery->count();

        $recommend_apps = collect();
        $categories = $app->categories->pluck('id');

        if ($categories->count() > 0) {
            $app_category = AppCategory::with(['app' => function ($query) {
                    $query->where('status', 1);
                }])
                ->whereIn('category_id', $categories)
                ->where('app_id', '!=', $app->id)
                ->limit(6)
                ->get();
            if ($app_category->isNotEmpty()) {
                foreach ($app_category as $item) {
                    if ($item->app && $item->app->id) {
                        $recommend_apps[] = $item->app;
                    }
                }
                $recommend_apps = $recommend_apps->chunk(2);
            }
        }

        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.apps.show', compact('app', 'comments', 'comment_count', 'recommend_apps', 'sign_package'));
    }

    /**
     * Display app comments listing of the resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function comments(App $app)
    {
        $comments = $app->getAppComments();
        return view('wap.apps.comments', compact('app', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function commentCreate(App $app)
    {
        return view('wap.apps.comment_create', compact('app'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function commentStore(Request $request, App $app)
    {
        $this->validate($request, [
            'star' => 'required|integer|in:1,2,3,4,5',
            'body' => 'required|string|min:10|max:500',
        ], [], [
            'star' => '评分',
            'body' => '评论内容'
        ]);

        $member = session()->get('member');
        $request->merge(['member_id' => $member->id, 'app_id' => $app->id]);
        $request->merge(['status' => 0]);
        $result = $this->comment->create($request->all());
        if (! $result) {
            return $this->apiShow(WapStatus::COMMENT_FAILED_CODE, WapStatus::COMMENT_FAILED_MESSAGE);
        }

        return $this->apiShow(WapStatus::COMMENT_SUCCESS_CODE, WapStatus::COMMENT_SUCCESS_MESSAGE);
    }

    protected function buildFailedValidationResponse(Request $request, array $errors) {
        $errors = array_reduce($errors, function($carry, $item) {
            return array_merge($carry, $item);
        }, []);

        return new JsonResponse($this->buildErrorResponse($errors), 400);
    }

    protected function buildErrorResponse($strings) {
        if (is_string($strings)) {
            $strings = [$strings];
        }

        $errors = array_map(function($item) {
            $m = explode('|', $item, 2);
            if (count($m) == 2) {
                return ["code" => $m[0], 'message' => $m[1], 'messages' => $m[1]];
            } else {
                return ['message' => $item, 'messages' => $item];
            }
        }, $strings);
        return ['errors' => $errors];
    }

    private function validateRequest($request)
    {
        $member = $request->session()->get('member');
        $request->merge(['member_id' => $member->id]);

        Validator::extendImplicit('category_id_exists_validate', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) > 0) {
                $category_ids = collect(explode(',', $value));
                $categories = Category::pluck('id');

                foreach ($category_ids as $item) {
                    if (! $categories->contains($item)) {
                        return false;
                    }
                }
            }
            return true;
        });

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:20|unique:apps',
            'slogan' => 'required|min:3|max:30',
            'instruction' => 'required|min:5|max:300',
            'member_id' => 'required|integer|exists:members,id',
            'logo_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . $this->app_logos_max_size . '|dimensions:width=' . $this->app_logos_width .',height=' . $this->app_logos_height,
            'code_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . $this->app_codes_max_size . '|dimensions:width=' . $this->app_codes_width .',height=' . $this->app_codes_height,
            'image_files' => 'required',
            'images_files.*' => 'image|mimes:jpeg,jpg,bmp,png|max:' . $this->app_images_max_size . 'dimensions:width=' . $this->app_images_width .',height=' . $this->app_images_height,
            'categories' => 'required|category_id_exists_validate',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages();

            $this->buildFailedValidationResponse($request, $errors);
        }
    }
}
