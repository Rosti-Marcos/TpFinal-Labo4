<?php

    namespace Controllers;
    use DAO\PetDAO as PetDAO;
    use Models\Pet as Pet;

class PetController
{
    private $petDAO;

    public function __construct()
    {
        $this->petDAO = new PetDAO();
    }

    public function ShowPetListView()
    {
        $petList = $this->petDAO->GetByOwnerId($_SESSION['loggedUser']->getUserId());

        //$pet = $this->petDAO->GetByPetId(1);

        require_once(VIEWS_PATH . "petList.php");
        //var_dump($pet);die();
    }

    public function ShowAddPetView()
    {
        require_once(VIEWS_PATH . "petRegistration.php");
    }

    public function ShowPetProfile()
    {
        $pet = $this->petDAO->GetByPetId(1);

        require_once(VIEWS_PATH . "petProfile.php");
    }

    public function Add($petName, $petTypeId, $petBreed, $observation)
    {
        $img = 'petPics';
        $video = 'petVideo';
        $cert = 'vaccineCertId';
        $fileName = IMG_PATH . $this->FileUpload($img);
        $fileName2 = IMG_PATH . $this->FileUpload($video);
        $fileName3 = IMG_PATH . $this->FileUpload($cert);

        $pet = new Pet();
        $pet->setPetName($petName);
        $pet->setVaccineCertId($fileName3);
        $pet->setPetTypeId(intval($petTypeId));
        $pet->setPetPics($fileName);
        $pet->setPetVideo($fileName2);
        $pet->setPetBreed($petBreed);
        $pet->setObservation($observation);

        $this->petDAO->Add($pet);
        $this->ShowAddPetView();
    }

    public function FileUpload($nombre)
    {
        $fileName = $_FILES[$nombre]['name'];
        $aux = explode('.', $fileName);
        $name = $aux[0];
        $ext = $aux[1];
        //if($ext == 'jpg' || $ext == 'png' || $ext == 'mp4'){
        $fileName = $name . '_' . time() . '.' . $ext;
        $temp = $_FILES[$nombre]['tmp_name'];
        if (move_uploaded_file($temp, IMG_PATH . $fileName)) {
            return $fileName;
            //} else {
            echo "file type not allowed";
            //}
        }
    }

    public function petListByOwnerId(){
        $userId = $_SESSION['loggedUser']->getUserId();
        $petList = $this->petDAO->GetByOwnerId($userId);
        //var_dump($petList);die();
        //require_once $this->ShowPetListView();
        $this->ShowPetListView();
        //require_once(VIEWS_PATH . "petList.php");

    }


}


    /*public function FileUpload($petPics){

        $fileName = $_FILES['petPics']['name'];
        $temp = $_FILES['petPics']['tmp_name'];
        if (!file_exists(IMG_PATH)) {
            mkdir(IMG_PATH, 0777, true);
            if(move_uploaded_file($temp, IMG_PATH . $fileName)){
            //chmod(IMG_PATH . $archivo, 0777, true);
                echo "GUARDADO";
                } else {
                echo "ERROR";
            }
        }

    }*/


?>