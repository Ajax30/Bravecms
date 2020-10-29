<div class="wrapper style1">
	<div class="content">
		<h2>{{post.title}}</h2>

		<p class="meta clearfix">
			<span class="pull-left">By <a href="posts/byauthor/{{post.author_id}}" title="All posts by {{post.first_name}} {{post.last_name}}">{{post.first_name}} {{post.last_name}}</a></span>

			<span class="pull-right">Published on {{post.created_at  | dateParse | date : "MMMM dd y"}} in <a href="categories/posts/{{post.cat_id}}" title="All posts in {{post.category_name}}">{{post.category_name}}</a></span>
		</p>

		<div class="image fit">
			<img src="./assets/img/posts/{{post.post_image}}" alt="{{post.title}}">
		</div>

		<div class="post-content"></div>

		<div class="comments-form">
			<h3>Leave a comment</h3>
			<form name="commentForm" novalidate>
				<div class="row uniform">
					<div class="form-controll 6u 12u$(xsmall)">
						<input type="text" name="name" id="name" placeholder="Name" />
						<span class="error">This field can not be empty</span>
					</div>

					<div class="form-controll 6u$ 12u$(xsmall)">
						<input type="email" name="email" id="email" placeholder="Email" />
						<span class="error">Enter a valid email address</span>
					</div>

					<div class="form-controll 12u$">
						<textarea name="comment" rows="6" id="message"></textarea>
						<span class="error">This field can not be empty</span>
					</div>

					<!-- Break -->
					<div class="12u$">
						<input type="submit" value="Add comment" class="button special fit" />
					</div>
				</div>
			</form>
			<div class="alert alert-success {{fadeout}}">
				{{commentSuccessMsg}}
			</div>
		</div>

		<div class="comments">
			<h3>Comments</h3>
			<div class="comment">
				<h4>On {{comment.created_at  | dateParse | date : "MMMM dd y"}}, {{comment.name}} wrote:</h4>
				<p>{{comment.comment}}</p>
			</div>
		</div>

	</div>
</div>