function count_price_local(data_form)
{  

   var data_array = [];
   data_array = data_form.split('&');
   var temp_var = [];

var elem_form = [];
elem_form = {
    'type_of_work':null,
    'academic_level':null,
    'type_of_paper':null,
    'questions':null,
    'problems':null,
    'pages':null,
    'slides':null,
    'spacing':null,
    'deadline':null,
    'preferred_writer':null,
    'previous_writer':null,
    'discount_code':null,
    'plagiarism_report':null,
    'abstract_page':null,
    'top_priority':null
};
    var temp;
    
    var top_academic_level =  [];
    //top_academic_level = {8 : 8, 13 : 10}
    top_academic_level = {13 : 10};
    
   $.each(data_array, function(i, val) {
       temp_var = data_array[i].split('=');
      elem_form[temp_var[0]]=temp_var[1];
     });
     var name_type_of_paper = $(ORDER_FORM_ID).find("[name='type_of_paper']").find("[value='"+elem_form['type_of_paper']+"']").text();
     if(name_type_of_paper == 'Admission essay' || name_type_of_paper == 'Personal statement' || name_type_of_paper == 'Application letter' || name_type_of_paper == 'Cover letter'  || name_type_of_paper == 'Resume'  || name_type_of_paper == 'Curriculum vitae'){
         elem_form['academic_level'] = ((!isNaN(top_academic_level[client_id])?top_academic_level[client_id]:5)+100*client_id)*1;
     }
                     
     var tow_coef = type_of_work_coef[client_id+'_'+elem_form['type_of_work']];
     var ald_coef = ac_level_deadline_coef[elem_form['academic_level']+'_'+elem_form['deadline']];
     var top_coef = type_of_paper_coef[client_id+'_'+elem_form['type_of_paper']];

     var mcq = (name_type_of_paper== "Multiple choice questions");

    // var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(1) * parseFloat(tow_coef)).toFixed(1) :  Math.round( Math.round(top_coef * ald_coef) * tow_coef);
     
    var coef_round = 1;
    //var coef_round = 2;	
    if(elem_form['academic_level']==1501 && (elem_form['deadline']==1515 || elem_form['deadline']==1533 || elem_form['deadline']==1534)){
      //var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  ( (top_coef * ald_coef).toFixed(2) * tow_coef).toFixed(2);
        var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);
        coef = coef*1;
        coef_round = 2;
    }else if ((elem_form['type_of_paper']!=  10* 10000 + 1039) &&  10!=15 && 10!=12 && 10!=19 && elem_form['academic_level']==1001 && (elem_form['deadline']==1015 || elem_form['deadline']==1033 || elem_form['deadline']==1034)){
	var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);
        coef = coef*1;
        coef_round = 2;	
    }else{
        var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(1) * parseFloat(tow_coef)).toFixed(1) :  Math.round( Math.round(top_coef * ald_coef) * tow_coef);
	//var coef = (mcq) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);   
	coef = coef*1;		
    }
     
     var pd_pages = 0;
     if(elem_form['pages'] != undefined  && parseInt(elem_form['pages'])>0 )
    {
        pd_pages = parseFloat(elem_form['pages']);
    }
    
     var result_all = new Array();
     if( (elem_form['pages'] != undefined && parseInt(elem_form['pages'])>0 && !isNaN(parseInt(elem_form['pages']))  ) ||  (elem_form['slides'] != undefined && parseInt(elem_form['slides'])>0 && !isNaN(parseInt(elem_form['slides'])) )  )
     {
            result_all["page"] = coef.toFixed(coef_round);
            result_all["page_total"] = Math.round(coef * parseFloat(elem_form['pages']));
            result_all["slide"] = (coef / 2);
            result_all["slide_total"] = Math.round(coef * (parseFloat(elem_form['slides']) / 2).toFixed(1));
            if (elem_form['spacing'] == 1) {
                    result_all["page"] = coef * 2;
                    result_all["page_total"] = Math.round(coef * parseFloat(elem_form['pages']));
                    elem_form['pages'] = parseFloat(elem_form['pages']) * 2;
                    if (client_id == 13) {
                        result_all["slide"] = Math.round(coef);
                        temp = parseFloat(coef * elem_form['slides']);
                        result_all["slide_total"] =temp.toFixed(1);
                        elem_form['slides'] = parseFloat(elem_form['slides']) * 2;
                    } else {
                        pd_pages = pd_pages * 2;
                    }
                }

              var units = parseFloat(elem_form['pages']) + parseFloat(elem_form['slides']*1) * 0.5;    
     }else if(elem_form['problems'] != undefined && !isNaN(parseInt(elem_form['problems']))){
          var units = parseInt(elem_form['problems']);
     }else if(elem_form['questions'] != undefined && !isNaN(parseInt(elem_form['questions']))){
          var units = parseInt(elem_form['questions']);
     }else {
          var units = parseInt(0);
     }
     
     var result = (mcq) ? (coef * units).toFixed(coef_round) : (coef * units).toFixed(coef_round);
     var save_bundle = 0;
     var bundle_rate = 1;
     var tmp;

    if (elem_form['preferred_writer'] == 2 && elem_form['plagiarism_report'] == 1 && elem_form['top_priority'] == 1 &&  elem_form['abstract_page']  == 1 && 
        ((elem_form['pages'] != undefined && parseInt(elem_form['pages'])>0 ) ||  (elem_form['slides'] != undefined && parseInt(elem_form['slides'])>0))) {
               // bundle_rate = 0.85;  //15 %
    }
     
       if (/*client_id != 8 &&*/ client_id != 13 && elem_form['preferred_writer'] == 2) {
                var pref_writer_coef = bundles_coef[client_id+'_1'];
                   /* if (client_id == 4 || client_id == 10) {
                        temp =result * 0.58;
                        tmp = temp.toFixed(2)*1;
                    } else {
                        temp = result * parseFloat(pref_writer_coef);
                        tmp = temp.toFixed(2);
                    }*/
                        temp =result * 0.58;
                        tmp = temp.toFixed(2)*1;
       
                    temp =tmp * bundle_rate;
                    temp = parseFloat(result) +  parseFloat(temp.toFixed(2))*1;
                    result = parseFloat(temp).toFixed(2);
                    save_bundle = parseFloat(parseFloat(save_bundle)*1 + parseFloat(parseFloat(tmp) * (1 - parseFloat(bundle_rate))).toFixed(2)).toFixed(2)*1;
            }
            
           if (/*client_id != 8 &&*/ client_id != 13 && elem_form['preferred_writer'] == 4) {
                //var pref_writer_coef = bundles_coef[client_id+'_1'];
                   /* if (client_id == 4 || client_id == 10) {
                        temp =result * 0.58;
                        tmp = temp.toFixed(2)*1;
                    } else {
                        temp = result * parseFloat(pref_writer_coef);
                        tmp = temp.toFixed(2);
                    }*/
                        temp =result * 0.3;
                        tmp = temp.toFixed(2)*1;
       
                    temp =tmp * bundle_rate;
                    temp = parseFloat(result) +  parseFloat(temp.toFixed(2))*1;
                    result = parseFloat(temp).toFixed(2);
                    save_bundle = parseFloat(parseFloat(save_bundle)*1 + parseFloat(parseFloat(tmp) * (1 - parseFloat(bundle_rate))).toFixed(2)).toFixed(2)*1;
            }
            
            
        if ((pd_pages) < 1) {
                result_all['plag'] = parseFloat(0);
            } else if (pd_pages <= 10) {
                result_all['plag'] =  parseFloat(bundles_coef[client_id+'_4']);
            } else {
                /*if(client_id != 9){*/
                result_all['plag'] = parseFloat(pd_pages) - 0.01;/*}else{
                result_all['plag'] = (parseFloat(pd_pages) - 0.01+2).toFixed(2)*1;
                }*/
            }
            if (elem_form['plagiarism_report'] == 1) {
                result = (parseFloat((parseFloat(result_all['plag']) * bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2);
                save_bundle += parseFloat(result_all['plag']) * (1 - bundle_rate).toFixed(2)*1;
            }
            if (/*client_id != 8 &&*/ client_id != 13 && elem_form['abstract_page'] == 1) {
                    var abstract_page_coef = bundles_coef[client_id+'_2'];
                    result = (parseFloat((parseFloat(abstract_page_coef) * bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2);
                    save_bundle += (parseFloat(abstract_page_coef) * (1 - bundle_rate)).toFixed(2)*1;
            }
            if (/*client_id != 8 &&*/ elem_form['top_priority'] == 1) {
                var top_prior_coef = bundles_coef[client_id+'_3'];
                    result = (parseFloat((parseFloat(top_prior_coef)* bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2)*1;
                    save_bundle += (parseFloat(top_prior_coef) * (1 - bundle_rate)).toFixed(2)*1;      
            }
	   if(result=='NaN') result=0;
             return {'price':result,'plag':result_all['plag'],'save_bundle':save_bundle.toFixed(2)};
}




/*For page prices START*/
function count_price_local_page_prices(ac_lvl, top, deadline,tow,adm_help,quest,probl,quest_probl)
{
var question = null;
var problem = null;
var pages = (quest_probl)?parseInt(quest_probl):1;

if(adm_help){ac_lvl=1001;top=100014; }
if(quest){tow=1;question=(quest_probl)?parseInt(quest_probl):1;pages=null; top=101038;}
if(probl){tow=1;problem=(quest_probl)?parseInt(quest_probl):1;pages=null;  top=101039;}

var elem_form = new Array();
elem_form = {
    'type_of_work':tow,
    'academic_level':ac_lvl,
    'type_of_paper':top,
    'questions':question,
    'problems':problem,
    'pages':pages,
    'slides':0,
    'spacing':2,
    'deadline':deadline,
    'preferred_writer':1,
    'previous_writer':null,
    'discount_code':null,
    'plagiarism_report':null,
    'abstract_page':null,
    'top_priority':null
}
    var temp;
    
     var top_academic_level =  new Array();
    //top_academic_level = {8 : 8, 13 : 10}
    top_academic_level = {13 : 10}

     if(adm_help){
         elem_form['academic_level'] = ((!isNaN(top_academic_level[client_id])?top_academic_level[client_id]:5)*1+100*client_id)*1;
     }
                     
     var tow_coef = type_of_work_coef[client_id+'_'+elem_form['type_of_work']];
     var ald_coef = ac_level_deadline_coef[elem_form['academic_level']+'_'+elem_form['deadline']];
     var top_coef = type_of_paper_coef[client_id+'_'+elem_form['type_of_paper']];

     var coef = (quest) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(1) * parseFloat(tow_coef)).toFixed(1) :  Math.round( Math.round(top_coef * ald_coef) * tow_coef);
     
    var coef_round = 1;
    //var coef_round = 2;	
    if(elem_form['academic_level']==1501 && elem_form['deadline']==1515){
        var coef = (quest) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);
        coef = coef*1;
        coef_round = 2;
    }else   if( (elem_form['type_of_paper']!=  10* 10000 + 1039) &&   10!=15 && 10!=12 && 10!=19 && elem_form['academic_level']==1001 && elem_form['deadline']==1015){
        var coef = (quest) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);
        coef = coef*1;
        coef_round = 2;
    }else{
        var coef = (quest) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(1) * parseFloat(tow_coef)).toFixed(1) :  Math.round( Math.round(top_coef * ald_coef) * tow_coef);
        //var coef = (quest) ?   ((parseFloat(top_coef) * parseFloat(ald_coef)).toFixed(2) * parseFloat(tow_coef)).toFixed(2) :  (mnog_mod(top_coef,ald_coef).toFixed(2) * parseFloat(tow_coef)).toFixed(2);
        coef = coef*1;			
    }
     
     var pd_pages = 0;
     if(elem_form['pages'] != undefined  && parseInt(elem_form['pages'])>0 )
    {
        pd_pages = parseFloat(elem_form['pages']);
    }
    
     var result_all = new Array();
     if( (elem_form['pages'] != undefined && parseInt(elem_form['pages'])>0 && !isNaN(parseInt(elem_form['pages']))  ) ||  (elem_form['slides'] != undefined && parseInt(elem_form['slides'])>0 && !isNaN(parseInt(elem_form['slides'])) )  )
     {
            result_all["page"] = coef.toFixed(coef_round);
            result_all["page_total"] = Math.round(coef * parseFloat(elem_form['pages']));
            result_all["slide"] = (coef / 2);
            result_all["slide_total"] = Math.round(coef * (parseFloat(elem_form['slides']) / 2).toFixed(1));
            if (elem_form['spacing'] == 1) {
                    result_all["page"] = coef * 2;
                    result_all["page_total"] = Math.round(coef * parseFloat(elem_form['pages']));
                    elem_form['pages'] = parseFloat(elem_form['pages']) * 2;
                    if (client_id == 13) {
                        result_all["slide"] = Math.round(coef);
                        temp = parseFloat(coef * elem_form['slides']);
                        result_all["slide_total"] =temp.toFixed(1);
                        elem_form['slides'] = parseFloat(elem_form['slides']) * 2;
                    } else {
                        pd_pages = pd_pages * 2;
                    }
                }

              var units = parseFloat(elem_form['pages']) + parseFloat(elem_form['slides']*1) * 0.5;    
     }else if(elem_form['problems'] != undefined && !isNaN(parseInt(elem_form['problems']))){
          var units = parseInt(elem_form['problems']);
     }else if(elem_form['questions'] != undefined && !isNaN(parseInt(elem_form['questions']))){
          var units = parseInt(elem_form['questions']);
     }else {
          var units = parseInt(0);
     }
     
     var result = (quest) ? (coef * units).toFixed(coef_round) : (coef * units).toFixed(coef_round);
     var save_bundle = 0;
     var bundle_rate = 1;
     var tmp;

    if (/*client_id == 4 && elem_form['preferred_writer'] > 1*/ elem_form['preferred_writer'] == 2 && elem_form['plagiarism_report'] == 1 && elem_form['top_priority'] == 1 &&  elem_form['abstract_page']  == 1 && 
        ((elem_form['pages'] != undefined && parseInt(elem_form['pages'])>0 ) ||  (elem_form['slides'] != undefined && parseInt(elem_form['slides'])>0))) {
                bundle_rate = 0.85;
    }
     
       if (/*client_id != 8 &&*/ client_id != 13 && elem_form['preferred_writer'] == 2) {
                var pref_writer_coef = bundles_coef[client_id+'_1'];
                    /*if (client_id == 4) {
                        temp =result * 0.58;
                        tmp = temp.toFixed(2);
                    } else {
                        temp = result * parseFloat(pref_writer_coef);
                        tmp = temp.toFixed(2);
                    }*/
                    
                    temp =result * 0.58;
                    tmp = temp.toFixed(2)*1;
                    
                    temp =tmp * bundle_rate;
                    temp = parseFloat(result) +  parseFloat(temp.toFixed(2));
                    result = parseFloat(temp).toFixed(2);
                    save_bundle = parseFloat(parseFloat(save_bundle)*1 + parseFloat(parseFloat(tmp) * (1 - parseFloat(bundle_rate))).toFixed(2)).toFixed(2)*1;
            }
            
        if ((pd_pages) < 1) {
                result_all['plag'] = parseFloat(0);
            } else if (pd_pages <= 10) {
                result_all['plag'] =  parseFloat(bundles_coef[client_id+'_4']);
            } else {
                result_all['plag'] = parseFloat(pd_pages) - 0.01;
            }
            if (elem_form['plagiarism_report'] == 1) {
                result = (parseFloat((parseFloat(result_all['plag']) * bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2);
                save_bundle += parseFloat(result_all['plag']) * (1 - bundle_rate).toFixed(2)*1;
            }
            if (/*client_id != 8 &&*/ client_id != 13 && elem_form['abstract_page'] == 1) {
                    var abstract_page_coef = bundles_coef[client_id+'_2'];
                    result = (parseFloat((parseFloat(abstract_page_coef) * bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2)*1;
                    save_bundle += (parseFloat(abstract_page_coef) * (1 - bundle_rate)).toFixed(2)*1;
            }
            if (/*client_id != 8 &&*/ elem_form['top_priority'] == 1) {
                var top_prior_coef = bundles_coef[client_id+'_3'];
                    result = (parseFloat((parseFloat(top_prior_coef)* bundle_rate).toFixed(2)) + parseFloat(result)).toFixed(2)*1;
                    save_bundle += (parseFloat(top_prior_coef) * (1 - bundle_rate)).toFixed(2)*1;      
            }   
              if(getDecimal(result)==0) result = Math.round(result);
	   if(result=='NaN') result=0;		  
            return result;
}
/*For page prices END*/


function mnog_mod (value1, value2)
{
    return parseFloat(value1)*100*100* parseFloat(value2)/(100*100);
}

function getDecimal(input) {
    return input - (input ^ 0);
}