<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-lock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('definition_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/countries*") ? "c-show" : "" }} {{ request()->is("admin/provinces*") ? "c-show" : "" }} {{ request()->is("admin/campaign-channels*") ? "c-show" : "" }} {{ request()->is("admin/campaign-orgs*") ? "c-show" : "" }} {{ request()->is("admin/travel-groups*") ? "c-show" : "" }} {{ request()->is("admin/travel-statuses*") ? "c-show" : "" }} {{ request()->is("admin/travel-hospitals*") ? "c-show" : "" }} {{ request()->is("admin/ministries*") ? "c-show" : "" }} {{ request()->is("admin/departments*") ? "c-show" : "" }} {{ request()->is("admin/offices*") ? "c-show" : "" }} {{ request()->is("admin/hospitals*") ? "c-show" : "" }} {{ request()->is("admin/doctors*") ? "c-show" : "" }} {{ request()->is("admin/translators*") ? "c-show" : "" }} {{ request()->is("admin/settings*") ? "c-show" : "" }} {{ request()->is("admin/hotels*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.definition.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('country_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.countries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/countries") || request()->is("admin/countries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.country.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('province_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.provinces.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/provinces") || request()->is("admin/provinces/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-church c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.province.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('campaign_channel_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.campaign-channels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/campaign-channels") || request()->is("admin/campaign-channels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-flag-checkered c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.campaignChannel.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('campaign_org_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.campaign-orgs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/campaign-orgs") || request()->is("admin/campaign-orgs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.campaignOrg.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('travel_group_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.travel-groups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travel-groups") || request()->is("admin/travel-groups/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-object-group c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.travelGroup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('travel_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.travel-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travel-statuses") || request()->is("admin/travel-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-check-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.travelStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('travel_hospital_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.travel-hospitals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travel-hospitals") || request()->is("admin/travel-hospitals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.travelHospital.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('ministry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.ministries.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/ministries") || request()->is("admin/ministries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-globe c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.ministry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('department_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.departments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/departments") || request()->is("admin/departments/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.department.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('office_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.offices.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/offices") || request()->is("admin/offices/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.office.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('hospital_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.hospitals.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hospitals") || request()->is("admin/hospitals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-h-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hospital.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('doctor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.doctors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/doctors") || request()->is("admin/doctors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-md c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.doctor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('translator_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.translators.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/translators") || request()->is("admin/translators/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-language c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.translator.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.setting.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('hotel_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.hotels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/hotels") || request()->is("admin/hotels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-concierge-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hotel.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('coordination_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/patients*") ? "c-show" : "" }} {{ request()->is("admin/travels*") ? "c-show" : "" }} {{ request()->is("admin/travel-treatment-activities*") ? "c-show" : "" }} {{ request()->is("admin/activities*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-ambulance c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.coordination.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('patient_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.patients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/patients") || request()->is("admin/patients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bed c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.patient.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('travel_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.travels.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travels") || request()->is("admin/travels/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase-medical c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.travel.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('travel_treatment_activity_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.travel-treatment-activities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/travel-treatment-activities") || request()->is("admin/travel-treatment-activities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-medical c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.travelTreatmentActivity.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('activity_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.activities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/activities") || request()->is("admin/activities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-notes-medical c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.activity.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('basic_c_r_m_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/crm-statuses*") ? "c-show" : "" }} {{ request()->is("admin/crm-customers*") ? "c-show" : "" }} {{ request()->is("admin/crm-notes*") ? "c-show" : "" }} {{ request()->is("admin/crm-documents*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.basicCRM.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('crm_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_customer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmCustomer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-notes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-trash-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmNote.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('crm_document_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.crm-documents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.crmDocument.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('task_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.taskManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('task_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-statuses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.task-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('task_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.task.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tasks_calendar_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.tasks-calendars.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tasksCalendar.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('finance_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expenses-incomes*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.finance.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expenses_income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses-incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses-incomes") || request()->is("admin/expenses-incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expensesIncome.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('content_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/content-categories*") ? "c-show" : "" }} {{ request()->is("admin/content-tags*") ? "c-show" : "" }} {{ request()->is("admin/content-pages*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.contentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('content_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('content_page_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.content-pages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contentPage.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_alert_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userAlert.title') }}
                </a>
            </li>
        @endcan
        @if(\Illuminate\Support\Facades\Schema::hasColumn('teams', 'owner_id') && \App\Models\Team::where('owner_id', auth()->user()->id)->exists())
            <li class="c-sidebar-nav-item">
                <a class="{{ request()->is("admin/team-members") || request()->is("admin/team-members/*") ? "c-active" : "" }} c-sidebar-nav-link" href="{{ route("admin.team-members.index") }}">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-users">
                    </i>
                    <span>{{ trans("global.team-members") }}</span>
                </a>
            </li>
        @endif
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>