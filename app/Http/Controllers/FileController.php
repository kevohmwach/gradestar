<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Product;
use File;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class FileController extends Controller
{
    public function checkInput($data) {
    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES);
        return $data;
    }
    public function download($orderRef, $id){
        $id = filter_var(($this->checkInput( $id)),FILTER_SANITIZE_NUMBER_INT);
        $orderRef = filter_var($this->checkInput( $orderRef),FILTER_SANITIZE_STRING);
        $product = Billing::where('bill_orderid', $orderRef)
                            ->where('bill_status','PAID')
                            ->where('bill_prodid', $id)
                            ->where('downloadlink_status', 1)
                            ->where('downloadlink_views', '<', 3)
                            ->get();
        if( $product->count() ){
            //show file
            $data =  Product::find($id);
            $file_path = $data['prod_file'];
            $complete_path = storage_path('app/public/'.$file_path);
            if (!file_exists($complete_path)) {
                //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
                return response('Error: Document not found');
            }
            $file = File::get($complete_path);
            $response = Response::make($file, 200);
            $response->header('Content-Type', 'application/pdf');
            return $response;
        }else{
            return response ('Error: No record found or download link has expired');
        }
    }
    public function showPdfFile($id){
        $data =  Product::find($id);
        $file_path = $data['prod_file'];
        $complete_path = storage_path('app/public'.$file_path);
        if (!file_exists($complete_path)) {
            //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
            return response('Error: Document not found');
        }
        $file = File::get($complete_path);
        $response = Response::make($file, 200);
        $response->header('Content-Type', 'application/pdf');
        return $response;
    }
    public function downloadFile($filePath,$complete_path, $slug)
    {
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404, 'The requested file does not exist.');
        }
        // 4. Force clear buffers (Prevents 'Connection Reset' on XAMPP)
        if (ob_get_level()) {
            ob_end_clean();
        }
        // THIS IS THE FIX: Kill every single buffer level
        while (ob_get_level()) {
            ob_end_clean();
        }
        $filename = Str::slug($slug).".pdf";
        // return Storage::disk('public')->download($filePath, "test.pdf", [
        //     'Content-Disposition' => 'attachment', 
        // ]);
        return Storage::disk('public')->download($filePath, $filename);
    }
    // public function downloadFile($filePath, $complete_path, $slug)
    // {
    //     if (!file_exists($complete_path)) {
    //         abort(404);
    //     }

    //     $publicFileName = trim($slug, '-') . '.pdf';
    //     $tempPath = public_path('downloads/' . $publicFileName);

    //     // Create the directory if it doesn't exist
    //     if (!file_exists(public_path('downloads'))) {
    //         mkdir(public_path('downloads'), 0777, true);
    //     }

    //     // Copy the hashed file to a "pretty named" file in the public folder
    //     copy($complete_path, $tempPath);

    //     // Redirect the user directly to the file
    //     // Apache will serve this as a static file, which WON'T crash the process
    //     return redirect('/downloads/' . $publicFileName);
    // }
    public function auto_download($orderRef, $id, $slug){
        $id = filter_var(($this->checkInput( $id)),FILTER_SANITIZE_NUMBER_INT);
        $orderRef = filter_var($this->checkInput( $orderRef),FILTER_SANITIZE_STRING);
        $product = Billing::where('bill_orderid', $orderRef)
                            ->where('bill_status','PAID')
                            ->where('bill_prodid', $id)
                            ->where('downloadlink_status', 1)
                            ->where('downloadlink_views', '<', 3)
                            ->get();
        if( $product->count() ){
            //show file
            $data =  Product::find($id);
            $file_path = $data['prod_file'];
            $complete_path = storage_path('app/public/'.$file_path);
            if (!file_exists($complete_path)) {
                //return response()->json(['error' => 'File not found.'], Response::HTTP_NOT_FOUND);
                return response('Error: Document not found');
            }
            return $this->downloadFile($file_path,$complete_path, $slug);
        }else{
            return response ('Error: No record found or download link has expired');
        }
    }
}