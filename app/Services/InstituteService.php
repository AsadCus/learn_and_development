<?php

namespace App\Services;

use App\Models\institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class instituteService
{
    public function __construct(institute $institute)
    {
        $this->institute = $institute;
    }
    
    public function handleGetAllInstitute($request)
    {
        $fromDate = $request->input('start_date');
        $toDate = $request->input('end_date');
        if ($fromDate) {
            $data = $this->institute->whereBetween('created_at', [$fromDate, $toDate])->get();
        } else {
            $data = $this->institute->get();
        }

        return $data;
    }

    public function handlePostStoreInstitute($request)
    {
        // dd($request);    
        $req = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'accreditation' => 'required',
            'website' => 'nullable',
            'email' => 'required',
            'phone' => 'nullable',
            'address' => 'required',
        ]); 
        $req['status'] = 'active';
        $Univ = $this->institute->create($req);

        return $Univ;
    }

    public function handleGetInstituteById($id)
    {   
        $data = $this->institute->find($id);
        return $data;
    }

    public function handlePutUpdateInstitute($request, $id)
    {
        $req = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'accreditation' => 'required',
            'website' => 'nullable',
            'email' => 'required',
            'phone' => 'nullable',
            'address' => 'required',
            'status' => 'required'
        ]); 
        $Univ = $this->institute->find($id)->update($req);
        return $Univ;
    }

    // public function handlePutStatusSupervisor($id)
    // {
    //     $data = $this->supervisor->find($id);
        
    //     if ($data->status == 'active') {
    //         $status = 'deactive';
    //     } else {
    //         $status = 'active';
    //     }

    //     $updateData = $data->update([
    //         'status' => $status,
    //     ]);

    //     return $updateData;
    // }
}