/**
 * Basic sample plugin inserting abbreviation elements into CKEditor editing area.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Register the plugin within the editor.
CKEDITOR.plugins.add( 'contentpopup', {

	// Register the icons.
	icons: 'popup',

	// The plugin initialization logic goes inside this method.
	init: function( editor ) {

		// Define an editor command that opens our dialog.
		editor.addCommand( 'popup', new CKEDITOR.dialogCommand( 'popupDialog' ) );

		// Create a toolbar button that executes the above command.
		editor.ui.addButton( 'Popup', {

			// The text part of the button (if available) and tooptip.
			label: 'Insert Popup',

			// The command to execute on click.
			command: 'popup',

			// The button placement in the toolbar (toolbar group name).
			toolbar: 'insert'
		});

		if ( editor.contextMenu ) {
			editor.addMenuGroup( 'popupGroup' );
			editor.addMenuItem( 'popupItem', {
				label: 'Edit Popup',
				icon: this.path + 'icons/popup.png',
				command: 'popup',
				group: 'popupGroup'
			});

			editor.contextMenu.addListener( function( element ) {
				if ( element.getAscendant( 'popup', true ) ) {
					return { abbrItem: CKEDITOR.TRISTATE_OFF };
				}
			});
		}

		// Register our dialog file. this.path is the plugin folder path.
		CKEDITOR.dialog.add( 'popupDialog', this.path + 'dialogs/contentpopup.js' );
	}
});

