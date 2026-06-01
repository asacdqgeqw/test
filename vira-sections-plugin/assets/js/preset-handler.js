(function() {
    'use strict';

    if (typeof elementor === 'undefined') return;

    elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
        var widgetType = model.get('widgetType');

        if (!window.ViraPresetsData || !window.ViraPresetsData[widgetType]) return;

        // Wait for panel to fully render, then bind
        setTimeout(function() {
            bindPresetControl(panel, model, view, widgetType);
        }, 100);
    });

    function bindPresetControl(panel, model, view, widgetType) {
        // Find the select element - try multiple selectors for compatibility
        var selectEl = panel.$el.find('select[data-setting="vira_preset"]')[0]
                    || panel.$el.find('[data-setting="vira_preset"]')[0];

        if (!selectEl) return;

        // Remove any previous handler (clone approach to remove all listeners)
        var newSelect = selectEl.cloneNode(true);
        selectEl.parentNode.replaceChild(newSelect, selectEl);

        // Add fresh listener
        newSelect.addEventListener('change', function() {
            var presetSlug = this.value;
            applyPreset(panel, model, view, widgetType, presetSlug);
        });
    }

    function applyPreset(panel, model, view, widgetType, presetSlug) {
        if (presetSlug === 'custom' || !presetSlug) return;

        var presets = window.ViraPresetsData[widgetType];
        if (!presets || !presets[presetSlug]) return;

        var data = presets[presetSlug];

        // Use Elementor 3.x+ $e.run command for atomic settings update
        if (typeof $e !== 'undefined' && $e.run) {
            try {
                $e.run('document/elements/settings', {
                    container: view.getContainer(),
                    settings: data,
                    options: { external: true }
                });
            } catch (err) {
                // Fallback if $e.run fails
                applyFallback(model, data);
            }
        } else {
            applyFallback(model, data);
        }

        // Force panel controls to re-render after a short delay
        setTimeout(function() {
            refreshPanel(panel, model, view);
        }, 150);
    }

    function applyFallback(model, data) {
        var settings = model.get('settings');
        Object.keys(data).forEach(function(key) {
            settings.set(key, data[key], { silent: true });
        });
        settings.trigger('change');
    }

    function refreshPanel(panel, model, view) {
        // Re-render the panel to reflect new settings
        try {
            var currentPage = panel.getCurrentPageView();
            if (currentPage && currentPage.render) {
                currentPage.render();
            }
        } catch (e) {
            // Alternative: re-route to the panel editor
            try {
                $e.route('panel/editor/' + model.get('widgetType'));
            } catch (e2) {}
        }
    }
})();
