<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css">
    </x-slot>

    <div class="home-bg" style="background-image: url('{{asset('/')}}assets/images/home-bg.png');">
        <!-- Centered Content -->
        <div class="d-flex flex-column ">
            <header class="text-center py-4">
                <div class="container">
                    <img src="{{asset('assets/images/logo.jpg')}}" alt="الشعار" class="rounded-circle mb-2 logo">
                    <h1 class="h-title-a">خدمة البحث عن المفرَج عنهم: دعم التواصل والشفافية</h1>
                </div>
            </header>

            <div class="container mt-5">
                <div class="text-center mb-4">
                    <p class="text-page">تعد قاعدة البيانات هذه خدمة مخصصة للبحث عن المسجونين الذين تم إخلاء سبيلهم. تهدف إلى توفير
                        المعلومات بشكل دقيق وشفاف لجميع الأفراد، مع الالتزام التام بالخصوصية واحترام القيم الإنسانية
                        والاجتماعية. يتم استخدام هذه الخدمة لتسهيل التواصل مع الأفراد المعنيين وتمكين ذويهم أو الجهات
                        المختصة من متابعة حالتهم بطريقة آمنة وسهلة.</p>
                </div>
                <form id="searchForm" class="mb-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <input type="text" id="name" name="name"  class="form-control form-control-lg" placeholder="اكتب الاسم هنا"
                                   required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100">بحث</button>
                        </div>
                    </div>
                </form>

                <div id="result" class="result">
                    <h4>النتائج:</h4>
                    <div id="resultList"></div>
                </div>
                <p id="noResultsMessage" class="no-results" style="display:none;">لا توجد نتائج لهذا الاسم.</p>

            </div>


        </div>


    </div>

    <x-slot name="js">
        <script>
                $(document).ready(function() {
                // عند إرسال النموذج
                $("#searchForm").submit(function(e) {
                    e.preventDefault(); // منع إعادة تحميل الصفحة

                    var name = $("#name").val(); // الحصول على الاسم من النموذج

                    if (name) {
                        // إرسال طلب AJAX إلى الرابط
                        $.ajax({
                            url: '{{route('get_data')}}',  // رابط API لارافيل
                            type: 'GET',
                            data: { query: name },
                            success: function(response) {
                                // التأكد من أن البيانات موجودة
                                if (response.message === 'success' && response.prisoners.length > 0) {
                                    var resultList = $('#resultList');
                                    resultList.empty(); // مسح النتائج السابقة
                                    $('#noResultsMessage').hide(); // إخفاء رسالة عدم وجود نتائج

                                    // عرض البيانات
                                    response.prisoners.forEach(function(item) {
                                        var prisonerCard = $('<div class="prisoner-card"></div>');
                                        prisonerCard.append('<div class="prisoner-name">' + item.name + '</div>');
                                        prisonerCard.append('<div class="prisoner-details">السجن: ' + (item.prison || 'غير محدد') + '</div>');
                                        resultList.append(prisonerCard);
                                    });

                                    // إظهار النتائج
                                    $('#result').show();
                                } else {
                                    $('#result').hide();
                                    $('#noResultsMessage').show();
                                }
                            },
                            error: function() {
                                alert('حدث خطأ أثناء استلام البيانات.');
                            }
                        });
                    } else {
                        alert('يرجى إدخال اسم للبحث');
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
