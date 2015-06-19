<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/mmenu/src/js/jquery.mmenu.oncanvas.js',CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl.'/js/price.js',CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/price.css');
?>
    <div class="wrapper mbody">
		  <div class="item-page">

  <p style="margin:0;"><div class="moduletable main-calc">
					
<div id="price-wrap">
	
		<center><h3>Price Calculator</h3></center>
		<p class="headerSub">Find out how much your order will cost.</p>
	
	
	<div class="clear"></div>
	<div class="price-row">
	<p class="levelSelect">Select Academic Level</p>
		<a name="hsLink" class="hs-price not-active" id="hsLink" onClick="calcToggleHs()" >H. School</a>
		<a id="ugradLink" class="undergrad-price active" onClick="calcToggleUgrad()" >Undergrad</a>
		<a id="masterLink" class="master-price not-active" onClick="calcToggleMaster()" >Master</a>
		<a id="doctoralLink" class="doctoral-price not-active" onClick="calcToggleDoctoral()" >Doctoral</a>
	</div>
		<div class="clear"></div>

		
		<!-- Start of HS pricing div -->
		<div id="hsDiv" class="hidden" >
		        <form action="#" id="priceformHs" onsubmit="return false;">
		        <div>
		            <div class="cont_order">
						<!-- start of due date selections -->
						<label>Select High School Deadline</label>
							<div class="order-select-wrap">
								<select id="hsduedate" name="hsduedate" onchange="calculateTotalHs()">
									<option value="selectDays">Select Days</option>
									<option value="twoMonths">60 Days</option>
									<option value="thirtyDays">30 Days</option>
									<option value="twentyDays">20 Days</option>
									<option value="tenDays">10 Days</option>
									<option value="sevenDays">7 Days</option>
									<option value="fiveDays">5 Days</option>
									<option value="fourDays">4 Days</option>
									<option value="threeDays">3 Days</option>
									<option value="twoDays">2 Days</option>
									<option value="oneDay">1 Day</option>
									<option value="twelveHours">12 Hours</option>
									<option value="eightHours">8 Hours</option>
									<option value="sixHours">6 Hours</option>
									<option value="threeHours">3 Hours</option>
				               </select>
		              </div>
					   <br>
						
						<!-- end of due date selections -->
						
						<label>Number of Pages</label>
						<div class="order-select-wrap">
			                <select id="pageprice" name="pageprice" onchange="calculateTotalHs()">
			                <option value="One">1</option>
			                <option value="Two">2</option>
			                <option value="Three">3</option>
			                <option value="Four">4</option> 
			                <option value="Five">5</option>
			                <option value="Six">6</option>
			                <option value="Seven">7</option>
			                <option value="Eight">8</option>
			                <option value="Nine">9</option>
			                <option value="Ten">10</option>
			                <option value="Eleven">11</option>
			                <option value="Twelve">12</option>
			                <option value="Thirteen">13</option>
			                <option value="Fourteen">14</option>
			                <option value="Fifteen">15</option>
			                <option value="Sixteen">16</option>
			                <option value="Seventeen">17</option>
			                <option value="Eighteen">18</option>
			                <option value="Nineteen">19</option>
			                <option value="Twenty">20</option>
			                <option value="TwentyOne">21</option>
			                <option value="TwentyTwo">22</option>
			                <option value="TwentyThree">23</option>
			                <option value="TwentyFour">24</option> 
			                <option value="TwentyFive">25</option>
			                <option value="TwentySix">26</option>
			                <option value="TwentySeven">27</option>
			                <option value="TwentyEight">28</option>
			                <option value="TwentyNine">29</option>
			                <option value="Thirty">30</option>
			                <option value="ThirtyOne">31</option>
			                <option value="ThirtyTwo">32</option>
			                <option value="ThirtyThree">33</option>
			                <option value="ThirtyFour">34</option> 
			                <option value="ThirtyFive">35</option>
			                <option value="ThirtySix">36</option>
			                <option value="ThirtySeven">37</option>
			                <option value="ThirtyEight">38</option>
			                <option value="ThirtyNine">39</option>
			                <option value="Forty">40</option>
			                <option value="FortyOne">41</option>
			                <option value="FortyTwo">42</option>
			                <option value="FortyThree">43</option>
			                <option value="FortyFour">44</option> 
			                <option value="FortyFive">45</option>
			                <option value="FortySix">46</option>
			                <option value="FortySeven">47</option>
			                <option value="FortyEight">48</option>
			                <option value="FortyNine">49</option>
			                <option value="Fifty">50</option>
			               </select>
		              </div>
		                          
		            </div>
		            
		        </div>  
		       </form>
			<div class="right-price-box">
			
				<div id="totalPriceHs" style="display: block;"></div>
				
				<a class="flatButton orange" href="http://www.ultius.com/component/orders/?Itemid=114">Proceed to Order</a>
				
			</div>
			
			<div class="clear"></div>
		 </div>
		<!-- end of HS pricing div -->
		
		<!-- Start of undergrad pricing div -->
		<div id="undergradDiv" class="visible" >
		        <form action="#" id="priceform" onsubmit="return false;">
		        <div>
		            <div class="cont_order">
						<!-- start of due date selections -->
						<label>Select Undergrad Deadline</label>
							<div class="order-select-wrap">
								<select id="duedate" name="duedate" onchange="calculateTotal()">
									<option value="selectDays">Select Days</option>
									<option value="twoMonths">60 Days</option>
									<option value="thirtyDays">30 Days</option>
									<option value="twentyDays">20 Days</option>
									<option value="tenDays">10 Days</option>
									<option value="sevenDays">7 Days</option>
									<option value="fiveDays">5 Days</option>
									<option value="fourDays">4 Days</option>
									<option value="threeDays">3 Days</option>
									<option value="twoDays">2 Days</option>
									<option value="oneDay">1 Day</option>
									<option value="twelveHours">12 Hours</option>
									<option value="eightHours">8 Hours</option>
									<option value="sixHours">6 Hours</option>
									<option value="threeHours">3 Hours</option>
				               </select>
		              </div>
					   <br>
						
						<!-- end of due date selections -->
						
						<label>Number of Pages</label>
						<div class="order-select-wrap">
			                <select id="pageprice" name="pageprice" onchange="calculateTotal()">
			                <option value="One">1</option>
			                <option value="Two">2</option>
			                <option value="Three">3</option>
			                <option value="Four">4</option> 
			                <option value="Five">5</option>
			                <option value="Six">6</option>
			                <option value="Seven">7</option>
			                <option value="Eight">8</option>
			                <option value="Nine">9</option>
			                <option value="Ten">10</option>
			                <option value="Eleven">11</option>
			                <option value="Twelve">12</option>
			                <option value="Thirteen">13</option>
			                <option value="Fourteen">14</option>
			                <option value="Fifteen">15</option>
			                <option value="Sixteen">16</option>
			                <option value="Seventeen">17</option>
			                <option value="Eighteen">18</option>
			                <option value="Nineteen">19</option>
			                <option value="Twenty">20</option>
			                <option value="TwentyOne">21</option>
			                <option value="TwentyTwo">22</option>
			                <option value="TwentyThree">23</option>
			                <option value="TwentyFour">24</option> 
			                <option value="TwentyFive">25</option>
			                <option value="TwentySix">26</option>
			                <option value="TwentySeven">27</option>
			                <option value="TwentyEight">28</option>
			                <option value="TwentyNine">29</option>
			                <option value="Thirty">30</option>
			                <option value="ThirtyOne">31</option>
			                <option value="ThirtyTwo">32</option>
			                <option value="ThirtyThree">33</option>
			                <option value="ThirtyFour">34</option> 
			                <option value="ThirtyFive">35</option>
			                <option value="ThirtySix">36</option>
			                <option value="ThirtySeven">37</option>
			                <option value="ThirtyEight">38</option>
			                <option value="ThirtyNine">39</option>
			                <option value="Forty">40</option>
			                <option value="FortyOne">41</option>
			                <option value="FortyTwo">42</option>
			                <option value="FortyThree">43</option>
			                <option value="FortyFour">44</option> 
			                <option value="FortyFive">45</option>
			                <option value="FortySix">46</option>
			                <option value="FortySeven">47</option>
			                <option value="FortyEight">48</option>
			                <option value="FortyNine">49</option>
			                <option value="Fifty">50</option>
			               </select>
		              </div>
		                          
		            </div>
		            
		        </div>  
		       </form>
			<div class="right-price-box">
			
				<div id="totalPrice" style="display: block;"></div>
				
				<a class="flatButton orange" href="http://www.ultius.com/component/orders/?Itemid=114" onclick="javascript:void(0);"></i>Proceed to Order</a>
				
			</div>
			
			<div class="clear"></div>
		 </div>
		 
		 <!-- end of undergrad pricing div -->
		 
		 <!-- Start of Master div -->
		 <div id="masterDiv" class="hidden">
		 	<form action="#" id="priceformMaster" onsubmit="return false;">
		        <div>
		            <div class="cont_order">
						<!-- start of due date selections -->
						<label>Select Master's Deadline</label>
							<div class="order-select-wrap">
								<select id="masterduedate" name="masterduedate" onchange="calculateTotalMaster()">
									<option value="selectDays">Select Days</option>
									<option value="twoMonths">60 Days</option>
									<option value="thirtyDays">30 Days</option>
									<option value="twentyDays">20 Days</option>
									<option value="tenDays">10 Days</option>
									<option value="sevenDays">7 Days</option>
									<option value="fiveDays">5 Days</option>
									<option value="fourDays">4 Days</option>
									<option value="threeDays">3 Days</option>
									<option value="twoDays">2 Days</option>
									<option value="oneDay">1 Day</option>
									<option value="twelveHours">12 Hours</option>
									<option value="eightHours">8 Hours</option>
									<option value="sixHours">6 Hours</option>
									<option value="threeHours">3 Hours</option>
				               </select>
		              </div>
					   <br>
						
						<!-- end of due date selections -->
						
						<label>Number of Pages</label>
						<div class="order-select-wrap">
			                <select id="pageprice" name="pageprice" onchange="calculateTotalMaster()">
			                <option value="One">1</option>
			                <option value="Two">2</option>
			                <option value="Three">3</option>
			                <option value="Four">4</option> 
			                <option value="Five">5</option>
			                <option value="Six">6</option>
			                <option value="Seven">7</option>
			                <option value="Eight">8</option>
			                <option value="Nine">9</option>
			                <option value="Ten">10</option>
			                <option value="Eleven">11</option>
			                <option value="Twelve">12</option>
			                <option value="Thirteen">13</option>
			                <option value="Fourteen">14</option>
			                <option value="Fifteen">15</option>
			                <option value="Sixteen">16</option>
			                <option value="Seventeen">17</option>
			                <option value="Eighteen">18</option>
			                <option value="Nineteen">19</option>
			                <option value="Twenty">20</option>
			                <option value="TwentyOne">21</option>
			                <option value="TwentyTwo">22</option>
			                <option value="TwentyThree">23</option>
			                <option value="TwentyFour">24</option> 
			                <option value="TwentyFive">25</option>
			                <option value="TwentySix">26</option>
			                <option value="TwentySeven">27</option>
			                <option value="TwentyEight">28</option>
			                <option value="TwentyNine">29</option>
			                <option value="Thirty">30</option>
			                <option value="ThirtyOne">31</option>
			                <option value="ThirtyTwo">32</option>
			                <option value="ThirtyThree">33</option>
			                <option value="ThirtyFour">34</option> 
			                <option value="ThirtyFive">35</option>
			                <option value="ThirtySix">36</option>
			                <option value="ThirtySeven">37</option>
			                <option value="ThirtyEight">38</option>
			                <option value="ThirtyNine">39</option>
			                <option value="Forty">40</option>
			                <option value="FortyOne">41</option>
			                <option value="FortyTwo">42</option>
			                <option value="FortyThree">43</option>
			                <option value="FortyFour">44</option> 
			                <option value="FortyFive">45</option>
			                <option value="FortySix">46</option>
			                <option value="FortySeven">47</option>
			                <option value="FortyEight">48</option>
			                <option value="FortyNine">49</option>
			                <option value="Fifty">50</option>
			               </select>
		              </div>
		                          
		            </div>
		            
		        </div>  
	        </form>
			<div class="right-price-box">
			
				<div id="totalPriceMaster" style="display: block;"></div>
				
				<a class="flatButton orange" href="http://www.ultius.com/component/orders/?Itemid=114">Proceed to Order</a>
				
			</div>
			
			<div class="clear"></div>
		 </div>
		 <!-- end of master div -->
		 
		 <!-- Start of Doctoral pricing div -->
		<div id="doctoralDiv" class="hidden" >
		        <form action="#" id="priceformDoctoral" onsubmit="return false;">
		        <div>
		            <div class="cont_order">
						<!-- start of due date selections -->
						<label>Select Doctoral Deadline</label>
							<div class="order-select-wrap">
								<select id="doctoralduedate" name="doctoralduedate" onchange="calculateTotalDoctoral()">
									<option value="selectDays">Select Days</option>
									<option value="twoMonths">60 Days</option>
									<option value="thirtyDays">30 Days</option>
									<option value="twentyDays">20 Days</option>
									<option value="tenDays">10 Days</option>
									<option value="sevenDays">7 Days</option>
									<option value="fiveDays">5 Days</option>
									<option value="fourDays">4 Days</option>
									<option value="threeDays">3 Days</option>
									<option value="twoDays">2 Days</option>
									<option value="oneDay">1 Day</option>
									<option value="twelveHours">12 Hours</option>
				               </select>
				            </div>
					   <br>
						
						<!-- end of due date selections -->
						
						<label>Number of Pages</label>
						<div class="order-select-wrap">
			                <select id="pageprice" name="pageprice" onchange="calculateTotalDoctoral()">
			                <option value="One">1</option>
			                <option value="Two">2</option>
			                <option value="Three">3</option>
			                <option value="Four">4</option> 
			                <option value="Five">5</option>
			                <option value="Six">6</option>
			                <option value="Seven">7</option>
			                <option value="Eight">8</option>
			                <option value="Nine">9</option>
			                <option value="Ten">10</option>
			                <option value="Eleven">11</option>
			                <option value="Twelve">12</option>
			                <option value="Thirteen">13</option>
			                <option value="Fourteen">14</option>
			                <option value="Fifteen">15</option>
			                <option value="Sixteen">16</option>
			                <option value="Seventeen">17</option>
			                <option value="Eighteen">18</option>
			                <option value="Nineteen">19</option>
			                <option value="Twenty">20</option>
			                <option value="TwentyOne">21</option>
			                <option value="TwentyTwo">22</option>
			                <option value="TwentyThree">23</option>
			                <option value="TwentyFour">24</option> 
			                <option value="TwentyFive">25</option>
			                <option value="TwentySix">26</option>
			                <option value="TwentySeven">27</option>
			                <option value="TwentyEight">28</option>
			                <option value="TwentyNine">29</option>
			                <option value="Thirty">30</option>
			                <option value="ThirtyOne">31</option>
			                <option value="ThirtyTwo">32</option>
			                <option value="ThirtyThree">33</option>
			                <option value="ThirtyFour">34</option> 
			                <option value="ThirtyFive">35</option>
			                <option value="ThirtySix">36</option>
			                <option value="ThirtySeven">37</option>
			                <option value="ThirtyEight">38</option>
			                <option value="ThirtyNine">39</option>
			                <option value="Forty">40</option>
			                <option value="FortyOne">41</option>
			                <option value="FortyTwo">42</option>
			                <option value="FortyThree">43</option>
			                <option value="FortyFour">44</option> 
			                <option value="FortyFive">45</option>
			                <option value="FortySix">46</option>
			                <option value="FortySeven">47</option>
			                <option value="FortyEight">48</option>
			                <option value="FortyNine">49</option>
			                <option value="Fifty">50</option>
			               </select>
		              </div>
		                          
		            </div>
		            
		        </div>  
		       </form>
			<div class="right-price-box">
			
				<div id="totalPriceDoctoral" style="display: block;"></div>
				
				<a class="flatButton orange" href="http://www.ultius.com/component/orders/?Itemid=114">Proceed to Order</a>
				
			</div>
			
			<div class="clear"></div>
		 </div>
		<!-- end of Doctoral pricing div --></div>
	<!--End of wrap-->		</div>
	</p>
	</div></div>
					
		<div class="clear"></div>
	<div class="clear" style="height: 0;"></div>
