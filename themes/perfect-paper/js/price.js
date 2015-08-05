/**
 * Created by coolfire on 10.04.15.
 */
var High_school = [];
High_school["selectDays"] = 0;
High_school["twoMonths"] = 7;
High_school["thirtyDays"] = 7;
High_school["twentyDays"] = 8;
High_school["tenDays"] = 9;
High_school["sevenDays"] = 10;
High_school["fiveDays"] = 11;
High_school["fourDays"] = 12;
High_school["threeDays"] = 13;
High_school["twoDays"] = 14;
High_school["oneDay"] = 17;
High_school["twelveHours"] = 20;
High_school["eightHours"] = 23;
High_school["sixHours"] = 26;
High_school["threeHours"] = 30;

var Undergraduate = [];
Undergraduate["selectDays"] = 0;
Undergraduate["twoMonths"] = 8;
Undergraduate["thirtyDays"] = 8;
Undergraduate["twentyDays"] = 9;
Undergraduate["tenDays"] = 11;
Undergraduate["sevenDays"] = 12;
Undergraduate["fiveDays"] = 13;
Undergraduate["fourDays"] = 14;
Undergraduate["threeDays"] = 15;
Undergraduate["twoDays"] = 17;
Undergraduate["oneDay"] = 20;
Undergraduate["twelveHours"] = 23;
Undergraduate["eightHours"] = 26;
Undergraduate["sixHours"] = 28;
Undergraduate["threeHours"] = 37;

var Bachelor = [];
Bachelor["selectDays"] = 0;
Bachelor["twoMonths"] = 13;
Bachelor["thirtyDays"] = 13;
Bachelor["twentyDays"] = 14;
Bachelor["tenDays"] = 15;
Bachelor["sevenDays"] = 16;
Bachelor["fiveDays"] = 17;
Bachelor["fourDays"] = 18;
Bachelor["threeDays"] = 19;
Bachelor["twoDays"] = 20;
Bachelor["oneDay"] = 22;
Bachelor["twelveHours"] = 24;
Bachelor["eightHours"] = 27;
Bachelor["sixHours"] = 29;
Bachelor["threeHours"] = 40;

var Professional = [];
Professional["selectDays"] = 0;
Professional["twoMonths"] = 15;
Professional["thirtyDays"] = 15;
Professional["twentyDays"] = 16;
Professional["tenDays"] = 17;
Professional["sevenDays"] = 19;
Professional["fiveDays"] = 20;
Professional["fourDays"] = 22;
Professional["threeDays"] = 23;
Professional["twoDays"] = 25;
Professional["oneDay"] = 29;
Professional["twelveHours"] = 33;
Professional["eightHours"] = 36;
Professional["sixHours"] = 39;
Professional["threeHours"] = 47;

function calc(){
    var summ = 0;
    var price = eval($('input[name="Academic_Level"]:checked').attr('id'))[$('input[name="hours"]:checked').attr('id')];
    console.log(price);
    $('.appr_price').html(price*$('#pages_number').val()*$('input[name="spaced"]:checked').data('val')/$('input[name="tos"]:checked').data('val'));
}

$(document).ready(function(){
    var calc_elem=$('.calc_elem');
    calc_elem.on('change',function(){calc();});
    calc_elem.on('click',function(){calc();});
    calc();
    //3B2mmEzVyKIf
});
