<div class="row">

	<div class="col-lg-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">SEO list <button data-toggle="modal" data-target="#AddSEOModal" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">Add SEO</button></h5>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Established</th>
								<th scope="col">Branches</th>
								<th scope="col">Products</th>
								<th scope="col">Services</th>
								<th scope="col">Income per annum</th>
								<th scope="col">Expenditure per annum</th>
								<th scope="col">Founded in </th>
								<th scope="col">HQ In</th>
							</tr>
						</thead>
						<tbody onclick="goTo('Views/seoDetails.php' , 'mainContent')">
							<tr >
								<th scope="row">Bana Chanda's Family Chicken</th>
								<td>2015</td>
								<td>1</td>
								<td>2</td>
								<td>-</td>
								<td>K103,000</td>
								<td>K50,000</td>
								<td>Zambia</td>
								<td>Zambia</td>
							</tr>
							<tr>
								<th scope="row">MTN</th>
								<td>2004</td>
								<td>645</td>
								<td>76</td>
								<td>30</td>
								<td>K77,003,000</td>
								<td>K650,000</td>
								<td>Dubai</td>
								<td>South Africa</td>
							</tr>
							<tr>
								<th scope="row">BENZ</th>
								<td>1845</td>
								<td>145</td>
								<td>203</td>
								<td>5</td>
								<td>K11,103,000</td>
								<td>K500,000</td>
								<td>Germany</td>
								<td>Germany</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>





<!-- add branch Modal -->
<div class="modal fade text-dark" id="AddSEOModal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">

				<h4 class="modal-title text-dark">Add SEO</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">


				<div class="form-group">
					<b class="col-6">SEO name</b>
					<input type="text" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter SEO name">
				</div>

				<div class="form-group">
					<b class="col-6">Established</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Established year">
				</div>

				<div class="form-group">
					<b class="col-6">Ownership</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Ownership">
				</div>

				<div class="form-group">
					<b class="col-6">Governance</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter governance">
				</div>

				<div class="form-group">
					<b class="col-6">Primary Country</b>
					<select class="form-control form-control-rounded"> 

						<option selected="" value="247">Zambia</option>
						<option value="196">South Africa</option>
						<option value="246">Yemen</option>
						<option value="183">Samoa</option>
						<option value="244">Wallis &amp; Futuna</option>
						<option value="240">Vanuatu</option>
						<option value="243">Vietnam</option>
					</select>
				</div>


				<div class="form-group">
					<b class="col-6">Country Founded</b>
					<select class="form-control form-control-rounded"> 

						<option selected="" value="247">Zambia</option>
						<option value="196">South Africa</option>
						<option value="246">Yemen</option>
						<option value="183">Samoa</option>
						<option value="244">Wallis &amp; Futuna</option>
						<option value="240">Vanuatu</option>
						<option value="243">Vietnam</option>
					</select>
				</div>


				<div class="form-group">
					<b class="col-6">HQ country</b>
					<select class="form-control form-control-rounded"> 

						<option selected="" value="247">Zambia</option>
						<option value="196">South Africa</option>
						<option value="246">Yemen</option>
						<option value="183">Samoa</option>
						<option value="244">Wallis &amp; Futuna</option>
						<option value="240">Vanuatu</option>
						<option value="243">Vietnam</option>
					</select>
				</div>



				<div class="form-group">
					<b class="col-6">Income per annum</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Income per annum">
				</div>


				<div class="form-group">
					<b class="col-6">Expenditure per annum</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Income per annum">
				</div>


				<div class="form-group">
					<b class="col-6">EXpenditure per annum</b>
					<input type="number" class="form-control form-control-rounded" value="" id="input-6" placeholder="Enter Income per annum">
				</div>



			</div>
			<div class="modal-footer">

				<button type="button" onclick="confirm('Save?');"  class="btn btn-info">Save</button>
				<button type="button" data-dismiss="modal" class="btn btn-dark">Close</button>
			</div>
		</div>

	</div>
</div>