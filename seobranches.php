<div class="card-title">Branches
 <button data-toggle="modal" data-target="#addCountryModal" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">

      Add Country</button></div>
<hr>

<div >

  <div class="row">
    <label class="col-6">Zambia 
      <button data-toggle="modal" data-target="#addBranchModal" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">

      Add Branch</button>

    </label>
    <label class="col-6">5</label>
  </div>

  <div class="row">
    <div class="col-6"></div>
    <div class="col-6" data-toggle="modal" data-target="#myModal">
     <hr>
     <div class="row">
      <label class="col-6">Kitwe branch</label>
      <label class="col-6">Jumbo drive</label>
    </div>


    <hr>

    <div class="row">
      <label class="col-6">Ndola branch</label>
      <label class="col-6">Presidential Avnue drive</label>
    </div>

    <hr>

    <div class="row">
      <label class="col-6">Lusaka branch</label>
      <label class="col-6">Presidential Avnue drive</label>
    </div>


  </div>
</div>
<hr>

<div class="row">
  <label class="col-6">South Afrcia
    <button onclick="" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">

    Add Branch</button>
  </label>
  <label class="col-6">5</label>
</div>
<hr>


</div>



<!-- edit branch Modal -->
<div class="modal fade text-dark" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Edit Branch</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Branch name</b>
          <input type="text" class="form-control form-control-rounded" value="Lusaka branch" id="input-6" placeholder="Enter brance name">
        </div>

        <div class="form-group">
          <b class="col-6">Address</b>
          <input type="text" class="form-control form-control-rounded" value="Presidential Avnue drive" id="input-6" placeholder="Enter brance name">
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>




<!-- add branch Modal -->
<div class="modal fade text-dark" id="addBranchModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Branch</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

          <form id="addBranchForm">
        <div class="form-group">
          <b class="col-6">Branch name</b>
          <input type="text" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter branch name">
        </div>

        <div class="form-group">
          <b class="col-6">Address</b>
          <input type="text" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter brance address">
        </div>


      </div>
      <div class="modal-footer">

        <button type="button"  class="btn btn-info">Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
      </div>
    </div>

  </div>
</div>

</div>



