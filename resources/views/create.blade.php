<!-- forma za dodavanje eventa -->
<!-- ako je postavljen event onda se koristi za brisanje ili ažuriranje -->
@extends('layouts.app')



@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
            integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script type="text/javascript">

        <?php if (isset($_event['end_date'])) { ?>
        //potrebno je kliknuti na ckecked da se prikaze datum kraja ako postoji
        $(function () {
            $("#show_end_date").prop("checked", true);
            $("#end_date_div").removeClass("hidden");

            deletionAlert();
        });
        <?php } ?>
    </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">


                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Dodavanje novog događaja
                        </div>
                        <div class="card-body">
                            <form id="form" class="form-horizontal"
                                  action="<?= isset($_event) ? '/submit_edit_remove/' : "/new_create/"; ?>"
                                  method="get" onsubmit="return validateNotEmpty();">
                                @csrf
                                <?php if (isset($_event)) { ?>
                                <input type="hidden" name="id" value="<?= $_event['id']; ?>"/>
                                <input type="hidden" name="event_id" value="<?= $_event['event_id']; ?>"/>
                                <input type="hidden" name="event_color" value="<?= $_event['event_color']; ?>"/>
                                <?php } ?>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Naziv</label>
                                        <input class="form-control requ" name="event_name" type="text"
                                               value="{{($_event['event_name'])??''}}"/>
                                        <p class="help-block"><span style="color:red">*</span>naziv događaja</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label>Datum događaja</label>
                                        <input class="form-control requ" name="start_date" id="start_date"
                                               type="datetime-local"/>
                                        <p class="help-block"><span style="color:red">*</span>datum početka događaja
                                        </p>
                                    </div>
                                </div>

                                <div id="end_date_div" class="form-group hidden">
                                    <!--Prikazano je ako je checkbox true-->
                                    <div class="col-md-6">
                                        <label>Datum kraja</label>
                                        <input class="form-control requ" name="end_date" id="end_date"
                                               type="datetime-local"/>
                                        <p class="help-block"><span style="color:red">*</span>datum kraja događaja
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Opis</label>
                                        <textarea name="event_description" id="description" class="form-control"
                                                  rows="5">{{($_event['event_name'])??''}}</textarea>
                                        <p class="help-block">opis događaja koji se dodaje</p>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label>Color</label>
                                    <div class="col-md-12">
                                        <select name="event_color" class="form-control">
                                            <option ></option>
                                            <option value="#ecca00">Yellow</option>
                                            <option value="#FF0000">Red</option>
                                            <option value="#008000">Green</option>
                                            <option selected value="#3568ba">Blue</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <a class="btn btn-danger" value="nazad" href="/home"><span
                                                aria-hidden="true">
                            </span> Nazad</a>
                                        <?php if (isset($_event)) { ?>
                                        <div class="pull-right">
                                            <button id="remove" class="btn btn-danger" name="action"
                                                    value="remove"><span
                                                    aria-hidden="true">
                                    </span> Ukloni
                                            </button>
                                            <button type="submit" id="edit" class="btn btn-primary" name="action"
                                                    value="edit"><span aria-hidden="true">
                                    </span> Promijeni
                                            </button>
                                        </div>
                                        <?php } else { ?>
                                        <button type="submit" id="dodaj" class="btn btn-success pull-right"
                                                value="dodaj"><span aria-hidden="true">
                                </span> Dodaj
                                        </button>
                                        <?php } ?>
                                    </div>
                                    <div id="alertDiv" class="col-lg-12" style="display:none">
                                        <br>
                                        <div class="alert alert-warning alert-dismissible" role="alert">
                                            <button type="button" class="close" aria-label="Close"
                                                    onclick="$('#alertDiv').hide();">
                                                <span aria-hidden="true">&times;</span></button>
                                            Unesite sve <strong>zahtijevane podatke</strong> (označeni sa <span
                                                style="color: red;">*</span>).
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div id="deletionDialog" class="hidden" title="Potvrda brisanja">
            Da li ste sigurni da želite izbrisati odabrani događaj?
        </div>
@endsection
