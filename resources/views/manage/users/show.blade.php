<x-manage title="{{$user->name}}">


    <x-slot name="headerPage">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{$user->name}}</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </x-slot>
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">بيانات المستخدم</div>
        </div>
        <div class="card-body pt-0">
            <p>الاسم: {{$user->name}}</p>
            <p>البريد الالكتروني: {{$user->email}}</p>
            <p>رقم الجوال: {{$user->phone ?? '-'}}</p>
        </div>
    </div>
    <subscriptions :user="`{{$user->id}}`"></subscriptions>



</x-manage>
<script>

</script>
