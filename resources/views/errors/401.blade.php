@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('content')
<section class="section">
	<div class="container mt-5">
		<div class="page-error">
			<div class="page-inner">
				<h1>401</h1>
				<div class="page-description">
					@lang('http-statuses.401')
				</div>
				<div class="page-search">
					<div class="mt-3">
						<a href="/">Back to Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
