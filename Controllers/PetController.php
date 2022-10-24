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

    public function ShowPetListView(){
        require_once(VIEWS_PATH."validate-session.php");
        $petList = $this->petDAO->GetByOwnerId($_SESSION['loggedUser']->getUserId());
        require_once(VIEWS_PATH . "petList.php");

    }

    public function ShowAddPetView(){
        $petSpecieController = new PetSpecieController();
        $petSpecieList = $petSpecieController->petSpecieDAO->GetAll();
        $petSizeController = new PetSizeController();
        $petSizeList = $petSizeController->petSizeDAO->GetAll();
        require_once(VIEWS_PATH."validate-session.php");
        require_once(VIEWS_PATH . "petRegistration.php");

    }

    public function ShowPetProfile($PetId){
        require_once(VIEWS_PATH."validate-session.php");
        if(!empty($PetId)){
            $pet = $this->petDAO->GetByPetId($PetId);
            require_once(VIEWS_PATH . "petProfile.php");
        }
    }

    public function Add($petName, $petBreed, $petSize, $petSpecie, $observation){
        require_once(VIEWS_PATH."validate-session.php");
        $img = 'petPics';
        $video = 'petVideo';
        $cert = 'vaccineCertId';
        $fileName = UPLOADS_PATH . $this->FileUpload($img);
        $fileName2 = UPLOADS_PATH . $this->FileUpload($video);
        $fileName3 = UPLOADS_PATH . $this->FileUpload($cert);

        $pet = new Pet();
        $pet->setPetName($petName);
        $pet->setVaccineCertId($fileName3);
        $pet->setPetSizeId(\intval ($petSize));
        $pet->setPetPics($fileName);
        $pet->setPetVideo($fileName2);
        $pet->setPetBreed($petBreed);
        $pet->setPetSpecieId($petSpecie);
        $pet->setObservation($observation);

        $this->petDAO->Add($pet);
        $this->ShowAddPetView();
    }

    public function FileUpload($nombre){
        $fileName = $_FILES[$nombre]['name'];
        $aux = explode('.', $fileName);
        $name = $aux[0];
        $ext = $aux[1];
        $fileName = $name . '_' . time() . '.' . $ext;
        $temp = $_FILES[$nombre]['tmp_name'];
        if (!file_exists(UPLOADS_PATH)){
            mkdir(UPLOADS_PATH, 0777, true);
        }
        if (move_uploaded_file($temp, UPLOADS_PATH . $fileName)) {
            return $fileName;

        }
    }
}
?>