<?php

namespace Seerbit\Request;


use PHPUnit\Framework\TestCase;
use Seerbit\Client;
use Seerbit\Service\Status\TransactionStatusService;

class ValidationTest extends TestCase
{

    use TestHelper;

    public function testTransactionValidateStatus()
    {

        $client = TestHelper::SeerBitServiceBearer();
        //Instantiate Mobile Money Service
        $service = New TransactionStatusService($client);

        $transaction = $service->ValidateTransactionStatus("SBT-T78693956103");
        $this->assertArrayHasKey("httpStatus",$transaction->toArray());

        $this->assertEquals("200",$transaction->toArray()["httpStatus"]);

    }

}