<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    @yield('styles')
</head>

<body class="c-app">
    @include('partials.menu')
    <div class="c-wrapper">
        <header class="c-header c-header-fixed px-3">
        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto toggleBtn" type="button" data-target="#sidebar" data-class="c-sidebar-show">
    <i id="smlighticon" class="fas fa-chevron-right"></i>
</button>
<a class="c-header-brand d-lg-none" href="#">{{ trans('panel.site_title') }}</a>

          <button id="toggleButton" class="c-header-toggler mfs-3 d-md-down-none toggleBtn" type="button" responsive="true">
         <i id="lefticon" class="fas fa-chevron-left"></i>
         <i id="righticon" class="fas fa-chevron-right" style="display:none;"></i>
          </button>

            <!-- <button class="main-search" type="button" responsive="true">
                <i class="fas fa-fw fa-search"></i>
            </button>
            <button class="un-clickable"><span class="K" responsive="true">⌘K</span></button> -->
            
            <ul class="c-header-nav ml-auto">

            @if(count(config('panel.available_languages', [])) > 1)
    <li class="c-header-nav-item dropdown d-md-down-none ">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" >
            <svg xmlns="http://www.w3.org/2000/svg"   xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"  class="component-iconify MuiBox-root css-1virv8 iconify iconify--flagpack" width="1.34em" height="1em" viewBox="0 0 32 24"><g fill="none"><path fill="#2E42A5" fill-rule="evenodd" d="M0 0v24h32V0z" clip-rule="evenodd"></path><mask id="iconifyReact7" width="32" height="24" x="0" y="0" maskUnits="userSpaceOnUse" style="mask-type:luminance"><path fill="#fff" fill-rule="evenodd" d="M0 0v24h32V0z" clip-rule="evenodd"></path></mask><g mask="url(#iconifyReact7)"><path fill="#fff" d="m-3.563 22.285l7.041 2.979L32.16 3.238l3.714-4.426l-7.53-.995l-11.698 9.491l-9.416 6.396z"></path><path fill="#F50100" d="M-2.6 24.372L.989 26.1L34.54-1.599h-5.037z"></path><path fill="#fff" d="m35.563 22.285l-7.042 2.979L-.159 3.238l-3.715-4.426l7.53-.995l11.698 9.491l9.416 6.396z"></path><path fill="#F50100" d="m35.323 23.783l-3.588 1.728l-14.286-11.86l-4.236-1.324l-17.445-13.5H.806l17.434 13.18l4.631 1.588z"></path><mask id="iconifyReact8" fill="#fff"><path fill-rule="evenodd" d="M19.778-2h-7.556V8H-1.973v8h14.195v10h7.556V16h14.25V8h-14.25z" clip-rule="evenodd"></path></mask><path fill="#F50100" fill-rule="evenodd" d="M19.778-2h-7.556V8H-1.973v8h14.195v10h7.556V16h14.25V8h-14.25z" clip-rule="evenodd"></path><path fill="#fff" d="M12.222-2v-2h-2v2zm7.556 0h2v-2h-2zM12.222 8v2h2V8zM-1.973 8V6h-2v2zm0 8h-2v2h2zm14.195 0h2v-2h-2zm0 10h-2v2h2zm7.556 0v2h2v-2zm0-10v-2h-2v2zm14.25 0v2h2v-2zm0-8h2V6h-2zm-14.25 0h-2v2h2zm-7.556-8h7.556v-4h-7.556zm2 8V-2h-4V8zm-16.195 2h14.195V6H-1.973zm2 6V8h-4v8zm12.195-2H-1.973v4h14.195zm2 12V16h-4v10zm5.556-2h-7.556v4h7.556zm-2-8v10h4V16zm16.25-2h-14.25v4h14.25zm-2-6v8h4V8zm-12.25 2h14.25V6h-14.25zm-2-12V8h4V-2z" mask="url(#iconifyReact8)"></path></g></g></svg>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url()->current() }}?change_language=tr"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -30000 90000 60000">
	<path fill="#e30a17" d="m0-30000h90000v60000H0z"/>
	<path fill="#fff" d="m41750 0 13568-4408-8386 11541V-7133l8386 11541zm925 8021a15000 15000 0 1 1 0-16042 12000 12000 0 1 0 0 16042z"/>
