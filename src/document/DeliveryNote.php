<?php

namespace zoparga\SzamlazzHuSzamlaAgent\Document;

use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\Invoice;
use zoparga\SzamlazzHuSzamlaAgent\Header\DeliveryNoteHeader;

/**
 * Szállítólevél segédosztály
 *
 * @package szamlaagent\document
 */
class DeliveryNote extends Invoice {

    /**
     * Szállítólevél kiállítása
     *
     * @throws \Exception
     */
    function __construct() {
        parent::__construct(null);
        // Alapértelmezett fejléc adatok hozzáadása
        $this->setHeader(new DeliveryNoteHeader());
    }
 }
