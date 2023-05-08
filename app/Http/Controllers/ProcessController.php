<?php

namespace App\Http\Controllers;

use App\Models\value;
use App\Models\Result;
use App\Models\Criteria;
use App\Models\Alternative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ProcessController extends Controller
{
    public function index(int $categories_id)
    {
        $alternatives = Alternative::select('name')->where('categories_id', $categories_id)->get(20);
        $criterias = Criteria::select('name', 'weight', 'atribute')->where('categories_id', $categories_id)->get(10);

        return view('dashboard.pages.process.index', [
            'categories_id' => $categories_id,
            'alternatives' => $alternatives,
            'criterias' => $criterias
        ]);
    }


    /**
     * param int categories_id
     */
    public function result(int $categories_id)
    {
        $alternatives = Alternative::where('categories_id', $categories_id)->get();
        $results = DB::table('alternatives')->where('categories_id', '=', $categories_id)
            ->join('results', 'results.alternatives_id', '=', 'alternatives.id')
            ->orderBy('results.result', 'desc')
            ->get();

        // return $results;

        return view('dashboard.pages.process.result', [
            'categories_id' => $categories_id,
            'alternatives' => $alternatives,
            'results' => $results
        ]);
    }

    public function generate(int $categories_id)
    {
        try {
            $data_alternatives = Alternative::with('values')->where('categories_id', $categories_id)->get();
            // dd($data_alternatives);
            foreach ($data_alternatives as $data) {
                // dd($data);
                foreach ($data->values as $data) {

                    // dd($data);

                    // get criteria
                    $criteria = Criteria::where('id', $data->criteria_id)->first();

                    // dd($criteria);

                    // check value is cost or benefit
                    if ($criteria->atribute == 1) {

                        //get max value on table value
                        $benefit = value::where('criteria_id', $data->criteria_id)->max('value');
                        // dd($benefit);

                        // normalisasi data
                        $normalisasi = $data->value / $benefit;

                        // dd($normalisasi);

                        $prefrensi = $normalisasi * $criteria->weight;
                        // dd($prefrensi);

                        $data = value::findOrFail($data->id);

                        // dd($prefrensi);
                        $data->update([
                            'normalization' => $normalisasi,
                            'prefrensi' => $prefrensi
                        ]);
                    } else {

                        //get min value on table value
                        $cost =  value::where('criteria_id', $data->criteria_id)->min('value');

                        // normalisasi data
                        $normalisasi = $cost / $data->value;

                        $prefrensi = $normalisasi * $criteria->weight;
                        $data = value::findOrFail($data->id);
                        // dd($data);

                        $data->update([
                            'normalization' => $normalisasi,
                            'prefrensi' => $prefrensi
                        ]);
                    }
                }
            }


            // sum all normalization coulmn on tables values
            $gett_new = Alternative::with('values', 'result')->where('categories_id', $categories_id)->get();
            // dd($gett_new);
            foreach ($gett_new as $data) {
                // dd($data);
                $result = 0;
                foreach ($data->values as $datas) {
                    $result = $datas->prefrensi + $result;
                }

                // dd($result);

                if ($data->result()->exists()) {
                    $update = Result::where('alternatives_id', $data->id)->first();
                    // dd($update);
                    $update->update([
                        'result' => $result
                    ]);
                } else {
                    // dd($result);
                    Result::create([
                        'alternatives_id' => $data->id,
                        'result' =>  $result
                    ]);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        // dd($categories_id);

        return redirect()->action([ProcessController::class, 'result'],  ['categories_id' => $categories_id])->with('success', 'Generate Success');
    }


    /**
     * param int categories_id
     * param int alternative_id
     */
    public function show(int $categories_id, int $alternative_id)
    {
        try {
            $alternative_detail = Alternative::with('values.criterias')->find($alternative_id);

            return view('dashboard.pages.process.show', [
                'categories_id' => $categories_id,
                'alternative' => $alternative_detail
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
