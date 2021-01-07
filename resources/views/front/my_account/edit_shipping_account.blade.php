    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Edit Shipping Address</h4>
                <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
           <form action="{{ route('my-account.shipping.update', $shipping->id) }}" method="post">
	            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                        		<label for="acc_firstName">First Name *</label>
                        		<input type="text" class="form-control" id="acc_firstName" name="first_name" value="{{ $shipping->first_name }}" required>
                        	</div>
            	        </div>
                    	<div class="col-md-6">
                        	<div class="form-group">
                        		<label for="acc_lastName">Last Name *</label>
                        		<input type="text" class="form-control" id="acc_lastName" name="last_name" value="{{ $shipping->last_name }}" required>
                        	</div>
                    	</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ $shipping->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zone">Zone *</label>
                                <input type="text" class="form-control" id="zone" name="zone" value="{{ $shipping->zone }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District *</label>
                                <input type="text" class="form-control" id="district" name="district" value="{{ $shipping->district }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Area *</label>
                                <input type="text" class="form-control" id="area" name="area" value="{{ $shipping->area }}" required>
                            </div>
                        </div>
                	    <div class="col-md-6">
                        	<div class="form-group">
                        		<label for="country">Country *</label>
                        		<select class="form-control" id="country" name="country" required>
                        			<option value="Nepal" selected>Nepal</option>
                        		</select>
                        	</div>
                    	</div>
                    	<div class="col-md-6">
                        	<div class="form-group">
                        		<label for="locationType">Location Type *</label>
                        		<select class="form-control" id="locationType" name="location_type">
                        			<option selected>Home</option>
                        			<option>Business</option required>
                        		</select>
                        	</div>
                        </div>
                        <div class="col-md-6">
                        	<div class="form-group">
                        		<label for="mobile">Mobile *</label>
                        		<div class="input-group">
                        			<span class="input-group-addon">+977</span>
                        			<input type="text" class="form-control" id="mobile" aria-describedby="inputGroupSuccess2Status" name="mobile" value="{{ $shipping->mobile }}" required>
                        		</div>
                        	</div>
                    	</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Mobile 2</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+977</span>
                                    <input type="text" class="form-control" id="phone" aria-describedby="inputGroupSuccess2Status" name="phone" value="{{ $shipping->phone }}" required>
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default modal-close" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>