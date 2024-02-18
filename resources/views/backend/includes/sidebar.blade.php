<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>

            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.system')
                </li>

                <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/blogs'), 'open')
                }}">
                    <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/blogs*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-rss"></i> @lang('menus.backend.sidebar.blogs')
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/blogs/blog-categories*'))
                        }}" href="{{ route('admin.blog-categories.index') }}">
                                @lang('labels.backend.access.blog-category.management')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{
                            active_class(Route::is('admin/blogs/blog-tags*'))
                        }}" href="{{ route('admin.blog-tags.index') }}">
                                @lang('labels.backend.access.blog-tag.management')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blogs')) }}" 
                                href="{{ route('admin.blogs.index') }}">
                                @lang('labels.backend.access.blogs.management')
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
