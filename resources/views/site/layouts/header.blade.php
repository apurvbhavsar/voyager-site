<div class="navbar navbar-expand-lg navbar-light fixed-top d-flex">
	<div class="container">
		<a href="{{ url('') }}" class="navbar-brand mr-auto"><img src="{{ asset('storage') }}/{{ setting('site.logo') }}" class="img-fluid" alt="{{ setting('site.title') }}"></a>
		<nav>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-3">
                    @php
                        $items = menu('site', '_json');
                        // dd($items);
                    @endphp
                    @foreach ($items as $item)
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ $item->url && $item->url !== "#" ? $item->url : url('/')  }}"> {{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
	</div>
</div>
