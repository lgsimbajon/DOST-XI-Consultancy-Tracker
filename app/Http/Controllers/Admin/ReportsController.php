<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\NewFirm;
use Yajra\DataTables\Facades\DataTables;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.reports.index');
    }

    public function view(Request $request)
    {
        $input = $request->all();
        $province = $input['prov'];
        $from = $input['from'];
        $oFrom = $from;
        $to = $input['to'];


        $output = '<div class="box-body table-responsive"><table class="table table-hover"><tbody><tr><th>Year</th><th>MPEX</th><th>CPT</th><th>GMP Assessment</th><th>GMP Seminar</th><th>Plant Layout Design</th><th>GMP Manual</th><th>EA</th><th>Packaging & Labeling</th><th>CAMPI</th></tr>';

        while ((int)$from <= (int)$to)
        {

            $output .= "<tr>";
            $output .= "<td>" . $from . "</td>";

            if ($province == "Region XI")
            {

                $count = NewFirm::all()->where('mpex', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('cpt', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('gmp_assessment', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('gmp_seminar', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('plant_layout_design', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('gmp_manual', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('energy_audit', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('packaging_labeling', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('campi', '=', $from)->count();
                $output .= "<td>" . $count . "</td>";

                $output .= "</tr>";

            }

            else
            {

                $count = NewFirm::all()->where('mpex', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";
//
                $count = NewFirm::all()->where('cpt', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";
//
                $count = NewFirm::all()->where('gmp_assessment', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('gmp_seminar', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('plant_layout_design', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('gmp_manual', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('energy_audit', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('packaging_labeling', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $count = NewFirm::all()->where('campi', '=', $from)->where('province', '=', $province)->count();
                $output .= "<td>" . $count . "</td>";

                $output .= "</tr>";

            }

            $from++;

        };

        $output.='</tbody></table></div>';

        return view('admin.reports.show', compact('province', 'oFrom', 'to', 'output'));
    }

}