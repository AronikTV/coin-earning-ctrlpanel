@extends('layouts.main')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">{{__('Earn Coins')}}</h5>
                        </div>
                    </div>
                    <div class="card-body table-responsive">

                        <table id="datatable" class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Reward')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                    		<tbody>
                     			 <tr>
                                            <td>Linkvertise</td>
                                            <td><span class="badge bg-light text-dark">30 Coins</span></td>
                                            <td><span class="badge bg-success">Available</span></td>
                            		    <td><a href="https://my.domain.example/earn/lv"><!-- Change the domakn to your own -->
                                            <Button class="btn btn-inverse-success">Start</Button>
                                	         </a></td>
                       		</tr>

          <td>Adsense</td>
          <td><span class="badge bg-light text-dark">5 Coins</span></td>
          <td><span class="badge bg-success">Available</span></td>
      <td><a href="https://my.domain.example/earn/ad"> <!-- Change ghe domain to your own -->
          <Button class="btn btn-inverse-success">Start</Button>
           </a></td>
</tr>
                      	  </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

