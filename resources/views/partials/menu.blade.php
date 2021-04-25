<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-user"></i>
                    Users
                </a>
            </li>

            <li>
                <a href="{{ route('admin.skills.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tags"></i>
                    Skills
                </a>
            </li>

            <li>
                <a href="{{ route('admin.projects.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-project-diagram"></i>
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('admin.competitions.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fas fa-trophy"></i>
                    Competitions
                </a>
            </li>
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>