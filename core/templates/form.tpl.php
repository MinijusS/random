<?php if (isset($data['error'])): ?>
    <span class="error-label"><?php print $data['error']; ?></span>
<?php elseif (isset($data['success'])): ?>
    <span class="success-label"><?php print $data['success']; ?></span>
<?php endif; ?>
<form <?php print html_attr(($data['attr'] ?? []) + ['method' => 'POST']); ?>>
    <?php foreach ($data['fields'] ?? [] as $field_id => $field): ?>
        <?php if ($field['type'] == 'hidden'): ?>
            <input <?php print input_attr($field, $field_id); ?>>
        <?php else: ?>
            <div class="field" <?php print html_attr(($field['extras']['attr'] ?? [])); ?>>
                <label>
                    <span><?php print $field['label']; ?></span>
                    <?php if (in_array($field['type'], ['text', 'password', 'email', 'number'])): ?>
                        <input <?php print input_attr($field, $field_id); ?>>
                    <?php elseif (in_array($field['type'], ['textarea'])): ?>
                        <textarea <?php print textarea_attr($field, $field_id); ?>><?php print $field['value'] ?? ''; ?></textarea>
                    <?php elseif (in_array($field['type'], ['color'])): ?>
                        <input <?php print color_attr($field, $field_id); ?>>
                    <?php elseif (in_array($field['type'], ['select'])): ?>
                        <select <?php print select_attr($field, $field_id); ?>>
                            <?php if (isset($field['placeholder'])): ?>
                                <option disabled selected><?php print $field['placeholder']; ?></option>
                            <?php endif; ?>
                            <?php foreach ($field['options'] ?? [] as $index => $option): ?>
                                <option <?php print option_attr($field, $index); ?>><?php print $option; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php elseif (in_array($field['type'], ['radio'])): ?>
                        <?php foreach ($field['options'] as $index => $option): ?>
                            <input <?php print radio_attr($field, $index, $field_id); ?>><?php print $option; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (isset($field['error'])): ?>
                        <span class="error"><?php print $field['error']; ?></span>
                    <?php endif; ?>
                </label>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php foreach ($data['buttons'] ?? [] as $button_index => $button): ?>
        <button <?php print button_attr($button, $button_index); ?>>
            <?php print $button['title']; ?>
        </button>
    <?php endforeach; ?>
</form>