
var ANIM_TIMEOUT = 1000;
var COOKIE_SESSION_NAME = "WS_SUPPORT_SESSION";


function getCookieParam(param_name) {
    var val;
    $.each(document.cookie.split("; "), function(key, value) {
        param = value.split('=');
        if (param[0] == param_name) {
            val = param[1];
        }
    })
    return (typeof(val) == "undefined") ? null : val;
}

//selectAll switcher
function selectAllSwitch(switcher, direction) {
    var switch_state = (typeof(direction) == "boolean") ? direction : !((typeof(switcher.attr("pushed")) != "undefined"));
    if (switch_state)
        switcher.attr("pushed", true).find("span").html("Deselect all");
    else
        switcher.removeAttr("pushed").find("span").html("Select all");
}

function resetForm(form) {
    var form_elements = form.find(":input");
    form_elements.each(function() {
        var elem = $(this);
        if (typeof(elem.attr("default_value")) != "undefined")
            elem.attr("value", elem.attr("default_value"));
    })
    //checkbox selectAll reset
    var selectAllSwitcher = form.find("._toggle-select-all");
    if (typeof(selectAllSwitcher) != "undefined")
        selectAllSwitcher.each(function() {
            selectAllSwitch($(this), false);
        })
    resetFormValidation(form);
    return form_elements.not(':button, :submit, :reset, :hidden').removeAttr('checked').not(":checkbox").val('').removeAttr('selected');
}

function addBreaks(text) {
    output = '';
    for (var i = 0; i < text.length; i++) {
        if (i > 0 && i % 20 == 0 && i != " ")
            output += "<wbr>";
        output += text.charAt(i);
    }
    return output;
}

function serializeAnArray(arr) {
    var output = [];
    arr.each(function() {
        output.push({
            name: $(this).attr("name"),
            value: $(this).attr("value")
        });
    });
    return output;
}

function in_array(needle, haystack, strict) {
    var found = false, key, strict = !!strict;
    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    }
    return found;
}

$(document).ready(function() {

    //sets form's elements to null if it's empty
    $('form.disable-fields-if-empty').submit(function() {
        $('input,textarea,select').each(function() {
            if ($(this).val() == '')
                $(this).attr('disabled', 'disabled');
        });

    })

    //hidable block
    $(".display_switch").click(function() {
        ds = $(this);
        ds.next(".block_hidable").toggle(ANIM_TIMEOUT);
        vs = ds.find(".visibility_switcher");
        (vs.html() == "show") ? vs.html("hide") : vs.html("show");
    })

    //checkbox toggle select all
    $("._toggle-select-all").live("click", function() {
        var switcher = !((typeof($(this).attr("pushed")) != "undefined"));
        var container = (typeof ($(this).attr("checkboxcontainer")) != "undefined") ? $("#" + $(this).attr("checkboxcontainer")) : $(this).parent();
        (container.find("input[type='checkbox']")).each(function() {
            $(this).attr('checked', switcher);
        })
        selectAllSwitch($(this));
    })

    //login as
    $("a._loginas").click(function() {
        a = $(this);
//        console.log(a.attr("site")+"auth?subcom=authas&id="+a.attr("account")+"&sess_id="+getCookieParam(COOKIE_SESSION_NAME));return;
        window.open(a.attr("site") + "auth?subcom=authas&id=" + a.attr("account") + "&sess_id=" + getCookieParam(COOKIE_SESSION_NAME), '_blank');
    });

    //show password
    $(".hidden_ps").html("(click to show)");
    $(".hidden_ps").mousedown(function() {
        $(this).html($(this).attr("ps"))
    }).mouseout(function() {
        $("body").mouseup(function() {
            $(".hidden_ps").html("(click to show)");
            $(this).off("mouseup");
        })
    }).mouseup(function() {
        $(this).html("(click to show)");
    })

    //modal close autocleanup
    $(".modal[autocleanup]").on("hide", function() {
        $(this).find("form").each(function() {
            resetForm($(this));
        })
    })

})