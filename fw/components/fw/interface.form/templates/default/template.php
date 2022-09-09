<div<?php if (isset($this->params['additional_class'])) echo " class=\"{$this->params['additional_class']}\""?>>
    <form<?php if (isset($this->params['attr'])) {
        foreach ($this->params['attr'] as $attr => $value) {
            echo " $attr=\"$value\"";
        }
    }
    if (isset($this->params['method'])) echo " method=\"{$this->params['method']}\"";
    if (isset($this->params['action'])) echo " action=\"{$this->params['action']}\""; ?>>
        <?php if (isset($this->params['elements'])) {
            foreach ($this->params['elements'] as $params) {
                \Fw\Core\Application::getInstance()->includeComponent('fw:interface.form.input', 'default', $params);
            }
        }?>
            <?php if (isset($this->params['submit'])) {
                $submit = $this->params['submit'];
                $submit_title = $submit['title'] ?? 'Submit'; ?>
                <div<?php if (isset($submit['additional_class'])) echo " class=\"{$submit['additional_class']}\""; ?>>
            <button type="submit" <?php if (isset($submit['attr'])) {
            foreach ($submit['attr'] as $attr => $value) {
                echo " $attr=\"$value\"";
            }?>><?=$submit_title?></button>
        </div><?php }} ?>
    </form>
</div>
