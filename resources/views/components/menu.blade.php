<!--begin::Menu-->
<div
    class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
    id="#kt_aside_menu" data-kt-menu="true">

    <div class="menu-item">
        <a class="menu-link" href="{{route('dashboard')}}">
										<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
													<rect x="2" y="2" width="9" height="9" rx="2" fill="black"/>
													<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
													<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                          fill="black"/>
												</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
            <span class="menu-title">الرئيسية</span>
        </a>
    </div>

    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            {{--            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('common.management')}}</span>--}}
        </div>
    </div>


    @if ( Auth::user()->can('view-any', \App\Models\User::class) || Auth::user()->can('view-any',  \App\Models\Role::class) )
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
									<span class="menu-link">
										<span class="menu-icon">
<span class="svg-icon svg-icon-2">   <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                          fill="none">
<path
    d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
    fill="black"/>
<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
<path
    d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
    fill="black"/>
<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
</svg></span>
										</span>
										<span class="menu-title">الاداريين</span>
										<span class="menu-arrow"></span>
									</span>
            <div class="menu-sub menu-sub-accordion">
                @can('view-any', \App\Models\User::class)
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('users.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">{{__('All managers')}}</span>
                        </a>
                    </div>
                @endcan
                @can('view-any', \App\Models\Role::class)
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('roles.index')}}">
												<span class="menu-bullet">
													<span class="bullet bullet-dot"></span>
												</span>
                            <span class="menu-title">الصلاحيات</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    @endif
    @can('view-any', \App\Models\Visitor::class)
{{--        <div class="menu-item">--}}
{{--            <a class="menu-link" href="{{route('visitors.index')}}">--}}
{{--										<span class="menu-icon">--}}
{{--										<span class="svg-icon svg-icon-2">   <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                                                                  width="24" height="24"--}}
{{--                                                                                  viewBox="0 0 24 24"--}}
{{--                                                                                  fill="none">--}}
{{--<path--}}
{{--    d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"--}}
{{--    fill="black"/>--}}
{{--<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>--}}
{{--<path--}}
{{--    d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"--}}
{{--    fill="black"/>--}}
{{--<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>--}}
{{--</svg></span>--}}
{{--                                            <!--end::Svg Icon-->--}}
{{--										</span>--}}
{{--                <span class="menu-title">{{__('Visitors')}}</span>--}}
{{--            </a>--}}
{{--        </div>--}}
    @endcan
        <div class="menu-item">
            <a class="menu-link" href="{{route('prisoners.index')}}">
										<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
     fill="none">
<path
    d="M16.0173 9H15.3945C14.2833 9 13.263 9.61425 12.7431 10.5963L12.154 11.7091C12.0645 11.8781 12.1072 12.0868 12.2559 12.2071L12.6402 12.5183C13.2631 13.0225 13.7556 13.6691 14.0764 14.4035L14.2321 14.7601C14.2957 14.9058 14.4396 15 14.5987 15H18.6747C19.7297 15 20.4057 13.8774 19.912 12.945L18.6686 10.5963C18.1487 9.61425 17.1285 9 16.0173 9Z"
    fill="black"/>
<rect opacity="0.3" x="14" y="4" width="4" height="4" rx="2" fill="black"/>
<path
    d="M4.65486 14.8559C5.40389 13.1224 7.11161 12 9 12C10.8884 12 12.5961 13.1224 13.3451 14.8559L14.793 18.2067C15.3636 19.5271 14.3955 21 12.9571 21H5.04292C3.60453 21 2.63644 19.5271 3.20698 18.2067L4.65486 14.8559Z"
    fill="black"/>
<rect opacity="0.3" x="6" y="5" width="6" height="6" rx="3" fill="black"/>
</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                <span class="menu-title">السجناء</span>
            </a>
        </div>
        <div class="menu-item">
            <a class="menu-link" href="{{route('settings.index')}}">
										<span class="menu-icon">
										<span class="svg-icon svg-icon-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3"
      d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
      fill="black"/>
<path
    d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
    fill="black"/>
</svg>
											</span>
                                            <!--end::Svg Icon-->
										</span>
                <span class="menu-title">الإعدادات</span>
            </a>
        </div>

    <div class="menu-item">
        <div class="menu-content pt-8 pb-2">
            {{--            <span class="menu-section text-muted text-uppercase fs-8 ls-1">{{__('common.website')}}</span>--}}
        </div>
    </div>

</div>
<!--end::Menu-->
