<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\Memo_;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Notifications\MemoNotification;
use Illuminate\Notifications\DatabaseNotification;
use Notification;
use URL;

class Memo extends Component
{
    use WithFileUploads;
    public $memo_path;
    public $id_memo;

    protected $listeners = [
        'delete'
    ];

    public function selectItem($id)
    {
        $this->id_memo = $id;
    }

    public function delete()
    {
        $memo = Memo_::find($this->id_memo);
        $memo->delete();

        $noti = DatabaseNotification::where('data->memoId', $this->id_memo)->get();
        for($i=0; $i<count($noti); $i++)
        {
            $del = DatabaseNotification::where('data->memoId', $this->id_memo);
            $del->delete();
        }        

        return redirect()->back()->with('message', 'Memo deleted successfully');
    }

    public function create(Request $request)
    {
        $this->memo_path = $request->memo_path;
        $filenameWithExt = $this->memo_path->getClientOriginalName();
        $extension = $this->memo_path->getClientOriginalExtension();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $this->memo_path->storeAs('public' . DIRECTORY_SEPARATOR . 'filememo', $fileNameToStore);
        $path = '' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'filememo' . DIRECTORY_SEPARATOR . '' . $fileNameToStore;

        $newMemo = Memo_::create([
            'user_id'=> auth()->user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'description'=> $request->description,
            'memo_path' => ''.URL::to('').$path.'',
            ]);
        
        $user = User::all();
        Notification::send($user, new MemoNotification($newMemo->id,$request->title));

        return redirect()->back()->with('message', 'Memo has been successfully inserted');
    }

    public function edit($id)
    {
        $memo = Memo_::where('id', '=', $id)->get();
        return view('livewire.memo.edit', compact('id', 'memo'));
    }

    public function update(Request $request, $id) 
    {
        if ($request->memo_path != NULL) 
        {
        $this->memo_path = $request->memo_path;
        $filenameWithExt = $this->memo_path->getClientOriginalName();
        $extension = $this->memo_path->getClientOriginalExtension();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $this->memo_path->storeAs('public' . DIRECTORY_SEPARATOR . 'filememo', $fileNameToStore);
        $path = '' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'filememo' . DIRECTORY_SEPARATOR . '' . $fileNameToStore;

        Memo_::find($id)->update([
            'user_id'=> auth()->user()->id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            'title'=> $request->title,
            'description'=> $request->description,
            'memo_path' => ''.URL::to('').$path.'',
            ]);

            $updateNoti = DatabaseNotification::where('data->memoId', $id)->get();
            for($i=0; $i<count($updateNoti); $i++)
            {
                $update = DatabaseNotification::where('data->memoId', $id);
                $update->update(['data->title' => $request->title]);
            }

        } else {
            Memo_::find($id)->update([
                'user_id'=> auth()->user()->id,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'title'=> $request->title,
                'description'=> $request->description,
                ]);
            
            $updateNoti = DatabaseNotification::where('data->memoId', $id)->get();
            for($i=0; $i<count($updateNoti); $i++)
            {
                $update = DatabaseNotification::where('data->memoId', $id);
                $update->update(['data->title' => $request->title]);
            }
        }

        return redirect('/memo')->with('message', 'Memo Updated Successfully');
    }

    //update read status on Notification
    public function readNotification() {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);

        return redirect()->back();
    }

    public function render()
    {
        $memo = Memo_::orderBy('id', 'desc')->get();
        return view('livewire.memo.all', compact('memo'));
    }
}
