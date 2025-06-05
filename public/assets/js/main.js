// $(document).ready(function () {
//   $("body").append(
//     '<div class="col-notify"><div class="col-notify-in"><p id="notifyTxt"></p></div></div>'
//   );
// });
function notifyme2(notification) {
    if (notification != "") {
        $("#notifyTxt").html(notification);
        $(".col-notify").fadeIn();
        setTimeout(function () {
            $(".col-notify").fadeOut();
        }, 3000);
    }
}

function notifyme(id, text, type, position) {
    if (id == "") {
        $.notify(text, type, {
            position: position,
        });
    } else {
        $(id).notify(text, type, {
            position: position,
        });
    }
}

function showProcessing(id, txt, image) {
    $("#" + id).append(
        '<table class="col-xs-12 processing"><tr><td><img src="'+image+'"><p class="text-center">' +
            txt +
            "</p></td></tr></table>"   );
}
function showProcessing2(id, txt) {
    $("#" + id).append(
        '<table class="col-xs-12 processing"><tr><td><p class="text-center">' +
            txt +
            "</p></td></tr></table>"
    );
}

function hideProcessing() {
    $(".processing").remove();
}

function closeModalRefreshTable(tableId) {
    $("#" + tableId)
        .DataTable()
        .ajax.reload();
    $(".modalClose").click();
}
$(document).on("click", ".dynamicPopup", function (e) {
    e.preventDefault();
    let url = $(this).data("url");
    console.log(url);
    let pop = $(this).data("pop");
    let image = $(this).data("image");
    //   let action = $(this).data("action");
    //   $('.action_header').text(action);
    $(".popupContent-" + pop).html(
        '<center><p class="my-5">please wait</p></center>'
    );
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $(".popupContent-" + pop).html(
                '<center><p class="my-5"><img src="'+image+'"><br>please wait</p></center>'
            );
            $(".popupContent-" + pop).html(data);
        })
        .fail(function () {
            $(".popupContent-" + pop).html(
                '<div class="modal-body text-center pt-5 pb-5"><h4 class="text-muted text-center mb-5">uh-oh<br>Something went wrong!</h4><button type="button" class="btn btn-danger px-4 text-uppercase text-white rounded-10 mr-2 modalClose" data-dismiss="modal">Close</button><button type="button" onclick="location.reload(true);" class="btn btn-primary px-4 rounded-10 text-uppercase text-white">RELOAD</button></div>'
            );
        });
});
// $(document).on("click", ".submitForm", function(e) {
//     e.preventDefault();
//     let method = $(this).data("method");
//     let form = $(this).data("form");
//     let target = $(this).data("target");
//     let returnaction = $(this).data("returnaction");
//     let processing = $(this).data("processing");
//     let reset = $(this).data("reset");
//     showProcessing(form, processing);
//     let formData = new FormData(document.getElementById(form));
//     $.ajax({
//         type: "POST",
//         url: window.location.origin + target,
//         headers: { "Custom-Method": method },
//         data: formData,
//         dataType: "JSON",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(data) {
//             let result = JSON.parse(JSON.stringify(data));
//             if (result.status == 1) {
//                 notifyme("", result.message, "success", "top right");
//                 if (returnaction == "reload") {
//                     setTimeout(function() {
//                         location.reload();
//                     }, 1000);
//                 } else if (returnaction == "redirect") {
//                     setTimeout(function() {
//                         window.location.href = window.location.origin + result.redirect_to;
//                     }, 1000);
//                 } else {
//                     if (reset == 1) {
//                         $('#' + form).trigger("reset");
//                         hideProcessing();
//                     } else {
//                         hideProcessing();
//                         closeModalRefreshTable(returnaction);
//                     }
//                 }

