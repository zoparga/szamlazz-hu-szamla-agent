<?php

/**
 * Ez a példa megmutatja, hogy hogyan tudunk hozzáadni egy jóváírást egy számlához
 */


use zoparga\SzamlazzHuSzamlaAgent\SzamlaAgentAPI;
use zoparga\SzamlazzHuSzamlaAgent\CreditNote\InvoiceCreditNote;
use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\Invoice;
use zoparga\SzamlazzHuSzamlaAgent\Document\Document;
use zoparga\SzamlazzHuSzamlaAgent\SzamlaAgentUtil;

try {
    // Számla Agent létrehozása alapértelmezett adatokkal
    $agent = SzamlaAgentAPI::create('agentApiKey');

    // Új számla létrehozása
    $invoice = new Invoice(Invoice::INVOICE_TYPE_E_INVOICE);
    // Számla fejléce
    $header = $invoice->getHeader();
    // Annak a számlának a számlaszáma, amelyikhez a jóváírást szeretnénk rögzíteni
    $header->setInvoiceNumber('TESZT-2021-001');
    // Fejléc hozzáadása a számlához
    $invoice->setHeader($header);

    // Hozzáadjuk a jóváírás összegét (false esetén felülírjuk a teljes összeget)
    $invoice->setAdditive(true);

    // Új jóváírás létrehozása (az összeget a számla devizanemében kell megadni)
    $creditNote = new InvoiceCreditNote(SzamlaAgentUtil::getTodayStr(), 10000.0, Document::PAYMENT_METHOD_BANKCARD, 'TESZT');
    // Jóváírás hozzáadása a számlához
    $invoice->addCreditNote($creditNote);

    // Számla jóváírás elküldése
    $result = $agent->payInvoice($invoice);
    // Agent válasz sikerességének ellenőrzése
    if ($result->isSuccess()) {
        echo 'A jóváírás rögzítése sikerült. Számlaszám: ' . $result->getDocumentNumber();
        // Válasz adatai a további feldolgozáshoz
        var_dump($result->getData());
    }
} catch (\Exception $e) {
    $agent->logError($e->getMessage());
}
