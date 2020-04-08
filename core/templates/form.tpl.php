<div class="box">
    <?php if (isset($form['error'])): ?>
        <span class="error-label"><?php print $form['error']; ?></span>
    <?php endif; ?>
    <form <?php print html_attr(($form['attr'] ?? []) + ['method' => 'POST']); ?>>
        <?php foreach ($form['fields'] ?? [] as $field_id => $field): ?>
            <div class="field">
                <label>
                    <span><?php print $field['label']; ?></span>
                    <?php if (in_array($field['type'], ['text', 'password', 'email', 'number'])): ?>
                        <input <?php print input_attr($field, $field_id); ?>>
                    <?php elseif (in_array($field['type'], ['textarea'])): ?>
                        <textarea <?php print textarea_attr($field, $field_id); ?>><?php print $field['value'] ?? ''; ?></textarea>
                    <?php elseif (in_array($field['type'], ['select'])): ?>
                        <select <?php print select_attr($field, $field_id); ?>>
                            <?php foreach ($field['options'] as $index => $option): ?>
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
        <?php endforeach; ?>
        <?php foreach ($form['buttons'] ?? [] as $button_index => $button): ?>
            <button <?php print button_attr($button); ?>>
                <?php print $button['title']; ?>
            </button>
        <?php endforeach; ?>
    </form>
</div>