//             } else {
//                 hideProcessing();
//                 notifyme2(result.message);
//                 let response = result.response;
//                 for (let key in response) {
//                     if (response.hasOwnProperty(key)) {
//                         if (response[key].message != "") {
//                             notifyme(
//                                 "#" + response[key].id,
//                                 response[key].message,
//                                 "error",
//                                 "bottom"
//                             );
//                             $("#" + response[key].id)
//                                 .focus()
//                                 .select();
//                         }
//                     }
//                 }
//             }
//         },
//         error: function(data) {
//             console.log("error");
//             console.log(data);
//         },
//     });
// });
$(document).on("click", ".changeview", function (e) {
    e.preventDefault();
    let changeto = $(this).data("changeto");
    let target = "/controller/settings.controller.php?to=" + changeto;
    $.ajax({
        type: "POST",
        url: window.location.origin + target,
        headers: { "Custom-Method": "viewchange" },
        data: "",
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let result = JSON.parse(JSON.stringify(data));
            if (result.status == 1) {
                notifyme2(result.message);
                location.reload();
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
});
$(document).on("click", ".submitForm", function (e) {
    e.preventDefault();
    let method = $(this).data("method");
    let form = $(this).data("form");
    let target = $(this).data("target");
    let returnaction = $(this).data("returnaction");
    let processing = $(this).data("processing");
    let reset = $(this).data("reset");
    var type = $(this).data("type");
    var image = $(this).data("image");
    if(type == undefined)
    {
        type =  "POST";
    }
    if (processing == "") {
        showProcessing2(form, processing);
    } else {
        showProcessing(form, processing, image);
    }
    let formData = new FormData(document.getElementById(form));
    $.ajax({
        type: type,
        url: target,
        headers: { "Custom-Method": method,'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: formData,
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let result = JSON.parse(JSON.stringify(data));
            if (result.status == 1) {
                notifyme2(result.message);
                // notifyme("", result.message, "success", "top right");
                if (returnaction == "reload") {
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else if (returnaction == "nothing") {
                    console.log("saved");
                    hideProcessing();
                } else if (returnaction == "getItems") {
                    $(".modalClose").click();
                    hideProcessing();
                    getItems();
                } else if (returnaction == "getval") {
                    $(".modalClose").click();
                    hideProcessing();
                    if (form == "customerForm") {
                        addCustomer(result.returnthis);
                    }
                } else if (returnaction == "redirect") {
                    setTimeout(function () {
                        window.location.href = result.redirect_to;
                    }, 1000);
                } else if (returnaction == "createSupplierModal") {
 closeCreateSupplierModal();
                    var newOption = new Option(result.name, result.id, true, true);
                    $('#supplier_id').append(newOption).val(result.id);
                    hideProcessing();
                } else if (returnaction == "createCustomerModal") {
                    // Properly add only <option> to the select, not to any DataTable!
                    closecreateCustomerModal();
                    if ($("#customer_id").length) {
                        // Prevent duplicate options
                        if ($("#customer_id option[value='" + result.id + "']").length === 0) {
                            var newOption = new Option(result.name, result.id, true, true);
                            $('#customer_id').append(newOption).val(result.id).trigger('change');
                        } else {
                            $('#customer_id').val(result.id).trigger('change');
                        }
                    }
                    hideProcessing();                }
                // else if (returnaction === "createItemModal") {
                //     closeCreateItemModal();

                //     var newOption = new Option(result.name, result.id, true, true); // Create a new option with text and value

                //     $(newOption).attr({
                //         "data-price_id": result.price_id,
                //         "data-item_id": result.item_id,
                //         "data-name": result.name,
                //         "data-item_size": result.size_name,
                //         "data-cost_price": result.item_price_cost_price
                //     });

                //     $('#items').append(newOption).val(result.id).trigger('change');
                //     hideProcessing();
                // }
                 else {
                    if (reset == 1) {
                        $("#" + form).trigger("reset");
                        hideProcessing();
                    } else {
                        hideProcessing();
                        closeModalRefreshTable(returnaction);
                    }
                }
            } else {
                hideProcessing();
                notifyme2(result.message);
                // notifyme2(result.message);
                let response = result.response;
                for (let key in response) {
                    //console.log(response[key][0]);
                    if (response.hasOwnProperty(key)) {
                        if (key != "") {
                            $("#" + key)
                                .focus()
                                .select();
                        }
                        if (response[key][0] != "") {
                            notifyme(
                                "#" + key,
                                response[key][0],
                                "error",
                                "bottom"
                            );
                        }
                    }
                }
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
});

function noresult(type, id) {
    let txt = "It's empty here";
    if (type == 1) {
        txt = "Zero matches for your search.";
    }
    let dv =
        '\
    <div class="col-12 mt-5">\
        <div class="col-md-4 mt-5 offset-md-4">\
        <div class="card rounded-10 shadow-0 border-0">\
            <div class="card-body border-0 text-center pt-5 pb-5 mt-5 mb-5">\
            <img src="assets/img/noresult.png" class=" img-fluid mb-3">\
            <h4 class="text-muted mb-0">' +
        txt +
        "</h4>\
            </div>\
        </div>\
        </div>\
    </div>\
    ";
    $("#" + id).html(dv);
}

function selSearchAjax(selector, target, parent) {
    $("#" + selector).select2({
        dropdownParent: $("#" + parent),
        theme: "bootstrap-5",
        ajax: {
            url: window.location.origin + target,
            headers: { "Custom-Method": "select" },
            type: "post",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term, // search term
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
            cache: true,
        },
    });
}

$(function () {
    $('[data-toggle="popover"]').popover();
});

document.onkeyup = function (e) {
    e.preventDefault();
    if (e.altKey && e.which == 78) {
        $("#createbtn").click();
    }
    if (e.ctrlKey && e.altKey && e.which == 70) {
        // $("#searchMenuBtn").click();
        $("#searchNav").focus();
    }
    if (e.altKey && e.which == 83) {
        newSale();
    }
};

function focustoid(id) {
    setTimeout(function () {
        document.getElementById(id).focus();
    }, 500);
}

$(document).on("click", ".newsale", function (e) {
    e.preventDefault();
    newSale();
});
function newSale() {
    let target = "/controller/sales.controller.php";
    $.ajax({
        type: "POST",
        url: window.location.origin + target,
        headers: { "Custom-Method": "newsale" },
        data: "",
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let result = JSON.parse(JSON.stringify(data));
            if (result.status == 1) {
                let returnaction = result.returnaction;
                if (returnaction == "redirect") {
                    window.location.href =
                        window.location.origin + result.redirect_to;
                }
            } else {
                notifyme2(result.message);
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
}
function decreasePercentage(originalNumber, percentage) {
    // Check if the arguments are valid numbers
    if (isNaN(originalNumber) || isNaN(percentage)) {
        return "Invalid input. Please enter valid numbers.";
    }

    // Calculate the decreased value
    var decreasedValue = (originalNumber * (100 - percentage)) / 100;

    return decreasedValue;
}

function calculatePercentage(number, percentage) {
    return (percentage / 100) * number;
}

function printit(token,url) {
    let ifr = '<iframe id="tr'+ token +'" style="width: 100%; border: 0; height: 0" src="'+ url +'">';
    $("#if").html(ifr);
    let wspFrame = document.getElementById("tr" + token).contentWindow;
    wspFrame.focus();
    wspFrame.print();
}
function printrec(token, type) {
    let ifr =
        '<iframe id="tr' +
        token +
        '" style="width: 100%; border: 0; height: 0" src="receipt.php?token=' +
        token +
        "&type=" +
        type +
        '">';
    $("#if").html(ifr);
    let wspFrame = document.getElementById("tr" + token).contentWindow;
    wspFrame.focus();
    wspFrame.print();
}
function refreshTable(tableId) {
    $("#" + tableId)
        .DataTable()
        .ajax.reload();
}

// function handlePrintDialogCancel(callback) {
//   let printDialogOpen = false;

//   // Listen for the beforeprint event
//   window.addEventListener("beforeprint", () => {
//     printDialogOpen = true;
//   });

//   // Set a timeout to check if the print dialog is still open after a certain period
//   const checkPrintStatus = setInterval(() => {
//     if (printDialogOpen) {
//       // The print dialog is still open
//       console.log("Print dialog is open");
//     } else {
//       // The print dialog is closed (canceled)
//       console.log("Print dialog is closed (canceled)");

//       // Add your logic here to handle the cancel event
//       // For example, reload the page: location.reload();

//       // Call the provided callback function
//       if (typeof callback === "function") {
//         callback();
//       }

//       // Clear the interval as we don't need to check anymore
//       clearInterval(checkPrintStatus);
//     }

//     // Reset the flag for the next iteration
//     printDialogOpen = false;
//   }, 1000); // Check every second
// }
function clearSelect2(id) {
    $("#" + id)
        .val(null)
        .trigger("change");
    $("#clear" + id).hide();
}

function generatePass(id) {
    let pass = "";
    let str =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZ" +
        "abcdefghijklmnopqrstuvwxyz0123456789@#$";

    for (let i = 1; i <= 8; i++) {
        let char = Math.floor(Math.random() * str.length + 1);

        pass += str.charAt(char);
    }

    $("#" + id).val(pass);
}
function copyToClipboard(id) {
    /* Get the textarea element */
    var copyText = document.getElementById(id);

    /* Create a range to select the text in the textarea */
    var range = document.createRange();
    range.selectNode(copyText);
    window.getSelection().removeAllRanges(); // Clear previous selections
    window.getSelection().addRange(range);

    try {
        /* Copy the text to the clipboard */
        document.execCommand("copy");
        // alert("Copied the text:\n" + copyText.value);
        notifyme2("Copied to Clipboard");
    } catch (err) {
        console.error("Unable to copy to clipboard", err);
    }

    /* Clear the selection */
    window.getSelection().removeAllRanges();
}
function readURL(input, img) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#" + img).attr("src", e.target.result);
        };

        $("#" + img).show();

        reader.readAsDataURL(input.files[0]);
    } else {
        $("#" + img).hide();
    }
}

function generateUsername(name) {
    // Remove spaces and convert to lowercase
    // const cleanedName = name.replace(/\s/g, '').toLowerCase();
    const cleanedName = name.replace(/[^a-zA-Z0-9]/g, "").toLowerCase();

    // Generate a random number between 1000 and 9999
    // const randomSuffix = Math.floor(Math.random() * 9000) + 1000;

    // Combine the cleaned name and random suffix
    // const username = cleanedName + randomSuffix;

    const username = cleanedName.slice(0, 12);

    return username;
}
function showHidePassword(id, id2) {
    if (!$("#" + id).hasClass("fa-eye")) {
        $("#" + id).removeClass("fa-eye-slash");
        $("#" + id).addClass("fa-eye");
        $("#" + id2).attr("type", "password");
    } else {
        $("#" + id).removeClass("fa-eye");
        $("#" + id).addClass("fa-eye-slash");
        $("#" + id2).attr("type", "text");
    }
    // document.getElementById(id2).focus();
}

function changeBranch(branch) {
    let branch2 = $("#" + branch).val();
    let target = "/controller/branches.controller.php?branch=" + branch2;
    $.ajax({
        type: "POST",
        url: window.location.origin + target,
        headers: { "Custom-Method": "changeBranch" },
        data: "",
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            let result = JSON.parse(JSON.stringify(data));
            if (result.status == 1) {
                location.reload();
            } else {
                location.reload();
            }
        },
        error: function (data) {
            console.log("error");
            console.log(data);
        },
    });
}

$(document).on("click", ".submitForm123", function (e) {
    var id = "1"; //$(this).data('id');
    var username = $(this).data("username");
    var target = $(this).data("target");
    if (id && confirm("Are you sure, You want to delete  user?")) {
        $.ajax({
            url: target,
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            type: "post",
            success: function (response) {
                if (response == "success") {
                    alert("User Deleted Successfully");
                    window.location.href = "{{ url('home')}}";
                } else {
                    alert("Something Went Wrong! please try again.");
                }
            },
        });
    } else {
        return false;
    }
});
