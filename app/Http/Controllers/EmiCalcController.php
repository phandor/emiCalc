<?php

namespace App\Http\Controllers;

use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmiCalcController extends Controller
{
     private $emissionFactors = [
        'diesel' => 171.5,
        'gasoline' => 170.0,
        'electric' => 53.0,
        'scooter' => 20.0,
        'bus' => 89.0,
        'train' => 14.0
    ];

    public function showForm()
    {
        return view('home');
    }
    
    public function calculate(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'position' => 'sometimes|string|max:255',
                'facility' => 'sometimes|string|max:255',
                'meansOfTransport' => 'required|in:diesel,gasoline,electric,scooter,bus,train',
                'km' => 'required|numeric|min:0'
            ]);

            $transport = $validated['meansOfTransport'];
            $km = (float)$validated['km'];
            $emission = $km * $this->emissionFactors[$transport];
            $transportName = $this->getTransportName($transport);

            InvoiceItem::create([
                'name' => $validated['name'] ?? null,
                'position' => $validated['position'] ?? null,
                'facility' => $validated['facility'] ?? null,
                'transport_type' => $transport,
                'transport_name' => $transportName,
                'distance_km' => $km,
                'emission' => $emission
            ]);

            return redirect()->route('emissions.form')->with([
                'result' => [
                    'name' => $validated['name'] ?? '',
                    'position' => $validated['position'] ?? '',
                    'facility' => $validated['facility'] ?? '',
                    'transportName' => $transportName,
                    'km' => $km,
                    'emission' => $emission
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Calculation error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred during the Calculation.');
        }
    }

    private function getTransportName($key)
    {
        $names = [
            'diesel' => 'Diesel engine car',
            'gasoline' => 'Gasoline engine car',
            'electric' => 'Electric car',
            'scooter' => 'E-Scooter',
            'bus' => 'Bus',
            'train' => 'Train'
        ];
        
        return $names[$key] ?? $key;
    }
}
