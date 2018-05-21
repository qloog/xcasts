<script type="text/javascript">
    $(document).ready(function () {
        $('.ui.dropdown').dropdown();

        var simplemde = new SimpleMDE({
            @if($topic->id ?? 0)
            element: document.getElementById("body"),
            @else
            autosave: {
                enabled: true,
                delay: 1,
                unique_id: "body"
            },
            @endif
            spellChecker: false,
            forceSync: true,
            tabSize: 4,
            toolbar: [
                "bold", "italic", "heading", "|", "quote", "code", "table",
                "horizontal-rule", "unordered-list", "ordered-list", "|",
                "link", "image", "|",  "side-by-side", 'fullscreen', "|",
                {
                    name: "guide",
                    action: function customFunction(editor){
                        var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
                        if (win) {
                            //Browser has allowed it to be opened
                            win.focus();
                        } else {
                            //Browser has blocked it
                            alert('Please allow popups for this website');
                        }
                    },
                    className: "fa fa-info-circle",
                    title: "Markdown 语法！"
                },
                {
                    name: "publish",
                    action: function customFunction(editor){
                        $('#topic-submit').click();
                    },
                    className: "fa fa-paper-plane",
                    title: "发布帖子"
                }
            ]
        });

        inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
            uploadUrl: '{{ route('upload.image') }}',
            extraParams: {
                '_token': '{{ csrf_token() }}'
            },
            onFileUploadResponse: function(xhr) {
                var result = JSON.parse(xhr.responseText),
                        filename = result[this.settings.jsonFieldName];

                if (result && filename) {
                    var newValue;
                    if (typeof this.settings.urlText === 'function') {
                        newValue = this.settings.urlText.call(this, filename, result);
                    } else {
                        newValue = this.settings.urlText.replace(this.filenameTag, filename);
                    }
                    var text = this.editor.getValue().replace(this.lastValue, newValue);
                    this.editor.setValue(text);
                    this.settings.onFileUploaded.call(this, filename);
                }
                return false;
            }
        });
    });
</script>