<!-- add branch Modal -->
<div class="modal fade text-dark" id="addCountryModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title text-dark">Add Country</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">


        <div class="form-group">
          <b class="col-6">Select Country</b>
          
          <select class="form-control form-control-rounded"> 

                          <option selected="" value="247">Zambia</option>
                          <option value="196">South Africa</option>
                          <option value="246">Yemen</option>
                          <option value="183">Samoa</option>
                          <option value="244">Wallis &amp; Futuna</option>
                          <option value="240">Vanuatu</option>
                          <option value="243">Vietnam</option>
                          <option value="232">U.S. Virgin Islands</option>
                          <option value="32">British Virgin Islands</option>
                          <option value="242">Venezuela</option>
                          <option value="208">St. Vincent &amp; Grenadines</option>
                          <option value="241">Vatican City</option>
                          <option value="239">Uzbekistan</option>
                          <option value="234">United States of America</option>
                          <option value="238">Uruguay</option>
                          <option value="231">U.S. Outlying Islands</option>
                          <option value="236">Ukraine</option>
                          <option value="235">Uganda</option>
                          <option value="219">Tanzania</option>
                          <option value="217">Taiwan</option>
                          <option value="230">Tuvalu</option>
                          <option value="227">Turkey</option>
                          <option value="226">Tunisia</option>
                          <option value="225">Trinidad &amp; Tobago</option>
                          <option value="224">Tonga</option>
                          <option value="221">Timor-Leste</option>
                          <option value="228">Turkmenistan</option>
                          <option value="223">Tokelau</option>
                          <option value="218">Tajikistan</option>
                          <option value="220">Thailand</option>
                          <option value="222">Togo</option>
                          <option value="44">Chad</option>
                          <option value="229">Turks &amp; Caicos Islands</option>
                          <option value="215">Syria</option>
                          <option value="188">Seychelles</option>
                          <option value="191">Sint Maarten</option>
                          <option value="212">Swaziland</option>
                          <option value="213">Sweden</option>
                          <option value="193">Slovenia</option>
                          <option value="192">Slovakia</option>
                          <option value="210">Suriname</option>
                          <option value="216">S�o Tom� &amp; Pr�ncipe</option>
                          <option value="199">South Sudan</option>
                          <option value="187">Serbia</option>
                          <option value="207">St. Pierre &amp; Miquelon</option>
                          <option value="195">Somalia</option>
                          <option value="184">San Marino</option>
                          <option value="67">El Salvador</option>
                          <option value="189">Sierra Leone</option>
                          <option value="194">Solomon Islands</option>
                          <option value="211">Svalbard &amp; Jan Mayen</option>
                          <option value="203">St. Helena</option>
                          <option value="197">South Georgia &amp; South Sandwich Islands</option>
                          <option value="190">Singapore</option>
                          <option value="186">Senegal</option>
                          <option value="209">Sudan</option>
                          <option value="185">Saudi Arabia</option>
                          <option value="181">Rwanda</option>
                          <option value="180">Russia</option>
                          <option value="179">Romania</option>
                          <option value="182">R�union</option>
                          <option value="178">Qatar</option>
                          <option value="78">French Polynesia</option>
                          <option value="168">Palestine</option>
                          <option value="171">Paraguay</option>
                          <option value="176">Portugal</option>
                          <option value="162">North Korea</option>
                          <option value="177">Puerto Rico</option>
                          <option value="175">Poland</option>
                          <option value="170">Papua New Guinea</option>
                          <option value="167">Palau</option>
                          <option value="173">Philippines</option>
                          <option value="172">Peru</option>
                          <option value="174">Pitcairn Islands</option>
                          <option value="169">Panama</option>
                          <option value="166">Pakistan</option>
                          <option value="165">Oman</option>
                          <option value="156">New Zealand</option>
                          <option value="152">Nauru</option>
                          <option value="153">Nepal</option>
                          <option value="164">Norway</option>
                          <option value="154">Netherlands</option>
                          <option value="160">Niue</option>
                          <option value="157">Nicaragua</option>
                          <option value="159">Nigeria</option>
                          <option value="161">Norfolk Island</option>
                          <option value="158">Niger</option>
                          <option value="155">New Caledonia</option>
                          <option value="151">Namibia</option>
                          <option value="140">Mayotte</option>
                          <option value="132">Malaysia</option>
                          <option value="131">Malawi</option>
                          <option value="139">Mauritius</option>
                          <option value="137">Martinique</option>
                          <option value="147">Montserrat</option>
                          <option value="138">Mauritania</option>
                          <option value="149">Mozambique</option>
                          <option value="163">Northern Mariana Islands</option>
                          <option value="145">Mongolia</option>
                          <option value="146">Montenegro</option>
                          <option value="150">Myanmar</option>
                          <option value="135">Malta</option>
                          <option value="134">Mali</option>
                          <option value="129">Macedonia</option>
                          <option value="136">Marshall Islands</option>
                          <option value="141">Mexico</option>
                          <option value="133">Maldives</option>
                          <option value="130">Madagascar</option>
                          <option value="143">Moldova</option>
                          <option value="144">Monaco</option>
                          <option value="148">Morocco</option>
                          <option value="206">St. Martin</option>
                          <option value="128">Macau</option>
                          <option value="120">Latvia</option>
                          <option value="127">Luxembourg</option>
                          <option value="126">Lithuania</option>
                          <option value="122">Lesotho</option>
                          <option value="201">Sri Lanka</option>
                          <option value="125">Liechtenstein</option>
                          <option value="205">St. Lucia</option>
                          <option value="124">Libya</option>
                          <option value="123">Liberia</option>
                          <option value="121">Lebanon</option>
                          <option value="119">Laos</option>
                          <option value="117">Kuwait</option>
                          <option value="198">South Korea</option>
                          <option value="204">St. Kitts &amp; Nevis</option>
                          <option value="116">Kiribati</option>
                          <option value="37">Cambodia</option>
                          <option value="118">Kyrgyzstan</option>
                          <option value="115">Kenya</option>
                          <option value="114">Kazakhstan</option>
                          <option value="111">Japan</option>
                          <option value="113">Jordan</option>
                          <option value="112">Jersey</option>
                          <option value="110">Jamaica</option>
                          <option value="109">Italy</option>
                          <option value="108">Israel</option>
                          <option value="101">Iceland</option>
                          <option value="105">Iraq</option>
                          <option value="104">Iran</option>
                          <option value="106">Ireland</option>
                          <option value="31">British Indian Ocean Territory</option>
                          <option value="102">India</option>
                          <option value="107">Isle of Man</option>
                          <option value="103">Indonesia</option>
                          <option value="100">Hungary</option>
                          <option value="96">Haiti</option>
                          <option value="55">Croatia</option>
                          <option value="98">Honduras</option>
                          <option value="97">Heard &amp; McDonald Islands</option>
                          <option value="99">Hong Kong</option>
                          <option value="95">Guyana</option>
                          <option value="90">Guam</option>
                          <option value="77">French Guiana</option>
                          <option value="91">Guatemala</option>
                          <option value="87">Greenland</option>
                          <option value="88">Grenada</option>
                          <option value="86">Greece</option>
                          <option value="68">Equatorial Guinea</option>
                          <option value="94">Guinea-Bissau</option>
                          <option value="81">Gambia</option>
                          <option value="89">Guadeloupe</option>
                          <option value="93">Guinea</option>
                          <option value="85">Gibraltar</option>
                          <option value="84">Ghana</option>
                          <option value="92">Guernsey</option>
                          <option value="82">Georgia</option>
                          <option value="233">United Kingdom</option>
                          <option value="80">Gabon</option>
                          <option value="142">Micronesia</option>
                          <option value="73">Faroe Islands</option>
                          <option value="76">France</option>
                          <option value="72">Falkland Islands</option>
                          <option value="74">Fiji</option>
                          <option value="75">Finland</option>
                          <option value="71">Ethiopia</option>
                          <option value="70">Estonia</option>
                          <option value="200">Spain</option>
                          <option value="245">Western Sahara</option>
                          <option value="69">Eritrea</option>
                          <option value="66">Egypt</option>
                          <option value="65">Ecuador</option>
                          <option value="3">Algeria</option>
                          <option value="64">Dominican Republic</option>
                          <option value="61">Denmark</option>
                          <option value="63">Dominica</option>
                          <option value="62">Djibouti</option>
                          <option value="83">Germany</option>
                          <option value="59">Czech Republic</option>
                          <option value="58">Cyprus</option>
                          <option value="42">Cayman Islands</option>
                          <option value="47">Christmas Island</option>
                          <option value="57">Cura�ao</option>
                          <option value="56">Cuba</option>
                          <option value="54">Costa Rica</option>
                          <option value="40">Cape Verde</option>
                          <option value="50">Comoros</option>
                          <option value="49">Colombia</option>
                          <option value="53">Cook Islands</option>
                          <option value="51">Congo - Brazzaville</option>
                          <option value="52">Congo - Kinshasa</option>
                          <option value="38">Cameroon</option>
                          <option value="60">C�te d�Ivoire</option>
                          <option value="46">China</option>
                          <option value="45">Chile</option>
                          <option value="214">Switzerland</option>
                          <option value="48">Cocos (Keeling) Islands</option>
                          <option value="39">Canada</option>
                          <option value="43">Central African Republic</option>
                          <option value="28">Botswana</option>
                          <option value="29">Bouvet Island</option>
                          <option value="25">Bhutan</option>
                          <option value="33">Brunei</option>
                          <option value="19">Barbados</option>
                          <option value="30">Brazil</option>
                          <option value="26">Bolivia</option>
                          <option value="24">Bermuda</option>
                          <option value="22">Belize</option>
                          <option value="20">Belarus</option>
                          <option value="202">St. Barth�lemy</option>
                          <option value="27">Bosnia</option>
                          <option value="16">Bahamas</option>
                          <option value="17">Bahrain</option>
                          <option value="34">Bulgaria</option>
                          <option value="18">Bangladesh</option>
                          <option value="35">Burkina Faso</option>
                          <option value="41">Caribbean Netherlands</option>
                          <option value="23">Benin</option>
                          <option value="21">Belgium</option>
                          <option value="36">Burundi</option>
                          <option value="15">Azerbaijan</option>
                          <option value="14">Austria</option>
                          <option value="13">Australia</option>
                          <option value="9">Antigua &amp; Barbuda</option>
                          <option value="79">French Southern Territories</option>
                          <option value="8">Antarctica</option>
                          <option value="4">American Samoa</option>
                          <option value="11">Armenia</option>
                          <option value="10">Argentina</option>
                          <option value="237">United Arab Emirates</option>
                          <option value="5">Andorra</option>
                          <option value="2">Albania</option>
                          <option value="249">�land Islands</option>
                          <option value="7">Anguilla</option>
                          <option value="6">Angola</option>
                          <option value="1">Afghanistan</option>
                          <option value="12">Aruba</option>
          </select>
        </div>
 

      </div>
      <div class="modal-footer">

        <button type="button"  class="btn btn-info">Save</button>
        <button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
      </div>
    </div>

  </div>
</div>

</div>




<script>
$(document).ready(function()
{
 // createForm 
    $("#createForm").on('submit',(function(e)
    {
			   e.preventDefault();
			   $.ajax({
					   url: "ajax.saveCountry.php",
					   type: "POST",
					   data:  new FormData(this),
					   contentType: false,
							 cache: false,
					   processData:false,
					   beforeSend : function()
						   {
							// put your check here :)
						   },
					   success: function(r)
						  {
							openMessageModal('Infomation',r);
							getBranches();
							$("#AddSEOModal").modal("hide");
							 $('#createForm').trigger('reset');
						  },
						 error: function(e) 
						  {
							   alert(e);
						  }          
				});
			 }));

     



      //deleteCountryForm

     
                    getBranches();
});

function getBranches()
 {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() 
  {
    if (this.readyState == 4 && this.status == 200)
     {

      document.getElementById("countriesTablepool").innerHTML =this.responseText;

    }
  };
  xhttp.open("POST", "ajax.getBranch.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("");
}


















function openModal()
{

  $("#AddSEOModal").modal("show");

}











</script>
