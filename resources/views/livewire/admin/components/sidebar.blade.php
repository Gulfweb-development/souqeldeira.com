<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ admin()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link  {{ request()->segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                @lang('app.dashboard')
                            </p>
                        </a>
                    </li>
                    @if (permationTo('admin_view'))

                        <li class="nav-item">
                            <a href="{{ route('admin.admin.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'admin' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.admins')
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (permationTo('role_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.role.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'role' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.roles')
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (permationTo('setting_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'setting' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.settings')
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (permationTo('governorate_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.governorate.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'governorate' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.governorates')
                                </p>
                            </a>
                        </li>

                    @endif



                    <li class="nav-item">
                        <a href="{{ route('admin.subscriptions.index') }}"
                            class="nav-link  {{ request()->segment(2) == 'subscriptions' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                @lang('app.subscriptions')
                            </p>
                        </a>
                    </li>


                    @if (permationTo('region_create'))
                        <li class="nav-item">
                            <a href="{{ route('admin.region.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'region' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.regions')
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (permationTo('building_type_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.buildingtype.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'buildingtype' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.building_types')
                                </p>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
            <a href="{{ route('admin.buildingstatus.index') }}" class="nav-link  {{ request()->segment(2) == 'buildingstatus' ? 'active' : '' }}" >
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('app.building_statuses')
              </p>
            </a>
          </li> --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('admin.slider.index') }}"
                            class="nav-link  {{ request()->segment(2) == 'slider' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                @lang('app.sliders')
                            </p>
                        </a>
                    </li> --}}
                    @if (permationTo('client_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.client.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'client' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.clients')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (permationTo('faq_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.faq.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'faq' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.faqs')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (permationTo('policy_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.policy.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'policy' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.policies')
                                </p>
                            </a>
                        </li>
                    @endif
                    <li
                        class="nav-item has-treeview {{ in_array(request()->segment(2), ['about', 'whychooseus']) ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ in_array(request()->segment(2), ['about', 'whychooseus']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                @lang('app.abouts')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (permationTo('about_text_view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.about.index') }}"
                                        class="nav-link {{ request()->segment(2) == 'about' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> @lang('app.text')</p>
                                    </a>
                                </li>
                            @endif
                            @if (permationTo('about_why_choose_view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.whychooseus.index') }}"
                                        class="nav-link {{ request()->segment(2) == 'whychooseus' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> @lang('app.why_choose_us')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li
                        class="nav-item has-treeview {{ in_array(request()->segment(2), ['contact', 'info']) ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ in_array(request()->segment(2), ['contact', 'info']) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                @lang('app.contacts')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (permationTo('contact_message_view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.contact.index') }}"
                                        class="nav-link {{ request()->segment(2) == 'contact' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> @lang('app.message')</p>
                                    </a>
                                </li>
                            @endif
                            @if (permationTo('contact_info_view'))
                                <li class="nav-item">
                                    <a href="{{ route('admin.info.index') }}"
                                        class="nav-link {{ request()->segment(2) == 'info' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> @lang('app.infos')</p>
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a href="{{ route('admin.reports.index') }}"
                                   class="nav-link {{ request()->segment(2) == 'reports' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p> @lang('app.reports')</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
            <a href="{{ route('admin.about.index') }}" class="nav-link  {{ request()->segment(2) == 'about' ? 'active' : '' }}" >
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('app.abouts')
              </p>
            </a>
          </li> --}}

                    @if (permationTo('blog_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.blog.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'blog' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.blogs')
                                </p>
                            </a>
                        </li>
                    @endif

                    @if (permationTo('user_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'user' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.users')
                                </p>
                            </a>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
            <a href="{{ route('admin.company.index') }}" class="nav-link  {{ request()->segment(2) == 'company' ? 'active' : '' }}" >
              <i class="nav-icon fas fa-th"></i>
              <p>
                @lang('app.companies')
              </p>
            </a>
          </li> --}}
                    @if (permationTo('agency_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.agency.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'agency' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.agencies')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (permationTo('ad_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.ad.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'ad' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.ads')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (permationTo('school_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.school.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'school' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.schools')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (permationTo('comment_view'))
                        <li class="nav-item">
                            <a href="{{ route('admin.comment.index') }}"
                                class="nav-link  {{ request()->segment(2) == 'comment' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.comments')
                                </p>
                            </a>
                        </li>
                    @endif
                    @if ('notification_create')
                        <li class="nav-item">
                            <a href="{{ route('admin.notification.create') }}"
                                class="nav-link  {{ request()->segment(2) == 'notification' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    @lang('app.notifications')
                                </p>
                            </a>
                        </li>
                    @endif
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
