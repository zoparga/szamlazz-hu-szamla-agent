<?php

namespace zoparga\SzamlazzHuSzamlaAgent\Header;

use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\Invoice;

/**
 * Végszámla fejléc
 *
 * @package SzamlaAgent\Header
 */
class FinalInvoiceHeader extends InvoiceHeader {

    /**
     * @param int $type
     *
     * @throws \SzamlaAgent\SzamlaAgentException
     */
    function __construct($type = Invoice::INVOICE_TYPE_P_INVOICE) {
        parent::__construct($type);
        $this->setFinal(true);
    }
}
