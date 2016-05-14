<?php

class MaterialsController extends Zend_Controller_Action
{
     private $model ,$user;

    public function init(){
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_Materials();
        $this->user = new Application_Model_DbTable_Users();
    }
    

    public function indexAction(){
     	$this->view->materials = $this->model->listMaterials();

    }

    public function addmaterialAction(){
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity(); 
            $user_id = $identity->id_user;
            $type = $identity->type;
            $this->view->type = $type;
            
            $admin_user  = $this->user->getUserById($user_id);
            // var_dump($admin_user[0]['type']);die;
            if($admin_user[0]['type'] == '1'){
                $form = new Application_Form_Material();
                if($this->getRequest()->isPost()){
                    if($form->isValid($this->getRequest()->getParams())){
                    $data = $form->getValues();
                     $no_user=0;     //will ask in it what make
                    array_push($data,$user_id);
                    array_push($data,$no_user);
                    if($this->model->addMaterial($data))
                       $this->redirect('admin/goodadd');
                    }
                 }   
            $layout = $this->_helper->layout();
            $layout->setLayout('admin-layout');
            $this->view->form = $form;
        }else{
            $this->redirect("admin/index");
            // $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
        }
    }else{
            $this->redirect("users/login");
        }

    }
    
        public function editimageAction(){
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity()){
                $identity = $auth->getIdentity(); 
                $user_id = $identity->id_user;
                $admin_user  = $this->user->getUserById($user_id);
                // var_dump($admin_user[0]['type']);die;
                if($admin_user[0]['type'] == '1'){
                    $ids = $this->getRequest()->getParams();
                    $id_type=$ids['id_type'];
                    $course_id=$ids['course_id'];
            //            $id_up=$ids['id_up'];
                    $id_mat=$ids['id_mat'];
                   
                    $tysing = $this->model->getMaterialById($id_mat);
                    $form = new Application_Form_editmaterial();
                    $form->populate($tysing[0]);
                    if($this->getRequest()->isPost()){
                        if($form->isValid($this->getRequest()->getParams())){
                            $data = $form->getValues();
                            // var_dump($data);
                            if($this->model->updateMaterial($data,$id_mat)){
                                $this->redirect('materials/showsingle/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);
                            }
                        }
                    }
                    $layout = $this->_helper->layout();
                    $layout->setLayout('admin-layout');
                    $this->view->form = $form;
                    $this->render('addmaterial');
                }else{
                    $this->redirect("admin/index");
                }
            }else{
                    $this->redirect("users/login");
                }
    }

       public function editvideoAction(){
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity()){
                $identity = $auth->getIdentity(); 
                $user_id = $identity->id_user;
                $admin_user  = $this->user->getUserById($user_id);
                // var_dump($admin_user[0]['type']);die;
                if($admin_user[0]['type'] == '1'){
                    $ids = $this->getRequest()->getParams();
                    $id_type=$ids['id_type'];
                    $course_id=$ids['course_id'];
            //            $id_up=$ids['id_up'];
                    $id_mat=$ids['id_mat'];
                   
                    $tysing = $this->model->getMaterialById($id_mat);
                    $form = new Application_Form_editmaterial();
                    $form->populate($tysing[0]);
                    if($this->getRequest()->isPost()){
                        if($form->isValid($this->getRequest()->getParams())){
                            $data = $form->getValues();
                            // var_dump($data);
                            if($this->model->updateMaterial($data,$id_mat)){
                                $this->redirect('materials/showvideo/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);
                            }
                        }
                    }
                    $layout = $this->_helper->layout();
                    $layout->setLayout('admin-layout');
                    $this->view->form = $form;
                    $this->render('addmaterial');
                }else{
                    $this->redirect("admin/index");
                }
            }else{
                    $this->redirect("users/login");
                }
    }

      public function editpptpdfwordAction(){
            $auth = Zend_Auth::getInstance();
            if($auth->hasIdentity()){
                $identity = $auth->getIdentity(); 
                $user_id = $identity->id_user;
                $admin_user  = $this->user->getUserById($user_id);
                // var_dump($admin_user[0]['type']);die;
                if($admin_user[0]['type'] == '1'){
                    $ids = $this->getRequest()->getParams();
                    $id_type=$ids['id_type'];
                    $course_id=$ids['course_id'];
            //            $id_up=$ids['id_up'];
                    $id_mat=$ids['id_mat'];
                   
                    $tysing = $this->model->getMaterialById($id_mat);
                    $form = new Application_Form_editmaterial();
                    $form->populate($tysing[0]);
                    if($this->getRequest()->isPost()){
                        if($form->isValid($this->getRequest()->getParams())){
                            $data = $form->getValues();
                            // var_dump($data);
                            if($this->model->updateMaterial($data,$id_mat)){
                                $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
                            }
                        }
                    }
                    $layout = $this->_helper->layout();
                    $layout->setLayout('admin-layout');
                    $this->view->form = $form;
                    $this->render('addmaterial');
                }else{
                    $this->redirect("admin/index");
                }
            }else{
                    $this->redirect("users/login");
                }
    }
    public function singleAction(){
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity(); 
            $user_id = $identity->id_user;
            $admin_user  = $this->user->getUserById($user_id);
            // var_dump($admin_user[0]['type']);die;
            if($admin_user[0]['type'] == '1'){
                $this->view->admin = "admin";
              }  
            $ids = $this->getRequest()->getParams();
            $id_type=$ids['id_type'];
            $course_id=$ids['course_id'];
            $this->view->id_type=$id_type;
            $this->view->course_id=$course_id;
            
            $course=new Application_Model_DbTable_Course();
            $this->view->course = $course->getCourseById($course_id);
            $num = $course->addViewsCourse($course_id);
            $this->view->course_num_views = $course->numViewsCourse($course_id);
            
           $typematerialss= new Application_Model_DbTable_Typematerials();
           $this->view-> typematerials= $typematerialss->listTypematerials();
           
           $typeuploadss= new Application_Model_DbTable_Typeuploads();
           $this->view-> typeuploadss= $typeuploadss->filterrTypeuploadById($course_id,$id_type);
    //        for obtain on number of download from database
           $numdown = $typeuploadss->download($id_type,$course_id);
           $fimg=0;
           $fvideo=0;
           $fpdf=0;
           $fword=0;
           $fppt=0;
           $totaldownload=0;
            foreach ($numdown as $key => $value) {
                if($numdown[$key]['contain_upload']=='Image'){
                    $fimg=1;
                    $i=$key;
                    break;
                }
            }
            foreach ($numdown as $key => $value) {
                if($numdown[$key]['contain_upload']=='Video'){
                    $fvideo=1;
                    $v=$key;
                    break;
                }
            }
            foreach ($numdown as $key => $value) {
                if($numdown[$key]['contain_upload']=='PDF'){
                    $fpdf=1;
                    $d=$key;
                    break;
                }
            }
            foreach ($numdown as $key => $value) {
                if($numdown[$key]['contain_upload']=='Word'){
                    $fword=1;
                    $w=$key;
                    break;
                }
            }
            foreach ($numdown as $key => $value) {
                if($numdown[$key]['contain_upload']=='PPT'){
                    $fppt=1;
                    $p=$key;
                    break;
                }
            }
            if($fimg==1){
                $this->view-> numdownimage=$numdown[$i]['no_download'];
                 $totaldownload+=$numdown[$i]['no_download'];

            }
            if($fvideo==1){
                $this->view-> numdownvideo=$numdown[$v]['no_download'];
                $totaldownload+=$numdown[$v]['no_download'];
            }
            if($fpdf==1){
                $this->view-> numdownpdf=$numdown[$d]['no_download'];
                 $totaldownload+=$numdown[$d]['no_download'];

            }
            if($fword==1){
                $this->view-> numdownword=$numdown[$w]['no_download'];
                 $totaldownload+=$numdown[$w]['no_download'];

            }
            if($fppt==1){
                $this->view-> numdownppt=$numdown[$p]['no_download'];
                 $totaldownload+=$numdown[$p]['no_download'];

            }
    //        var_dump($totaldownload);die();
            $this->view-> totaldownload=$totaldownload;

           $this->view-> typeimages= $this->model->imageMaterialById($course_id,$id_type);
           $this->view-> typevides= $this->model->videoMaterialById($id_type,$course_id);
           $this->view-> typePDFs= $this->model->PDFMaterialById($id_type,$course_id);
           $this->view-> typePPTs= $this->model->PPTMaterialById($id_type,$course_id);
           $this->view-> typewords= $this->model->wordMaterialById($id_type,$course_id);
        }else{
            $this->redirect("users/login");
        }   
    }
    
    
    public function showsingleAction(){
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity(); 
            $user_id = $identity->id_user;
            $admin_user  = $this->user->getUserById($user_id);
            
            if($admin_user[0]['type'] == '1'){
                $this->view->admin = "admin";
              } 
           $ids = $this->getRequest()->getParams();
            $id_type=$ids['id_type'];
            $course_id=$ids['course_id'];
            $id_mat=$ids['id_mat'];
            $this->view->id_type=$id_type;
            $this->view->course_id=$course_id;
            $this->view->id_mat=$id_mat;
            $this->view->user_id=$user_id;
            $this->view->showmaterial= $this->model->getMaterialById($id_mat);

            $obj=new Application_Model_DbTable_Comments();
            $comment=$obj->getCommentByMaterialId($id_mat);
            $this->view->comments=$comment;
  
            $this->view->usercomments=$obj->getCommentOfUser($id_mat,$user_id);
            $form = new Application_Form_Addcomment();
            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getParams())){
                $data = $form->getValues();
               
                array_push($data, $user_id);
                array_push($data, $id_mat);
                if ($obj->addComment($data))
                $this->redirect('materials/showsingle/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);

                
                }

            }
        
            $this->view->form = $form;
        }else{
            $this->redirect("users/login");
        }     
    }


    public function showvideoAction(){
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
            $identity = $auth->getIdentity(); 
            $user_id = $identity->id_user;
            $admin_user  = $this->user->getUserById($user_id);
            // var_dump($admin_user[0]['type']);die;
            if($admin_user[0]['type'] == '1'){
                $this->view->admin = "admin";
              }
           $ids = $this->getRequest()->getParams();
            $id_type=$ids['id_type'];
            $course_id=$ids['course_id'];
            $this->view->user_id=$user_id;
            $id_mat=$ids['id_mat'];
            $this->view->id_type=$id_type;
            $this->view->course_id=$course_id;
            $this->view->id_mat=$id_mat;
            $this->view->showmaterial= $this->model->getMaterialById($id_mat);

             $obj=new Application_Model_DbTable_Comments();
            $comment=$obj->getCommentByMaterialId($id_mat);
            $this->view->comments=$comment;
  
            $this->view->usercomments=$obj->getCommentOfUser($id_mat,$user_id);
            $form = new Application_Form_Addcomment();
            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getParams())){
                $data = $form->getValues();
               
                array_push($data, $user_id);
                array_push($data, $id_mat);
                if ($obj->addComment($data))
                $this->redirect('materials/showvideo/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);

                
                }

            }
        
            $this->view->form = $form;
        }else{
            $this->redirect("users/login");
        }   
    }
    
    public function downloadimageAction()
    {   $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
       $course_id=$ids['course_id'];
        $id_mat=$ids['id_mat'];
       
//        for number download of images
        $downloadimg=new Application_Model_DbTable_Typeuploads();
        // $img='Image';
        $row_img= $downloadimg->download($id_type,$course_id);
        foreach ($row_img as $key => $value) {
            if($row_img[$key]['contain_upload']=='Image'){
                break;
            }
        }
       // var_dump($row_img[$key]['contain_upload']);die();
        $num_downimg['no_download']=$row_img[$key]['no_download']+1;
//        var_dump($num_downimg['no_download']);die();
        $downloadimg->updatedown($num_downimg,$row_img[$key]['id_up']);
            
        $material = $this->model->getMaterialById($id_mat);
//        var_dump($material[0]['mat_image']);die();
        $file_ex= explode(".",$material[0]['mat_image']);
        header('Content-type: application/'.$file_ex[1]);
        header("Content-Disposition: attachment; filename='".$material[0]['mat_image']."'"); 
        readfile(APPLICATION_PATH.'/../public/images/materials/'.$material[0]['mat_image']);
//        for make download in same page
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
//        $this->redirect('materials/showsingle/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);

    }
    
    public function downloadvideoAction()
    {   $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
       $course_id=$ids['course_id'];
        $id_mat=$ids['id_mat'];
       
//        for number download of video
        $downloadvideo=new Application_Model_DbTable_Typeuploads();
        // $video='Video';
        $row_video= $downloadvideo->download($id_type,$course_id);
        foreach ($row_video as $key => $value) {
            if($row_video[$key]['contain_upload']=='Video'){
                break;
            }
        }
       // var_dump($row_video[$key]['contain_upload']);die();
        $num_downvideo['no_download']=$row_video[$key]['no_download']+1;
//        var_dump($num_downvideo['no_download']);die();
        $downloadvideo->updatedown($num_downvideo,$row_video[$key]['id_up']);
            
        $material = $this->model->getMaterialById($id_mat);
//        var_dump($material[0]['mat_video']);die();
        $file_ex= explode(".",$material[0]['mat_video']);
        header('Content-type: application/'.$file_ex[1]);
        header("Content-Disposition: attachment; filename='".$material[0]['mat_video']."'"); 
        readfile(APPLICATION_PATH.'/../public/videos/'.$material[0]['mat_video']);
//        for make download in same page
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        
//        $this->redirect('materials/showsingle/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);

    }

    public function pdfdowntestAction(){ 

        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
//        for number download of pdf
        $downloadpdf=new Application_Model_DbTable_Typeuploads();
        $row_pdf= $downloadpdf->download($id_type,$course_id);
        foreach ($row_pdf as $key => $value) {
            if($row_pdf[$key]['contain_upload']=='PDF'){
                break;
            }
        }
       // var_dump($row_pdf[$key]['contain_upload']);die();
        $num_downpdf['no_download']=$row_pdf[$key]['no_download']+1;
        $downloadpdf->updatedown($num_downpdf,$row_pdf[$key]['id_up']);

        $id_mat=$ids['id_mat'];
        $material = $this->model->getMaterialById($id_mat);
        $file_ex= explode(".",$material[0]['mat_pdf']);
        header('Content-type: application/'.$file_ex[1]);
        header("Content-Disposition: attachment; filename='".$material[0]['mat_pdf']."'"); 
        readfile(APPLICATION_PATH.'/../public/materials/pdfdown/pdfs/'.$material[0]['mat_pdf']);
            
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        // $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);

    }
    public function worddowntestAction(){ 

        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
//        for number download of word
        $downloadword=new Application_Model_DbTable_Typeuploads();
        // $video='Video';
        $row_word= $downloadword->download($id_type,$course_id);
        foreach ($row_word as $key => $value) {
            if($row_word[$key]['contain_upload']=='Word'){
                break;
            }
        }
       // var_dump($row_word[$key]['contain_upload']);die();
        $num_downpdf['no_download']=$row_word[$key]['no_download']+1;
        $downloadword->updatedown($num_downpdf,$row_word[$key]['id_up']);
        $id_mat=$ids['id_mat'];
        $material = $this->model->getMaterialById($id_mat);
        $file_ex= explode(".",$material[0]['mat_word']);
        header('Content-type: application/'.$file_ex[1]);
        header("Content-Disposition: attachment; filename='".$material[0]['mat_word']."'"); 
        readfile(APPLICATION_PATH.'/../public/materials/worddown/Words/'.$material[0]['mat_word']);
            
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        // $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);

    }
    public function pptdowntestAction(){ 

        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
//        for number download of ppt
        $downloadppt=new Application_Model_DbTable_Typeuploads();
        $row_ppt= $downloadppt->download($id_type,$course_id);
        foreach ($row_ppt as $key => $value) {
            if($row_ppt[$key]['contain_upload']=='PPT'){
                break;
            }
        }
       // var_dump($row_ppt[$key]['contain_upload']);die();
        $num_downpdf['no_download']=$row_ppt[$key]['no_download']+1;
        $downloadppt->updatedown($num_downpdf,$row_ppt[$key]['id_up']);
            
        $id_mat=$ids['id_mat'];
        $material = $this->model->getMaterialById($id_mat);
        $file_ex= explode(".",$material[0]['mat_ppt']);
        header('Content-type: application/'.$file_ex[1]);
        header("Content-Disposition: attachment; filename='".$material[0]['mat_ppt']."'"); 
        readfile(APPLICATION_PATH.'/../public/materials/pptdown/ppts/'.$material[0]['mat_ppt']);
            
        $this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
        // $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);

    }
    

    public function deleteAction() {
        $ids = $this->getRequest()->getParams();
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
        $id_up=$ids['id_up'];
        $id_mat=$ids['id_mat'];

        $seldownload=new Application_Model_DbTable_Typeuploads();
        $typeup=$seldownload->getTypeuploadById($id_up);

        $typemat=$this->model->getMaterialById($id_mat);

        if($typeup[0]['contain_upload']=="Image"){
             $typemat[0]['mat_image']=NULL;
             $this->model->updateMaterial($typemat[0],$id_mat);
             
        }elseif($typeup[0]['contain_upload']=="Video"){
              $typemat[0]['mat_video']=NULL;
             $this->model->updateMaterial($typemat[0],$id_mat);
            
        }elseif($typeup[0]['contain_upload']=="Word"){
              $typemat[0]['mat_word']=NULL;
             $this->model->updateMaterial($typemat[0],$id_mat);
            
        }elseif($typeup[0]['contain_upload']=="PDF"){
              $typemat[0]['mat_pdf']=NULL;
             $this->model->updateMaterial($typemat[0],$id_mat);
            
        }elseif($typeup[0]['contain_upload']=="PPT"){
              $typemat[0]['mat_ppt']=NULL;
             $this->model->updateMaterial($typemat[0],$id_mat);
            
        }

         if(($typemat[0]['mat_image']==NULL)and($typemat[0]['mat_video']==NULL)and($typemat[0]['mat_word']==NULL)and($typemat[0]['mat_pdf']==NULL)and($typemat[0]['mat_ppt']==NULL)){  
            if($this->model->deleteMaterial($id_mat))
            $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
         }
        $this->redirect('materials/single/course_id/'.$course_id.'/id_type/'.$id_type);
    }



    public function editcommentAction(){
        $ids= $this->getRequest()->getParams();
        $id_comt=$ids['id_comt'];
        $id_mat=$ids['id_mat'];
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
        $this->view->showmaterial= $this->model->getMaterialById($id_mat);
        $obj=new Application_Model_DbTable_Comments();
        $comment=$obj->getCommentByMaterialId($id_mat);
            $this->view->comments=$comment;

            $form = new Application_Form_Addcomment();
            $com=$obj->getCommentById($id_comt);
            $form->populate($com[0]);
            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getParams())){
                $data= $form->getValues();
                if ($obj->updateComment($data,$id_comt))

                $this->redirect('materials/showsingle/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);
}
            }
        
            $this->view->form = $form;  
           $this->render('showsingle');      
      /*  $this->model->updateComment($id_comt=$id);*/


    }
    

    public function editcommentvideoAction(){
        $ids= $this->getRequest()->getParams();
        $id_comt=$ids['id_comt'];
        $id_mat=$ids['id_mat'];
        $id_type=$ids['id_type'];
        $course_id=$ids['course_id'];
        $this->view->showmaterial= $this->model->getMaterialById($id_mat);
        $obj=new Application_Model_DbTable_Comments();
        $comment=$obj->getCommentByMaterialId($id_mat);
            $this->view->comments=$comment;

            $form = new Application_Form_Addcomment();
            $com=$obj->getCommentById($id_comt);
            $form->populate($com[0]);
            if($this->getRequest()->isPost()){
                if($form->isValid($this->getRequest()->getParams())){
                $data= $form->getValues();
                if ($obj->updateComment($data,$id_comt))

                $this->redirect('materials/showvideo/course_id/'.$course_id.'/id_type/'.$id_type.'/id_mat/'.$id_mat);
}
            }
        
            $this->view->form = $form;  
           $this->render('showvideo');      
      /*  $this->model->updateComment($id_comt=$id);*/


    }
}
