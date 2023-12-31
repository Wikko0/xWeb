<!-- MODALS -->
<div id="modal3" class="modal_div modal-links modal-ev">
    <span class="modal_close"></span>
    <div class="modal-block">
        <div class="modal-links-title event">
            <b>Events</b> <br>
            CountDown
        </div>
        <button>Active notification</button>


        <div id="events" class="list"></div>
        <script type="text/javascript">
            $(document).ready(function () {
                App.getEventTimes();
            });
        </script>

    </div><!-- modal-block -->
</div><!-- modal_div -->

<div id="modal4" class="modal_div modal-links modal-ev">
    <span class="modal_close"></span>
    <div class="modal-block">
        <div class="modal-links-title boss">
            <b>Bosses</b> <br>
            CountDown
        </div>
        <button>Active notification</button>

        <div id="boses" class="list"></div>
        <script type="text/javascript">
            $(document).ready(function () {
                Apps.getEventTimes();
            });
        </script>

    </div><!-- modal-block -->
</div><!-- modal_div -->
<div id="modal5" class="modal_div modal">
    <span class="modal_close"></span>
    @if(session('errors'))
        <div class="notification error">
            <div>
                <li>{{session('errors')}}</li>
            </div>
        </div>
    @endif
    <h1>Login</h1>
    <form method="post" action="{{route('login')}}">
        @csrf
        <p><input type="text" name="login" placeholder="Login" ></p>
        <p><input type="password" name="password" placeholder="Password"></p>
        <p>
            <button class="download-link">Login</button>
        </p>
    </form>
</div><!-- modal_div -->

<div id="modal6" class="modal_div modal-links modal-ev">
    <span class="modal_close"></span>
    <div class="modal-block">
        <div class="modal-links-title event">
            <b>Buy</b> <br>
            Credits
        </div>


        <div class="paypal-logo"></div>

        @foreach($paypalPackProvider->take(4) as $value)
        <form action="{{route('pay')}}" method="post">

            @csrf
            <input type="hidden" name="amount" value="{{$value->amount}}">
            <input type="hidden" name="credits" value="{{$value->credits}}">
        <div class="paypal-heading">
            <h4 class="paypal-title">

                    <span>{{$value->name}}</span>
                    <span>{{$value->credits}} Credits</span>
                    <span> <button type="submit" class="paybutton">{{$value->amount}}$ BUY</button> </span>
            </h4>
        </div>
        </form>
        @endforeach

    </div><!-- modal-block -->
</div><!-- modal_div -->

<div id="modal7" class="modal_div modal-links modal-ev">
    <span class="modal_close"></span>
    <div class="modal-block">
        <div class="modal-links-title event">
            <b>Buy</b> <br>
            VIP
        </div>
        @foreach($vipProvider->take(4) as $values)
        <form action="{{route('getvip')}}" method="post">
            @csrf
            <input type="hidden" name="days" value="{{$values->days}}">
            <input type="hidden" name="credits" value="{{$values->credits}}">

            <div class="buyvip-heading">
                    <h4 class="buyvip-title">


                        <span>{{$values->name}}</span>
                        <span>{{$values->days}} Days</span>
                        <span>{{$values->credits}} Credits</span>
                        <span> <button type="submit" class="buyvipbutton">Get VIP</button> </span>
                    </h4>
                </div>
        </form>
        @endforeach
    </div><!-- modal-block -->
</div><!-- modal_div -->
<div id="overlay"></div>
