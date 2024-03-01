<script src="{{ asset('js/site.core.js')}}"></script>
<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>
<script src="{{ asset('assets/js/plugins/main.min.js') }}"></script>

<script src="{{asset ('assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{asset ('js/plugins/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('js/letter.avatar.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>

<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
<script src="{{ asset('libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{asset('assets/js/plugins/datepicker-full.min.js')}}"></script>

<script>
(function () {
  const d_week = new Datepicker(document.querySelector('#pc-datepicker-2_modal'), {
    buttonClass: 'btn',
  });
})();
</script>
<!-- <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
</script> -->
<script src="{{asset('assets/js/plugins/dropzone-amd-module.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/choices.min.js')}}"></script>

<!-- <script src="{{ asset('libs/select2/dist/css/select2.min.css')}}"></script> -->
<link rel="stylesheet" href="{{ asset('libs/select2/dist/css/select2.min.css') }}">

<script src="{{asset ('assets/js/plugins/simple-datatables.js') }}"></script>
{{-- <script>
    if($("#pc-dt-simple").length > 0) {
      const dataTable = new simpleDatatables.DataTable("#pc-dt-simple");
    }
</script> --}}
<script>
    if ($(".datatable").length > 0) {
        $( $(".datatable") ).each(function( index,element ) {
            var id = $(element).attr('id');
            const dataTable = new simpleDatatables.DataTable("#"+id);
        });
    }
</script>
<script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
<!-- Time picker -->
<script src="{{asset('assets/js/plugins/flatpickr.min.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('assets/js/plugins/datepicker-full.min.js')}}"></script>

<script src="{{ asset('js/custom.js') }}"></script>

<!-- Demo JS - remove it when starting your project -->


<script>
          $(".dash-navbar li a").click(function() {
           $(this).parent().addClass('active').siblings().removeClass('active'); 
          } );
            </script>
<script>
    function show_toastr(title, message, type) {
        var o, i;
        var icon = '';
        var cls = '';
        if (type == 'success') {
            icon = 'fas fa-check-circle';
            // cls = 'success';
            cls = 'primary';
        } else {
            icon = 'fas fa-times-circle';
            cls = 'danger';
        }
        console.log(type, cls);
        $.notify({
            icon: icon,
            title: " " + title,
            message: message,
            url: ""
        }, {
            element: "body",
            type: cls,
            allow_dismiss: !0,
            placement: {
                from: 'top',
                align: 'right'
            },
            offset: {
                x: 15,
                y: 15
            },
            spacing: 10,
            z_index: 1080,
            delay: 2500,
            timer: 2000,
            url_target: "_blank",
            mouse_over: !1,
            animate: {
                enter: o,
                exit: i
            },
            //// danger
            template: '<div class="toast text-white bg-' + cls +
                ' fade show" role="alert" aria-live="assertive" aria-atomic="true">' +
                '<div class="d-flex">' +
                '<div class="toast-body"> ' + message + ' </div>' +
                '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>' +
                '</div>' +
                '</div>'
            // template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        });
    }
</script>

<script>
    var dataTabelLang = {
        paginate: {previous: "{{__('Previous')}}", next: "{{__('Next')}}"},
        lengthMenu: "{{__('Show')}} _MENU_ {{__('entries')}}",
        zeroRecords: "{{__('No data available in table')}}",
        info: "{{__('Showing')}} _START_ {{__('to')}} _END_ {{__('of')}} _TOTAL_ {{__('entries')}}",
        infoEmpty: " ",
        search: "{{__('Search:')}}"
    }
</script>
<script>
    var toster_pos="{{env('SITE_RTL') =='on' ?'left' : 'right'}}";
</script>

<script>
    var date_picker_locale = {
        format: 'YYYY-MM-DD',
        daysOfWeek: [
            "{{__('Sun')}}",
            "{{__('Mon')}}",
            "{{__('Tue')}}",
            "{{__('Wed')}}",
            "{{__('Thu')}}",
            "{{__('Fri')}}",
            "{{__('Sat')}}"
        ],
        monthNames: [
            "{{__('January')}}",
            "{{__('February')}}",
            "{{__('March')}}",
            "{{__('April')}}",
            "{{__('May')}}",
            "{{__('June')}}",
            "{{__('July')}}",
            "{{__('August')}}",
            "{{__('September')}}",
            "{{__('October')}}",
            "{{__('November')}}",
            "{{__('December')}}"
        ],
    };
    var calender_header = {
        today: "{{__('today')}}",
        month: '{{__("month")}}',
        week: '{{__("week")}}',
        day: '{{__("day")}}',
        list: '{{__("list")}}'
    };
</script>
<script>
                        $(document).ready(function() {
      var input = document.querySelector("#phone-input");
      var iti = window.intlTelInput(input, {
        separateDialCode: true,
      });
 
      var indiaCountryCode = iti.getSelectedCountryData().iso2;
      var countryCode = iti.getSelectedCountryData().dialCode;
      $('#country-code').val(countryCode);
      if (indiaCountryCode !== 'us') {
        iti.setCountry('us');
      }
    });
    </script>

<script>
    const isNumericInput = (event) => {
	const key = event.keyCode;
	return ((key >= 48 && key <= 57) || // Allow number line
		(key >= 96 && key <= 105) // Allow number pad
	);
};

const isModifierKey = (event) => {
	const key = event.keyCode;
	return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
		(key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
		(key > 36 && key < 41) || // Allow left, up, right, down
		(
			// Allow Ctrl/Command + A,C,V,X,Z
			(event.ctrlKey === true || event.metaKey === true) &&
			(key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
		)
};

const enforceFormat = (event) => {
	// Input must be of a valid number format or a modifier key, and not longer than ten digits
	if(!isNumericInput(event) && !isModifierKey(event)){
		event.preventDefault();
	}
};

const formatToPhone = (event) => {
	if(isModifierKey(event)) {return;}

	// I am lazy and don't like to type things more than once
	const target = event.target;
	const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
	const zip = input.substring(0,3);
	const middle = input.substring(3,6);
	const last = input.substring(6,10);

	if(input.length > 6){target.value = `(${zip}) ${middle} - ${last}`;}
	else if(input.length > 3){target.value = `(${zip}) ${middle}`;}
	else if(input.length > 0){target.value = `(${zip}`;}
};

const inputElement = document.getElementById('phone-input');
inputElement.addEventListener('keydown',enforceFormat);
inputElement.addEventListener('keyup',formatToPhone);

</script>
{{--
@if(Session::has('success'))
    <script>
        toastrs('{{__("Success")}}', '{!! session("success") !!}', 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if(Session::has('error'))
    <script>
        toastrs('{{__("Error")}}', '{!! session("error") !!}', 'error');
    </script>
    {{ Session::forget('error') }}
@endif --}}

@if(Session::has('success'))
    <script>
        show_toastr('{{__("Success")}}', '{!! session("success") !!}', 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if(Session::has('error'))
    <script>
        show_toastr('{{__("Error")}}', '{!! session("error") !!}', 'error');
    </script>
    {{ Session::forget('error') }}
@endif








@stack('script-page')

@php
    $status = [
            __('Draft'),
            __('In Review'),
            __('Presented'),
            __('Approved'),
            __('Rejected'),
            __('Canceled'),
        ];
@endphp
