CKEDITOR.editorConfig = function( config ) {
  config.language = 'es';
  config.allowedContent = true;
  config.format_tags = 'p;h1;h2;h3;div';
  config.format_h2 = { element: 'h2', attributes: { 'class': 'uppercase mb-4 text-lg' } };
  config.format_p = { element: 'p', attributes: { 'class': 'flex mb-8 text-grupo-gray' } };
  config.removeButtons = 'Underline,Subscript,Superscript';
  config.stylesSet = false;
  // config.stylesSet = 'mystyles:/editorstyles/styles.js';
  config.stylesSet = [
    { name: 'parrafos', element: 'p', attributes: { 'class': 'flex mb-8 text-grupo-gray' } },
  ];
};