<script xmlns=""/></svg>Türkçe</a>
            <a class="dropdown-item" href="{{ url()->current() }}?change_language=en">    
 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="component-iconify MuiBox-root css-1virv8 iconify iconify--flagpack" width="1.34em" height="1em" viewBox="0 0 32 24"><g fill="none"><path fill="#2E42A5" fill-rule="evenodd" d="M0 0v24h32V0z" clip-rule="evenodd"></path><mask id="iconifyReact7" width="32" height="24" x="0" y="0" maskUnits="userSpaceOnUse" style="mask-type:luminance"><path fill="#fff" fill-rule="evenodd" d="M0 0v24h32V0z" clip-rule="evenodd"></path></mask><g mask="url(#iconifyReact7)"><path fill="#fff" d="m-3.563 22.285l7.041 2.979L32.16 3.238l3.714-4.426l-7.53-.995l-11.698 9.491l-9.416 6.396z"></path><path fill="#F50100" d="M-2.6 24.372L.989 26.1L34.54-1.599h-5.037z"></path><path fill="#fff" d="m35.563 22.285l-7.042 2.979L-.159 3.238l-3.715-4.426l7.53-.995l11.698 9.491l9.416 6.396z"></path><path fill="#F50100" d="m35.323 23.783l-3.588 1.728l-14.286-11.86l-4.236-1.324l-17.445-13.5H.806l17.434 13.18l4.631 1.588z"></path><mask id="iconifyReact8" fill="#fff"><path fill-rule="evenodd" d="M19.778-2h-7.556V8H-1.973v8h14.195v10h7.556V16h14.25V8h-14.25z" clip-rule="evenodd"></path></mask><path fill="#F50100" fill-rule="evenodd" d="M19.778-2h-7.556V8H-1.973v8h14.195v10h7.556V16h14.25V8h-14.25z" clip-rule="evenodd"></path><path fill="#fff" d="M12.222-2v-2h-2v2zm7.556 0h2v-2h-2zM12.222 8v2h2V8zM-1.973 8V6h-2v2zm0 8h-2v2h2zm14.195 0h2v-2h-2zm0 10h-2v2h2zm7.556 0v2h2v-2zm0-10v-2h-2v2zm14.25 0v2h2v-2zm0-8h2V6h-2zm-14.25 0h-2v2h2zm-7.556-8h7.556v-4h-7.556zm2 8V-2h-4V8zm-16.195 2h14.195V6H-1.973zm2 6V8h-4v8zm12.195-2H-1.973v4h14.195zm2 12V16h-4v10zm5.556-2h-7.556v4h7.556zm-2-8v10h4V16zm16.25-2h-14.25v4h14.25zm-2-6v8h4V8zm-12.25 2h14.25V6h-14.25zm-2-12V8h4V-2z" mask="url(#iconifyReact8)"></path></g></g></svg> English
          </a>
        </div>
    </li>
    
