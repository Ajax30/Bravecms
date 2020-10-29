<!-- One -->
<section id="one" class="wrapper style1">

	<div class="image fit flush">
		<a href="{{post.slug}}">
			<img src="./assets/img/posts/{{post.post_image}}" alt="{{post.title}}" />
		</a>
	</div>
	<header class="special">
		<h2>{{post.title}}</h2>
		<p>{{post.description}}</p>
	</header>
	<div class="content">{{post.content}}</div>
</section>

<!-- Three -->
<section id="three" class="wrapper">
	<div class="spotlight">
		<div class="image flush">
			<a href="{{post.slug}}">
				<img src="./assets/img/posts/{{post.post_image}}" alt="{{post.title}}" />
			</a>
		</div>
		<div class="inner">
			<h3>{{post.title}}</h3>
			<p>{{post.description}}</p>
			<div>
				<a href="{{post.slug}}" class="button special small">Read More</a>
			</div>
		</div>
	</div>
</section>
<div class="pagination-container"></div>
