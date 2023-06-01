@extends('errors::layout')

@section('title', __('Not Found'))
@section('content')
<section class="section">
	<div class="container mt-5">
		<div class="page-error">
			<div class="page-inner">
				<h1>404</h1>
				<div class="page-description">
					@lang('http-statuses.404')
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
