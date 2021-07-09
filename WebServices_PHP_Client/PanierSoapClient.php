<?php
function displayRequestResponse($soapClient)
{
    echo 'Request : <br/><xmp>',
    $soapClient->__getLastRequestHeaders(), $soapClient->__getLastRequest(),
    '</xmp>';
    echo 'Response : <br/><xmp>',
    $soapClient->__getLastResponseHeaders(), $soapClient->__getLastResponse(),
    '</xmp>';
}

include('SecteurSoap.php');

use \App\Soap\ArticleSoap;
use \App\Soap\CategorieSoap;


$soapClient = null;
try {

    ini_set("soap.wsdl_cache_enabled", "0");

    $opts = array(
        'http' => array(
            'user_agent' => 'PHPSoapClient',
            //'header' => 'Content-Type: text/xml'
        )
    );
    $context = stream_context_create($opts);

    $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_2,
        'stream_context' => $context,
        'cache_wsdl' => WSDL_CACHE_NONE/*,
		'use' => SOAP_LITERAL,
		'style' => SOAP_DOCUMENT*/
    );

    $soapClient =  new \SoapClient('http://localhost:8001/soap?wsdl', $options);
    //header('Content-Type: text/xml');
    //$soapClient->__setSoapHeaders(new SoapHeader('Content-Type','text/xml'));

    $functions = $soapClient->__getFunctions();
    var_dump($functions);
    displayRequestResponse($soapClient);

    //header('Content-Type: text/xml');
    //$soapClient->__setSoapHeaders(new SoapHeader('Content-Type','text/xml'));

    $result = $soapClient->__soapcall("sayHello", array("name" => "Jean"));
    echo '<p>' . $result . '</p>';
    displayRequestResponse($soapClient);

    $result = $soapClient->sumHello(2, 5);
    echo '<p>' . $result . '</p>';
    displayRequestResponse($soapClient);

    $result = $soapClient->sumFloats(2.2, 5.3, 3.7);
    echo '<p>' . $result . '</p>';
    displayRequestResponse($soapClient);

     //Function soap get article by Id
     echo '<p> Retrouver un article par son id :</p>';
     $result = $soapClient->getArticleById(100);
     var_dump($result);

     echo "<p> Libelle de l'article  : " . $result->libelle . "</p>";


     //Function soap get Categorie of an article
     echo "<p> Retrouver la catégorie d'un article</p>";
     $result = $soapClient->getCategorieByArticleId(100);
     var_dump($result);

     echo "<p> Libelle de la catégorie  : " . $result->libelle . "</p>";

     displayRequestResponse($soapClient);


    //Function soap get all article
    // echo '<p> Retrouver tous les articles de la base:</p>';
    // $result = $soapClient->getAllArticles();
    // var_dump($result);
    // displayRequestResponse($soapClient);

   
    echo '<p>' . $result->id . ' : ' . $result->libelle . '</p>';
    displayRequestResponse($soapClient);
} catch (SoapFault $fault) {
    displayRequestResponse($soapClient);
    // <xmp> tag displays xml output in html
    echo '<br/><br/> Error Message : <br/>';
    $fault->getMessage();
    $fault->getTraceAsString();
    var_dump($fault);
}
