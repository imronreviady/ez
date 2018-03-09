/**
 * editor_plugin_src.js
 *
 * Copyright 2011, Sutulustus - Triad Advertising
 * Released under MIT License.
 *
 * License: http://www.opensource.org/licenses/mit-license.php
 */

(function () {
    // Register plugin
    tinymce.PluginManager.add('codemagic', function((ed, url) {
        // Register commands
        ed.addCommand('mceCodeMagic', function() {
            ed.windowManager.open({
                file : url + '/codemagic.htm',
                width : 900,
                height : 600,
                inline : 1,
                maximizable: true
            }, {
                plugin_url : url
            });
        });

        // Register buttons
        ed.addButton('codemagic', {
            title: 'codemagic.editor_button',
            cmd: 'mceCodeMagic',
            image: url + '/img/code.png'
        });

        ed.onNodeChange.add(function(ed, cm, n, co) {
            cm.setDisabled('link', co && n.nodeName != 'A');
            cm.setActive('link', n.nodeName == 'A' && !n.name);
        });
        
    });
})();