@endif

                <ul class="c-header-nav ml-auto pl-1" > 
                    <li class="c-header-nav-item dropdown notifications-menu">
                        <a href="#" class="c-header-nav-link" data-toggle="dropdown">
                        <i class="fas fa-bell"></i>
                        @php($alertsCount = \Auth::user()->userUserAlerts()->where('read', false)->count())
                                @if($alertsCount > 0)
                                    <span class="badge badge-warning navbar-badge">
                                        {{ $alertsCount }}
                                    </span>
                                @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ">
                            @if(count($alerts = \Auth::user()->userUserAlerts()->withPivot('read')->limit(10)->orderBy('created_at', 'ASC')->get()->reverse()) > 0)
                                @foreach($alerts as $alert)
                                    <div class="dropdown-item">
                                        <a href="{{ $alert->alert_link ? $alert->alert_link : "#" }}" target="_blank" rel="noopener noreferrer">
                                            @if($alert->pivot->read === 0) <strong> @endif
                                                {!! $alert->alert_text !!}
                                            @if($alert->pivot->read === 0) </strong> @endif
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center">
                                    {{ trans('global.no_alerts') }}
                                </div>
                            @endif
                        </div>
                    </li>
                </ul>
                <li  class="pl-1 pr-1">
                    <a class="c-header-nav-link" href="{{ config('chat.url') }}" >
                      <i class="fa fa-comments" aria-hidden="true" > </i>
                    </a>
                </li>
                <li class="nav-item dropdown ">
                  <a class="nav-link avatar-name" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button"
                     aria-haspopup="true" aria-expanded="false">
                     <img src="https://api-prod-minimal-v6.vercel.app/assets/images/avatar/avatar-25.webp" style="max-width:2.3rem" class="rounded-circle"   alt="Avatar" />
                  </a>

                    <div class="dropdown-menu dropdown-menu-right">
                    <span class="dropdown-header-name">{{\Auth::user()->name}}</span>
                      <span class="dropdown-header">{{\Auth::user()->email}}</span>
                      <div class="row avatar-menu">
        <div class="col-md-12">
            <div class="dotted-border">
            </div>
        </div>    
        <div class="c-sidebar-nav-link-li">

        @can('viewPulse')
                        <a class="c-sidebar-nav-icon c-sidebar-nav-link" target="_blank" href="{{ url(config('pulse.path')) }}" title="Pulse">
                          Pluse
                        </a> 
                      @endcan
                      </div>

                      <div class="c-sidebar-nav-link-li">

                      @can('viewTelescope')
                        <a class="c-sidebar-nav-icon c-sidebar-nav-link mt-2 mb-1" target="_blank" href="{{ url(config('telescope.path')) }}" title="Telescope">
                           Telescope
                        </a>
                      @endcan
                      </div>

                      <div class="c-sidebar-nav-link-exit">
                        <a href="#" class="c-sidebar-nav-link  " onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        {{ trans('global.logout') }}
                      </a></div>
                    </div>
              </li>

            </ul>
        </header>

        <div class="c-body">
            <main class="c-main">


                <div class="container-fluid">
                    @if(session('message'))
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                            </div>
                        </div>
                    @endif
                    @if($errors->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                  <div style="position: fixed; top: 10px;right: 0; z-index: 2000;">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show toast" data-autohide="true" data-delay="2000">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show toast" data-autohide="true" data-delay="3000">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                  </div>
                @yield('content')
                {{ $slot??'' }}
                
                </div>


            </main>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/main.js') }}"></script>
 
    <script>
      $(function() {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let selectAllButtonTrans = '{{ trans('global.select_all') }}'
        let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'
  
        let languages = {
              'tr': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json',
              'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json',
              'fa': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Persian.json',
              "lengthMenu": '_MENU_ bản ghi trên trang',
                "search": '<i class="fa fa-search"></i>',
                "searchPlaceholder": "Search...",
                "paginate": {
                "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
            },
        };
  
        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
          language: {
            url: languages['{{ app()->getLocale() }}']
          },
          columnDefs: [{ visible: false, targets: 0 }, { searchable: false, targets: -1 }],
          /*     columnDefs: [{
              orderable: false,
              className: 'select-checkbox',
              targets: 0
          }, {
              orderable: false,
              searchable: false,
              targets: -1
          }],
          select: {
            style:    'multi+shift',
            selector: 'td:first-child'
          }, */
          order: [],
          scrollX: true,
          pageLength: 10,
          dom: 'Bfrtilp<"actions">',
          buttons: [
          /*       {
              extend: 'selectAll',
              className: 'btn-primary',
              text: selectAllButtonTrans,
              exportOptions: {
                columns: ':visible'
              },
              action: function(e, dt) {
                e.preventDefault()
                dt.rows().deselect();
                dt.rows({ search: 'applied' }).select();
              }
            },
            {
              extend: 'selectNone',
              className: 'btn-primary',
              text: selectNoneButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            }, */
            // {
            //   extend: 'copy',
            //   className: 'btn-default',
            //   text: copyButtonTrans,
            //   exportOptions: {
            //     columns: ':visible'
            //   }
            // },
            {
              extend: 'excel',
              className: 'btn-excel',
              text: '<i class="far fa-file-excel"></i> ' +excelButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'csv',
              className: 'btn-csv',
              text: '<i class="far fa-file-alt"></i>' +csvButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
        
            // {
            //   extend: 'pdf',
            //   className: 'btn-default',
            //   text: pdfButtonTrans,
            //   exportOptions: {
            //     columns: ':visible'
            //   }
            // },
            {
              extend: 'print',
              className: 'btn-print',
              text: '<i class="fas fa-print"></i> '+printButtonTrans,
              exportOptions: {
                columns: ':visible'
              }
            },
            // {
            //   extend: 'colvis',
            //   className: 'btn-default',
            //   text: colvisButtonTrans,
            //   exportOptions: {
            //     columns: ':visible'
            //   }
            // }
          ]
        });
  
        $.fn.dataTable.ext.classes.sPageButton = '';
      });
  
      $(document).ready(function () {
          $(".notifications-menu").on('click', function () {
              if (!$(this).hasClass('open')) {
                  $('.notifications-menu .label-warning').hide();
                  $.get('/admin/user-alerts/read');
              }
          });
      });
  
      $('.toast').toast('show');

      document.getElementById('toggleButton').addEventListener('click', function() {
    var lefticon = document.getElementById('lefticon');
    var righticon = document.getElementById('righticon');

    if (lefticon.style.display === 'none') {
        lefticon.style.display = 'block';
        righticon.style.display = 'none';
    } else {
        lefticon.style.display = 'none';
        righticon.style.display = 'block';
    }
});

window.onload = function() {
    var searchInput = document.querySelector('#DataTables_Table_0_filter input[type="search"].form-control.form-control-sm');

    if (searchInput) {
        searchInput.placeholder = 'Search...';
    }
};

document.addEventListener('DOMContentLoaded', function() {
     const dateInputs = document.querySelectorAll('.form-control.date');

     dateInputs.forEach(input => {
        input.placeholder = 'Tarih Giriniz...';
    });
});


    </script>
    
    @yield('scripts')
</body>

</html>