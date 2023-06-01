@extends('errors::layout')

@section('title', __('Service Unavailable'))
@section('content')
<section class="section">
	<div class="container mt-5">
		<div class="page-error">
			<div class="page-inner">
				<h1>503</h1>
				<div class="page-description">
					Service Unavailable
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
