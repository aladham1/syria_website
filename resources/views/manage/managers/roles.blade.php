<x-manage title="الصلاحيات">
    <x-slot name="headerPage">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">الصلاحيات
        </div>
        @can('create', \App\Models\Role::class)
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="javascript:;"
                   class="btn btn-sm btn-primary" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_create_app">
                    <i class="fas fa-plus fs-4 me-2"></i>
                   اضافة</a>
            </div>
        @endcan
    </x-slot>


    <roles :can_edit="{{json_encode(Auth::user()->hasAbility('roles.update'))}}"
           :can_delete="{{json_encode(Auth::user()->hasAbility('roles.delete'))}}"></roles>


</x-manage>
