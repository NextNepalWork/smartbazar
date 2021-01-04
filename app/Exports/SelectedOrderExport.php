<?php

namespace App\Exports;

use App\Model\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class SelectedOrderExport implements FromCollection, WithHeadings, WithEvents
{
	use Exportable;

	protected $orders;

	public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $orders = Order::whereIn('id', $this->orders)->get();
        $i = 1;
        foreach ($orders as $order) {
        	$priceTotal = 0;
        	$product_names = [];
        	foreach ($order->products as $product) {
        		$product_names = $product->name;
        		$actualPrice = $product->pivot->qty * $product->pivot->price;
                $actualPrice += $actualPrice * ($product->pivot->tax / 100);
                $dis = $product->pivot->discount;
                $priceTotal += ($actualPrice - $dis);
        	}
        	if ($order->shipping_amount) {
                $priceTotal += $order->shipping_amount;
            }

            $columns[] = array(
                'S No' => $i,
                'Order No' => $order->code,
                'Name' => $order->shipping_address->first_name . ' ' . $order->shipping_address->last_name,
                'Address' => $order->shipping_address->area . ', ' . $order->shipping_address->district . ', ' . $order->shipping_address->zone,
                'Contact' => $order->shipping_address->phone ? $order->shipping_address->mobile . ', ' . $order->shipping_address->phone : $order->shipping_address->mobile,
                'Amount' => $priceTotal,
                'Product' => $product_names
            );
            $i++;
        }
        return collect($columns);
    }

    public function headings(): array
    {
        return [
            'S No',
            'Order No',
            'Name', 
            'Address', 
            'Contact', 
            'Amount', 
            'Product'
        ];
    }

    public function registerEvents(): array
    {
    	$styleArray = [
    		'font' => [
    			'bold' => true
    		]
    	];

        return [
            AfterSheet::class => function(AfterSheet $event) use ($styleArray) {
                $event->sheet->getStyle('A1:G1')->applyFromArray($styleArray);
            }
        ];
    }
}
