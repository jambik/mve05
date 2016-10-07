<div class="headerable">
    <div class="title">Настройки Хидера</div>

    <div class="input-field col s12">
        {!! Form::label('header_title', 'Title (META)') !!}
        {!! Form::text('header[title]', isset($item) && $item->header->count() ? $item->header->first()->title : '', ['class' => 'validate', 'id' => 'header_title']) !!}
    </div>

    <div class="input-field col s12">
        {!! Form::label('header_keywords', 'Keywords (META)') !!}
        {!! Form::text('header[keywords]', isset($item) && $item->header->count() ? $item->header->first()->keywords : '', ['class' => 'validate', 'id' => 'header_keywords']) !!}
    </div>

    <div class="input-field col s12">
        {!! Form::label('header_description', 'Description (META)') !!}
        {!! Form::text('header[description]', isset($item) && $item->header->count() ? $item->header->first()->description : '', ['class' => 'validate', 'id' => 'header_description']) !!}
    </div>

    <div class="input-field col s12">
        {!! Form::label('header_caption', 'Надпись на странице') !!}
        {!! Form::text('header[caption]', isset($item) && $item->header->count() ? $item->header->first()->caption : '', ['class' => 'validate', 'id' => 'header_caption']) !!}
    </div>

    <div class="input-field file-field col s12">
        <div class="btn">
            <span>Фото</span>
            {!! Form::file('header[image]') !!}
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" placeholder="Выберите файл">
        </div>
    </div>

    @if (isset($item) && $item->header->count() && $item->header->first()->image)
        <div class="col s12">
            <div><img src="/images/medium/{{ $item->header->first()->img_url . $item->header->first()->image }}" alt="" /></div>
            <button class="btn btn-small red waves-effect waves-light" type="button" title="Удалить фото" onclick="deleteImage(this)" data-request-url="{{ route('headerable.delete') }}" data-model-class="{{ get_class($item) }}" data-model-id="{{ $item->id }}"><i class="material-icons">delete</i></button>
            <div class="preloader-wrapper small active preloader" style="display: none;"><div class="spinner-layer spinner-red-only"><div class="circle-clipper left"><div class="circle"></div></div><div class="gap-patch"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>
        </div>
    @endif
</div>