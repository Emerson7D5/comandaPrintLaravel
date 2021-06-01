<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImprimirController extends Controller
{ 

    public static function imprime(Request $request)
    {
        $tamanioLetra = 10;
        $tipoLetra = "Consolas"; //'Comic Sans MS'
        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir); 
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
                 
        $section = $phpWord->addSection();  

        $section->setMarginLeft(300); 
        $section->setMarginRight(300); 
        $section->setMarginTop(300); 
        $section->setMarginBottom(300);
        
        $section->addText(
            '===========================',
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
         );

        $section->addText(
            '====      PEDIDO        === ',
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );
 
        $section->addText(
            'SALA # '. $request->sala,
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );

        
        $section->addText(
            'MESA # '. $request->mesa,
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );
                
        $section->addText(
            'COD CLIENTE # '. $request->codcliente,
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );
        
        $section->addText(
            'FECHA ORDEN '. $request->horaInicio,
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );
               
        $section->addText(
            '===========================',
            array('name' =>$tipoLetra , 'size' => $tamanioLetra)
        );
         
        $section->addText(
            'CANT.       PRODUCTO',
            array('name' =>$tipoLetra , 'size' => $tamanioLetra)
        );
        
        $section->addText(
            '===========================',
            array('name' =>$tipoLetra , 'size' => $tamanioLetra)
        );
       //  print_r(json_encode($request->platos));

        foreach ( $request->platos as $plato) {
            //print_r(json_encode($plato));
            $section->addText(
                $plato["UNIDADES"] .' - ' .$plato["descripcion"],
                    array('name' => $tipoLetra , 'size' => $tamanioLetra)
            );

            foreach ( $plato["modificadores"] as $modificador) {
                //print_r(json_encode($plato));
                $section->addText(
                    "       " .$modificador["NUMMODIF"] .' - ' .$modificador["DESCRIPCION"],
                        array('name' => $tipoLetra , 'size' => 8)
                );
            }
        }
         
              
        $section->addText(
            '============================',
            array('name' => 'Comic Sans MS', 'size' => $tamanioLetra)
        );
                 
        $section->addText(
            '==== FIN DE LA ORDEN =====',
            array('name' => $tipoLetra , 'size' => $tamanioLetra)
        );
        
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('../tmp/orden.docx');

        $filename = "../tmp/orden.docx";
                
        exec('write /pt "' . realpath($filename) .'" ' . "EPSON" );

        
        return "Impreso!";

    }

    public function index($orden)
    { 



        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir);

        // require_once $baseDir . '../../vendor/phprtflite/phprtflite/lib/PHPRtfLite.php';
        // PHPRtfLite::registerAutoloader();
        // $rtf = new PHPRtfLite();
        // // add section
        // $sect = $rtf->addSection();
        // // write text
        // $sect->writeText('Hello world!', new PHPRtfLite_Font(), new PHPRtfLite_ParFormat());
    
        // // save rtf document to hello_world.rtf
        // $rtf->save('../tmp/hello_world.rtf');

        // //PHPRtfLite::registerAutoloader();    

        // $rtf = new PHPRtfLite(); 

        // //$rtf->setLandscape();
        // $rtf->setPaperWidth(21);  // in cm
        // // margin left: 1cm
        // $rtf->setMarginLeft(1);
        // // margin right: 2cm
        // $rtf->setMarginRight(1);
        // // margin top: 3cm
        // $rtf->setMarginTop(1);
        // // margin bottom: 4cm
        // $rtf->setMarginBottom(1);
        // //$rtf->setPaperHeight(25); 

        // $font = new PHPRtfLite_Font(16, 'Arial', '#000000', '#FFFFFF');

        // $section = $rtf->addSection();
        // $section->writeText("Iniciando la impresion", $font);

        // error_log ("::PRINTING_TEXT::" . "Iniciando impresion", 0);

        // $timestamp = $this->get_timestamp();
        // $filename = "../tmp/EA_{$timestamp}.rtf";



        // $rtf->save($filename);
        // exec('write /pt "' . realpath($filename) .'" ' . "EPSON" );





        
        // // //$timestamp = $this->get_timestamp();
        // $filename = "../tmp/ea_123.rtf";
        // $impresora = "EPSON" ;

        // $myfile = fopen($filename, "w") or die("Unable to open file!");
        // $txt = str_replace("<br>", "\r\n", "COMANDA No 123" );        
        // fwrite($myfile, $txt);       
        // $txt = str_replace("<br>", "\r\n", "===============================" );
        // fwrite($myfile, $txt);         
        // $txt = str_replace("<br>", "\r\n", "CANT    PRODUCTO" );
        // fwrite($myfile, $txt);           
        // $txt = str_replace("<br>", "\r\n", "===============================" );
        // fwrite($myfile, $txt);      
        // $txt = str_replace("<br>", "\r\n", " 2      SAND GRA SUP-ESPE" );
        // fwrite($myfile, $txt);     
        // $txt = str_replace("<br>", "\r\n", " 1      SAND GRA ESPECI" );
        // fwrite($myfile, $txt);    
        // $txt = str_replace("<br>", "\r\n", " 3      SUPERPERRO" );
        // fwrite($myfile, $txt);     
        // $txt = str_replace("<br>", "\r\n", "===============================" );
        // fwrite($myfile, $txt);   
        // $txt = str_replace("<br>", "\r\n", "GRACIAS POR SU COMPRA" );        
        // fwrite($myfile, $txt);  
        // $txt = str_replace("<br>", "\r\n", "===============================" );
        // fwrite($myfile, $txt);  
        // fclose($myfile);
 
        // exec('write /pt "' . realpath($filename) .'" ' . "EPSON" );

		////shell_exec('C:/spoolsv.exe "' . realpath($filename). '" ' . $impresora  );
        //return realpath($filename);

$phpWord = new \PhpOffice\PhpWord\PhpWord();
        
/* Note: any element you append to a document must reside inside of a Section. */
 
// Adding an empty Section to the document...
$section = $phpWord->addSection();  

 $section->setMarginLeft(300); 
 $section->setMarginRight(300); 
 $section->setMarginTop(300); 
 $section->setMarginBottom(300);

 
// Adding Text element to the Section having font styled by default...
$section->addText(
    '"Learn from yesterday, live for today, hope for tomorrow. '
        . 'The important thing is not to stop questioning." '
        . '(Albert Einstein)',
        array('name' => 'Tahoma', 'size' => 8)
);

/*
 * Note: it's possible to customize font style of the Text element you add in three ways:
 * - inline;
 * - using named font style (new font style object will be implicitly created);
 * - using explicitly created font style object.
 */

// Adding Text element with font customized inline...
$section->addText(
    '"Great achievement is usually born of great sacrifice, '
        . 'and is never the result of selfishness." '
        . '(Napoleon Hill)',
    array('name' => 'Comic Sans MS', 'size' => 8)
);

// Adding Text element with font customized using named font style...
$section->addText(
    '"The greatest accomplishment is not in never falling, '
        . 'but in rising again after you fall." '
        . '(Vince Lombardi)' 
);

// // Adding Text element with font customized using explicitly created font style object...
// $fontStyle = new \PhpOffice\PhpWord\Style\Font();
// $fontStyle->setBold(true);
// $fontStyle->setName('Arial');
// $fontStyle->setSize(5);
// $myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
// $myTextElement->setFontStyle($fontStyle);


// Saving the document as OOXML file...
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('../tmp/helloWorld.docx');

$filename = "../tmp/helloWorld.docx";
        
        exec('write /pt "' . realpath($filename) .'" ' . "EPSON" );

        
        return "Impreso!";
    }



}
