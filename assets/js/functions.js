function getResult(result, where) {
    $.ajax({
        async: true,
        type: "GET",
        url: result,
        beforeSend: function() {
            $("#overlayAlert").show();
            $(".spinner").show();
        },
        complete: function(data) {
            $("" + where + "").html(data.responseText);
            $("#overlayAlert").hide();
            $(".spinner").hide();
        }
    });
}

function showModal(dataForm) {
    $.ajax({
        async: true,
        type: "POST",
        url: "modal.php?action=" + dataForm.action,
        data: dataForm,
        complete: function(data) {
            $('#Modal').html(data.responseText);
            $('#' + dataForm.name).show();
            if (dataForm.action == "form") {
                $("#overlay" + dataForm.id).show();
            }
        }
    });
}

function hideModal(id, modal, form) {
    $("#" + modal).hide();
    $("#" + id).hide();
    $("#" + form)[0].reset();
}

function closeModal() {
    $("#Modal").hide();
    $("#overlayImg").hide();
}

function closeModalAlert() {
    $("#alertMsg").hide();
    $("#overlayAlert").hide();
}

function exit() {
    $.get("salir.php", function(data) {
        $(".result").html(data);
        window.location = "index.php";
    });
}