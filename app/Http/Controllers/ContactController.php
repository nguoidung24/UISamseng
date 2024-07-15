<?php

namespace App\Http\Controllers;


use App\Service\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contacService;

    public function __construct(
        ContactService $contacService,
    ) {
        $this->contacService = $contacService;
    }
    public function create(Request $request)
    {
        $att                = [];
        $att['last_name']   = $request->get('last_name');
        $att['first_name']  = $request->get('first_name');
        $att['email']       = $request->get('email');
        $att['content']     = $request->get('content');


        if ($this->contacService->create($att)) {
            $data['status'] = 'Success';
            $data['message'] = 'Contact form submitted successfully.';
        } else {
            $data['status'] = 'Error';
            $data['message'] = 'Failed to submit contact form. Please try again later.';
        }
        return response()->json($data, 200);
    }
}
