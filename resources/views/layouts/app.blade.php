<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سوريا ويب سايت</title>
    <!-- Include Bootstrap CSS -->
    <link href="{{asset('/')}}assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/css/website2.css" rel="stylesheet">
</head>
<body>
<!-- Your content goes here -->
<main>
    <section id="inner-section">
        {{$slot}}
    </section>
</main>
<footer class="text-white text-center py-3 mt-5">
    <div class="container">
        <p>اشترك معنا:</p>
        <a href="{{config('settings.telgrame')}}" target="_blank" class="btn btn-outline-light me-2">قناتنا على التلغرام</a>
        <a href="{{config('settings.whatsapp')}}" target="_blank" class="btn btn-outline-light">التواصل عبر الواتساب</a>
    <p class="mt-3">{!! config('settings.footer_text') !!}</p>
    </div>
</footer>

<!-- Include Bootstrap JS and jQuery -->
<script src="{{asset('/')}}assets/js/jquery-3.7.1.min.js"></script>
<script src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(".icon-list").click(function () {
        $(this).find(".list").toggleClass("visible");
    });
</script>
{{--xR$*p6#UW!T.--}}
{{$js}}
</body>
</html>
