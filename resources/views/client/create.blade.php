@extends('ormbackend::admin.layout')
@section('ormbackend::content')
<!-- begin:: Content -->
<script src="/assets/admin/js/ormbackend/entity-edit.js" type="text/javascript" defer></script>
@php ($entity = $container->first())
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
	@include('ormbackend::admin.includes.alert', ['errors' => $errors])
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Portlet-->
			<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" id="kt_page_portlet">
				@include('ormbackend::admin.includes.create-header', ['meta' => $meta])
				<form class="kt-form" name="entity-edit" method="post" action="{{ $formAction }}" enctype="multipart/form-data">
    				@csrf
    				<div class="kt-portlet__body">
						<div class="row">
							<div class="col-xl-2"></div>
							<div class="col-xl-8">
								<div class="kt-section">
									<div class="kt-section__body">
										@php ($fields = [])
										@foreach ($entity->fields() as $field)
    										@if (!$field->disabled)
    											@php ($fields[] = $field)
    										@endif
										@endforeach
										@php ($old = old($entity->classUrlName))
										@include('ormbackend::admin.includes.fields', [
											'meta' => $meta,
											'fields' => $fields,
											'old' => $old,
											'message' => $message ?? null,
											'exclude' => [
												$entity->field('secret')->fullname,
												$entity->field('revoked')->fullname
											]
										])
									</div>
								</div>
							</div>
							<div class="col-xl-2"></div>
						</div>
    				</div>
    				<div class="kt-portlet__foot kt-portlet__foot--solid">
    					<div class="kt-form__actions">
    						<div class="row">
    		            		<div class="col-xl-4"></div>
    		            		<div class="col-xl-8">
    								<button type="submit" class="btn btn-brand"><i class="la la-check"></i> {{ __('Save') }}</button>
    								<button type="button" class="btn btn-secondary goto" data-url="{{ route('admin.'.$meta['group'].'.search', [$meta['classUrlName']]) }}"><i class="fa fa-undo"></i>{{ __('Cancel') }}</button>
    		            		</div>
    		            	</div>
    					</div>
    				</div>
				</form>
			</div>
			<!--end::Portlet-->
		</div>
	</div>
</div>
<!-- end:: Content -->
@endsection