- [Basic Usage](INDEX.md)
- [Structs](STRUCTS.md)
- [Hooks](HOOKS.md)
- **[Example App](EXAMPLE-APP.md)**

# Example App

### Service Provider

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
use romanzipp\Seo\Structs\Meta\Charset;
use romanzipp\Seo\Structs\Meta\Description;
use romanzipp\Seo\Structs\Meta\OpenGraph;
use romanzipp\Seo\Structs\Meta\Twitter;
use romanzipp\Seo\Structs\Meta\Viewport;
use romanzipp\Seo\Structs\Title;

class SeoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        StructBuilder::$indent = str_repeat(' ', 4);

        $this->bootMacros();

        $this->bootStructHooks();

        $this->bootDefaultStructs();
    }

    private function bootMacros()
    {
        Seo::macro('customTag', function (string $value) {
            return $this->add(
                Meta::make()->name('custom')->content($value)
            );
        });
    }

    private function bootStructHooks()
    {
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
        seo()->title('Home');
        seo()->description('My Description');

        seo()->addMany([
            Charset::make(),
            Viewport::make()->content('width=device-width, initial-scale=1'),
        ]);

        seo()->addMany([
            Meta::make()->name('mobile-web-app-capable')->content('yes'),
            Meta::make()->name('theme-color')->content('#f03a17'),
        ]);

        seo()->addMany([
            OpenGraph::make()->property('title')->content('Site-Name'),
            OpenGraph::make()->property('site_name')->content('Site-Name'),
            OpenGraph::make()->property('locale')->content('de_DE'),
        ]);

        seo()->add(
            Twitter::make()->name('player')->content('http://example.com/player?video=1&t=5', false)
        );
    }
}
```

### Middleware

```
$ php artisan make:middleware AppendSeoValues
```

#### `Http/Middleware/AppendSeoValues.php`

```php
namespace App\Http\Middleware;

use Closure;
use romanzipp\Seo\Structs\Meta\CsrfToken;

class AppendSeoValues
{
    public function handle($request, Closure $next)
    {
        seo()->add(
            CsrfToken::make()->token(csrf_token())
        );

        return $next($request);
    }
}

```

### Controllers


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

### View

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
