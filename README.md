# How to use this CMS


I have created a simple installation process: after creating a database and providing its credentials to the `application/config/database.php` file, you can run the `Install` controller which will create all the necessary tables:

    class Install extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
        }
    
        public function index(){
            // Create all the database tables if there are none
            // by redirecting to the Migrations controller
            $tables = $this->db->list_tables();
            redirect(count($tables) == 0 ? 'migrate' : '/');
        }
    }


After that, you can register as an **author**. Being the first registered author, you are also an admin, meaning that your author account *does not require activation* (and the value for the `is_admin` column has a value of `1` in the database record for you). 

All the future authors will need their accounts *activated by you* in order to publish articles (posts).


# How to use your own theme


You can easily integrate your own HTML theme with this CMS. For this purpose, the application uses the Twig templating engine.

Below is a guide on how to add your own theme.

## Add the theme's assets

First, make a directory for your theme's assets in the `themes` directory (which can be found in the application's root directory). Supose your theme's directory is *mytheme*, you will have a `themes/mytheme` directory to add tour theme's assts in: your CSS files in `themes/mytheme/assets/css`, your Javascript files in `themes/mytheme/assets/js`, your images in `themes/mytheme/assets/images`.

## Add the theme's views

In `application/views/themes/`, add a *mytheme* directory for tour theme's views. 

In `application/views/themes/mytheme`, add your master layout file, which must be named `layout.twig`.

Use this file to include your CSS and JavaScript files. Supose the main (or only) CSS file your theme is named *style.css*, you will need this line in the in the `<head>` section of your theme's `layout.twig` file. 

    <link rel="stylesheet" href="{{base_url}}themes/{{theme_directory}}/assets/css/style.css">

Similarly, you will include your script file(s):

    <script src="{{base_url}}themes/{{theme_directory}}/assets/js/main.js"></script>

To make yout theme the active one, go to `application/models/Static_model.php` and replace the currently active theme's directory name with yours:

    $data['theme_directory'] = "mytheme";

Note that the **Static_model** adds a few **useful variables** to the `$data` array (`site_title`, for instance) and you can use those variables in your theme's views.
 
On the same lavel with your theme's `layout.twig` file, add a *templates* directory, that will contain the templates for your posts, single post, pages, etc. These teplates will be injected in the master layout file (layout.twig) in the proper place, by the folowing snippet (You can choose what you inject in the layout file):

    {% if singlePost is defined %}
      {{include(singlePost)}}
    {% elseif pageTemplate is defined  %}
      {{include(pageTemplate)}}
    {% elseif contactForm is defined  %}
      {{include(contactForm)}}
	 {% elseif notFound is defined  %}
      {{include(notFound)}}
	 {% else %}
      {{ include('themes/' ~ theme_directory ~ '/templates/posts.twig') }}				
	 {% endif %}

The *templates* directory, for which the snippet above is used, should contain the templates: 404.twig, posts.twig, singlepost.twig, page.twig and contact.twig.

Considering the information we have so far, here is how a basic layout file should look like:

	<html lang="en">
	  <head>
		<meta charset="utf-8">
		<title>{{site_title}}</title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="{{base_url}}themes/{{theme_directory}}/assets/css/style.css">
	  </head>
		<body>
		  <div class="container">
		    {% if singlePost is defined %}
		      {{include(singlePost)}}
		    {% elseif pageTemplate is defined  %}
		      {{include(pageTemplate)}}
		    {% elseif contactForm is defined  %}
		      {{include(contactForm)}}
		    {% elseif notFound is defined  %}
		      {{include(notFound)}}
		    {% else %}
		      {{ include('themes/' ~ theme_directory ~ '/templates/posts.twig') }}			
		    {% endif %}
		  </div>
		  <script src="{{base_url}}themes/{{theme_directory}}/assets/js/main.js"></script>
		</body>
    </html>

The **Post controller** (`application/controllers/Posts.php`) already sends a `$posts` variable to the `layout.php` Twig view so we can display a list of posts by adding this snippet in `application/views/themes/mytheme/templates/posts.twig`:

    {% if posts %}
     {% for post in posts %}
      <div class="post">
       <h2 class="post-title">
        <a href="{{base_url}}{{post.slug}}">{{post.title}}</a>
       </h2>
       <div class="post-excerpt">{{post.description}}</div>
      </div>
     {% endfor %}
    {% else %}
     <p>There are no posts yet.</p>
    {% endif %}

In `singlepost.twig` you can display the full contet of the post by using Twig's raw filter:

    <div class="post">
      <h2 class="post-title">
        <a href="{{base_url}}{{post.slug}}">{{post.title}}</a>
      </h2>
      <div class="post-content">
        {{post.content | raw}}
      </div>
    </div>

You can find all the other variables that display content in the two *already existing* themes (or in the front-end controllers).

This application is intended to provide an easy way to "merge" an **HTML template** with its own **Content Management System**, which is so easy to use it needs not be explained.

Let me know if this small guide is comprehensive enough.

# License

MIT License

Copyright (c) 2020 Razvan Zamfir

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.