<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pdfs extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Orden');

    }

    public function apreciacion($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_apreciacion');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, Apreciacion');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.


        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td></td><td><strong>FORMATO BÁSICO DE APRECIACIÓN</strong></td><td></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        $html .= '<tr style="text-align:center;"><td>EJÉRCITO DE CHILE</td><td ><strong>SECRETO</strong></td><td style="text-align:justify;">'.$orden -> datos_ejemplar.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr style="text-decoration: underline;"><td></td><td style="text-align:center;" ><strong> APRECIACIÓN DE '.$orden -> titulo.' </strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> OPERACIÓN '.$orden -> operacion.' </strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> REFERENCIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> HUSO HORARIO</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> huso.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.MISIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mision.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2.SITUACIÓN Y CONSIDERACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> situacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 3.CURSOS DE ACCIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> cursos.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 4.ANÁLISIS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> analisis.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 5.COMPARACIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> comparacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3"><strong> 6.RECOMENDACIONES Y CONCLUSIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> recomendaciones.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_apreciacion.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }


    public function decision($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_decision');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, Decision');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.

// use the font

        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td colspan="3"><strong>FORMATO GENÉRICO DE COMUNICADO DE DECISIÓN</strong></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        $html .= '<tr style="text-align:center;"><td colspan="3">'.$orden -> clasificacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> ÓRDENES VERBALES PREVIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> previas.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr style="text-align:center;"><td>EJÉRCITO DE CHILE</td><td ><strong>SECRETO</strong></td><td>'.$orden -> datos_ejemplar.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:center;text-decoration: underline;"  colspan="3"><strong> COMUNICADO DE DECISIÓN N.° '.$orden -> titulo.' </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:left;" ><strong>DEL:  </strong> </td><td style="text-align:left;">'.$orden -> del.'</td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:left;" ><strong>AL:  </strong> </td><td style="text-align:left;">'.$orden -> al.'</td><td></td></tr>';
        $html .= '<tr><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> TEXTO</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_Decision.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }



    public function frago($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_FRAGO');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, FRAGO');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.


// use the font
        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        if ($orden -> previas != '') {

        $html .= '<tr><td><strong> ORDENES VERBALES PREVIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> previas.'</td></tr>';
        $html .= "<tr><td></td></tr>";

        }
        $html .= '<tr style="text-align:center;"><td>EJÉRCITO DE CHILE</td><td ><strong>SECRETO</strong></td><td style="text-align:justify;">'.$orden -> datos_ejemplar.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:center; text-decoration: underline;" colspan="3" ><strong> ORDEN AISLADA (FRAGO) N.°'.$orden -> titulo.' </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> REFERENCIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> HUSO HORARIO</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> huso.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.SITUACIÓN Y CONSIDERACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> situacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2.MISIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mision.'</td></tr>';

        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 3.EJECUCIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> ejecucion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 4.APOYO AL COMBATE</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> apoyo.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 5.MANDO Y COMUNICACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mando.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_FRAGO.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }


    public function plan($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_Plan');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, Plan');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.


// use the font
        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td colspan="3"><strong>FORMATO GENÉRICO DE PLAN U ORDEN</strong></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        $html .= '<tr style="text-align:center;"><td>EJÉRCITO DE CHILE</td><td ><strong>SECRETO</strong></td><td style="text-align:justify;">'.$orden -> datos_ejemplar.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:center; text-decoration: underline;" colspan="3" ><strong> PLAN (ORDEN) DE '.$orden -> titulo.' </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> REFERENCIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> HUSO HORARIO</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> huso.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> ORGANIZACIÓN DE TAREA</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> organizacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.SITUACIÓN </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> situacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2.MISIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mision.'</td></tr>';

        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 3.EJECUCIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> ejecucion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 4.APOYO AL COMBATE</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> apoyo.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 5.MANDO Y COMUNICACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mando.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_Plan.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }


    public function warno($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_WARNO');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, WARNO');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.

