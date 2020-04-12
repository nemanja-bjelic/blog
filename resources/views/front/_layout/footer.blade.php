<!-- Page Footer-->
<footer class="main-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <h6 class="text-white">@lang('Bootstrap Blog')</h6>
                </div>
                <div class="contact-details">
                    <p>53 Broadway, Broklyn, NY 11249</p>
                    <p>@lang('Phone'): (020) 123 456 789</p>
                    <p>@lang('Email'): <a href="mailto:info@company.com">Info@Company.com</a></p>
                    <ul class="social-menu">
                        <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menus d-flex">
                    <ul class="list-unstyled">
                        <li> <a href="{{route('front.index.index')}}">@lang('Home')</a></li>
                        <li> <a href="{{route('front.posts.index')}}">@lang('Blog')</a></li>
                        <li> <a href="{{route('front.contact.index')}}">@lang('Contact')</a></li>
                        <li> <a href="{{route('login')}}">Login</a></li>
                    </ul>
                    <ul class="list-unstyled">
                        @foreach(App\Models\PostCategory::query()->orderBy('priority')->limit(4)->get() as $postCategory)
                        <li> <a href="{{ $postCategory->getFrontUrl() }}">{{$postCategory->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="latest-posts">
                    @foreach(\App\Models\Post::query()->where('status', 1)->orderBy('created_at', 'desc')->limit(3)->get() as $post)
                    <a href="{{ $post->getFrontUrl() }}">
                        <div class="post d-flex align-items-center">
                            <div class="image"><img src="{{$post->getPhotoThumbUrl()}}" alt="{{$post->title}}" class="img-fluid"></div>
                            <div class="title"><strong>{{$post->title}}</strong>
                                <span class="date last-meta">{{$post->created_at->format('F d, Y')}}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                        
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; 2017. @lang('All rights reserved. Your great site').</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>@lang('Template By')<a href="{{url('https://bootstrapious.com/p/bootstrap-carousel')}}" class="text-white">@lang('Bootstrapious')</a>
                        <!-- Please do not remove the backlink to Bootstrap Temple unless you purchase an attribution-free license @ Bootstrap Temple or support us at http://bootstrapious.com/donate. It is part of the license conditions. Thanks for understanding :)                         -->
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>