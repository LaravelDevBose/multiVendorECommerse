@extends('admin.master')

@section('title')
Questions-Answer
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/selects/select2.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/invoice_template.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>

<!-- /theme JS files -->
@endsection

@section('content')
<!-- Content area -->
<div class="content">
  <!-- Question answer  template -->
  <div class="panel panel-white">
      <div class="panel-heading">
        <h6 class="panel-title">Answer the Question</h6>
        <div class="heading-elements">

          </div>
      </div>

      <div class="panel-body no-padding-bottom">
        <div class="row">
          <div class="col-md-12 col-lg-12 content-group">
							<ul class="list-condensed list-unstyled">
                <li><h5 class="text-uppercase">{{ $readQusen->name }}</h5></li>
  							<li><b>Email:</b><i>{{ $readQusen->email }}</i></li>
  							<li><p class="text-semibold"><b>Q:</b>{{ $readQusen->message }} ?</p></li>
		          </ul>
					</div>

        </div>
<hr>
        <div class="row">

          <div class=" col-md-8 col-lg-7 content-group">
            <?php
                $productImage = $productInfo->image;
                if(!file_exists($productImage)){
                  $productImage = 'public/frontEnd/images/placeholder.jpg'; 
                }
              ?>
            <img src="{{ asset($productImage) }}" class="content-group mt-10" alt="" style="width: 120px;">
            <ul class="list-condensed list-unstyled">
              <li><span class="text-right text-bold">Product Name :</span>{{ $productinfo->productName }} </li>
              <li><span class="text-bold">Product Code :</span>{{ $productinfo->productCode }} </li>
              <li><span class="text-bold">Category Name :</span>{{ $productinfo->categoryName }} </li>
              <li><span class="text-bold">Final Price: </span>{{ $productinfo->newPrice }}</li>

            </ul>
          </div>

          <div class="col-md-4 col-lg-5 content-group">
						<span class="text-muted">Short Description:</span>
						<ul class="list-condensed list-unstyled invoice-payment-details">
              @if($productinfo->primaryColor)
							<li><span class="text-bold">Primary Color: </span>{{ $productinfo->primaryColor }}</li>
              @endif

              @if($productinfo->secondaryColor)
							<li><span class="text-bold">Secondary Color:</span>{{ $productinfo->secondaryColor }} </li>
              @endif

              @if($productinfo->newPrice)
							<li><span class="text-bold">Material :</span>{{ $productinfo->newPrice }}</li>

              @if($productinfo->oldPrice)
							<li><span class="text-bold">Sell Price: </span>{{ $productinfo->oldPrice }}</li>
              @endif

              @if($productinfo->discount)
							<li><span class="text-bold">Discount: </span>{{ $productinfo->discount }}</li>
              @endif
						</ul>
					</div>
        </div>
      </div>

      <div class="panel-body">
        <div class="row invoice-payment">
          <div class="col-md-12">
            @if($answer->message)
            <div class="content-group">
              <ul class="list-condensed list-unstyled">
                <li><p class="text-semibold"><b>Answer:</b>{{ $answer->message }} ?</p></li>
                <?php 
                  $date = new DateTime($answer->created_at);
                  $answerDate = date_format($date, 'd F Y');
                ?>
                <li><b>Reply At :</b><i>{{ $answerDate }}</i></li>
              </ul>
            </div>
            @endif

            <form action="{{ route('ans.qusen')}}" method="POST"> {{ csrf_field() }}
                <div class="content-group">
                  
                  <input type="hidden" name="qusenId" value="{{ $readQusen->id}}">
                  <h6>Your Answer</h6>
                  <div class="form-group">
										<textarea rows="3" cols="3" name="message" maxlength="2500" class="form-control maxlength-textarea" placeholder="Write Your Answer (Max 2500 Characters)"></textarea>
									</div>

                  <div class="text-right">
                    <button type="submit" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Reply</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
        
      </div>
    </div>
    <!-- /Question answer  template -->
</div>


@endsection
