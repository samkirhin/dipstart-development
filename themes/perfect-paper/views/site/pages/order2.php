<?php
$form=$this->beginWidget('CActiveForm',array(
    'htmlOptions'=>array('class'=>'form-horizontal'),
));
?>
<div class="panel panel-default panel-container-default">
    <ul class="nav nav-tabs panel-heading clearfix" id="tab-panel">
        <li class="active"><a id="top_tab-1" href="#tab-1" class="col-xs-12 text-center" data-toggle="tab">1. Paper details</a></li>
        <li><a id="top_tab-2" href="#tab-2" class="col-xs-12 text-center" data-toggle="tab">2. Price calculator</a></li>
        <li><a id="top_tab-3" href="#tab-3" class="col-xs-12 text-center" data-toggle="tab">3. Contact information</a></li>
    </ul>
    <div class="tab-content">
        <div class="panel-body form-container tab-pane active" id="tab-1">
            <div class="form-group">
                <label for="type_of_paper" class="col-sm-3 control-label">Type of paper:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <select id="type_of_paper" name="type_of_paper" class="form-control">
                        <optgroup label="Essays">
                            <option value="100016">Annotated bibliography</option>
                            <option value="100017">Argumentative essay</option>
                            <option value="100033">Article</option>
                            <option value="100015">Article review</option>
                            <option value="100019">Biography</option>
                            <option value="100005">Book review</option>
                            <option value="100012">Business plan</option>
                            <option value="100013">Case study</option>
                            <option value="100008">Course work</option>
                            <option value="100001">Creative writing</option>
                            <option value="100018">Critical thinking</option>
                            <option value="100002" selected="">Essay</option>
                            <option value="100024">Literature review</option>
                            <option value="100006">Movie review</option>
                            <option value="100004">Presentation</option>
                            <option value="100030">Report</option>
                            <option value="100003">Research paper</option>
                            <option value="100009">Research proposal</option>
                            <option value="100007">Term paper</option>
                            <option value="100011">Thesis</option>
                            <option value="100028">Thesis proposal</option>
                            <option value="101037">Thesis statement</option>
                        </optgroup>
                        <optgroup label="Dissertation">
                            <option value="100010">Dissertation</option>
                            <option value="100021">Dissertation abstract</option>
                            <option value="100020">Dissertation chapter</option>
                            <option value="100027">Dissertation conclusion</option>
                            <option value="100023">Dissertation hypothesis</option>
                            <option value="100022">Dissertation introduction</option>
                            <option value="100025">Dissertation methodology</option>
                            <option value="101034">Dissertation proposal</option>
                            <option value="100026">Dissertation results</option>
                        </optgroup>
                        <optgroup label="Questions &amp; Problems">
                            <option value="101038">Multiple choice questions</option>
                            <option value="101039">Problem solving</option>
                        </optgroup>
                        <optgroup label="Admissions">
                            <option value="100014">Admission essay</option>
                            <option value="100029">Application letter</option>
                            <option value="100031">Cover letter</option>
                            <option value="100058">Curriculum vitae</option>
                            <option value="100032">Personal statement</option>
                            <option value="100059">Resume</option>
                        </optgroup>
                        <option value="100999">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-3 control-label">Subject:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <select name="subject" id="subject" class="form-control">
                        <option value="">Choose...</option>
                        <option value="1">Accounting</option>
                        <option value="2">Anthropology</option>
                        <option value="4">Art &amp; architecture</option>
                        <option value="42">Astronomy</option>
                        <option value="34">Biology</option>
                        <option value="5">Business</option>
                        <option value="35">Chemistry</option>
                        <option value="6">Classic English literature</option>
                        <option value="7">Communication</option>
                        <option value="8">Criminal Law</option>
                        <option value="46">Culture</option>
                        <option value="9">Economics</option>
                        <option value="49">Ecology</option>
                        <option value="10">Education</option>
                        <option value="38">Engineering</option>
                        <option value="39">English</option>
                        <option value="37">Environmental studies</option>
                        <option value="11">Family and consumer science</option>
                        <option value="12">Film studies</option>
                        <option value="14">Finance</option>
                        <option value="51">Geology</option>
                        <option value="41">Geography</option>
                        <option value="15">History</option>
                        <option value="47">Human Resource Management</option>
                        <option value="48">Investments</option>
                        <option value="52">Journalism</option>
                        <option value="16">Law</option>
                        <option value="33">Literature</option>
                        <option value="17">Management</option>
                        <option value="18">Marketing</option>
                        <option value="19">Mathematics</option>
                        <option value="20">Medicine</option>
                        <option value="21">Music</option>
                        <option value="22">Nursing</option>
                        <option value="23">Philosophy</option>
                        <option value="36">Physics</option>
                        <option value="26">Political science</option>
                        <option value="53">Poetry</option>
                        <option value="25">Psychology</option>
                        <option value="24">Religious studies</option>
                        <option value="27">Shakespeare studies</option>
                        <option value="28">Sociology</option>
                        <option value="29">Technology</option>
                        <option value="13">Theater studies</option>
                        <option value="50">Tourism</option>
                        <option value="30">Women and gender studies</option>
                        <option value="31">World affairs</option>
                        <option value="32">World literature</option>
                        <option value="999">Other</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Paper format:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>

                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="paper_format" id="paper_format_MLA">MLA
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="paper_format" id="paper_format_APA">APA
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="paper_format" id="paper_format_Chicago">Chicago / Turabian
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="paper_format" id="paper_format_Harvard">Harvard
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="paper_format" id="paper_format_Other">Other
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="checkbox">
                        <label>
                            <input name="add_abstract" type="checkbox"> Add an Abstract page to my paper
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="sources" class="col-sm-3 control-label">Sources:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="input-group spinner">
                        <button class="btn btn-primary pull-left" type="button">+</button>
                        <input name="sources" id="sources" type="text" class="form-control pull-left" value="1">
                        <button class="btn btn-primary pull-left" type="button">-</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="topic" class="col-sm-3 control-label">Topic:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <input id="topic" name="topic" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="paper_details" class="col-sm-3 control-label">Paper details:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <textarea name="paper_details" id="paper_details" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div class="radio">
                <label class="col-sm-3 control-label">Additional Materials:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="additional_materials" id="not" checked>Not needed
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="additional_materials" id="later">Needed, I will provide them later
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="additional_materials" id="wont">Needed, I won't be able to provide them
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <p>Please upload your additional materials not later than in 2 hours. Mind that we will not
                        start working on your order until you provide us with the required information/files</p>

                    <p>Please provide the names of required sources in Paper Details. Also note that research into
                        absent sources may require additional time, which may slightly extend the deadline.</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 order-price-block">
                    <span>Approximate price:</span><strong id="appr_price_step2">$9.97</strong>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button id="click_to_tab" data-tab="2" class="btn btn-danger pull-right">GO to Step 2</button>
                </div>
            </div>
        </div>
        <div class="panel-body form-container tab-pane" id="tab-2">
            <div class="form-group">
                <label class="col-sm-3 control-label">Type of service:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option1">Writing from scratch
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option2">Editing/proofreading
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Academic Level:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option3">Undergraduate
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option4">Bachelor
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option5">Professional
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> I want to order VIP customer service
                            <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="pages_number" class="col-sm-3 control-label">Number of pages:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-3">
                    <div class="input-group spinner">
                        <button class="btn btn-primary pull-left" type="button">+</button>
                        <input id="pages_number" type="text" class="form-control pull-left" value="1">
                        <button class="btn btn-primary pull-left" type="button">-</button>
                    </div>
                </div>
                <label for="slides_number" class="col-sm-3 control-label">Number of slides:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-3">
                    <div class="input-group spinner">
                        <button class="btn btn-primary pull-left" type="button">+</button>
                        <input id="slides_number" type="text" class="form-control pull-left" value="1">
                        <button class="btn btn-primary pull-left" type="button">-</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-4">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option6">Single Spaced
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option7">Double Spaced
                        </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <p class="bg-info" style="padding: 6px; text-align: center">1 page = 275 words</p></div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">First Draft Deadline:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-3">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option8">3
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option9">6
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option10">12
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option11">24
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option12">2
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option13">3
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option14">6
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option15">10
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option16">14
                        </label>
                    </div>
                </div>
                <div class="col-sm-offset-3 col-sm-3">Hours</div>
                <div class="col-sm-6">Days</div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    The deadline for the first draft is <strong>25 Jun 12 AM</strong>.
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </div>
                <div class="col-sm-offset-3 col-sm-9">
                    We estimate that your final submission deadline is <strong>26 Jun 07 PM</strong>.
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Preferred writer:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary" style="padding: 16px 15px !important;">
                            <input type="radio" name="options" id="option17">Regular writer
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option18">Advanced regular<br>writer
                        </label>
                        <label class="btn btn-primary" style="padding: 16px 15px !important;">
                            <input type="radio" name="options" id="option19">My previous writer
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option20">TOP writer:<br>Fullfiled by top 10 writers
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <a href="#">Have a discount?</a> (optional)
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Preferred payment system:
                    <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                </label>
                <div class="col-sm-9">
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option21">Credit card
                        </label>
                        <label class="btn btn-primary btn-deadline">
                            <input type="radio" name="options" id="option22">PayPal
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <p class="bg-info" style="padding: 15px;">Please note that overseas transactions from the territory of the European Union might include additional charges, stipulated by your Government. They will be reflected on the payment page and your bank statement. <strong>PaperHelper.com</strong> does not have the authority to fix or scale down the VAT or any other fees.</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 order-price-block">
                    <span>Total price:</span><strong id="appr_price_step3">$17.97</strong>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <a href="#tab-1" id="click_to_tab" data-tab="1"><strong><</strong> Back to Step 1</button></a>
                </div>
                <div class="col-sm-6">
                    <button id="click_to_tab"  data-tab="3" class="btn btn-danger pull-right">Go to Step 3</button>
                </div>
            </div>
        </div>
        <div class="panel-body form-container tab-pane" id="tab-3">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#new" data-toggle="tab">I am new here</a></li>
                <li><a href="#sign-in" data-toggle="tab">Sign in</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane form-container active" id="new">
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-9">
                            <input id="email" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_email" class="col-sm-3 control-label">Confirm email:</label>
                        <div class="col-sm-9">
                            <input id="confirm_email" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="first_name" class="col-sm-3 control-label">First Name:</label>
                        <div class="col-sm-9">
                            <input id="first_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="col-sm-3 control-label">Last name:</label>
                        <div class="col-sm-9">
                            <input id="last_name" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="col-sm-3 control-label">Password:
                            <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                        </label>
                        <div class="col-sm-9">
                            <input id="pass" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirm_pass" class="col-sm-3 control-label">Confirm password:</label>
                        <div class="col-sm-9">
                            <input id="confirm_pass" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-sm-3 control-label">Country:</label>
                        <div id="country" class="col-sm-9">
                            <select id="country" class="form-control">
                                <option>Choose...</option>
                                <option>Lorem ipsum</option>
                                <option>Dolor sit amet</option>
                                <option>Consecteur adipising</option>
                                <option>Elit nulliam</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cellphone" class="col-sm-3 control-label">Cell phone:
                            <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                        </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                            <span class="input-group-addon">
                                +225
                            </span>
                                <input id="cellphone" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <i class="clearfix">
                                By proceeding to the next step, you are accepting our <a href="#">Terms of Use</a>, <a href="#">Privacy Policy</a> and <a href="#">Money Back Guarantee</a>.
                            </i>
                            <i class="clearfix">
                                By proceeding to the next step, you express your prior affirmative consent to receive emails and sms from us.
                            </i>
                        </div>
                    </div>
                </div>
                <div class="tab-pane form-container" id="sign-in">
                    <div class="form-group">
                        <label for="have_email" class="col-sm-3 control-label">Email:
                            <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                        </label>

                        <div class="col-sm-9">
                            <input id="have_email" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="have_password" class="col-sm-3 control-label">Password:
                            <a class="glyphicon glyphicon-info-sign" data-toggle="tooltip" title="Lorem ipsum dolor sit amet"></a>
                        </label>
                        <div class="col-sm-9">
                            <input id="have_password" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <i class="clearfix">
                                By proceeding to the next step, you are accepting our <a href="#">Terms of Use</a>, <a href="#">Privacy Policy</a> and <a href="#">Money Back Guarantee</a>.
                            </i>
                            <i class="clearfix">
                                By proceeding to the next step, you express your prior affirmative consent to receive emails and sms from us.
                            </i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <a href="#tab-2" id="click_to_tab" data-tab="2"><strong><</strong> Back to Step 2</button></a>
                    </div>
                    <div class="col-sm-12">
                        <button id="secure_pay" class="btn btn-danger pull-right">Proceed to Secure Payment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->endWidget();
?>
<script type="text/javascript">
    (function ($) {
        var sin=$('.spinner input');
        $('.spinner .btn:first-of-type').on('click', function() {
            sin.val( parseInt(sin.val(), 10) + 1);
        });
        $('.spinner .btn:last-of-type').on('click', function() {
            sin.val( parseInt(sin.val(), 10) - 1);
        });
    })(jQuery);

    $('form').on('click','#click_to_tab',function(){
        $('#tab-panel a[href="#tab-'+$(this).data('tab')+'"]').tab('show');
        return false;
    });
    $('a[data-toggle="tab"]').on('hide.bs.tab', function (e) {
        console.log(e);
        //e.target; // activated tab
        e.relatedTarget.active(); // previous tab
        //e.preventDefault();
        return true;
    });
</script>
