/**
 * The abbr dialog definition.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Our dialog definition.
CKEDITOR.dialog.add( 'popupDialog', function( editor ) {
	return {

		// Basic properties of the dialog window: title, minimum size.
		title: 'Popup Properties',
		minWidth: 400,
		minHeight: 200,

		// Dialog window contents definition.
		contents: [
			{
				// Definition of the Basic Settings dialog tab (page).
				id: 'tab-basic',
				label: 'Basic Settings',

				// The tab contents.
				elements: [
					{
						// Text input field for the abbreviation text.
						type: 'text',
						id: 'popup_id',
						label: 'Popup ID',

						// Validation checking whether the field is not empty.
						validate: CKEDITOR.dialog.validate.notEmpty( "Popup ID can not be empty" ),

						// Called by the main setupContent call on dialog initialization.
						setup: function( element ) {
							this.setValue( element.getText() );
						},

						// Called by the main commitContent call on dialog confirmation.
						commit: function( element ) {
							element.setText( this.getValue() );
						}
					}
				]
			}
		],

		// Invoked when the dialog is loaded.
		onShow: function() {

			// Get the selection in the editor.
			var selection = editor.getSelection();

			// Get the element at the start of the selection.
			var element = selection.getStartElement();

			// Get the <abbr> element closest to the selection, if any.
			if ( element )
				element = element.getAscendant( 'popup_id', true );

			// Create a new <abbr> element if it does not exist.
			if ( !element || element.getName() != 'popup_id' ) {
				element = editor.document.createElement( 'popup_id' );

				// Flag the insertion mode for later use.
				this.insertMode = true;
			}
			else
				this.insertMode = false;

			// Store the reference to the <abbr> element in an internal property, for later use.
			this.element = element;

			// Invoke the setup methods of all dialog elements, so they can load the element attributes.
			if ( !this.insertMode )
				this.setupContent( this.element );
		},

		// This method is invoked once a user clicks the OK button, confirming the dialog.
		onOk: function() {
			// Creates a new <abbr> element.
			var popup_id = this.element;

			// Invoke the commit methods of all dialog elements, so the <abbr> element gets modified.
			this.commitContent( popup_id );

            // Get selected text
            selectedText = editor.getSelection().getNative();

            if(CKEDITOR.env.ie)
            {
                selectedText = selectedText.createRange().text;
            }

			// Finally, in if insert mode, inserts the element at the editor caret position.
			if ( this.insertMode )
                editor.insertHtml("{{ popup:open  popup='" + popup_id.getText() + "' }} " + selectedText + " {{ /popup:open }}");
		}
	};
});