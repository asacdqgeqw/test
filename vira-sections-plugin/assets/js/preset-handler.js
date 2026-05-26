(function() {
    'use strict';
    
    if (typeof elementor === 'undefined') {
        return;
    }

    // Wait for Elementor editor to be ready
    elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
        var widgetType = model.get('widgetType');
        
        if (!window.ViraPresetsData || !window.ViraPresetsData[widgetType]) {
            return;
        }

        var presetControl = panel.$el.find('[data-setting="vira_preset"]');
        
        if (presetControl.length === 0) {
            // Try with a delay for dynamic rendering
            setTimeout(function() {
                bindPresetHandler(panel, model, view, widgetType);
            }, 500);
        } else {
            bindPresetHandler(panel, model, view, widgetType);
        }
    });

    function bindPresetHandler(panel, model, view, widgetType) {
        // Prevent duplicate bindings using a data attribute flag
        if (panel.el.dataset.viraPresetBound) {
            return;
        }
        panel.el.dataset.viraPresetBound = '1';

        // Use Elementor's built-in control change event
        panel.el.addEventListener('change', function(e) {
            if (e.target && e.target.dataset && e.target.dataset.setting === 'vira_preset') {
                applyPreset(model, widgetType, e.target.value);
            }
        });
    }

    function applyPreset(model, widgetType, presetSlug) {
        if (presetSlug === 'custom' || !presetSlug) {
            return;
        }

        var presets = window.ViraPresetsData[widgetType];
        if (!presets || !presets[presetSlug]) {
            return;
        }

        var data = presets[presetSlug];
        var settings = model.get('settings');

        // Apply each preset setting and trigger change events for reactivity
        Object.keys(data).forEach(function(key) {
            settings.set(key, data[key]);
        });

        // Trigger change on settings to update panel controls and live preview
        settings.trigger('change');
    }
})();
