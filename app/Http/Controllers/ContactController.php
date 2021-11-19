<?php

namespace App\Http\Controllers;

use App\Mail\SendData;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;




class ContactController extends Controller
{
    public function saveContact(Request $request)
    {
        try {
            if($request->email) {

                Contact::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'message' => $request->message
                ]);

                $details = [
                    'title' => 'Nombre: '. $request->name, 
                    'body' => 'Email: '. $request->email,
                    'section' => 'Mensaje: '. $request->message,
                  
                     
                ];

                Mail::to("horaciovallejos25watts@gmail.com")->send(new SendData($details));

                //return json_encode(['status' => 'ok']);
                return 'Email ENVIADO';
            }
            
            //return $request;
            //return json_encode($request);

        } catch (\ErrorException $e) {
            return json_encode(['status' => 'faild', 'message' => $e->getMessage()]);
        }
    }
}
