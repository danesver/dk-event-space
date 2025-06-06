<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AppointmentBooked;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Facades\Storage;
use App\Mail\WeddingReminder; 
use App\Mail\VisitReminder; 
use Log;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('bookAppointment','myEvents');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function main()
    {
         // Fetch all categories from the database
        $category = DB::table('tblweddingcategories')->get();

        // Pass the data to the view
        return view('welcome', compact('category'));
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function contact()
    {
        return view('contact');
    }

    public function bookAppointment()
    {
        $this->middleware('auth');
         // Fetch all categories from the database
        $bookingDates = DB::table('tblweddingbook')->pluck('wedding_date')->toArray();

        $quotation = DB::table('tblweddingquotation')->get();

        // Pass the data to the view
        return view('booking-appointment', compact('quotation','bookingDates'));
    }
    
    
    public function bookAppointmentEdit($id)
    {
        $this->middleware('auth');
         // Fetch all categories from the database
        //$bookingDates = DB::table('tblweddingbook')->where('booking_id','!=',$id)->pluck('wedding_date')->toArray();

        $bookingDates = DB::table('tblweddingbook')
                        ->where('booking_id', '!=', $id)
                        ->select('wedding_date', 'event_slot') // replace 'slot' with actual column name if different
                        ->get()
                        ->toArray();
        $bookingData = DB::table('tblweddingbook')->where('booking_id',$id)->first();
        $quotation = DB::table('tblweddingquotation')->get();

        // Pass the data to the view
        return view('booking-appointment', compact('quotation','bookingDates','bookingData'));
    }
    


    public function saveBookAppointment(Request $request){
        $this->middleware('auth');
        $userId = Auth::id();  

        //mereging servies

        // Assuming you have the $request data

        // Step 1: Get the request data from $request
        $booking_id = $request->booking_id;
        $wedding_status = $request->wedding_status;
        $wedding_type = $request->wedding_type;
        $no_of_guest = $request->no_of_guest;
        $wedding_date = $request->wedding_date;
        $event_slot = $request->event_slot;
        $seating_arrangement = $request->seating_arrangement;
        $other_seating_arrangement = $request->other_seating_arrangement;

        // Convert array of AV requirements and special requests to comma-separated strings
        $av_requirements = implode(', ', $request->av_requirements);
        $special_requests = implode(', ', $request->special_requests);

        // Step 2: Convert comma-separated strings into arrays
        $av_requirements_array = explode(', ', $av_requirements);  // Convert AV requirements to array
        $special_requests_array = explode(', ', $special_requests);  // Convert special requests to array

        // Step 3: Combine everything into a single array
        $dataMerge = [
            $wedding_status,
            $wedding_type,
            'Number of Guests',
            $wedding_date,
            $event_slot,
            $seating_arrangement
        ];

        // Merge the arrays of AV requirements and special requests
        $dataMerge = array_merge($dataMerge, $av_requirements_array, $special_requests_array);
       

        $pricesList = DB::table('tblweddingquotation')->whereIn('quotation_text',$dataMerge)->get();

        // Now sum the 'quotation_amount' values using the collection's sum method
        $totalAmount = $pricesList->sum('quotation_amount');
       
        // Sample data for the quotation
        $data = [
            'items' => $pricesList,
            'total_amount' => $totalAmount,
            'customer_name'=>$request->firstname.' '.$request->lastname,
            'customer_address'=>'',
            'customer_phone'=>$request->phone,
            'customer_email'=>$request->email,
            'wedding_type'=>$request->wedding_type,
            'other_wedding_type'=>$request->other_wedding_type,
            'other_seating_arrangement'=>$request->other_seating_arrangement,
            'wedding_date'=>$request->wedding_date,
            'event_slot'=>$request->event_slot,

        ];
       
        // Load the HTML content from the view and pass data
        $pdf = PDF::loadView('quotation-pdf', $data);

        // Define the path to store the PDF
        $path = public_path('quotations/quotation_' . time() . '.pdf');

        // Store the PDF to the specified path
        $pdf->save($path);

        // Optionally, return the path or file URL if needed
        $fileUrl = 'quotations/' . basename($path);

        
        if($booking_id){
            $getResult = DB::table('tblweddingbook')->where('booking_id',$booking_id)->first();
            
                    $data = [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'user_email' => $request->email,
                    'phone' => $request->phone,
                    'wedding_type' => $request->wedding_type,
                    'other_wedding_type' => $request->other_wedding_type,
                    'no_of_guest' => $request->no_of_guest,
                    'wedding_date' => $request->wedding_date,
                    'event_slot' => $request->event_slot,
                    'seating_arrangement' => $request->seating_arrangement,
                    'other_seating_arrangement'=>$request->other_seating_arrangement,
                    'av_requirements' => implode(', ', $request->av_requirements), // Saving array as JSON
                    'special_requests' => implode(', ', $request->special_requests), // Saving array as JSON
                    'textarea' => $request->textarea,
                    'visit_date' => $getResult->visit_date, // If visit_date is not provided, it will be null
                    'visit_time' => $getResult->visit_time,
                    'user_id'=>$userId, // Same for visit_time,
                    'organizer_id'=>0,
                    'pdf'=>$fileUrl,
                    'amount'=>$totalAmount 
                ];
                $insertedId = DB::table('tblweddingbook')->where('booking_id',$booking_id)->update($data);
        }else{
                    $data = [
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'user_email' => $request->email,
                    'phone' => $request->phone,
                    'wedding_status' => $request->wedding_status,
                    'wedding_type' => $request->wedding_type,
                    'other_wedding_type' => $request->other_wedding_type,
                    'no_of_guest' => $request->no_of_guest,
                    'wedding_date' => $request->wedding_date,
                    'event_slot' => $request->event_slot,
                    'seating_arrangement' => $request->seating_arrangement,
                    'other_seating_arrangement'=>$request->other_seating_arrangement,
                    'av_requirements' => implode(', ', $request->av_requirements), // Saving array as JSON
                    'special_requests' => implode(', ', $request->special_requests), // Saving array as JSON
                    'textarea' => $request->textarea,
                    'visit_date' => $request->visit_date, // If visit_date is not provided, it will be null
                    'visit_time' => $request->visit_time,
                    'user_id'=>$userId, // Same for visit_time,
                    'organizer_id'=>0,
                    'pdf'=>$fileUrl,
                    'amount'=>$totalAmount 
                ];
                $booking_id = DB::table('tblweddingbook')->insertGetId($data);
        }
        // Insert the data into the tblweddingbook table
       

        $insertData = [];

        foreach ($pricesList as $record) {
            // Prepare the data to insert
            $insertData[] = [
                'wedding_id' => $booking_id,  // Assuming the foreign key for wedding_id
                'quotation_text' => $record->quotation_text,  // Quotation text
                'quotation_amount' => $record->quotation_amount,  // Quotation amount
                'created_at' => now(),  // Created at timestamp (optional)
                'updated_at' => now(),  // Updated at timestamp (optional)
            ];
        }
        DB::table('tblweddingbook_detail')->where('wedding_id',$booking_id)->delete();
        // Step 3: Insert the prepared data into tblweddingbook_detail table
        DB::table('tblweddingbook_detail')->insert($insertData);

        // Send the email
        //Mail::to($request->email)->send(new AppointmentBooked($data));
        // Return a response (redirect or success message)
        // Return a response (redirect or success message)
        return response()->json(['success' => true, 'message' => 'Your appointment has been booked successfully!']);
    }

    public function index()
    {
        $this->middleware('auth');
        $userId = Auth::id();
        return view('home');
    }

    public function myEvents()
    {
        $this->middleware('auth');
        $userId = Auth::id();  

        $myEvents = DB::table('tblweddingbook')->where('user_id',$userId)->get();
        $dateAvailability = DB::table('availability')->get();
        // Pass the data to the view
        return view('home', compact('myEvents','dateAvailability'));
        
    }

    public function sendMail(Request $request)
    {
        // Redirect or return a response after sending the mail
        //return redirect()->back()->with('status', 'Your message has been sent!');
        // Validate and process form data here
        // For example:
        $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Send the email (you can use Laravel's Mail facade for this)
        Mail::to('recipient@example.com')->send(new \App\Mail\ContactMail($request->all()));

        // Redirect or return a response after sending the mail
        return redirect()->back()->with('status', 'Your message has been sent!');
    }


    public function cronJob(){
        $weddings = DB::table('tblweddingbook')->where('event_date', '<=', Carbon::now()->addDays(3.5))
                   ->where('wedding_status', 'Confirm Booking') // Example: Only get 'confirmed' weddings
                   ->get();

        // Loop through each wedding
        foreach ($weddings as $wedding) {
            // Perform some action for each wedding, e.g., send a reminder email
            // Example: Sending email reminder to the couple or organizer
            try {
                \Mail::to($wedding->user_email)  // Assuming you have the couple's email in the table
                    ->send(new WeddingReminder($wedding)); // Send an email using the WeddingReminder mailable
            } catch (\Exception $e) {
                // Handle errors in case the email fails
                \Log::error("Failed to send email for wedding ID {$wedding->id}: " . $e->getMessage());
            }
            
            // Additional actions can be added here, such as logging, updating records, etc.
        }

        $visitsList  = DB::table('tblweddingbook')->where('wedding_status', 'Confirm Visit') // Only get 'confirmed' weddings
                ->whereNotNull('visit_date')  // Ensure that the visit date is not null
                ->where('visit_date', '<=', Carbon::now()->addDays(1.5))->get(); // Visit date is within 1.5 days


                // Loop through each wedding
        foreach ($visitsList as $wedding) {
            // Perform some action for each wedding, e.g., send a reminder email
            // Example: Sending email reminder to the couple or organizer
            try {
                \Mail::to($wedding->user_email)  // Assuming you have the couple's email in the table
                    ->send(new VisitReminder($wedding)); // Send an email using the WeddingReminder mailable
            } catch (\Exception $e) {
                // Handle errors in case the email fails
                \Log::error("Failed to send email for visit ID {$wedding->id}: " . $e->getMessage());
            }
            
            // Additional actions can be added here, such as logging, updating records, etc.
        }

    }


    public function saveBookConfrimation(Request $request){
        $this->middleware('auth');
        $userId = Auth::id();  
        $data = json_decode($request->getContent(), true);
        // Access the 'id' key
        $id = $data['id'] ?? null;
        DB::table('tblweddingbook')->where('booking_id', $id)->update(['wedding_status' => 'Confirm Booking']);
        
        
        return response()->json(['success' => true, 'message' => 'Your appointment has been booked successfully!']);
    }

    public function saveBookVisit(Request $request){
        $this->middleware('auth');
        $userId = Auth::id();  
        $data = json_decode($request->getContent(), true);
        // Access the 'id' key
        $id = $data['id'] ?? null;
        $visit_date = $data['visit_date'] ?? null;
        $visit_time = $data['visit_time'] ?? null;
        DB::table('tblweddingbook')->where('booking_id', $id)->update(['wedding_status' => 'Pending Visit','visit_date' => $visit_date,'visit_time' => $visit_time]);
        
        
        return response()->json(['success' => true, 'message' => 'Your appointment has been booked successfully!']);
    }

    public function saveBookCancel(Request $request){
        $this->middleware('auth');
        $userId = Auth::id();  
        $data = json_decode($request->getContent(), true);
        // Access the 'id' key
        $id = $data['id'] ?? null;
        
        DB::table('tblweddingbook')->where('booking_id', $id)->update(['wedding_status' => 'Cancel Booking']);
        
        
        return response()->json(['success' => true, 'message' => 'Your appointment has been booked successfully!']);
    }

    
    
}
