<x-manage title="الإعدادات">
    <x-slot name="headerPage">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">الإعدادات</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form class="form" id="settings_form">
               <div class="row">
                   <div class="col-md-6">
                       <div class="d-flex flex-column me-n7 pe-7">
                           <div class="form-floating mb-7">
                               <input type="number" value="{{config('settings.price_for_user')}}" name="price_for_user" class="form-control"
                                      id="price_for_user"
                                      placeholder="رابط التلغرام"/>
                               <label for="price_for_user">رابط التلغرام</label>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="d-flex flex-column me-n7 pe-7">
                           <div class="form-floating mb-7">
                               <input type="text" value="{{config('settings.seo_title')}}" name="seo_title" class="form-control"
                                      id="seo_title"
                                    placeholder="اسم الموقع">
                               <label for="seo_title">أسم الموقع</label>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="d-flex flex-column me-n7 pe-7">
                           <div class="form-floating mb-7">
                               <input type="text" value="{{config('settings.whatsapp')}}" name="whatsapp" class="form-control"
                                      id="whatsapp"
                                      placeholder="رقم الواتس اب">
                               <label for="seo_title">رقم الواتس اب</label>
                           </div>
                       </div>
                   </div>

               </div>
                <div class="text-center pt-15">
                    <button type="button" class="btn btn-primary btn-save">
                        <span class="indicator-label">تحديث</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-slot name="js">
        <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
        <script>
            $(document).ready(function () {
                var update_transaction = function () {
                    $('.btn-save').on("click", function (e) {
                        var data = new FormData($("#settings_form")[0])
                        $.ajax({
                            method: "post",
                            url: "{{route('settings.update')}}",
                            data:data,
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            async: true,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                //  wait.resolve();
                                $(".loadingMask").css('display', 'none');
                                if (data.errors) {
                                    Swal.fire({
                                        text: "حدث خطأ ما، يرجى المحاولة فما بعد!",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "حسناً",
                                        customClass: {
                                            confirmButton: "btn btn-danger"
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        text: "تم التحديث بنجاح!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "حسناً",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    });
                                }
                            },
                            error: function () {
                                $(".loadingMask").css('display', 'none');
                                Swal.fire({
                                    text: "حدث خطأ ما، يرجى المحاولة فما بعد!",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "حسناً",
                                    customClass: {
                                        confirmButton: "btn btn-danger"
                                    }
                                });
                            }
                        });


                    });
                };
                update_transaction();


            });
        </script>
    </x-slot>
</x-manage>