// use the font
// $pdf->SetFont($fontname, '', 14, '', false);
        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td colspan="3"><strong>FORMATO GENÉRICO DE ORDEN PREPARATORIA (WARNO)</strong></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        if ($orden -> previas != '') {

        $html .= '<tr><td><strong> ORDENES VERBALES PREVIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> previas.'</td></tr>';
        $html .= "<tr><td></td></tr>";

        }
        $html .= '<tr style="text-align:center;"><td>EJÉRCITO DE CHILE</td><td ><strong>SECRETO</strong></td><td style="text-align:justify;">'.$orden -> datos_ejemplar.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td style="text-align:center; text-decoration: underline;" colspan="3" ><strong> ORDEN PREPARATORIA (WARNO) N.°'.$orden -> titulo.' </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> REFERENCIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3"><strong> HUSO HORARIO UTILIZADO DURANTE LA OPLAN/OPORD</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> huso.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> ORGANIZACIÓN DE TAREAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> organizacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.SITUACIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> situacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2.MISIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mision.'</td></tr>';

        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 3.EJECUCIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> ejecucion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 4.APOYO AL COMBATE</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> apoyo.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 5.MANDO Y COMUNICACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mando.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_WARNO.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    public function organizacion($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_Organizacion');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, Organizacion');
        // convert TTF font to TCPDF format and store it on the fonts folder


        // use the font

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td colspan="3"><strong>FORMATO GENÉRICO DE ORGANIZACIÓN DE TAREA</strong></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        $html .= '<tr><td colspan="3"><strong> ORGANIZACIÓN DE TAREA DE LA '.$orden -> titulo.' </strong> </td> </tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3">DEL: '.$orden -> del.'  AL : '.$orden -> al.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.UNIDAD DE MANDO Y CONTROL</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2. UNIDADES SUBORDINADAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_Organizacion.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }



    public function grafica($id) {

        $orden = $this->Orden->get_orden($id);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'Letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('CEMSE');
        $pdf->SetTitle('Orden_GRAFICA');
        $pdf->SetSubject('Apreciacion');
        $pdf->SetKeywords('Orden, PDF, GRAFICA');

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);


// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('arial', '', 12, '', true);
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
          $imagen= base_url('/biblioteca/ordenes/'.$orden->ruta);
        //preparamos y maquetamos el contenido a crear
        $html = '';
        $html .= " <style>
          table {
            border: none;
          }

          .td {
            width=10% !important;
          }
        </style>";
        $html .= "<table width='100%'>";
        // $html .= '<tr style="text-align:center;"><td colspan="3"><strong>FORMATO GENÉRICO DE ORDEN GRÁFICA</strong></td></tr>';
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        // $html .= "<tr><td></td><td></td><td></td></tr>";
        $html .= '<tr><td style="text-align:center; text-decoration: underline;" colspan="3" ><strong> ORDEN GRÁFICA N.°'.$orden -> titulo.' </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> REFERENCIAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> referencias.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3"><strong> HUSO HORARIO UTILIZADO DURANTE LA OPLAN/OPORD</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> huso.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> ORGANIZACIÓN DE TAREAS</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> organizacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 1.SITUACIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> situacion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 2.MISIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mision.'</td></tr>';

        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 3.EJECUCIÓN</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> ejecucion.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 4.APOYO AL COMBATE</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> apoyo.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> 5.MANDO Y COMUNICACIONES</strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td colspan="3" style="word-wrap: break-word;">'.$orden -> mando.'</td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td><strong> IMAGEN </strong> </td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr style="text-align:center;"><td colspan="3" style="word-wrap: break-word;"><img src="'.$imagen.'" alt="" width=""></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" ><strong> FIRMA</strong> </td><td></td></tr>';
        $html .= "<tr><td></td></tr>";
        $html .= '<tr><td></td><td style="text-align:center;" >'.$orden -> firmas.'</td><td></td></tr>';
        $html .= "</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Orden_GRAFICA.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
}
