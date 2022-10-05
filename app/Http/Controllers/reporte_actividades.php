<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

//Models
use App\Models\V_reporte_actividades;

class reporte_actividades extends Controller
{
    //Datos Globales
    public function getReporte(){
        $data = V_reporte_actividades::all();
        return response()->json($data, 200);
    }

    //Filtrado Global
    public function getReportesQuery($query){
        $queryArr = explode( ',', $query );
        $date;
        $consulta = [];
        for($i = 0; $i < count($queryArr); $i++){
            switch($queryArr[$i]){
                case 'contratista_nombre_comercial': array_push($consulta, array(['contratista_nombre_comercial' => $queryArr[$i+1]]) ); 
                break;
                case 'Proyecto': array_push($consulta, array(['Proyecto' => $queryArr[$i+1]]) ); 
                break;
                case 'documento': array_push($consulta, array(['documento' => $queryArr[$i+1]]) ); 
                break;
                case 'estatus': array_push($consulta, array(['estatus' => $queryArr[$i+1]]) ); 
                break;
                case 'trabajado': $date = explode(' ', $queryArr[$i+1]);
                array_push($consulta, array('trabajado', '>=', $date[0]));
                array_push($consulta, array('trabajado', '<=', "{$date[0]} 23:59:59"));
                break;
            }
        }

        $data = V_reporte_actividades::where($consulta)->get();
        return response()->json($data, 200);
    }

    //Filtrado por periodo
    public function getReportesbyFecha($query){
        $queryArr = explode( ',', $query );
        $queryArr[0] = $queryArr[0]. ' 23:59:59';
        $data = V_reporte_actividades::where('trabajado', '>=', $queryArr[1], 'and')->where('trabajado', '<=', $queryArr[0])->get();
        return response()->json($data, 200);
    }

    //Datos por analista
    public function getReportesM(){
        $data = V_reporte_actividades::where('trabajado_por', 'Mary')->get();
        return response()->json($data, 200);
    }

    public function getReportesJ(){
        $data = V_reporte_actividades::where('trabajado_por', 'Jacky')->get();
        return response()->json($data, 200);
    }

    //funciones para el filtrado
    public function getReportesMQuery($query){
        $queryArr = explode( ',', $query );
        $consulta = [];
        $date;
        for($i = 0; $i < count($queryArr); $i++){
            switch($queryArr[$i]){
                case 'contratista_nombre_comercial': array_push($consulta, array(['contratista_nombre_comercial' => $queryArr[$i+1]]) ); 
                break;
                case 'Proyecto': array_push($consulta, array(['Proyecto' => $queryArr[$i+1]]) ); 
                break;
                case 'documento': array_push($consulta, array(['documento' => $queryArr[$i+1]]) ); 
                break;
                case 'estatus': array_push($consulta, array(['estatus' => $queryArr[$i+1]]) ); 
                break;
                case 'trabajado': $date = explode(' ', $queryArr[$i+1]);
                array_push($consulta, array('trabajado', '>=', $date[0]));
                array_push($consulta, array('trabajado', '<=', "{$date[0]} 23:59:59"));
                break;
            }
        }

        $data = V_reporte_actividades::where('trabajado_por', 'Mary')->where($consulta)->get();
        return response()->json($data, 200);
    }

    public function getReportesJQuery($query){
        $queryArr = explode( ',', $query );
        $consulta = [];
        $date;
        for($i = 0; $i < count($queryArr); $i++){
            switch($queryArr[$i]){
                case 'contratista_nombre_comercial': array_push($consulta, array(['contratista_nombre_comercial' => $queryArr[$i+1]]) ); 
                break;
                case 'Proyecto': array_push($consulta, array(['Proyecto' => $queryArr[$i+1]]) ); 
                break;
                case 'documento': array_push($consulta, array(['documento' => $queryArr[$i+1]]) ); 
                break;
                case 'estatus': array_push($consulta, array(['estatus' => $queryArr[$i+1]]) ); 
                break;
                case 'trabajado': $date = explode(' ', $queryArr[$i+1]);
                array_push($consulta, array('trabajado', '>=', $date[0]));
                array_push($consulta, array('trabajado', '<=', "{$date[0]} 23:59:59"));
                break;
            }
        }

        $data = V_reporte_actividades::where('trabajado_por', 'Jacky')->where($consulta)->get();
        return response()->json($data, 200);
    }

    //Filtrado por periodo
    public function getReportesMbyFecha($query){
        $queryArr = explode( ',', $query );
        $queryArr[0] = $queryArr[0]. ' 23:59:59';
        $data = V_reporte_actividades::where('trabajado_por', 'Mary')->where('trabajado', '>=', $queryArr[1], 'and')->where('trabajado', '<=', $queryArr[0])->get();
        return response()->json($data, 200);
    }

