<x-manage title="{{__('Managers')}}">


    <x-slot name="headerPage">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{__('Managers')}}
                <!--end::Description--></h1>
            <!--end::Title-->
        </div>
        @can('create', \App\Models\User::class)
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="javascript:;"
                   class="btn btn-sm btn-primary" data-bs-toggle="modal"
                   data-bs-target="#kt_modal_create_app">
                    <i class="fas fa-plus fs-4 me-2"></i>
                    إضافة إداري</a>
            </div>
        @endcan
    </x-slot>


    <users :type="`{{request()->get('type')}}`" :can_edit="{{json_encode(Auth::user()->hasAbility('users.update'))}}"
              :can_delete="{{json_encode(Auth::user()->hasAbility('users.delete'))}}"></users>

</x-manage>
<script>

</script>
