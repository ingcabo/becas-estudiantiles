<?php
    require_once 'PHPExcel.php';
    
    /* Devuelve un estilo de celda en formato de arreglo segun su nombre*/
    function get_style($name){
        $ARIAL_11_BOLD =  array(
                'name'         => 'Arial',
                'bold'         => true,
                'italic'       => false,
                'size'         => 11
         );

         $ARIAL_8_BOLD =  array(
                'name'         => 'Arial',
                'bold'         => true,
                'italic'       => false,
                'size'         => 8
         );

         $ARIAL_8 =  array(
                'name'         => 'Arial',
                'bold'         => false,
                'italic'       => false,
                'size'         => 8
         );


         /*************
          * ALINEACION *
          **************/
          $CENTER_CENTER = array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap'       => true
          );

          $LEFT_TOP = array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'   => PHPExcel_Style_Alignment::VERTICAL_TOP,
                'wrap'       => true
          );


         /**************
          *   BORDES   *
          **************/
         $THIN_ALL = array(
                        'top'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'bottom'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'left'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'right'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
         );

         $THIN_INTER = array(
                        'top'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ),
                        'bottom'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
         );


         /**********************
          * COLORES DE RELLENO *
          **********************/
          $GOLD_SOLID = array(
                        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FFFFBE00'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FFFFBE00'
                        )
           );

           $LIGHTBLUE_SOLID = array(
                        'type'       => PHPExcel_Style_Fill::FILL_SOLID,
                        'rotation'   => 90,
                        'startcolor' => array(
                            'argb' => 'FF0073E6'
                        ),
                        'endcolor'   => array(
                            'argb' => 'FF0073E6'
                        )
           );



         /**********************
          *      ESTILOS       *
          **********************/

         /* Titulo de los reportes, Tamaño texto 11 tipo Arial en Negritas,
          * Centrado */
         $TITULO1 = array(
            'font' => $ARIAL_11_BOLD,
            'alignment' => $CENTER_CENTER
         );

         /* Cabecera de columna, color de fondo Oro, Negritas, tamaño texto 8 tipo
          * Arial, 4 bordes delgados, Centrado */
         $COLUMN_HEADER1 = array(
            'font' => $ARIAL_8_BOLD,
            'alignment' => $CENTER_CENTER,
            'borders' => $THIN_ALL,
            'fill' => $GOLD_SOLID
         );

         /* Cabecera de columna, color de fondo Azul Claro, Negritas, tamaño texto 8 tipo
          * Arial, 4 bordes delgados, Centrado */
         $COLUMN_HEADER2 = array(
            'font' => $ARIAL_8_BOLD,
            'alignment' => $CENTER_CENTER,
            'borders' => $THIN_ALL,
            'fill' => $LIGHTBLUE_SOLID
         );

         /* Registro de tabla, sin color de fondo, tamaño texto 8 tipo
          * Arial, 4 bordes delgados, Orientado a la izquierda */
         $RECORD1= array(
            'font' => $ARIAL_8,
            'alignment' => $LEFT_TOP,
            'borders' => $THIN_ALL
         );

        if ($name == 'ARIAL_11_BOLD') {
            return $ARIAL_11_BOLD;
        } elseif ($name == 'ARIAL_8_BOLD'){
            return $ARIAL_8_BOLD;
        } elseif ($name == 'ARIAL_8'){
            return  $ARIAL_8;
        } elseif ($name == 'CENTER_CENTER'){
            return  $CENTER_CENTER;
        } elseif ($name == 'LEFT_TOP'){
            return  $LEFT_TOP;
        } elseif ($name == 'THIN_ALL'){
            return  $THIN_ALL;
        } elseif ($name == 'THIN_INTER'){
            return  $THIN_INTER;
        } elseif ($name == 'GOLD_SOLID'){
            return  $GOLD_SOLID;
        } elseif ($name == 'LIGHTBLUE_SOLID'){
            return  $LIGHTBLUE_SOLID;
        } elseif ($name == 'TITULO1'){
            return  $TITULO1;
        } elseif ($name == 'COLUMN_HEADER1'){
            return  $COLUMN_HEADER1;
        } elseif ($name == 'COLUMN_HEADER2'){
            return  $COLUMN_HEADER2;
        } else {
            return  $RECORD1;
        }


    }


/* Genera en la hoja de calculo $sheet las filas del arreglo $records
 * a partir de una posicion especifica. Mezcla las celdas segun el tamaño
 * especificado en $columnsSize para cada columna y le aplica el estilo
 * dado en $style a todas las celdas */
if ( ! function_exists('arrayToExcelTable')) {
    function arrayToExcelTable( PHPExcel_Worksheet $sheet,
                                array $records, array $style = null,
                                array $columnsSize = null, $initColumn = 0,
                                $initRow=1){

       $currColumn = $initColumn;
       $currRow = $initRow;
       foreach($records as $record) {
           $sheet->insertNewRowBefore($currRow);
           $nCol = 0; /* Numero de columna (tomando en cuenta las mezclas) */
           foreach($record as $value) {
               /* Desplazamientos de celda para alcanzar la siguiente columna */
               $columnShift = 1;
               /* Se verifica el tamaño especificado para la columna. Si es
                * mayor a una celda se mezclan las celdas que sean
                * necesarias */
               if($columnsSize<>null && count($columnsSize) > $nCol){
                   $columnSize = $columnsSize[$nCol];
                   if ($columnSize > 1) {
                       $sheet->mergeCellsByColumnAndRow($currColumn, $currRow,
                                       $currColumn+$columnSize-1, $currRow);
                       for($i=$currColumn;$i<($currColumn+$columnSize);$i++){
                           $sheet->getStyleByColumnAndRow($i, $currRow)
                                   ->applyFromArray($style);
                       }
                       $columnShift = $columnSize;
                   }
               }

               /* Se aplica el valor al campo */
               $sheet->setCellValueByColumnAndRow($currColumn, $currRow, $value);
               if($style <> null){
                  $sheet->getStyleByColumnAndRow($currColumn, $currRow)
                        ->applyFromArray($style);
               }
               $nCol++;
               $currColumn += $columnShift;
           }
           $currRow++;
           $currColumn = $initColumn;
        }
    }
}
?>
