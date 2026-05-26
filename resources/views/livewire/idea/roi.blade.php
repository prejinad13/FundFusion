<div class="card card-body bg-label-primary h-100 mx-1">
    <div class="row">
        <div class="col-sm-12 mb-2">
            <label class="form-label" for="required_investment_amount">Required Investment Amount <small class="text-danger">*</small></label>
            <div class="input-group">
              <span class="input-group-text">Rs.</span>
            {!! Form::text('required_investment_amount', $required_investment_amount, [
              'class' => 'form-control',
              'id' => 'required_investment_amount',
              'wire:model.live'=>'required_investment_amount',
              'placeholder' => 'Required Investment Amount',
              'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
              ]) !!}
            </div>
            @error('required_investment_amount') <small class="text-danger">{{$message}} </small> @enderror
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="estimated_return">Estimated Return</label>
            <div class="input-group">
              <span class="input-group-text">Rs.</span>
            {!! Form::text('estimated_return', $estimated_return, [
              'class' => 'form-control',
              'id' => 'estimated_return',
              'wire:model.live'=>'estimated_return',
              'placeholder' => 'Est. Return',
              'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
              ]) !!}
            </div>
          </div>
          <div class="col-sm-6">
            <label class="form-label" for="return_on_investment">ROI <small class="text-danger">*</small></label>
            <div class="input-group">

            {!! Form::text('return_on_investment', $return_on_investment, [
              'class' => 'form-control',
              'id' => 'return_on_investment',
              'wire:model.live'=>'return_on_investment',
              'placeholder' => 'Return on Investment',
              'oninput' => "this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')",
              'readonly',
              'style'=>'cursor:no-drop'
              ]) !!}
              <span class="input-group-text">%</span>
            </div>
            @error('return_on_investment') <small class="text-danger">{{$message}} </small> @enderror
          </div>
    </div>

</div>
