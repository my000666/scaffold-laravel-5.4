@if (Session::has('caffeinated.flash.message'))
	<div class="alert alert-{{ Session::get('caffeinated.flash.level') }}">
		<div class="container-fluid">
			<div class="alert-icon">
				<?php
					switch(Session::get('caffeinated.flash.level')) {
						case 'danger': $level = 'error_outline'; break;
						case 'success': $level = 'check'; break;
						case 'warning': $level = 'warning'; break;
						default: $level = 'info_outline';
					}
				?>
				<i class="material-icons">{{ $level }}</i>
			</div>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true"><i class="material-icons">clear</i></span>
			</button>

			{{ Session::get('caffeinated.flash.message') }}
		</div>
	</div>
@endif
