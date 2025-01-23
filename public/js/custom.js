$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// const baseUrl = "http://127.0.0.1:8000";
const baseUrl = window.location.origin;

function numberOnly(input) {
    var regex = /[^0-9]/gi;
    input.value = input.value.replace(regex, "");
}

function charOnly(input) {
    var regex = /[^A-Za-z ]/gi;
    input.value = input.value.replace(regex, "");
}
