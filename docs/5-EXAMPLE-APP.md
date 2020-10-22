- [Basic Usage](1-INDEX.md)
  - [Add Methods](1-INDEX.md#add-methods)
  - [Macros](1-INDEX.md#macros)
- [Structs](2-STRUCTS.md)
  - [Available Shorthand Methods](2-STRUCTS.md#available-shorthand-methods)
  - [Adding single structs](2-STRUCTS.md#adding-single-structs)
  - [Available Structs](2-STRUCTS.md#available-structs)
  - [Escaping](2-STRUCTS.md#escaping)
  - [Creating custom Structs](2-STRUCTS.md#creating-custom-structs)
- [Hooks](3-HOOKS.md)
  - [Examples](3-HOOKS.md#examples)
  - [Reference](3-HOOKS.md#reference)
- [Laravel-Mix](4-LARAVEL-MIX.md)
- **[Example App](5-EXAMPLE-APP.md)**

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

        // Add a getTitle method for obtaining the unmodified title

        Seo::macro('getTitle', function () {
            /** @var \romanzipp\Seo\Services\SeoService $this */

            if ( ! $title = $this->getStruct(Title::class)) {
                return null;
            }

            if ( ! $body = $title->getBody()) {
                return null;
            }

            return $body->getOriginalData();
        });    

        // Create a custom macro

        Seo::macro('customTag', function (string $value) {
            /** @var \romanzipp\Seo\Services\SeoService $this */

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
        seo()->title($post->title ?: "Post No. {$post->id}");
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
