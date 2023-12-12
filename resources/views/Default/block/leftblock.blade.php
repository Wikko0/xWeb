<div class="block-links">
    <div class="container flex-c-c">

    <div class="links">
            <a href="{{route('download')}}" class="download-button flex-c-c bright">Download</a>
            <a href="{{route('register')}}" class="reg-button flex-c-c bright">Register</a>
            <div class="countdown flex">
                <a href="#modal3" class="open_modal events-button">Events <br> CountDown</a>
                <a href="#modal4" class="open_modal bosses-button">Bosses <br> CountDown</a>
            </div>
        </div>
        <div class="header-slider">
            <div class="slider slider-top single-item">
                @forelse($sliderProvider as $value)
                    <div><img src="images/{{$value->name}}.jpg" alt="Slider{{$value->name}}"></div>
                @empty
                    <div><img src="{{asset('images/slider-img.jpg')}}" alt="Slider"></div>
                @endforelse
            </div>
        </div>
        </div><!-- container -->
        </div><!-- block-links -->
