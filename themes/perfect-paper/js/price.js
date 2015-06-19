/**
 * Created by coolfire on 10.04.15.
 */

jQuery(function ($) {
    $('nav#menuLeft').mmenu({
        // zposition: "front"
    });
});
jQuery(function ($) {
    $('nav#menuRight').mmenu({
        position: "right"
    });
});

// Fixed Header Action
jQuery(window).bind('scroll', function () {
    if (jQuery(window).scrollTop() > 90) {
        jQuery(".fixedTop").addClass("active");
        jQuery(".navLogo").addClass("activeHeader");
        jQuery(".headTopRight").addClass("activeHeadTopRight");
    }
    else {
        jQuery(".fixedTop").removeClass("active");
        jQuery(".navLogo").removeClass("activeHeader");
        jQuery(".headTopRight").removeClass("activeHeadTopRight");
    }
});

// Price Calc

var page_price = new Array();
page_price["One"] = 1;
page_price["Two"] = 2;
page_price["Three"] = 3;
page_price["Four"] = 4;
page_price["Five"] = 5;
page_price["Six"] = 6;
page_price["Seven"] = 7;
page_price["Eight"] = 8;
page_price["Nine"] = 9;
page_price["Ten"] = 10;
page_price["Eleven"] = 11;
page_price["Twelve"] = 12;
page_price["Thirteen"] = 13;
page_price["Fourteen"] = 14;
page_price["Fifteen"] = 15;
page_price["Sixteen"] = 16;
page_price["Seventeen"] = 17;
page_price["Eighteen"] = 18;
page_price["Nineteen"] = 19;
page_price["Twenty"] = 20;
page_price["TwentyOne"] = 21;
page_price["TwentyTwo"] = 22;
page_price["TwentyThree"] = 23;
page_price["TwentyFour"] = 24;
page_price["TwentyFive"] = 25;
page_price["TwentySix"] = 26;
page_price["TwentySeven"] = 27;
page_price["TwentyEight"] = 28;
page_price["TwentyNine"] = 29;
page_price["Thirty"] = 30;
page_price["ThirtyOne"] = 31;
page_price["ThirtyTwo"] = 32;
page_price["ThirtyThree"] = 33;
page_price["ThirtyFour"] = 34;
page_price["ThirtyFive"] = 35;
page_price["ThirtySix"] = 36;
page_price["ThirtySeven"] = 37;
page_price["ThirtyEight"] = 38;
page_price["ThirtyNine"] = 39;
page_price["Forty"] = 40;
page_price["FortyOne"] = 41;
page_price["FortyTwo"] = 42;
page_price["FortyThree"] = 43;
page_price["FortyFour"] = 44;
page_price["FortyFive"] = 45;
page_price["FortySix"] = 46;
page_price["FortySeven"] = 47;
page_price["FortyEight"] = 48;
page_price["FortyNine"] = 49;
page_price["Fifty"] = 50;
page_price["FiftyThree"] = 53;
page_price["FiftySix"] = 56;
page_price["FiftySeven"] = 57;
page_price["FiftyNine"] = 59;
page_price["SixtyTwo"] = 62;
page_price["SixtyThree"] = 63;
page_price["SixtySix"] = 66;
page_price["Seventy"] = 70;
page_price["SeventyTwo"] = 72;


var due_date = new Array();
due_date["selectDays"] = 0;
due_date["twoMonths"] = 20;
due_date["thirtyDays"] = 20;
due_date["twentyDays"] = 21;
due_date["tenDays"] = 21;
due_date["sevenDays"] = 22;
due_date["fiveDays"] = 24;
due_date["fourDays"] = 26;
due_date["threeDays"] = 29;
due_date["twoDays"] = 33;
due_date["oneDay"] = 37;
due_date["twelveHours"] = 42;
due_date["eightHours"] = 48;
due_date["sixHours"] = 56;
due_date["threeHours"] = 62;

var due_date_master = new Array();
due_date_master["selectDays"] = 0;
due_date_master["twoMonths"] = 24;
due_date_master["thirtyDays"] = 26;
due_date_master["twentyDays"] = 28;
due_date_master["tenDays"] = 30;
due_date_master["sevenDays"] = 32;
due_date_master["fiveDays"] = 35;
due_date_master["fourDays"] = 37;
due_date_master["threeDays"] = 40;
due_date_master["twoDays"] = 43;
due_date_master["oneDay"] = 47;
due_date_master["twelveHours"] = 53;
due_date_master["eightHours"] = 59;
due_date_master["sixHours"] = 66;
due_date_master["threeHours"] = 72;

