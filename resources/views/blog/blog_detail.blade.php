@extends('layouts.main', ['title' => 'blog', 'headerClass' => 'header-v4'])

@section('content')

<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="/index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="/blog.html" class="stext-109 cl8 hov-cl1 trans-04">
			Blog
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			8 Inspiring Ways to Wear Dresses in the Winter
		</span>
	</div>
</div>


<!-- Content page -->
<section class="bg0 p-t-52 p-b-20">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					<!--  -->
					<div class="wrap-pic-w how-pos5-parent">
						<img src="/images/blog-04.jpg" alt="IMG-BLOG">

						<div class="flex-col-c-m size-123 bg9 how-pos5">
							<span class="ltext-107 cl2 txt-center">
								22
							</span>

							<span class="stext-109 cl3 txt-center">
								Jan 2018
							</span>
						</div>
					</div>

					<div class="p-t-32">
						<span class="flex-w flex-m stext-111 cl2 p-b-19">
							<span>
								<span class="cl4">By</span> {{ $data->user->name }}  
								<span class="cl12 m-l-4 m-r-6">|</span>
							</span>

							<span>
								22 Jan, 2018
								<span class="cl12 m-l-4 m-r-6">|</span>
							</span>

							<span>
								@if($data->tags()->get()->toArray())
									{{ implode(', ', simplify_array($data, 'title', 'tags')) }}
									<span class="cl12 m-l-4 m-r-6">  |</span>
								@endif
							</span>

							<span>
								@if(count($data->comments) > 1)
									{{ count($data->comments).' Comments' }}
								@elseif(count($data->comments) === 1)
									1 Comment
								@elseif(count($data->comments) === 0)
									No comments
								@endif
							</span>
						</span>

						<h4 class="ltext-109 cl2 p-b-28">
							{{ $data->title }}
						</h4>

						<p class="stext-117 cl6 p-b-26">{{ $data->text }}</p>
					</div>

					@if($data->tags()->get()->toArray())
					<div class="flex-w flex-t p-t-16">
						<span class="size-216 stext-116 cl8 p-t-4">
							Tags
						</span>

						<div class="flex-w size-217">
							@foreach($data->tags as $tag)
							<a href="{{ route('blog.search.tags', $tag->title) }}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
								{{ $tag->title }}
							</a>
							@endforeach
						</div>
					</div>
					@endif

					<!--  -->
					<div class="p-t-40">
						<h5 class="mtext-113 cl2 p-b-12">
							Leave a Comment
						</h5>

						<p class="stext-107 cl6 p-b-40">
							Your email address will not be published.
						</p>

						<form action="{{ route('blog.comment') }}" method="POST">
							<div class="bor19 m-b-20">
								<textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="text" placeholder="Comment..."></textarea>
							</div>

							@if(!Auth::check())
							<div class="bor19 size-218 m-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *">
							</div>

							<div class="bor19 size-218 m-b-20">
								<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *">
							</div>
							@endif

							<input type="hidden" name="post_id" value="{{ $data->id }}">
							<input type="hidden" name="post_title" value="{{ $data->title }}">

							<button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
								Post Comment
							</button>

							{{ csrf_field() }}
							{{ method_field('PUT') }}
						</form>
					</div>
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