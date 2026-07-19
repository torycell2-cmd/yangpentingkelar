@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

{{-- URL Tujuan: Jika sudah login, arahkan ke /profile, kalau belum ke dashboard --}}
@php( $target_url = Auth::check() ? url('/profile') : (View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home')) )

@if (config('adminlte.use_route_url', false))
    @php( $target_url = $target_url ? route($target_url) : '' )
@else
    @php( $target_url = $target_url ? url($target_url) : '' )
@endif

<a href="{{ $target_url }}"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand {{ config('adminlte.classes_brand') }}"
    @else
        class="brand-link {{ config('adminlte.classes_brand') }}"
    @endif>

    {{-- FOTO PROFIL (Logika untuk menampilkan foto dari DB) --}}
    @if(Auth::check())
        <img src="{{ asset('storage/' . Auth::user()->foto) }}"
             alt="User Profile"
             class="brand-image img-circle elevation-3"
             style="width: 33px; height: 33px; object-fit: cover; opacity: .8;">

        {{-- NAMA USER --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {{ Auth::user()->name }}
        </span>
    @else
        {{-- FALLBACK LOGO JIKA BELUM LOGIN --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
             alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
             class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
             style="opacity:.8">
        
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
        </span>
    @endif
</a>