var due_date_hs = new Array();
due_date_hs["selectDays"] = 0;
due_date_hs["twoMonths"] = 17;
due_date_hs["thirtyDays"] = 17;
due_date_hs["twentyDays"] = 18;
due_date_hs["tenDays"] = 18;
due_date_hs["sevenDays"] = 20;
due_date_hs["fiveDays"] = 22;
due_date_hs["fourDays"] = 24;
due_date_hs["threeDays"] = 27;
due_date_hs["twoDays"] = 32;
due_date_hs["oneDay"] = 35;
due_date_hs["twelveHours"] = 39;
due_date_hs["eightHours"] = 43;
due_date_hs["sixHours"] = 50;
due_date_hs["threeHours"] = 57;

var due_date_doctoral = new Array();
due_date_doctoral["selectDays"] = 0;
due_date_doctoral["twoMonths"] = 30;
due_date_doctoral["thirtyDays"] = 32;
due_date_doctoral["twentyDays"] = 34;
due_date_doctoral["tenDays"] = 36;
due_date_doctoral["sevenDays"] = 38;
due_date_doctoral["fiveDays"] = 42;
due_date_doctoral["fourDays"] = 46;
due_date_doctoral["threeDays"] = 50;
due_date_doctoral["twoDays"] = 57;
due_date_doctoral["oneDay"] = 63;
due_date_doctoral["twelveHours"] = 70;


// ALL HS CALCS

function getHsPagePrice() {
    var hsPagePrice = 17;
    var theForm = document.forms["priceformHs"];
    var selectedHsPagePrice = theForm.elements["pageprice"];
    hsPagePrice = page_price[selectedHsPagePrice.value];
    //finally we return the master page price
    return hsPagePrice;
}

function getHsDueDate() {
    var hsDueDatePrice = 0;
    var theForm = document.forms["priceformHs"];
    var selectedHsDueDate = theForm.elements["hsduedate"];
    hsDueDatePrice = due_date_hs[selectedHsDueDate.value];

    //finally we return master due date price
    return hsDueDatePrice;
}
function calculateTotalHs() {
    var cakePrice = getHsDueDate() * getHsPagePrice();
    var divobj = document.getElementById('totalPriceHs');
    divobj.style.display = 'block';
    divobj.innerHTML = "Total Price: $" + cakePrice;
}


// All UNDERGRAD CALC

function getPagePrice() {
    var pagePrice = 20;
    var theForm = document.forms["priceform"];
    var selectedPagePrice = theForm.elements["pageprice"];
    pagePrice = page_price[selectedPagePrice.value];

    //finally we return the final page price
    return pagePrice;
}

function getDueDate() {
    var dueDatePrice = 0;
    var theForm = document.forms["priceform"];
    var selectedDueDate = theForm.elements["duedate"];
    dueDatePrice = due_date[selectedDueDate.value];
    return dueDatePrice;
}
function calculateTotal() {
    var cakePrice = getDueDate() * getPagePrice();

    //display the result
    var divobj = document.getElementById('totalPrice');
    divobj.style.display = 'block';
    divobj.innerHTML = "Total Price: $" + cakePrice;
}


// ALL MASTER CALC

function getMasterPagePrice() {
    var masterPagePrice = 24;
    var theForm = document.forms["priceformMaster"];
    var selectedMasterPagePrice = theForm.elements["pageprice"];
    masterPagePrice = page_price[selectedMasterPagePrice.value];
    //finally we return the master page price
    return masterPagePrice;
}

function getMasterDueDate() {
    var masterDueDatePrice = 0;
    var theForm = document.forms["priceformMaster"];
    var selectedMasterDueDate = theForm.elements["masterduedate"];
    masterDueDatePrice = due_date_master[selectedMasterDueDate.value];

    //finally we return master due date price
    return masterDueDatePrice;
}

function calculateTotalMaster() {
    var cakePrice = getMasterDueDate() * getMasterPagePrice();
    var divobj = document.getElementById('totalPriceMaster');
    divobj.style.display = 'block';
    divobj.innerHTML = "Total Price: $" + cakePrice;
}

// ALL DOCTORAL CALC

