@extends('layouts.app')

@section('body')
  <script src="/vendor/ckeditor/ckeditor/build/ckeditor.js"></script>
  @if (auth()->user()->role == 'admin' || auth()->user()->role == 'member')
    <h3>Create</h3>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{ Form::label('title', 'Title') }}
      {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
      {{ Form::label('body', 'Body') }}
      {{ Form::textarea('body', '', ['id' => 'editor', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
    </div>
    <div id="word-count"></div>
    <div class="form-group">
      {{ Form::file('cover_image') }}
    </div>
    {{ Form::submit('Create post', ['class' => 'btn btn-primary']) }}
    <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel creating post</a>
    {!! Form::close() !!}
  @else
    <h1>{{ $msg_warning }}</h1>

    <a class="btn btn-primary" href="/about">Contact</a>
  @endif
  <script>

  	ClassicEditor
  		.create( document.querySelector( '#editor' ), {
        toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'alignment',
						'|',
						'outdent',
						'indent',
						'|',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'|',
						'code',
						'codeBlock',
						'|',
						'fontColor',
						'fontSize',
						'fontFamily',
						'highlight',
						'|',
						'horizontalLine',
						'htmlEmbed',
						'imageInsert',
						'pageBreak',
						'specialCharacters'
					]
				},
        wordcount: {
          showCharCount: true,
          maxCharCount: 10
        },
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side',
						'linkImage'
					]
				},
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells',
						'tableCellProperties',
						'tableProperties'
					]
				},
				licenseKey: '',
        wordCount: {
            onUpdate: stats => {
                const charactersProgress = stats.characters / maxCharacters * circleCircumference;
                const isLimitExceeded = stats.characters > maxCharacters;
                const isCloseToLimit = !isLimitExceeded && stats.characters > maxCharacters * .8;
                const circleDashArray = Math.min( charactersProgress, circleCircumference );

                // Set the stroke of the circle to show how many characters were typed.
                progressCircle.setAttribute( 'stroke-dasharray', `${ circleDashArray },${ circleCircumference }` );

                // Display the number of characters in the progress chart. When the limit is exceeded,
                // display how many characters should be removed.
                if ( isLimitExceeded ) {
                    charactersBox.textContent = `-${ stats.characters - maxCharacters }`;
                } else {
                    charactersBox.textContent = stats.characters;
                }

                wordsBox.textContent = `Words in the post: ${ stats.words }`;

                // If the content length is close to the character limit, add a CSS class to warn the user.
                container.classList.toggle( 'demo-update__limit-close', isCloseToLimit );

                // If the character limit is exceeded, add a CSS class that makes the content's background red.
                container.classList.toggle( 'demo-update__limit-exceeded', isLimitExceeded );

                // If the character limit is exceeded, disable the send button.
                sendButton.toggleAttribute( 'disabled', isLimitExceeded );
            }
        },


			} )
  		.then( editor => {
  			window.editor = editor;
        //const wordCountPlugin = editor.plugins.get( 'WordCount' );
        //const wordCountWrapper = document.getElementById( 'word-count' );
        //wordCountWrapper.appendChild( wordCountPlugin.wordCountContainer );
  		} )
  		.catch( err => {
  			console.error( err.stack );
  		} );
  </script>
@endsection
