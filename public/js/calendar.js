//inicijalizacija kalendara
function initializeCalendar(calendar_id, events, can_user_edit) {
    var calendar_full_id = "#" + calendar_id;

    $(calendar_full_id).fullCalendar({
        header: {
            center: "month, listYear",
            right: 'month, agendaWeek, agendaDay',
            ignoreTimezone: false
        },
        week: true,
        day: true,
        agenda: true,
        basic: true,
        views: {
            listYear: {
                type: "listYear",
                duration: { years: 1 },
                buttonText: "Godina",
                noEventsMessage: "Lista događaja je prazna"
            },
            week: {
                timeFormat: 'H:mm'
            },
        },
        timezone: 'Europe/Sarajevo',
        timeFormat: 'HH:mm',
        slotLabelFormat:"HH:mm",
        //events je json formatiran za prikaz ovdje: id, event_id, title, start, end - ako nije null i description

        events: JSON.parse(events),
        aspectRatio: 2,
        eventColor: "#3568ba", //defaultna boja koja se ne gleda ukoliko event ima svoju boju
        themeSystem: "standard",
        dayRender: function(date, cell) {
            var today = $.fullCalendar.moment();
            if (date.format("dddd, MMMM Do YYYY") === today.format("dddd, MMMM Do YYYY")) {
                cell.css("background", "#9cc6ff");
            } else if (date.get("d") === 0 || date.get("d") === 6) {
                //boja za vikende
                cell.css("background", "#fffce5");
            }
            setCss();
        },
        eventAfterRender: function(event, element, view) {
            setCss();
        },
        eventClick:  function(event, jsEvent, view) {
            setAlert(event, can_user_edit);
        },

    });
}

//izmjena css-a
function setCss() {
    //boja subote i nedjelje
    $(".fc-sat").css("background", "#fffce5");
    $(".fc-sun").css("background", "#fffce5");
    //promjene toolbara
    $(".fc-toolbar").css("color", "#021385");
    $(".fc-left>h2").css("font-size", "23px");
    //$(".fc-left").css("border", "2px solid #021385");
    //$(".fc-left").css("border-radius", "10px");
    //$(".fc-left").css("padding-left", "4%");
    //$(".fc-left").css("padding-right", "4%");
    //promjena fonta eventa
    $(".fc-title").css("font-size", "1.3em");
    $(".fc-content").addClass("text-center");
}

//priprema alerta
function setAlert(event, can_user_edit) {
    //set the values and open the modal
    var description = prepareEventDescription(event);
    $("#eventInfo").html(description);
    $("#eventLink").attr("href", event.url);
    $("#eventContent").dialog({
        modal: true,
        show: {
            effect: "puff",
            duration: 80
        },
        title: event.title,
        hide: {
            effect: "puff",
            duration: 80
        },
        width: "25%"
    });
    //postavljanje dugmadi za ulogu koja moze brisati i uređivati
    if (can_user_edit)
        $("#eventContent").dialog("option", "buttons", setEditButton(event));

}


function prepareEventDescription(event) {
    var dateStart = new Date(event.start);
    var start = dateStart.getDate() + ". " + (dateStart.getMonth() + 1) + ". " + dateStart.getFullYear();

    var end = "";
    if (event.end !== null) {
        var dateEnd = new Date(event.end);
        end = (dateEnd.getDate() - 1) + ". " + (dateEnd.getMonth() + 1) + ". " + dateEnd.getFullYear();
    }

    var description = event.description + "<br><br>" + "Datum događaja: " + start;
    if (end !== "") {
        description += "<br>" + "Datum kraja: " + end;
    }

    return description;
}


function setEditButton(event) {
    var buttons = [
        {
            text: "Upravljanje",
            click: function () {
                //postavi id u formu
                $("#event_id").val(event.id);
                $("#edit_remove_form").submit();
            }
        }
    ];
    return buttons;
}


function showEndDate() {
    $("#show_end_date").change(function () {
        if (this.checked) {
            $("#end_date_div").removeClass("hidden");
        } else {
            $("#end_date_div").addClass("hidden");
        }
    });
}


function datePickerSet(datePickerId, defaultDate) {
    let datePicker = '#' + datePickerId;
    $(datePicker).datepicker({changeMonth: true, changeYear: true});
    $(datePicker).datepicker('option', 'dateFormat', 'dd-mm-yy');
    $(datePicker).datepicker('option', 'showAnim', 'slide');
    $(datePicker).datepicker('option', 'defaultDate', defaultDate);
    $(datePicker).datepicker('setDate', defaultDate);
}

function deletionAlert() {
    $("#deletionDialog").dialog({
        autoOpen: false,
        modal: true,
        show: {
            effect: "puff",
            duration: 80
        },
        hide: {
            effect: "puff",
            duration: 80
        },
        buttons: [
            {
                text: "Ne",
                click: function () {
                    $(this).dialog("close");
                }
            },
            {
                text: "Da",
                click: function () {
                    $("#form").submit();
                }
            }
        ],
        open: function() {
            $(this).parents(".ui-dialog-buttonpane button:eq(2)").focus();
        }
    });

    $("#remove").click(function () {
        var dialog = $("#deletionDialog")
        dialog.removeClass("hidden");
        dialog.dialog("open");
        return false;
    });
}

function showEndDate() {
    $("#show_end_date").change(function () {
        if (this.checked) {
            $("#end_date_div").removeClass("hidden");
        } else {
            $("#end_date_div").addClass("hidden");
        }
    });
}


function datePickerSet(datePickerId, defaultDate) {
    let datePicker = '#' + datePickerId;
    $(datePicker).datepicker({changeMonth: true, changeYear: true});
    $(datePicker).datepicker('option', 'dateFormat', 'dd-mm-yy');
    $(datePicker).datepicker('option', 'showAnim', 'slide');
    $(datePicker).datepicker('option', 'defaultDate', defaultDate);
    $(datePicker).datepicker('setDate', defaultDate);
}

function deletionAlert() {
    $("#deletionDialog").dialog({
        autoOpen: false,
        modal: true,
        show: {
            effect: "puff",
            duration: 80
        },
        hide: {
            effect: "puff",
            duration: 80
        },
        buttons: [
            {
                text: "Ne",
                click: function () {
                    $(this).dialog("close");
                }
            },
            {
                text: "Da",
                click: function () {
                    $("#form").submit();
                }
            }
        ],
        open: function() {
            $(this).parents(".ui-dialog-buttonpane button:eq(2)").focus();
        }
    });

    $("#remove").click(function () {
        var dialog = $("#deletionDialog")
        dialog.removeClass("hidden");
        dialog.dialog("open");
        return false;
    });
}

function validateNotEmpty() {
    let values = $("input.requ").map(function (idx, elem) {
        return $(elem).val();
    }).get();

    for (var i = 0; i < values.length; i++) {
        if(values[i] === "") {
            $("#alertDiv").show();
            return false;
        }
    }
    return true;
}

