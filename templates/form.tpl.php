<form <?php print html_attr(($form['attr'] ?? []) + ['method' => 'POST']); ?>>
    <?php foreach ($form['fields'] ?? [] as $field_id => $field): ?>
        <div>
            <label>
                <span><?php print $field['label']; ?></span>
                <?php if (in_array($field['type'], ['text', 'password', 'email', 'number'])): ?>
                    <input <?php print input_attr($field, $field_id); ?>>
                <?php elseif (in_array($field['type'], ['textarea'])): ?>
                    <textarea <?php print textarea_attr($field, $field_id); ?>><?php print $field['value'] ?? ''; ?></textarea>
                <?php endif; ?>
                <?php if (isset($field['errors'])): ?>
                    <span style="color: red"><?php print $field['errors']; ?></span>
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