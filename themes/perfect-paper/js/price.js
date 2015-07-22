/**
 * Created by coolfire on 10.04.15.
 */

var page_price = [];
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


var due_date = [];
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

var due_date_master = [];
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

var due_date_hs = [];
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

var due_date_doctoral = [];
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

function calc(){
    var summ=0;
    if ($('#academ_level label .btn .active').text().trim()=='Undergraduate') summ=1;
    $('.appr_price').html($('#pages_number').val()*$('input[name="spaced"]:checked').data('val')/$('input[name="tos"]:checked').data('val'));
    console.log($('#pages_number').val());
}

$(document).ready(function(){
    var calc_elem=$('.calc_elem');
    calc_elem.on('change',function(){calc();});
    calc_elem.on('click',function(){calc();});
    calc();
});