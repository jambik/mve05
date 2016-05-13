@if (Session::has('flash_notification.message'))
    @if (Session::has('flash_notification.overlay'))
        <script type="text/javascript">
            $(document).ready(function() {
                noty({
                    text: '<p><strong>{{ Session::get('flash_notification.title') }}</strong></p> {{ Session::get('flash_notification.message') }}',
                    type: 'modal',
                    layout: 'topCenter',
                    theme: 'relax',
                    animation: {
                        open: 'animated flipInX', // jQuery animate function property object
                        close: 'animated flipOutX', // jQuery animate function property object
                        easing: 'swing', // easing
                        speed: 500 // opening & closing animation speed
                    },
                    buttons: [
                        {
                            addClass: 'btn btn-sm btn-danger',
                            text: 'Закрыть',
                            onClick: function($noty)
                            {
                                $noty.close();
                            }
                        }
                    ]
                });
            });
        </script>
    @else
        <script type="text/javascript">
            $(document).ready(function() {
                noty({
                    text: '{{ Session::get('flash_notification.message') }}',
                    type: '{{ Session::get('flash_notification.level') }}',
                    layout: 'topCenter',
                    theme: 'relax',
                    timeout: 5000,
                    animation: {
                        open: 'animated flipInX', // jQuery animate function property object
                        close: 'animated flipOutX', // jQuery animate function property object
                        easing: 'swing', // easing
                        speed: 500 // opening & closing animation speed
                    }
                });
            });
        </script>
    @endif
@endif