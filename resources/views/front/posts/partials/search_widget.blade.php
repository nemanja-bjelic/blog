<!-- Widget [Search Bar Widget]-->
<div class="widget search">
    <header>
        <h3 class="h6">@lang('Search the blog')</h3>
    </header>
    <form 
        action="{{ route('front.posts.search_posts') }}"
        method="get"
        class="search-form"
    >
        <div class="form-group">
            <input 
                type="search" 
                placeholder="@lang('What are you looking for')?"
                name="search_term"
            >
            <button type="submit" class="submit"><i class="icon-search"></i></button>
        </div>
    </form>
</div>