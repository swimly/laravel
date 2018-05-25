Create the file `app/Http/Middleware/Jsonify.php`
``` php
namespace App\Http\Middleware;

use Closure;

class Jsonify
{

    /**
     * Change the Request headers to accept "application/json" first
     * in order to make the wantsJson() function return true
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * 
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
```
Add the middleware to your $routeMiddleware table of your app/Http/Kernel.php file
``` php
protected $routeMiddleware = [
    'auth'       => \App\Http\Middleware\Authenticate::class,
    'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
    'jsonify'    => \App\Http\Middleware\Jsonify::class
];
```
Finally use it in your routes.php as you would with any middleware. In my case it looks like this 
``` php
Route::group(['prefix' => 'api/v1', 'middleware' => ['jsonify']], function() {
    // Routes
});
```
验证码总是报错
Add \Illuminate\Session\Middleware\StartSession::class to $middleware in Kernel.php