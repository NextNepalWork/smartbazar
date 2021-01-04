<a href="javascript:void(0)" class="uk-button btn-yellow uk-margin-bottom " data-target="#add_address_shipping" data-toggle="modal">add address</a>
    <div id="account" class="account-settings__container ">
        <div class="row">
            @foreach($shipping as $sa)
            <div class=" col-sm-12 panel panel-default border p-2 mb-5 ">
                <div class="panel-heading p-2 border-bottom mb-2">
                    @if(!empty($used_add))
                    @if($used_add->is_default == $sa->is_default)
                    <i class="fas fa-star pull-left uk-margin-right lx fa-1x"  style="color:gold"></i>
                    @endif
                    @endif
                    <strong class="titles">{{ $sa->first_name }} {{ $sa->last_name }}</strong>
                    <a class="pull-right link" href="{{ route('my-account.shipping.delete',[$sa->id]) }}" uk-icon="icon: trash"
                       title="delete" onclick="return confirm('Do you want to delete?');">
                    </a>
                    <a class="pull-right link btn-edit" data-edit-id="{{$sa->id }}" uk-icon="icon: pencil"
                       title="edit" data-target="#edit_address_shipping" data-toggle="modal">
                    </a>
                </div>
                <div class="panel-body">
                    <span uk-icon="location" class="pull-left"></span>
                    <span class="para pull-left uk-margin-left">
                        <ul class="liststyle--none">
                            <li><span class="mr-10 ">{{ $sa->area }}</span></li>
                            <li><span class="mr-10 ">{{ $sa->district }}</span></li>
                            <li><span class="mr-10 ">{{ $sa->zone }}</span></li>
                        </ul>
                    </span>
                    <div class="clearfix"></div>
                    <hr >
                    <span uk-icon="receiver" class="pull-left"></span>
                    <span class="para pull-left uk-margin-left">
                        <ul class="liststyle--none">
                            <li><span class="mr-10 ">{{ $sa->mobile }}{{ $sa->phone != null ? ', ' . $sa->phone : '' }}</span></li>
                            <li><span class="mr-10 ">{{ $sa->email }}</span></li>
                        </ul>
                    </span>
                    <div class="clearfix"></div>
                    <hr>
                    <button class="uk-button btn-yellow uk-width-1-1" data-id="{{ $sa->id }}">Use this address</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
<div id="add_address_shipping" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Add New Shipping Address</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
           <form action="{{ route('my-account.shipping.create') }}" method="post">
	            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        		<label for="acc_firstName">First Name *</label>
                        		<input type="text" class="form-control" id="acc_firstName" name="first_name" required>
                    	    </div>
            	        </div>
            	        <div class="col-md-6">
                        	<div class="form-group">
                        		<label for="acc_lastName">Last Name *</label>
                        		<input type="text" class="form-control" id="acc_lastName" name="last_name" required>
                        	</div>
                    	</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zone">Zone *</label>
                                <input type="text" class="form-control" id="zone" name="zone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District *</label>
                                <input type="text" class="form-control" id="district" name="district" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="area">Area *</label>
                                <input type="text" class="form-control" id="area" name="area" required>
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
                        			<input type="text" class="form-control" id="mobile" aria-describedby="inputGroupSuccess2Status" name="mobile" required>
                        		</div>
                        	</div>
                    	</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Mobile 2</label>
                                <div class="input-group">
                                    <span class="input-group-addon">+977</span>
                                    <input type="text" class="form-control" id="phone" aria-describedby="inputGroupSuccess2Status" name="phone" required>
                                </div>
                            </div>
                        </div>
                	</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>