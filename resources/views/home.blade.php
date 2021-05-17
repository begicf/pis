@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="calendar"></div>
                        <div class="text-right">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="/create_event/">Dodavanje događaja</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //inicijalizacija kalendara
        $(document).ready(function () {
            $(function () {
                initializeCalendar('calendar', '{{$event}}', '');
            });
        });


    </script>
@endsection



