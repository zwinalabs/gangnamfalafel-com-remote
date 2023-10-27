<div class="col-12">
    <section id="borne-area" class="section">
        <div>
        <div id="menu-content" class="">
            <div id="menu-header">
                <div id="menu-header-content"></div>
            </div>
            <div id="menu-body">
                <div id="menu-categories" class="col-2 col-md-2">
                    @if(!$restorant->categories->isEmpty())
                    {{-- tabbable sticky --}}
                        <nav class="tabbable " style="top: {{ config('app.isqrsaas') ? 64:88 }}px;">
                            <ul class="nav nav-pills bg-white mb-2" style=>
                                <li class="nav-item nav-item-category ">
                                    <a class="nav-link  mb-sm-3 mb-md-0 active" data-toggle="tab" role="tab" href="">{{ __('All categories') }}</a>
                                </li>
                                @foreach ( $restorant->categories as $key => $category)
                                    @if(!$category->aitems->isEmpty())
                                        <li class="nav-item nav-item-category" id="{{ 'cat_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">
                                            <a class="nav-link mb-sm-3 mb-md-0" data-toggle="tab" role="tab" id="{{ 'nav_'.clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}" href="#{{ clean(str_replace(' ', '', strtolower($category->name)).strval($key)) }}">{{ $category->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    @endif
                </div>
                <div id="menu-items" class="col-2 col-md-8">

                </div>
                <div id="menu-carts" class="col-2 col-md-2">

                </div>
            </div>
            <div id="menu-footer"></div>
        </div>
    </section>
</div>