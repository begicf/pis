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


    <div id="eventContent">
        <div id="eventInfo"></div>
    </div>

    <div class="hidden">
        <form id="edit_remove_form" action="/edit_or_remove_event/" method="get">
            <input type="hidden" id="event_id" name="id" />
        </form>
    </div>

    <script type="text/javascript">
        //inicijalizacija kalendara
        $(document).ready(function () {
            $(function () {
                initializeCalendar('calendar', '@json($event)', '');
            });
        });


    </script>
@endsection



