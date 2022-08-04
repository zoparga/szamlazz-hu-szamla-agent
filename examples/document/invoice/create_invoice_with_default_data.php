<?php

/**
 * Ez a példa megmutatja, hogy hogyan hozzunk létre egy számlát.
 */


use zoparga\SzamlazzHuSzamlaAgent\SzamlaAgentAPI;
use zoparga\SzamlazzHuSzamlaAgent\Buyer;
use zoparga\SzamlazzHuSzamlaAgent\Document\Invoice\Invoice;
use zoparga\SzamlazzHuSzamlaAgent\Item\InvoiceItem;

try {
    /**
     * Számla Agent létrehozása alapértelmezett adatokkal
     *
     * A számla sikeres kiállítása esetén a válasz (response) tartalmazni fogja
     * a létrejött bizonylatot PDF formátumban (1 példányban)
     */
    $agent = SzamlaAgentAPI::create('agentApiKey');

    /**
     * Új papír alapú számla létrehozása
     *
     * Átutalással fizetendő magyar nyelvű (Ft) számla kiállítása mai keltezési és
     * teljesítési dátummal, +8 nap fizetési határidővel.
     */
    $invoice = new Invoice(Invoice::INVOICE_TYPE_P_INVOICE);
    // Vevő adatainak hozzáadása (kötelezően kitöltendő adatokkal)
    $invoice->setBuyer(new Buyer('Kovács Bt.', '2030', 'Érd', 'Tárnoki út 23.'));
    // Számla tétel összeállítása alapértelmezett adatokkal (1 db tétel 27%-os ÁFA tartalommal)
    $item = new InvoiceItem('Eladó tétel 1', 10000.0);
    // Tétel nettó értéke
    $item->setNetPrice(10000.0);
    // Tétel ÁFA értéke
    $item->setVatAmount(2700.0);
    // Tétel bruttó értéke
    $item->setGrossAmount(12700.0);
    // Tétel hozzáadása a számlához
    $invoice->addItem($item);

    // Számla elkészítése
    $result = $agent->generateInvoice($invoice);
    // Agent válasz sikerességének ellenőrzése
    if ($result->isSuccess()) {
        echo 'A számla sikeresen elkészült. Számlaszám: ' . $result->getDocumentNumber();
        // Válasz adatai a további feldolgozáshoz
        var_dump($result->getDataObj());
    }
} catch (\Exception $e) {
    $agent->logError($e->getMessage());
}
