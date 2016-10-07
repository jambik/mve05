<div class="input-field file-field col s12">
    <div class="btn">
        <span>Фото</span>
        {!! Form::file('image') !!}
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate{{ $errors->has('image') ? ' invalid' : '' }}" type="text" placeholder="Выберите файл">
    </div>
</div>

@if (isset($item) && $item->image)
    <div class="col s12">
        <div><img src="/images/medium/{{ $item->img_url.$item->image }}" alt="" /></div>
        <button class="btn btn-small red waves-effect waves-light" type="button" title="Удалить фото" onclick="deleteImage(this)" data-request-url="{{ route('imageable.delete') }}" data-model-class="{{ get_class($item) }}" data-model-id="{{ $item->id }}"><i class="material-icons">delete</i></button>
        <div class="preloader-wrapper small active preloader" style="display: none;"><div class="spinner-layer spinner-red-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>
    </div>
@endif