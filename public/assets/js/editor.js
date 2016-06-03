tinymce.init(
	{ 
		selector:'textarea',
		language: 'es',
  		skin: 'lightgray',
  		plugins: [
		    'advlist autolink lists link image charmap print preview hr anchor pagebreak'
		  ],
  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
	}
);