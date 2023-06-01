@extends('errors::layout')

@section('title', __('Server Error'))
@section('content')
<section class="section">
	<div class="container mt-5">
		<div class="page-error">
			<div class="page-inner">
				<h1>500</h1>
				<div class="page-description">
					Server Error
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