    public function getReportesJbyFecha($query){
        $queryArr = explode( ',', $query );
        $queryArr[0] = $queryArr[0]. ' 23:59:59';
        $data = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('trabajado', '>=', $queryArr[1], 'and')->where('trabajado', '<=', $queryArr[0])->get();
        return response()->json($data, 200);
    }

    //Endpoints para generar los graficos
    public function getGlobalChart(){
        $data['total'] = $this->getGlobalChartTotal();
        $data['status'] = $this->getGlobalChartStatus();
        return response()->json($data, 200);
        return response()->json([$data1, $data2], 200);
    }

    public function getGlobalChartTotal(){
        $data = [];
        $data[0] = V_reporte_actividades::where('trabajado_por', 'Mary')->count();
        $data[1] = V_reporte_actividades::where('trabajado_por', 'Jacky')->count();
        return $data;
    }

    public function getGlobalChartStatus(){
        $data = [];
        $data[0] = V_reporte_actividades::where('estatus', 1)->count();
        $data[1] = V_reporte_actividades::where('estatus', 2)->count();
        $data[2] = V_reporte_actividades::where('estatus', 3)->count();
        // $data[0] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 1)->count();
        // $data[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 2)->count();
        // $data[2] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 3)->count();
        // $data[3] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 1)->count();
        // $data[4] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 2)->count();
        // $data[5] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 3)->count();
        return $data;
    }

    public function getGlobalChartDate($query){
        $queryArr = explode( ',', $query );
        $queryArr[0] = $queryArr[0]. ' 23:59:59';
        $data = V_reporte_actividades::where('trabajado_por', 'Mary')->where('trabajado', '>=', $queryArr[1], 'and')->where('trabajado', '<=', $queryArr[0])->count();
        $data2 = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('trabajado', '>=', $queryArr[1], 'and')->where('trabajado', '<=', $queryArr[0])->count();
        return response()->json([$data, $data2], 200);
    }

    //Chart Comparative Status
    public function getStatusCompareChart(){
        $data = [];
        $dataset = [];
        $data[3] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 1)->count();
        $data[4] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 2)->count();
        $data[5] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('estatus', 3)->count();
        $data[6] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 1)->count();
        $data[7] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 2)->count();
        $data[8] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('estatus', 3)->count();

        $data[0] = $data[3] + $data[6];
        $data[1] = $data[4] + $data[7];
        $data[2] = $data[5] + $data[8];

        $dataset['pendiente'] = [$data[0], $data[3], $data[6]];
        $dataset['aceptado'] = [$data[1], $data[4], $data[7]];
        $dataset['rechazado'] = [$data[2], $data[5], $data[8]];

        return response()->json($dataset, 200);
    }

    //Chart Comparative Documents
    public function getDocumentCompareChart(){
        $documentos = [];
        $sipare = []; 
        $comprobante = [];
        $reporte = [];
        $sua = [];
        $nominas = [];

        $sipare[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('documento', 'SIPARE')->count();
        $sipare[2] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('documento', 'SIPARE')->count();
        $sipare[0] = $sipare[1] + $sipare[2];

        $comprobante[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('documento', 'Comprobante pago SUA')->count();
        $comprobante[2] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('documento', 'Comprobante pago SUA')->count();
        $comprobante[0] = $comprobante[1] + $comprobante[2];

        $reporte[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('documento', 'Reporte general de registro de obra SUA')->count();
        $reporte[2] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('documento', 'Reporte general de registro de obra SUA')->count();
        $reporte[0] = $reporte[1] + $reporte[2];

        $sua[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('documento', 'Archivo .SUA')->count();
        $sua[2] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('documento', 'Archivo .SUA')->count();
        $sua[0] = $sua[1] + $sua[2];

        $nominas[1] = V_reporte_actividades::where('trabajado_por', 'Mary')->where('documento', 'Nominas (XML en archivo ZIP)')->count();
        $nominas[2] = V_reporte_actividades::where('trabajado_por', 'Jacky')->where('documento', 'Nominas (XML en archivo ZIP)')->count();
        $nominas[0] = $nominas[1] + $nominas[2];

        $documentos['sipare'] = [$sipare[0], $sipare[1], $sipare[2]];
        $documentos['comprobante'] = [$comprobante[0], $comprobante[1], $comprobante[2]];
        $documentos['reporte'] = [$reporte[0], $reporte[1], $reporte[2]];
        $documentos['sua'] = [$sua[0], $sua[1], $sua[2]];
        $documentos['nominas'] = [$nominas[0], $nominas[1], $nominas[2]];

        return response()->json($documentos, 200);
    }
}
