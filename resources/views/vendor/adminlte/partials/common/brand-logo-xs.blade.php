@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

{{-- Logika arah URL --}}
<a href="{{ Auth::check() ? url('/profile') : $dashboard_url }}"
   @if(config('adminlte.classes_brand'))
       class="{{ config('adminlte.classes_brand') }}"
   @else
       class="brand-link {{ config('adminlte.classes_brand_text') }}"
   @endif>

    @if(Auth::check())
        {{-- KUNCI UKURAN FOTO DI SINI (width: 33px, height: 33px) --}}
        <img src="{{ asset('storage/' . Auth::user()->foto) }}"
             alt="User Profile"
             class="brand-image img-circle elevation-3"
             style="width: 33px; height: 33px; object-fit: cover; opacity: .8;">
             
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {{ Auth::user()->name }}
        </span>
    @else
        {{-- FOTO FALLBACK --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="width: 33px; height: 33px; object-fit: cover; opacity: .8;">
             
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
        </span>
    @endif
</a>