<div class="icon-list">
    <img src="{{asset('assets/images/icon-list.png')}}" alt="">
    <ul class="list hidden">
        <li><a href="{{route('website.plans')}}">الرئيسية</a></li>
        <li><a href="{{route('website.visits.index')}}">زياراتي</a></li>
        <li>
            <a href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
               خروج
            </a>
            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
                <input type="hidden" name="visitor" value="1">
            </form>
        </li>
    </ul>
</div>


