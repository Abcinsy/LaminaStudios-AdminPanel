<div class="card border-{{ $style }}" @if ($style != 'none') style="border-top:2px solid;" @endif>
    <div class="card-header with-border">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-tools">
            {!! $tools !!}
        </div>
    </div>
    
    <div class="form-horizontal">
        <div class="card-body">
            <div class="row">
                @if(isset($model))
                    @if($model instanceof App\Models\Applicant)
                        @include('admin.table.applicant.applicant-information', ['model' => $model])
                    @elseif($model instanceof App\Models\InternshipProgram)
                        @include('admin.table.internship.internship-information', ['model' => $model])
                    @endif
                @endif
                
                @foreach ($fields as $field)
                    {!! $field->render() !!}
                @endforeach
            </div>
        </div>
    </div>
</div>