<ul style="background-color: #212a39" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-text mx-3">{{ __('Homepage') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    @can('user_management_access')
        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cogs"></i>
                <span>{{ __('User Management') }}</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}"
                        href="{{ route('admin.permissions.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                        {{ __('Permissions') }}</a>
                    <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}"
                        href="{{ route('admin.roles.index') }}"><i class="fa fa-briefcase mr-2"></i>
                        {{ __('Roles') }}</a>
                    <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('Users') }}</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProperty" aria-expanded="true"
                aria-controls="collapseProperty">
                <i class="fas fa-home"></i>
                <span>{{ __('Business Management') }}</span>
            </a>
            <div id="collapseProperty" class="collapse" aria-labelledby="headingProperty" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}"
                        href="{{ route('admin.categories.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                        {{ __('Category') }}</a>
                    <a class="collapse-item {{ request()->is('admin/properties') || request()->is('admin/properties/*') ? 'active' : '' }}"
                        href="{{ route('admin.properties.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                        {{ __('Bussiness') }}</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ request()->is('admin/messages') || request()->is('admin/messages') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.messages.index') }}">
                <i class="fas fa-envelope"></i>
                <span>{{ __('Message') }}</span></a>
        </li>

        {{--               Blog start            --}}

        <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true"
                aria-controls="collapseBlog">
                <i class="fas fa-home"></i>
                <span>{{ __('Blog Management') }}</span>
            </a>
            <div id="collapseBlog" class="collapse" aria-labelledby="headingBlog" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin/blog_categories') || request()->is('admin/blog_categories/*') ? 'active' : '' }}"
                        href="{{ route('admin.blog_categories.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                        {{ __('Blog Category') }}</a>


                    <a class="collapse-item {{ request()->is('admin/blogpost') || request()->is('admin/blogpost/*') ? 'active' : '' }}"
                        href="{{ route('admin.blogpost.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                        {{ __('Post') }}</a>

                </div>
            </div>
        </li>

        {{--               Blog end             --}}
    @endcan
    @if (auth()->user()->roles()->where('title', 'agent')->count() > 0)
        @can('blog_access')
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseBlog" aria-expanded="true"
                    aria-controls="collapseBlog">
                    <i class="fas fa-home"></i>
                    <span>{{ __('Blog Management') }}</span>
                </a>
                <div id="collapseBlog" class="collapse" aria-labelledby="headingBlog" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/blogs') || request()->is('admin/blogs/*') ? 'active' : '' }}"
                            href="{{ route('admin.blogs.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                            {{ __('Blog') }}</a>
                    </div>
                </div>
            </li>
        @endcan
        <li class="nav-item {{ request()->is('admin/agents') || request()->is('admin/agents') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.agents.edit', auth()->id()) }}">
                <i class="fas fa-cog"></i>
                <span>{{ __('Update Profile') }}</span></a>
        </li>
    @endif

    {{--               Blog end             --}}

    @if (auth()->user()->roles()->where('title', 'agent')->count() > 0)
        @can('property_access')
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseProperty"
                    aria-expanded="true" aria-controls="collapseProperty">
                    <i class="fas fa-home"></i>
                    <span>{{ __('Business Management') }}</span>
                </a>
                <div id="collapseProperty" class="collapse" aria-labelledby="headingProperty"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/properties') || request()->is('admin/properties/*') ? 'active' : '' }}"
                            href="{{ route('admin.properties.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                            {{ __('Business') }}</a>
                    </div>
                </div>
            </li>
        @endcan
        <li class="nav-item {{ request()->is('admin/agents') || request()->is('admin/agents') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.agents.edit', auth()->id()) }}">
                <i class="fas fa-cog"></i>
                <span>{{ __('Update Profile') }}</span></a>
        </li>
    @endif

{{--               Add management start             --}}
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseAdd" aria-expanded="true"
        aria-controls="collapseAdd">
        <i class="fas fa-home"></i>
        <span>{{ __('Add Management') }}</span>
    </a>
    <div id="collapseAdd" class="collapse" aria-labelledby="headingBlog" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->is('admin/addcategories') || request()->is('admin/addcategories/*') ? 'active' : '' }}"
                href="{{ route('admin.addcategories.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                {{ __('Add Category') }}</a>


            <a class="collapse-item {{ request()->is('admin/blogpost') || request()->is('admin/blogpost/*') ? 'active' : '' }}"
                href="{{ route('admin.blogpost.index') }}"> <i class="fa fa-briefcase mr-2"></i>
                {{ __('Add') }}</a>

        </div>
    </div>
</li>
{{--               Add management end             --}}


</ul>
