<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
		 \App\Models\WechatResponse::class                  => \App\Policies\WechatResponsePolicy::class,
		 \App\Models\WechatMenu::class                      => \App\Policies\WechatMenuPolicy::class,
		 \App\Models\Wechat::class                          => \App\Policies\WechatPolicy::class,
		 \App\Models\Article::class                         => \App\Policies\ArticlePolicy::class,
		 \App\Models\Block::class                           => \App\Policies\BlockPolicy::class,
		 \App\Models\Link::class                            => \App\Policies\LinkPolicy::class,
		 \App\Models\Project::class                         => \App\Policies\ProjectPolicy::class,
		 \App\Models\Slide::class                           => \App\Policies\SlidePolicy::class,
		 \App\Models\Category::class                        => \App\Policies\CategoryPolicy::class,
		 \App\Models\Navigation::class                      => \App\Policies\NavigationPolicy::class,
		 \App\Models\File::class                            => \App\Policies\FilePolicy::class,
		 \App\Models\Setting::class                         => \App\Policies\SettingPolicy::class,
         \App\Models\User::class                            => \App\Policies\UserPolicy::class,
         \App\Models\Page::class                            => \App\Policies\PagePolicy::class,
         \App\Models\Reply::class                           => \App\Policies\ReplyPolicy::class,
         \App\Models\Form::class                            => \App\Policies\FormPolicy::class,
         \App\Models\Content\About::class                   => \App\Policies\AboutPolicy::class,
         \App\Models\Content\Road::class                    => \App\Policies\RoadPolicy::class,
         \App\Models\Content\Dynamic::class                 => \App\Policies\Content\DynamicPolicy::class,
         \App\Models\Content\Hiring::class                  => \App\Policies\Content\HiringPolicy::class,
         \App\Models\Content\Brand::class                   => \App\Policies\Content\BrandPolicy::class,
         \App\Models\Content\Issue::class                   => \App\Policies\Content\IssuePolicy::class,
         \App\Models\Content\Uplog::class                   => \App\Policies\Content\UplogPolicy::class,
         \App\Models\Content\Problem::class                 => \App\Policies\Content\ProblemPolicy::class,
         \App\Models\Content\Protocol::class                => \App\Policies\Content\ProtocolPolicy::class,
         \App\Models\Content\Info::class                    => \App\Policies\Content\InfoPolicy::class,
         \App\Models\Content\Img::class                     => \App\Policies\Content\ImgPolicy::class,
         \App\Models\Content\Video::class                   => \App\Policies\Content\VideoPolicy::class,
         \App\Models\Content\Bname::class                   => \App\Policies\Content\BnamePolicy::class,
         \App\Models\Content\Bcontact::class                => \App\Policies\Content\BcontactPolicy::class,

         \Spatie\Permission\Models\Role::class              => \App\Policies\RolePolicy::class,
         \Spatie\Permission\Models\Permission::class        => \App\Policies\PermissionPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
