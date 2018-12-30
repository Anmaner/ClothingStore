@extends('layouts.main', ['title' => 'blog', 'headerClass' => 'header-v4'])

@section('content')

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('/images/bg-02.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Blog
	</h2>
</section>	


<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					<!-- item blog -->
					@foreach($posts as $post)
					<div class="p-b-63">
						<a href="{{ route('post', $post->alias) }}" class="hov-img0 how-pos5-parent">
							<img src="/images/{{ $post->img }}" alt="IMG-BLOG">

							<div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									22
								</span>

								<span class="stext-109 cl3 txt-center">
									Jan 2018
								</span>
							</div>
						</a>

						<div class="p-t-32">
							<h4 class="p-b-15">
								<a href="{{ route('post', $post->alias) }}" class="ltext-108 cl2 hov-cl1 trans-04">
									{{ $post->title }}
								</a>
							</h4>

							<p class="stext-117 cl6">{{ $post->intro }}</p>

							<div class="flex-w flex-sb-m p-t-18">
								<span class="flex-w flex-m stext-111 cl2 p-r-30 m-tb-10">
									<span>
										<span class="cl4">By</span> {{ $post->user->name }}  
										<span class="cl12 m-l-4 m-r-6">|</span>
									</span>

									<span>
										@if($post->tags()->get()->toArray())
											{{ implode(', ', simplify_array($post, 'title', 'tags')) }}
											<span class="cl12 m-l-4 m-r-6">  |</span>
										@endif
									</span>

									<span>
										@if(count($post->comments) > 1)
											{{ count($post->comments).' Comments' }}
										@elseif(count($post->comments) === 1)
											1 Comment
										@elseif(count($post->comments) === 0)
											No comments
										@endif
									</span>
								</span>

								<a href="{{ route('post', $post->alias) }}" class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
									Continue Reading

									<i class="fa fa-long-arrow-right m-l-9"></i>
								</a>
							</div>
						</div>
					</div>
					@endforeach

					<!-- Pagination -->
					{{ $posts->links() }}
				</div>
			</div>

			<div class="col-md-4 col-lg-3 p-b-80">
				<div class="side-menu">
					<div class="bor17 of-hidden pos-relative">
						<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">

						<button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
					</div>

					<div class="p-t-55">
						<h4 class="mtext-112 cl2 p-b-33">
							Categories
						</h4>

						<ul>
							@foreach($categories as $categorie)
							<li class="bor18">
								<a href="{{ route('blog', $categorie->alias) }}" class="dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4 hov-butt {{ isset($catTitle) && $categorie->alias == $catTitle ? 'how-active2' : '' }}">
									{{ $categorie->title }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>

					<div class="p-t-65">
						<h4 class="mtext-112 cl2 p-b-33">
							Featured Products
						</h4>

						<ul>
							@foreach($products as $prod)
							<li class="flex-w flex-t p-b-30">
								<a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
									<img src="/images/{{ isset($prod->photos[0])?$prod->photos[0]->photo:'default-photo.png' }}" alt="PRODUCT" width="90" height="110">
								</a>

								<div class="size-215 flex-col-t p-t-8">
									<a href="#" class="stext-116 cl8 hov-cl1 trans-04">
										{{ $prod->title }}
									</a>

									<span class="stext-116 cl6 p-t-20">
										${{ $prod->price }}.00
									</span>
								</div>
							</li>
							@endforeach
						</ul>
					</div>

					<div class="p-t-55">
						<h4 class="mtext-112 cl2 p-b-20">
							Archive
						</h4>

						<ul>
							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										July 2018
									</span>

									<span>
										(9)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										June 2018
									</span>

									<span>
										(39)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										May 2018
									</span>

									<span>
										(29)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										April  2018
									</span>

									<span>
										(35)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										March 2018
									</span>

									<span>
										(22)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										February 2018
									</span>

									<span>
										(32)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										January 2018
									</span>

									<span>
										(21)
									</span>
								</a>
							</li>

							<li class="p-b-7">
								<a href="#" class="flex-w flex-sb-m stext-115 cl6 hov-cl1 trans-04 p-tb-2">
									<span>
										December 2017
									</span>

									<span>
										(26)
									</span>
								</a>
							</li>
						</ul>
					</div>

					<div class="p-t-50">
						<h4 class="mtext-112 cl2 p-b-27">
							Tags
						</h4>

						<div class="flex-w m-r--5">
							@foreach($tags as $tag)
							<a href="{{ route('blog.search.tags', $tag->title) }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5 title {{ isset($curTag) && $tag->title == $curTag ? 'tag-active' : '' }}">
								{{ $tag->title }}
							</a>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	

@stop


@section('scripts')
<!--===============================================================================================-->	
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
<!--===============================================================================================-->
	<script src="/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
@stop