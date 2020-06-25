<?php

namespace Core\Views;

class Form extends \Core\Abstracts\Views\Form
{
    public function render($template_path = ROOT . '/core/templates/form.tpl.php')
    {
        return parent::render($template_path);
    }

    /**
     * Validates form based on $this->data
     * Does NOT call any callbacks, just returns the result
     * of the form
     *
     * Does not call function validate_form !!!,
     * implements all functionality inside
     *
     * @return bool
     */
    public function validate(): bool
    {
        $success = true;
        $safe_input = $this->getSubmitData();
        foreach ($this->data['fields'] as $field_index => &$field) {
            $field['value'] = $safe_input[$field_index];
            foreach ($field['validate'] ?? [] as $validator_index => $field_validator) {
                if (is_array($field_validator)) {
                    $validator_function = $validator_index;
                    $validator_params = $field_validator;
                    $valid = $validator_function($field['value'], $field, $validator_params);
                } else {
                    $validator_function = $field_validator;
                    $valid = $validator_function($field['value'], $field);
                }
                if (!$valid) {
                    $success = false;
                    break;
                }
            }
        }
        if ($success) {
            foreach ($this->data['validators'] ?? [] as $validator_index => $form_validator) {
                if (is_array($form_validator)) {
                    $validator_function = $validator_index;
                    $validator_params = $form_validator;
                    $valid = $validator_function($safe_input, $this->data, $validator_params);
                } else {
                    $validator_function = $form_validator;
                    $valid = $validator_function($safe_input, $this->data);
                }
                if (!$valid) {
                    $success = false;
                    break;
                }
            }
        }
        return $success;
    }

    /**
     * Checks if the form is submitted
     *
     * Gets submit action from $_POST, and checks if form array
     * has a button with such index
     *
     * @return bool
     */
    public function isSubmitted(): bool
    {
        if (isset($this->data['buttons'])) {
            foreach ($this->data['buttons'] as $button_id => $button_value) {
                if (self::getSubmitAction() === $button_id) {
                    return true;
                }
            }
        }
        return false;
    }

    public function setMessage($message)
    {
        switch ($message) {
            case 'valid_register':
                $this->data['success'] = 'Vartotojas sekmingai sukurtas!';
                break;
            case 'invalid_register':
                $this->data['fail'] = 'Vartotojas nesukurtas!';
                break;
        }
    }

    /**
     * Gets form submitted data
     * If $filtered = false, returns $_POST if not empty (or null)
     * If $filtered = true, returns filtered $_POST array
     * based on form array: $this->data
     *
     * @param bool $filter
     * @return array|null
     */
    public function getSubmitData($filter = true): ?array
    {
        if (!$filter) {
            return $_POST ?: null;
        } else {
            $filter_params = [];
            foreach ($this->data['fields'] ?? [] as $field_id => $field) {
                $filter_params[$field_id] = $field['filter'] ?? FILTER_SANITIZE_SPECIAL_CHARS;
            }
            return filter_input_array(INPUT_POST, $filter_params);
        }
    }

    /**
     * Determines which button was pressed by reading "action"
     * index in $_POST.
     * If $_POST is empty, or doesnt contain action, returns null
     *
     * @return string|null
     */
    static function getSubmitAction(): ?string
    {
        return $_POST['action'] ?? null;
    }
}