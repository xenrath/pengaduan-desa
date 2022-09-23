<!-- JAVASCRIPT -->

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }} "></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }} "></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }} "></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

<!-- datepicker -->
<script src="{{ asset('assets/libs/air-datepicker/js/datepicker.min.js') }} "></script>
<script src="{{ asset('assets/libs/air-datepicker/js/i18n/datepicker.en.js') }} "></script>

<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }} "></script>

<script src="{{ asset('assets/js/app.js') }} "></script>
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('bed5f709ab9eeead99ee', {
        cluster : 'ap1'
    });

    var channel = pusher.subscribe('notification-new-user');

    channel.bind('App\\Events\\NotificationNewUser', function(data){
        console.log(JSON.stringify(data.message))
        var link = `{{ route("user.index") }}`
        var existingNotifications = $('#container-notification').html();
        var newNotificationHtml = `
        <a href="${link}" class="text-reset notification-item">
                    <div class="media">
                        <div class="media-body overflow-hidden">
                            <h6 class="mt-0 mb-1">${data.message.name}</h6>
                            <div class="font-size-12 text-muted">
                                <p class="mb-0 text-truncate">
                                    It will seem like simplified English.
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
        `
        $('#container-notification').html(existingNotifications + newNotificationHtml)
    })
</script>

@yield('script')
