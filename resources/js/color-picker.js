import '@melloware/coloris/dist/coloris.css';
import Coloris from '@melloware/coloris';

export function initColorPicker() {
    Coloris.init();
    Coloris({
        el: '[data-coloris]',
        themeMode: 'light',
        format: 'hex',
        alpha: false,
        swatches: [
            '#ef4444', '#f97316', '#22c55e', '#3b82f6',
            '#6366f1', '#8b5cf6', '#ec4899', '#06b6d4', '#6b7280',
        ],
    });
}
