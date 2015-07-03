








                               <script>
            var partner_id = 98;
            var sub_id = 0;    
            document.write(""+
            "<form id='orderform1_f' target='_top' action='http://www.paperhelp.org/order.html#sif' method='post' style='padding: 0px; margin: 0px;'>"+
                "<input type='hidden' name='p__utmz' id='p__utmz' value=''/>"+
                "<input type='hidden' name='type' id='order_type' value=''/>"+
                "<input type='hidden' name='pid' id='pid' value=''/>"+
                "<input type='hidden' name='sub_id' id='sub_id' value=''/>"+       
                "<input type='hidden' name='partner_referer' id='partner_referer' value='http://paperhelper.org/order-now/'/>"+
                "<table style='width: 300px; height: 250px; background: url(http://edu-profit.com/img/bg_widget1.png)' border='0' cellpadding='0' cellspacing='0'>"+
                    "<tr style='vertical-align: top;'>"+
                        "<td>"+
                            "<div style='padding-top:46px; padding-left: 104px;'>"+
                                "<select style='height:22px;width: 187px;background-color:#eeeeee;border:1px solid #cfcfcf;' name='service_type' onchange='calculatePrice()' id='service_type'>"+
                                    "<option value=\"0\">Please select</option>"+
                                    "<optgroup label=\"Essays\">"+
                                        "<option value=\"Annotated bibliography\">Annotated bibliography</option>"+
                                        "<option value=\"Argumentative essay\">Argumentative essay</option>"+
                                        "<option value=\"Article\">Article</option>"+
                                        "<option value=\"Article review\">Article review</option>"+
                                        "<option value=\"Biography\">Biography</option>"+
                                        "<option value=\"Book review\">Book review</option>"+
                                        "<option value=\"Business plan\">Business plan</option>"+
                                        "<option value=\"Case study\">Case study</option>"+
                                        "<option value=\"Course work\">Course work</option>"+
                                        "<option value=\"Creative writing\">Creative writing</option>"+
                                        "<option value=\"Critical thinking\">Critical thinking</option>"+
                                        "<option value=\"Essay\">Essay</option>"+
                                        "<option value=\"Literature review\">Literature review</option>"+
                                        "<option value=\"Movie review\">Movie review</option>"+
                                        "<option value=\"Presentation\">Presentation</option>"+
                                        "<option value=\"Report\">Report</option>"+
                                        "<option value=\"Research paper\">Research paper</option>"+
                                        "<option value=\"Research proposal\">Research proposal</option>"+
                                        "<option value=\"Term paper\">Term paper</option>"+
                                        "<option value=\"Thesis\">Thesis</option>"+
                                        "<option value=\"Thesis proposal\">Thesis proposal</option>"+
                                        "<option value=\"Thesis statement\">Thesis statement</option>"+ 
                                    "</optgroup>"+
                                    "<optgroup label=\"Dissertation\">"+
                                        "<option value=\"Dissertation\">Dissertation</option>"+
                                        "<option value=\"Dissertation abstract\">Dissertation abstract</option>"+
                                        "<option value=\"Dissertation chapter\">Dissertation chapter</option>"+
                                        "<option value=\"Dissertation conclusion\">Dissertation conclusion</option>"+
                                        "<option value=\"Dissertation hypothesis\">Dissertation hypothesis</option>"+
                                        "<option value=\"Dissertation introduction\">Dissertation introduction</option>"+
                                        "<option value=\"Dissertation methodology\">Dissertation methodology</option>"+
                                        "<option value=\"Dissertation proposal\">Dissertation proposal</option>"+
                                        "<option value=\"Dissertation results\">Dissertation results</option>"+ 
                                    "</optgroup>"+
                                    "<optgroup label=\"Questions &amp; Problems\">"+
                                        "<option value=\"Multiple choice questions\">Multiple choice questions</option>"+
                                        "<option value=\"Problem solving\">Problem solving</option>"+ 
                                    "</optgroup>"+
                                    "<optgroup label=\"Admissions\">"+
                                        "<option value=\"Admission essay\">Admission essay</option>"+
                                        "<option value=\"Application letter\">Application letter</option>"+
                                        "<option value=\"Cover letter\">Cover letter</option>"+
                                        "<option value=\"Curriculum vitae\">Curriculum vitae</option>"+
                                        "<option value=\"Personal statement\">Personal statement</option>"+
                                        "<option value=\"Resume\">Resume</option>"+
                                    "</optgroup>"+
                                    "<option value=\"Other\">Other</option>"+
                                "</select>"+
                            "</div>"+
                            "<div style='padding-top:11px; padding-left: 104px;'>"+
                                "<select style='height:22px;width: 187px;background-color:#eeeeee;border:1px solid #cfcfcf;' name='academic_level' onchange='calculatePrice()' id='academic_level'>"+
                                    "<option value=\"0\" selected=\"selected\">Please select</option>"+
                                    "<option value=\"1\">Undergraduate</option>"+
                                    "<option value=\"3\">Bachelor</option>"+
                                    "<option value=\"4\">Professional</option>"+
                                "</select>"+
                            "</div>"+
                            "<div style='padding-top:11px; padding-left: 104px;'>"+
                                "<select style='height:22px;width: 187px;background-color:#eeeeee;border:1px solid #cfcfcf;' name='deadline' onchange='calculatePrice()' id='deadline'>"+
                                    "<option value=\"0\" selected=\"selected\">Please select</option>"+
                                    "<option value=\"35\">3 hours</option>"+
                                    "<option value=\"36\">6 hours</option>"+        
                                    "<option value=\"37\">12 hours</option>"+
                                    "<option value=\"2\">24 hours</option>"+
                                    "<option value=\"3\">2 days</option>"+
                                    "<option value=\"4\">3 days</option>"+
                                    "<option value=\"7\">6 days</option>"+
                                    "<option value=\"11\">10 days</option>"+
                                    "<option value=\"15\">14 days</option>"+
                                "</select>"+
                            "</div>"+
                            "<div style='width:256px;height:60px;font:36px Arial;color:#6e7072;text-shadow:1px 1px 0px #eaeaea;float:left;'><div style='padding-left:12px;padding-top:13px;' id='preliminary_cost'>$0</div></div>"+
                            "<div style='float:left;width:44px;height:60px;'>"+
                                "<div style='padding-top:8px;'><input style='height:22px;width:30px;background-color:#eeeeee;border:1px solid #cfcfcf;' type='text' name='pages' id='number_of_pages' maxlength='3' onkeyup='calculatePrice()' onchange='calculatePrice()'/></div>"+
                                "<div style='padding-top:5px;font:11px Arial;color:#4e4e4e;text-shadow:1px 1px 0px #f6f6f6;' id='words_count_tr'><span id='price_per_page'>$0</span></div>"+
                            "</div>"+
                            "<div style='clear:both;'></div>"+
                            "<div style='padding-top:7px;padding-left:5px;'><img src='http://www.edu-profit.com/img/order1.png' style='border: 0; cursor: pointer; margin-left: 75px;' onclick='orderNow()'/></div>"+
                        "</td>"+
                    "</tr>"+
                "</table>"+
            "</form>");

            
                
            function calculatePrice() {
                var form = $("form#orderform1_f");

                var type_of_paper_val = form.find("[name='service_type']").val();
                var type_of_paper = type_of_paper_val;

                var academic_level_val = form.find("[name='academic_level']").val();
                var academic_level = (academic_level_val) ? client_id + '0' + academic_level_val : null; 

                var deadline_val = form.find("[name='deadline']").val();
                var deadline = (deadline_val) ? client_id + ((parseInt(deadline_val) > 9) ? '' : '0') + deadline_val : null;

                var admission_help = null;
                var questions = null;
                var problems = null;

                var pages = form.find("input[name='pages']").val();
                if (pages && pages.match(/[^0-9]/g) && pages != 'pages') {
                    pages = pages.replace(/[^0-9]/g, '');
                    form.find("input[name='pages']").val(pages);
                }
                    
                var price_per_page_block = $("#words_count_tr"); 
                var price_per_page_span = $("#price_per_page"); 
                var price_span = $("#preliminary_cost");
                var pages_name = $("#pages_name");
                var total = 0;
                var per_page = 0;

                price_per_page_block.show();
                pages_name.text("Number of pages:");
                    
                if (type_of_paper) {
                    if (type_of_paper == "Application letter" || type_of_paper == "Admission essay" || type_of_paper == "Cover letter" || type_of_paper == "Personal statement"   || type_of_paper == "Resume"  || type_of_paper == "Curriculum vitae") {
                        academic_level = client_id + '01';
                        type_of_paper = client_id + '0014';
                        admission_help = true;

                    } else if (type_of_paper == "Multiple choice questions") {
                        pages_name.text("Questions:");
                        type_of_paper = client_id + '1038';
                        questions = true;
                        price_per_page_block.hide();

                    } else if (type_of_paper == "Problem solving") {
                        pages_name.text("Problems:");
                        type_of_paper = client_id + '1039';
                        problems = true;
                        price_per_page_block.hide();

                    } else {
                        type_of_paper = client_id + '0002';
                    }

                } else {
                    type_of_paper = client_id + '0002';
                }

                var validate = ((typeof type_of_paper_val === "undefined" || type_of_paper_val) && type_of_paper && (typeof academic_level_val === "undefined" || academic_level_val) && academic_level && deadline && pages && pages != 0);
                if (validate) {
                    total = count_price_local_page_prices(academic_level, type_of_paper, deadline, 1, admission_help, questions, problems, pages);
                    per_page = (total / pages);    
                }
                if (total == 'NaN' || total == 0) {
                    total = 0;
                    per_page = 0;
                }

                price_span.text('$' + total);
                price_per_page_span.text('$' + per_page);
            }


            function getQuote() {
                var p__utmz = calcGetCookie("__utmz");
                if (p__utmz) {
                    document.getElementById('p__utmz').value = p__utmz;
                }
                document.getElementById('pid').value = partner_id;
                document.getElementById('sub_id').value = sub_id;    
                document.getElementById('order_type').value = 'inquiry';
                document.getElementById('orderform1_f').action="http://www.paperhelp.org/inquiry.html#sif";
                document.getElementById('orderform1_f').submit();
            }

            function orderNow() {
                var p__utmz = calcGetCookie("__utmz");
                if (p__utmz) {
                    document.getElementById('p__utmz').value = p__utmz;
                }
                document.getElementById('pid').value = partner_id;
                document.getElementById('sub_id').value = sub_id;    
                document.getElementById('order_type').value = 'order';
                document.getElementById('orderform1_f').submit();
            }
            
            function calcGetCookie(c_name){
                var i,x,y,ARRcookies=document.cookie.split(";");
                for (i=0;i<ARRcookies.length;i++) {
                    x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
                    y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
                    x=x.replace(/^\s+|\s+$/g,"");
                    if (x==c_name) {
                        return unescape(y);
                    }
                }
                return false;
            }
                
            
        </script>