<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::where('user_id', $request->user()->id)->get();

        return response()->json([
            'data' => $contacts
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        $contact = Contact::create([
            ...$validated,
            'user_id' => $request->user()->id,
        ]);

        return response()->json([
            'message' => 'Contacto creado correctamente',
            'data' => $contact
        ], 201);
    }

    public function show(Request $request, string $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json([
            'data' => $contact
        ]);
    }

    public function update(Request $request, string $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'avatar' => 'nullable|string|max:255',
        ]);

        $contact->update($validated);

        return response()->json([
            'message' => 'Contacto actualizado correctamente',
            'data' => $contact
        ]);
    }

    public function destroy(Request $request, string $id)
    {
        $contact = Contact::where('user_id', $request->user()->id)
            ->findOrFail($id);

        $contact->delete();

        return response()->json([
            'message' => 'Contacto eliminado correctamente'
        ]);
    }
}
