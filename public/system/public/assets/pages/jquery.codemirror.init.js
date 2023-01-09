
/**
* Theme: Ubold Admin Template
* Author: Coderthemes
* Code Editors page
*/

!function($) {
    "use strict";

    var CodeEditor = function() {};

    CodeEditor.prototype.getSelectedRange = function(editor) {
        return { from: editor.getCursor(true), to: editor.getCursor(false) };
    },
    CodeEditor.prototype.autoFormatSelection = function(editor) {
        var range = this.getSelectedRange(editor);
        editor.autoFormatRange(range.from, range.to);
    },
    CodeEditor.prototype.commentSelection = function(isComment, editor) {
        var range = this.getSelectedRange(editor);
        editor.commentRange(isComment, range.from, range.to);
    },
    CodeEditor.prototype.init = function() {
        var $this = this;
        //init plugin
        // CodeMirror.fromTextArea(document.getElementById("code"), {
        //     mode: {name: "xml", alignCDATA: true},
        //     lineNumbers: true
        // });
        // //example 2

        if($('#robots').length) {
            CodeMirror.fromTextArea(document.getElementById("robots"), {
                mode: {name: "robots"},
                lineNumbers: true,
                theme: 'ambiance'
            });
        }
        if($('#xml').length) {
            CodeMirror.fromTextArea(document.getElementById("xml"), {
                mode: {name: "xml"},
                lineNumbers: true,
                theme: 'ambiance'
            });
        }

        if($('#scriptHead').length) {
            CodeMirror.fromTextArea(document.getElementById("scriptHead"), {
                mode: {name: "scriptHead"},
                lineNumbers: true,
                theme: 'ambiance'
            });
        }

        if($('#scriptBody').length) {
            CodeMirror.fromTextArea(document.getElementById("scriptBody"), {
                mode: {name: "scriptBody"},
                lineNumbers: true,
                theme: 'ambiance'
            });
        }

        if($('#scriptFooter').length) {
            CodeMirror.fromTextArea(document.getElementById("scriptFooter"), {
                mode: {name: "scriptFooter"},
                lineNumbers: true,
                theme: 'ambiance'
            });
        }

        if($('#code3').length) {
            var editor = CodeMirror.fromTextArea(document.getElementById("code3"), {
                mode: {name: "javascript"},
                lineNumbers: true,
            });

            CodeMirror.commands["selectAll"](editor);

            //binding controlls
            $('.autoformat').click(function () {
                $this.autoFormatSelection(editor);
            });

            $('.commentbtn').click(function () {
                $this.commentSelection(true, editor);
            });

            $('.uncomment').click(function () {
                $this.commentSelection(false, editor);
            });
        }
    },
    //init
    $.CodeEditor = new CodeEditor, $.CodeEditor.Constructor = CodeEditor
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.CodeEditor.init()
}(window.jQuery);