function getDoctoralPagePrice() {
    var doctoralPagePrice = 30;
    var theForm = document.forms["priceformDoctoral"];
    var selectedDoctoralPagePrice = theForm.elements["pageprice"];
    doctoralPagePrice = page_price[selectedDoctoralPagePrice.value];
    //finally we return the master page price
    return doctoralPagePrice;
}

function getDoctoralDueDate() {
    var doctoralDueDatePrice = 0;
    var theForm = document.forms["priceformDoctoral"];
    var selectedDoctoralDueDate = theForm.elements["doctoralduedate"];
    doctoralDueDatePrice = due_date_doctoral[selectedDoctoralDueDate.value];

    //finally we return master due date price
    return doctoralDueDatePrice;
}

function calculateTotalDoctoral() {
    var cakePrice = getDoctoralDueDate() * getDoctoralPagePrice();
    var divobj = document.getElementById('totalPriceDoctoral');
    divobj.style.display = 'block';
    divobj.innerHTML = "Total Price: $" + cakePrice;
}

function hideTotal() {
    var divobj = document.getElementById('totalPrice');
    divobj.style.display = 'none';
}
function calcToggleHs() {
    if (document.getElementById("hsLink").className.match(/(?:^|\s)active(?!\S)/) || (document.getElementById("hsLink").className.match(/(?:^|\s)not-active(?!\S)/) )) {
        document.getElementById("masterLink").className = "master-price not-active";
        document.getElementById("masterDiv").className = "hidden";
        document.getElementById("ugradLink").className = "undergrad-price not-active";
        document.getElementById("undergradDiv").className = "hidden";
        document.getElementById("hsLink").className = "hs-price active";
        document.getElementById("hsDiv").className = "visible";
        document.getElementById("doctoralLink").className = "doctoral-price not-active";
        document.getElementById("doctoralDiv").className = "hidden";
    }
}
function calcToggleUgrad() {
    if (document.getElementById("ugradLink").className.match(/(?:^|\s)active(?!\S)/) || (document.getElementById("ugradLink").className.match(/(?:^|\s)not-active(?!\S)/) )) {
        document.getElementById("masterLink").className = "master-price not-active";
        document.getElementById("masterDiv").className = "hidden";
        document.getElementById("ugradLink").className = "undergrad-price active";
        document.getElementById("undergradDiv").className = "visible";
        document.getElementById("hsLink").className = "hs-price not-active";
        document.getElementById("hsDiv").className = "hidden";
        document.getElementById("doctoralLink").className = "doctoral-price not-active";
        document.getElementById("doctoralDiv").className = "hidden";
    }
}
function calcToggleMaster() {
    if (document.getElementById("masterLink").className.match(/(?:^|\s)active(?!\S)/) || (document.getElementById("masterLink").className.match(/(?:^|\s)not-active(?!\S)/) )) {
        document.getElementById("masterLink").className = "master-price active";
        document.getElementById("masterDiv").className = "visible";
        document.getElementById("ugradLink").className = "undergrad-price not-active";
        document.getElementById("undergradDiv").className = "hidden";
        document.getElementById("hsLink").className = "hs-price not-active";
        document.getElementById("hsDiv").className = "hidden";
        document.getElementById("doctoralLink").className = "doctoral-price not-active";
        document.getElementById("doctoralDiv").className = "hidden";
    }
}
function calcToggleDoctoral() {
    if (document.getElementById("doctoralLink").className.match(/(?:^|\s)active(?!\S)/) || (document.getElementById("doctoralLink").className.match(/(?:^|\s)not-active(?!\S)/) )) {
        document.getElementById("masterLink").className = "master-price not-active";
        document.getElementById("masterDiv").className = "hidden";
        document.getElementById("ugradLink").className = "undergrad-price not-active";
        document.getElementById("undergradDiv").className = "hidden";
        document.getElementById("hsLink").className = "hs-price not-active";
        document.getElementById("hsDiv").className = "hidden";
        document.getElementById("doctoralLink").className = "doctoral-price active";
        document.getElementById("doctoralDiv").className = "visible";
    }
}
function helpMenuToggle() {
    if (document.getElementById("helpMenuDiv").className.match(/(?:^|\s)quickMenuWrapper closed(?!\S)/)) {
        document.getElementById("helpMenuDiv").className = "quickMenuWrapper expanded";
    }
    else if (document.getElementById("helpMenuDiv").className.match(/(?:^|\s)quickMenuWrapper expanded(?!\S)/)) {
        document.getElementById("helpMenuDiv").className = "quickMenuWrapper closed";
    }
}
