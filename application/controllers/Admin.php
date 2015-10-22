<?php

/**
 * Our admin page.
 * 
 * controllers/Admin.php
 *
 * ------------------------------------------------------------------------
 */
class Admin extends Application {

    function __construct()
    {
	parent::__construct();
        $this->load->helper('formfields');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index()
    {
        $this->data['title'] = 'Quotations Maintenance';
        $this->data['quotes'] = $this->quotes->all();
	$this->data['pagebody'] = 'admin_list';    // this is the view we want shown
	$this->render();
    }
    
    // add a new quotation
    function add()
    {
        $quote = $this->quotes->create();
        $this->present($quote);
    }
    
    // present a quotation for adding/editing
    function present($quote)
    {
        $this->data['fid'] = makeTextField('ID#', 'id', $quote->id);
        $this->data['fwho'] = makeTextField('Author', 'who', $quote->who);
        $this->data['fmug'] = makeTextField('Picture', 'mug', $quote->mug);
        $this->data['fwhat'] = makeTextArea('The Quote', 'what', $quote->what);
        $this->data['pagebody'] = 'quote_edit';
        $this->data['fsubmit'] = makeSubmitButton('Process Quote', "Click here to validate the quotation data", 'btn-success');
        $this->render();
    }
    
    // process a quotation edit
    function confirm() {
        $record = $this->quotes->create();
        // extract submitted fields
        $record->id = $this->input->post('id');
        $record->id = $this->input->post('who');
        $record->id = $this->input->post('mug');
        $record->id = $this->input->post('what');
        // save stuff
        if(empty($record->id)) $this->quotes->add($record);
        else $this->quotes->update($record);
        redirect('/admin');
    }
}

/* End of file Admin.php */
/* Location: application/controllers/Admin.php */