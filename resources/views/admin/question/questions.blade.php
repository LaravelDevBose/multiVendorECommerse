@extends('admin.master')

@section('title')
View Questions
@endsection

@section('asset')
<!-- Theme JS files -->
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/pages/mail_list.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/artisan/assets/js/plugins/ui/ripple.min.js') }}"></script>

<!-- /theme JS files -->
@endsection

@section('content')

<!-- Content area -->
<div class="content"> 
  @include('admin.includes.message')
  <!-- Multiple lines -->
    <div class="panel panel-white">
      <div class="panel-heading">
        <h6 class="panel-title">User Questions List</h6>

        <div class="heading-elements not-collapsible">
          <span class="label bg-warning heading-text">{{ $unRead }} Un-Read</span>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-inbox">
          <tbody data-link="row" class="rowlink">

            @forelse($questions as $question)
            <tr class="unread">
              <td class="table-inbox-star rowlink-skip" >
                  @if($question->status = 2)
                    <i class="icon-star-full2 text-success-300" title="Replyed"></i>  <!-- Read message Sign -->
                  @elseif($question->status = 1)
                    <i class="icon-star-full2 text-info-300" title="Readed"></i>  <!-- Read message Sign -->
                  @else
                    <i class="icon-star-full2 text-warning-300" title="Un-Readed"></i> <!-- unRead message Sign -->
                  @endif
              </td>

              <td class="table-inbox-name">
                <a href="{{ route('read.qusen',$question->id ) }}">
                  <div class="letter-icon-title text-default">{{ $question->name }}</div>
                </a>
              </td>

              <td class="table-inbox-message">
                <div class="table-inbox-subject">{{ $question->productName }}</div>
                <span class="table-inbox-preview">{{ $question->message }}</span>
              </td>

              <td class="table-inbox-time">
                <?php 
                  $date = new DateTime($question->created_at);
                  $qusnDate = date_format($date, 'd M y');
                ?>
                {{ $qusnDate }}
              </td>

            </tr>
            @empty
            <tr class="unread">
              <td>
                <label>No Question View</label>
              </td>
            </tr>
            @endforelse

          </tbody>
        </table>
      </div>
    </div>
    <!-- /multiple lines -->

</div>

@endsection
