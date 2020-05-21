- [Basic Usage](INDEX.md)
- [Structs](STRUCTS.md)
- [Hooks](HOOKS.md)
- [Laravel-Mix](LARAVEL-MIX.md)
- **[Example App](EXAMPLE-APP.md)**

# Example App

## Service Provider

```
$ php artisan make:provider SeoServiceProvider
```

#### `Providers/SeoServiceProvider.php`

```php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use romanzipp\Seo\Builders\StructBuilder;
use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Title;

class SeoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        StructBuilder::$indent = str_repeat(' ', 4);
    
        // Create a custom macro

        Seo::macro('customTag', function (string $value) {
            return $this->add(
                Meta::make()->name('custom')->content($value)
            );
        });

        // Add a hook to ensure the site name is always appended to the title 

        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {
                    return ($body ? $body . ' | ' : '') . 'Site-Name';
                })
        );
    }

    private function bootDefaultStructs()
    {
        
    }
}
```

## Middleware

```
$ php artisan make:middleware AddSeoDefaults
```

#### `Http/Middleware/AddSeoDefaults.php`

```php
namespace App\Http\Middleware;

use Closure;
use romanzipp\Seo\Structs\Link;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;

class AddSeoDefaults
{
    public function handle($request, Closure $next)
    {
        seo()->charset();
        seo()->viewport();

        seo()->title('Home');
        seo()->description('My Description');

        seo()->csrfToken();

        seo()->addMany([

            Meta::make()->name('copyright')->content('Roman Zipp'),

            Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Meta::make()->name('theme-color')->content('#f03a17'),

            Link::make()->rel('icon')->href('/assets/images/Logo.png'),

            OpenGraph::make()->property('title')->content('Laravel'),
            OpenGraph::make()->property('site_name')->content('Laravel'),
            OpenGraph::make()->property('locale')->content('de_DE'),

            Twitter::make()->name('card')->content('summary_large_image'),
            Twitter::make()->name('site')->content('@romanzipp'),
            Twitter::make()->name('creator')->content('@romanzipp'),
            Twitter::make()->name('image')->content('/assets/images/Banner.jpg', false)

        ]);

        return $next($request);
    }
}

```

## Controllers

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        seo()->title('All Posts');

        $posts = Post::all();

        return view('posts.index', compact('posts'));
    }

    public function show(Request $request, Post $post)
    {
        seo()->title($post->title ?: 'Post No. ' . $post->id);
        seo()->description($post->intro);

        return view('posts.show', compact('post'));
    }
}
```

## View

```blade
<!DOCTYPE html>
<html>
<head>

    {{ seo()->render() }}

</head>
<body>

    @yield('content')

</body>
</html>
```
