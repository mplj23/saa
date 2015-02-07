<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element;

/**
 * Descrição de ProfissaoForm
 *
 * @author
 */
class ProfissaoForm extends Form {

    public function __construct() {
        parent::__construct('profissao');
        $this->setAttribute('method', 'post');

        $this->add($this->_id());
        $this->add($this->_descricao());
        $this->add($this->_submit());
    }

    protected function _submit() {
        $e = new Element\Submit('submit');
        $e->setValue("Salvar");
        $e->setAttribute("class", "btn btn-primary");
        
        return $e;
    }

    protected function _id() {
        $e = new Element\Text('id');
        $e->setAttribute('id', 'id');
        $e->setAttribute('class', 'form-control');
        $e->setLabel('Id:');
        $e->setAttribute('readonly', 'readonly');

        return $e;
    }

    protected function _descricao() {
        $e = new Element\Text('descricao');
        $e->setLabel('* Descricao:');
        $e->setAttribute('id', 'descricao');
        $e->setAttribute('class', 'form-control');

        return $e;
    }
}