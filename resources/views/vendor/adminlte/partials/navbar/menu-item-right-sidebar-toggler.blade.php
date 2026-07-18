{{-- Dropdown Daftar Teman --}}
<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-users"></i>
        <span class="badge badge-warning navbar-badge">{{ count($myFriends ?? []) }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">{{ count($myFriends ?? []) }} Teman Anda</span>
        <div class="dropdown-divider"></div>
        
        @forelse($myFriends as $friend)
            <a href="#" class="dropdown-item">
                <i class="fas fa-user mr-2"></i> {{ $friend->name }}
            </a>
        @empty
            <span class="dropdown-item text-muted text-sm text-center">Belum ada teman</span>
        @endforelse
    </div>
</li>