<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Datos Globales
Route::get('/reporte-actividades', 'App\Http\Controllers\reporte_actividades@getReporte');
Route::get('/reporte-actividades/q=', 'App\Http\Controllers\reporte_actividades@getReporte');
Route::get('/reporte-actividades/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesQuery');
Route::get('/reporte-actividadesPeriodo/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesbyFecha');

//Datos por Analista
Route::get('/reporte-actividadesm', 'App\Http\Controllers\reporte_actividades@getReportesM');
Route::get('/reporte-actividadesj', 'App\Http\Controllers\reporte_actividades@getReportesJ');

Route::get('/reporte-actividadesm/q=', 'App\Http\Controllers\reporte_actividades@getReportesM');
Route::get('/reporte-actividadesj/q=', 'App\Http\Controllers\reporte_actividades@getReportesJ');

Route::get('/reporte-actividadesm/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesMQuery');
Route::get('/reporte-actividadesj/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesJQuery');

//Filtrado por periodo
Route::get('/reporte-actividadesmPeriodo/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesMbyFecha');
Route::get('/reporte-actividadesjPeriodo/q={query}', 'App\Http\Controllers\reporte_actividades@getReportesJbyFecha');

//Obtener los datos para las graficas
Route::get('/global-chart', 'App\Http\Controllers\reporte_actividades@getGlobalChart');
Route::get('/global-chart/q={query}', 'App\Http\Controllers\reporte_actividades@getGlobalChartDate');
Route::get('/global-chart-status', 'App\Http\Controllers\reporte_actividades@getGlobalChartStatus');
Route::get('/global-chart-statusc', 'App\Http\Controllers\reporte_actividades@getStatusCompareChart');
Route::get('/global-chart-documents', 'App\Http\Controllers\reporte_actividades@getDocumentCompareChart');









