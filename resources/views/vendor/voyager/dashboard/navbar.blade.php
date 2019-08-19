<!-- custom navbar: 18 Aug 19 -->
<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
            @section('breadcrumbs')
                <ol class="breadcrumb hidden-xs">
                    @php
                    $segments = array_filter(explode('/', str_replace(route('voyager.dashboard'), '', Request::url())));
                    $url = route('voyager.dashboard');
                    @endphp
                    @if(count($segments) == 0)
                        <li class="active"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</li>
                    @else
                        <li class="active">
                            <a href="{{ route('voyager.dashboard')}}"><i class="voyager-boat"></i> {{ __('voyager::generic.dashboard') }}</a>
                        </li>
                        @foreach ($segments as $segment)
                            @php
                            $url .= '/'.$segment;
                            @endphp
                            @if ($loop->last)
                                <li>{{ ucfirst($segment) }}</li>
                            @else
                                <li>
                                    <a href="{{ $url }}">{{ ucfirst($segment) }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ol>
            @show
        </div>

        <ul class="nav navbar-nav @if (config('voyager.multilingual.rtl')) navbar-left @else navbar-right @endif">
            <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
            @if(is_array($nav_items) && !empty($nav_items))
                @foreach($nav_items as $name => $item)
                <li {!! isset($item['classes']) && !empty($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                    @if(isset($item['route']) && $item['route'] == 'voyager.logout')
                        <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            @if(isset($item['icon_class']) && !empty($item['icon_class']))
                                <i class="{!! $item['icon_class'] !!}"></i>
                            @endif
                            
                            {{__($name)}}
                        </a>

                        <form id="logout-form" action="{{ route('voyager.logout') }}" method="POST" style="display: none">
                            {{ csrf_field() }}
                        </form>
                    @else
                    <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : (isset($item['route']) ? $item['route'] : '#') }}" {!! isset($item['target_blank']) && $item['target_blank'] ? 'target="_blank"' : '' !!}>
                        @if(isset($item['icon_class']) && !empty($item['icon_class']))
                        <i class="{!! $item['icon_class'] !!}"></i>
                        @endif
                        {{__($name)}}
                    </a>
                    @endif
                </li>
                @endforeach
            @endif                
        </ul>
    </div>
</nav>
