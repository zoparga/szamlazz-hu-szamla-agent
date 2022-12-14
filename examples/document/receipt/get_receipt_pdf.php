<?php

/**
 * Ez a példa megmutatja, hogy hogyan töltsünk le egy nyugtát PDF-ben
 */


use zoparga\SzamlazzHuSzamlaAgent\SzamlaAgentAPI;

try {
    // Számla Agent létrehozása alapértelmezett adatokkal
    $agent = SzamlaAgentAPI::create('agentApiKey');

    // Nyugta PDF lekérdezése nyugtaszám alapján
    $result = $agent->getReceiptPdf('NYGTA-2021-001');

    // Agent válasz sikerességének ellenőrzése
    if ($result->isSuccess()) {
        $result->downloadPdf();
    }
} catch (\Exception $e) {
    $agent->logError($e->getMessage());
}
