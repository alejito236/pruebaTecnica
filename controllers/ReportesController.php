<?php


require_once 'models/Reportes.php';
require_once 'models/Tarea.php';
require_once 'models/Proyecto.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


 class ReportesController
{
    public function index()
    {
        require_once 'views/reportes/index.php';
    }

 public function exportar_post()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tabla = $_POST['tabla'];

        require_once 'vendor/autoload.php';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($tabla === 'proyectos') {
            $proyectos = (new Proyecto())->obtenerTodos();

            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Nombre');
            $sheet->setCellValue('C1', 'Descripción');
            $sheet->setCellValue('D1', 'Tarifa');

            $row = 2;
            foreach ($proyectos as $p) {
                $sheet->setCellValue("A$row", $p['idProyectos']);
                $sheet->setCellValue("B$row", $p['nombre_proyecto']);
                $sheet->setCellValue("C$row", $p['descripcion_proyecto']);
                $sheet->setCellValue("D$row", $p['tarifa_proyecto']);
                $row++;
            }

        } elseif ($tabla === 'tareas') {
            $tareas = (new Tarea())->obtenerTodas();

            $sheet->setCellValue('A1', 'ID');
            $sheet->setCellValue('B1', 'Nombre');
            $sheet->setCellValue('C1', 'Descripción');
            $sheet->setCellValue('D1', 'Proyecto');
            $sheet->setCellValue('E1', 'Fecha Inicio');
            $sheet->setCellValue('F1', 'Fecha Fin');
            $sheet->setCellValue('G1', 'Estado');

            $row = 2;
            foreach ($tareas as $t) {
                $sheet->setCellValue("A$row", $t['idtareas']);
                $sheet->setCellValue("B$row", $t['nombre_tarea']);
                $sheet->setCellValue("C$row", $t['descripicion_tarea']);
                $sheet->setCellValue("D$row", $t['nombre_proyecto']);
                $sheet->setCellValue("E$row", $t['fecha_inicio']);
                $sheet->setCellValue("F$row", $t['fecha_fin']);
                $sheet->setCellValue("G$row", $t['estado']);
                $row++;
            }
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="reporte_'.$tabla.'.xls"');
        header('Cache-Control: max-age=0');

        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
}


