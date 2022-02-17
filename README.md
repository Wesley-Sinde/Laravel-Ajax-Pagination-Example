 <div class="card-header">
                        <h4>Laravel 7 Ajax Pagination Example - https://www.wesley.io.ke/
                        <p align="center">Kindly follow me and star this project if you get it helpful</p>
                        </h4>
                    </div>


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://www.nicesnippets.com/upload/blog/1583578499_laravel7-ajax-pagination.png?ezimgfmt=ng%3Awebp%2Fngcb1%2Frs%3Adevice%2Frscb1-1" width="400"></a></p>

Now, let's see post of laravel 7 ajax pagination with jquery. We will look at example of laravel 7 pagination json. In this article, we will implement a jquery ajax pagination in laravel 7.

You can understand a concept of laravel 7 ajax bootstrap pagination. Here, Creating a basic example of pagination jquery ajax laravel 7.

Here i give you full example of ajax pagination example step by step like create laravel 7 project, migration, model, route, blade file etc. So you have to just follow few steps.

Step 1 : Install Laravel 7 Application


we are going from scratch, So we require to get fresh Laravel application using bellow command, So open your terminal OR command prompt and run bellow command:
```php
composer create-project --prefer-dist laravel/laravel blog
```
Database Configuration

In this step, we require to make database configuration, you have to add following details on your .env file.

1.Database Username

1.Database Password

1.Database Name

In .env file also available host and port details, you can configure all details as in your system, So you can put like as bellow:

following path: .env
```php
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Step 2: Create blogs Table and Model

In this step we have to create migration for blogs table using Laravel 7 php artisan command, so first fire bellow command:
```php
php artisan make:model Blog -m
```
After this command you have to put bellow code in your migration file for create blogs table.

following path: /database/migrations/2020_03_07_100411_create_blogs_table.php
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
```

Now we require to run migration be bellow command:
```php
php artisan migrate
```
After you have to put bellow code in your model file for create blogs table.

following path:/app/Blog.php
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{	
    /**
    * Run the migrations.
    *
    * @return void
    */
    protected $fillable = [
        'name','description'
    ];
}
```

Step 3: Create Route

In this is step we need to create route for ajax pagination layout file

following path:/routes/web.php
```php
Route::get('pagination-ajax','BlogController@index')->name('blogs.ajax.pagination');
```
Step 4: Create Controller

here this step now we should create new controller as BlogController,So run bellow command for generate new controller
```php
php artisan make:controller BlogController
```
now this step, this controller will manage ajax pagination layout bellow content in controller file.following fille path

following path:/app/Http/Controllers/BlogController.php
```php
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $blogs = Blog::paginate(5);
  
        if ($request->ajax()) {
            return view('pagination', compact('blogs'));
        }
  
        return view('pagination',compact('blogs'));
    }
}
```
Step 5: Create Blade Files

In Last step, let's create pagination.blade.php (resources/views/pagination.blade.php) for layout and lists all blog code here and put following code

following path:/resources/views/pagination.blade.php
```php
<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Ajax Pagination By wesley sinde</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"> 
     <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y=" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
    <style type="text/css">
        .mt-5{
            margin-top: 90px !important; 
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Laravel 7 Ajax Pagination Example - NiceSnippets.com</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="100px">Id</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $blogs->render() !!}                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    getData(page);
                }
            }
        });

        $(document).ready(function()
        {
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                var myurl = $(this).attr('href');
                var page=$(this).attr('href').split('page=')[1];

                getData(page);
            });

        });

        function getData(page){
            $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
                $("#tag_container").empty().html(data);
                location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError){
                  alert('No response from server');
            });
        }
    </script>
</body>
</html>
```
Now you have some dummy data on your blogs table before run this example. Now we are ready to run our example so run bellow command for quick run:

php artisan serve

Now you can open bellow URL on your browser:

http://localhost:8000/pagination-ajax

It will help you...

    <footer class="px-3 text-lg text-center text-white no-underline uppercase bg-gray-900 py- italilc">
        <a href="https://www.wesley.io.ke/">Wesley Sinde: Some rights reserved {{ now()->year }}
        </a>
    </footer>