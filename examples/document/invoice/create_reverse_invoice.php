<?php

/**
 * Ez a példa megmutatja, hogy hogyan hozzunk létre sztornó számlát.
 */


use zoparga\SzamlazzHuSzamlaAgent\SzamlaAgentAPI;
use zoparga\SzamlazzHuSzamlaAgent\Buyer;
use zoparga\SzamlazzHuSzamlaAgent\Seller;
use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\Invoice;
use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\ReverseInvoice;

try {
    // Számla Agent létrehozása alapértelmezett adatokkal
    $agent = SzamlaAgentAPI::create('agentApiKey');

    // Új sztornó számla létrehozása egyedi adatokkal
    $invoice = new ReverseInvoice(ReverseInvoice::INVOICE_TYPE_P_INVOICE);
    // Számla fejléc lekérdezése
    $header = $invoice->getHeader();
    // Számla számlaszám beállítása
    $header->setInvoiceNumber('TESZT-001');
    // A sztornózás oka (opcionális)
    $header->setComment('megjegyzés');
    // Számla kiállítás dátuma
    $header->setIssueDate('2021-08-30');
    // Számla teljesítés dátuma
    $header->setFulfillment('2021-08-30');
    $header->setInvoiceTemplate(Invoice::INVOICE_TEMPLATE_DEFAULT);

    // Eladó létrehozása
    $seller = new Seller();
    // Válasz e-mail cím beállítása
    $seller->setEmailReplyTo('hello@evulon.hu');
    // E-mail tárgyának beállítása
    $seller->setEmailSubject('Számla értesítő');
    // E-mail tartalmának beállítása
    $seller->setEmailContent('Fizesse ki a számlát, különben a mindenkori banki kamat...');
    // Eladó hozzáadása a számlához
    $invoice->setSeller($seller);

    // Vevő létrehozása
    $buyer = new Buyer();
    // Vevő e-mail címének beállítása
    $buyer->setEmail('vevoneve@example.org');
    // Vevő hozzáadása a számlához
    $invoice->setBuyer($buyer);

    // Sztornó számla elkészítése
    $result = $agent->generateReverseInvoice($invoice);
    // Agent válasz sikerességének ellenőrzése
    if ($result->isSuccess()) {
        echo 'A sztornó számla sikeresen elkészült. Számlaszám: ' . $result->getDocumentNumber();
        // Válasz adatai a további feldolgozáshoz
        var_dump($result->getData());
    }
    // ha sikertelen az számlaértesítő kézbesítése
    if ($result->hasInvoiceNotificationSendError()) {
        var_dump($result->getDataObj());
    }
} catch (\Exception $e) {
    $agent->logError($e->getMessage());
}
