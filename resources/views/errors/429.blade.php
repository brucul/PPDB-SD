@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('content')
<section class="section">
	<div class="container mt-5">
		<div class="page-error">
			<div class="page-inner">
				<h1>429</h1>
				<div class="page-description">
					Too Many Requests
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
