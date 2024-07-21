<?php
namespace App\Traits;
//

use App\Models\Category;

use App\Http\Resources\CategoryResource;

use Illuminate\Support\Facades\Hash;

trait CRUD_Trait{

    public function errorMessage($message,$code){
        return response()->json([
            'status' => false,
            'message' => $message,
    
        ],$code);
    }

   

    public function successMessage($message,$code){
        return response()->json([
            'status' => true,
            'message' => $message,
    
        ],$code);
    }
    
    public function errorValidationMessage($e){
        $errors_array=[];
        foreach($e->errors() as $key => $error) {
            foreach($error as $e)
                array_push($errors_array,$e);
    
        }

        return response()->json([
            'errors'=>$errors_array
        
        ], 422);
                
    }

    public function createCategory($model,$request){
        $model::create([
       
            'name' => $request->name,
            'created_at'=>now(), 
            'superCategory_id'=>$request->superCategory_id,
          ]);

    return $this->successMessage('The category has been created successfully',201);
       
    }


    public function createProduct($model,$request){
        $model::create([
       
            'name' =>$request->name,
            'created_at'=>now(), 
            'category_id'=>$request->category_id,
          ]);
    return $this->successMessage('The Product has been created successfully',201);
       
    }

    public function created_from($x){
        $date1 =  $x;
        $date2 = now();
        
        $diff = $date2->diff($date1);
        
        $x= $diff->format('%a Day and %h hours');
        return  $x;
    }



    public function updateData($model,$r){

        if($r->name)
        $model->update([
            'name' =>$r->name,
          ]);
        if($r->superCategory_id)
        $model->update([
            'superCategory_id' =>$r->superCategory_id,
          ]);
          if($r->superCategory_id)
          $model->update([
              'category_id' =>$r->category_id,
            ]);

        return $this->successMessage('Updated successfully',200);
       
    }


//////


    public function createToken($message,$code, $user){
        return response()->json([
            'status' => true,
            'message' => $message,
            'token' => $user->createToken("API TOKEN")->plainTextToken

        ],$code);
    }

//******* */
    public function creatUser($model,$request){
        //   $data=$request->except('postal_code','country','city');
        $data=$request->all();
          $data['password']=Hash::make($request->password);
          $data['user_ip']= $request->ip();
          $data['user_ip']= $request->ip();
          $data['address']= $request->postal_code.'_'.$request->country.'_'.$request->city;
          $user=$model::create($data);
        //   $model->createAddress($request->postal_code,$request->country,$request->city);
         
        
        return $this->createToken("create User Successfully",201, $user);
    }
////

    public function logUser($model,$email){
        $user = $model::where('email', $email)->first();
        return $this->createToken("Login User Successfully",200, $user);   
    }
/////

}