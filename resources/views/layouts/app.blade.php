<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('settings.seo_title')}}</title>
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


<!-- Include Bootstrap JS and jQuery -->
<script src="{{asset('/')}}assets/js/jquery-3.7.1.min.js"></script>
<script src="{{asset('/')}}assets/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(".icon-list").click(function () {
        $(this).find(".list").toggleClass("visible");
    });
</script>
{{$js}}
</body>
</html>
