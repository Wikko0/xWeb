@extends('Default.layout.default')

@section('content')

    @include('Default.block.leftblock')


    <div class="block-info">
        <div class="container flex-s">
            <div class="block-info-left block-info-b">
                <div class="game-info block-color">
                    <div class="info-text">
                        <div class="block-info-title">
                            Account
                            <span>Panel</span>
                        </div>
                        <a href="{{route('account-panel')}}">Learn More</a>
                    </div>
                </div>
                <div class="game-events block-bw">
                    <div class="flex-s-c info-text">
                        <div class="block-info-title">
                            Buy
                            <span>VIP</span>
                        </div>
                        <a href="{{route('buyvip')}}">Learn More</a>
                    </div>
                </div>
            </div><!-- block-info-left -->
            <div class="block-info-center">
                <div class="tab-title flex-c">
                    <a data-tab="news" class="tab-links active">News</a>
                    <a data-tab="eventss" class="tab-links">Events</a>
                    <a data-tab="updates" class="tab-links">Updates</a>
                    <a href="{{route('news')}}" class="tab-links-more">+</a>
                </div>
                <div class="tab-block">
                    <div class="tab-block-news active tab" id="news">
                        @foreach($informationProvider as $values)
                            <h2>{{$values->version}}! {{$values->sname}}</h2>
                        @endforeach
                        @foreach($news->take(5) as $new)

                            <a href="{{route('news')}}" title="News" class="news-title"><b>[{{$new->prefix}}
                                    ]</b> {{$new->subject}}
                                <span class="news-date">{{$new->date}}</span></a>
                        @endforeach
                    </div>
                    <div class="tab-block-news tab" id="eventss">
                        @foreach($informationProvider as $values)
                            <h2>{{$values->version}}! {{$values->sname}}</h2>
                        @endforeach
                        @foreach($events->take(5) as $event)

                            <a href="{{route('news')}}" title="News" class="news-title"><b>[{{$event->prefix}}]</b>
                                {{$event->subject}} <span class="news-date">{{$event->date}}</span></a>
                        @endforeach
                    </div>
                    <div class="tab-block-news tab" id="updates">
                        @foreach($informationProvider as $values)
                            <h2>{{$values->version}}! {{$values->sname}}</h2>
                        @endforeach
                        @foreach($updates->take(5) as $update)

                            <a href="{{route('news')}}" title="News" class="news-title"><b>[{{$update->prefix}}]</b>
                                {{$update->subject}} <span class="news-date">{{$update->date}}</span></a>
                        @endforeach
                    </div>
                </div>
            </div><!-- block-info-center -->
            <div class="block-info-right block-info-b">
                <div class="vip block-bw">
                    <div class="flex-s-c info-text">
                        <div class="block-info-title">
                            Buy
                            <span>Credits</span>
                        </div>
                        <a href="{{route('buycredits')}}">Learn More</a>
                    </div>
                </div>
                <div class="pets block-color">
                    <div class="info-text">
                        <div class="block-info-title">
                            Game
                            <span>Info</span>
                        </div>
                        <a href="{{route('information')}}">Learn More</a>
                    </div>
                </div>
            </div><!-- block-info-right -->
        </div><!-- container -->
    </div><!-- block-info -->
    <div class="battle-block">
        <div class="container flex-s-c">
            <div class="vanert flex">
                <div class="ranking-home">
                    <table>
                        <tbody>
                        <tr>
                            <td class="title">Rank</td>
                            <td class="title">Nick</td>
                            <td class="title">Character</td>
                            <td class="title">Resets</td>
                        </tr>
                        {!! $topCharacters !!}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="duprian flex">
                <div class="ranking-home">
                    <table>
                        <tbody>
                        <tr>
                            <td class="title">Rank</td>
                            <td class="title">Guild Name</td>
                            <td class="title">Master</td>
                            <td class="title">Resets</td>
                        </tr>
                        {!! $topGuilds !!}

                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- container -->
    </div><!-- battle-block -->
    <div class="slider-character">
        <div class="slider-container">
            <div class="slider-bottom-title">
                <h1>Hall of Fame</h1>
                <p>Best characters in server</p>
            </div>

            <div class="slider slider-bottom single-item">
                @foreach($charactersProvider as $values)
                    @if($values->class == "Blade Knight" && $values->status == "Yes")


                        <div class="bk-char">
                            <span class="char-ava gl left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon warrior-icon"></i> Blade Knight
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava sm right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                    @if($values->class == "Soul Master" && $values->status == "Yes")
                        <div class="sm-char">
                            <span class="char-ava bk left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon tank-icon"></i> Soul Master
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava elf right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                    @if($values->class == "Muse Elf" && $values->status == "Yes")
                        <div class="elf-char">
                            <span class="char-ava sm left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon archer-icon"></i> Muse Elf
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava mg right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif
                    @if($values->class == "Dark Lord" && $values->status == "Yes")
                        <div class="dl-char">
                            <span class="char-ava mg left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon tank-icon"></i> Dark Lord
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava sum right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                    @if($values->class == "Summoner" && $values->status == "Yes")
                        <div class="sum-char">
                            <span class="char-ava dl left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon magic-icon"></i> Summoner
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava rf right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                    @if($values->class == "Grow Lancer" && $values->status == "Yes")
                        <div class="gl-char">
                            <span class="char-ava rf left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon magic-icon"></i> Grow Lancer
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava bk right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif
                    @if($values->class == "Magic Gladiator" && $values->status == "Yes")
                        <div class="mg-char">
                            <span class="char-ava elf left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon magic-icon"></i> Magic Gladiator
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava dl right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                    @if($values->class == "Rage Fighter" && $values->status == "Yes")
                        <div class="rf-char">
                            <span class="char-ava sum left"></span>
                            <div class="char-info-block flex-s-c">
                                <div class="char-info">
                                    <div class="char-name">
                                        <i class="type-icon tank-icon"></i> Rage Fighter
                                    </div>
                                    <p>Name: <b>{{$values->name}}</b></p>
                                    <p>Wins: <b>{{$values->wins}}</b></p>
                                </div>
                            </div>
                            <span class="char-ava gl right"></span>
                            <div class="shadow">
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>


@endsection
