<?php


class timetable extends controller
{
    public function index()
    {
        $this->sessionManager->managerLogged();
        $classData = $this->model("manager", "classesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/timetable/index", ["classData" => $classData]);
        $this->render("manager/main/footer");
    }

    public function create()
    {
        $this->sessionManager->managerLogged();
        $days = $this->model("manager", "timetableModels")->listDays();
        $classes = $this->model("manager", "classesModels")->listView($_SESSION['manager']['corporation_id']);
        $studies = $this->model("manager", "studiesModels")->listView($_SESSION['manager']['corporation_id']);
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/timetable/create", [
            "days" => $days,
            "classes" => $classes,
            "studies" => $studies
        ]);
        $this->render("manager/main/footer");

    }

    public function send()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['timetableSend'])) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        date_default_timezone_set('Europe/Istanbul');

        if ($_POST['class_id'] == 0) {
            helper::flashData("stats", "Lütfen sınıf seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }
        if ($_POST['studies_id'] == 0) {
            helper::flashData("stats", "Lütfen ders seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }
        if ($_POST['teacher_id'] == 0) {
            helper::flashData("stats", "Lütfen öğretmen seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }
        if ($_POST['day_id'] == 0) {
            helper::flashData("stats", "Lütfen gün seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }
        if ($_POST['startTime'] == "" || $_POST['finishTime'] == "") {
            helper::flashData("stats", "Lütfen saat seçimi yapınız.");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }
        if ((strtotime($_POST['finishTime']) - strtotime($_POST['startTime'])) < 0) {
            helper::flashData("stats", "Ders bitiş saati sınav başlangıcından önce olamaz.");
            helper::redirect(SITE_URL . "/manager/exams/create");
            exit;
        }

        $class_id = $_POST['class_id'];
        $studies_id = $_POST['studies_id'];
        $teacher_id = $_POST['teacher_id'];
        $corporation_id = $_SESSION['manager']['corporation_id'];
        $day_id = $_POST['day_id'];
        $startTime = $_POST['startTime'];
        $finishTime = $_POST['finishTime'];
        $sameDayControl = $this->model("manager", "timetableModels")->sameDayControl($day_id);

        if ($sameDayControl != 0) {
            $sameDayStudies = $this->model("manager", "timetableModels")->getSameDayStudies($day_id);
            foreach ($sameDayStudies as $key => $value) {
                if (strtotime($startTime) >= strtotime($value['start']) && strtotime($startTime) < strtotime($value['finish'])) {
                    helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                    helper::redirect(SITE_URL . "/manager/timetable/create");
                    exit;
                }
                if (strtotime($finishTime) >= strtotime($value['start']) && strtotime($finishTime) < strtotime($value['finish'])) {
                    helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                    helper::redirect(SITE_URL . "/manager/timetable/create");
                    exit;
                }
                if (strtotime($finishTime) >= strtotime($value['finish']) && strtotime($startTime) <= strtotime($value['start'])) {
                    helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                    helper::redirect(SITE_URL . "/manager/timetable/create/");
                    exit;
                }
            }
        }

        $insert = $this->model("manager", "timetableModels")->insert(
            $class_id,
            $studies_id,
            $teacher_id,
            $corporation_id,
            $day_id,
            $startTime,
            $finishTime
        );

        if ($insert == false) {
            helper::flashData("stats", "Kayıt işlemi gerçekleştirilemedi");
            helper::redirect(SITE_URL . "/manager/timetable/create");
            exit;
        }

        helper::flashData("stats", "Kayıt işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/timetable/create");
        exit;
    }

    public function view($class_id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager", "timetableModels")->controlByClassID(helper::cleaner($class_id));
        if ($control['control'] == 0) {
            helper::flashData("stats", "Bu sınıfa ait bir ders programı henüz tanımlanmamıştır.");
            helper::redirect(SITE_URL . "/manager/timetable");
            exit;
        }
        $days = $this->model("manager", "timetableModels")->listDays();
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/timetable/view", ["class_id" => $class_id, "days" => $days]);
        $this->render("manager/main/footer");
    }

    public function edit($id)
    {

        $this->sessionManager->managerLogged();
        if (empty(helper::cleaner($id))) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        $control = $this->model("manager", "timetableModels")->controlByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        if ($control['timetableControl'] == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $data = $this->model("manager", "timetableModels")->getTimetableByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        $classData = $this->model("manager", "classesModels")->getData($data['class_id']);
        $studiesData = $this->model("manager", "studiesModels")->getData($data['studies_id']);
        $teacherData = $this->model("manager", "teacherModels")->getData($data['teacher_id']);
        $days = $this->model("manager", "timetableModels")->listDays();
        $this->render("manager/main/header");
        $this->render("manager/main/sidebar");
        $this->render("manager/timetable/edit", [
            "timetableData" => $data,
            "classData" => $classData,
            "studiesData" => $studiesData,
            "teacherData" => $teacherData,
            "days" => $days
        ]);
        $this->render("manager/main/footer");
    }

    public function update($id)
    {
        $this->sessionManager->managerLogged();

        if (!isset($_POST['timetableUpdate'])) {
            helper::cleaner(SITE_URL . "/manager");
            exit;
        }

        $control = $this->model("manager", "timetableModels")->controlByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);

        if ($control['timetableControl'] == 0) {
            helper::cleaner(SITE_URL . "/manager");
            exit;
        }

        $exData = $this->model("manager", "timetableModels")->getDataByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        $class_id = $_POST['class_id'];
        $day = $_POST['day_id'];
        $start = $_POST['startTime'];
        $finish = $_POST['finishTime'];

        if ($day == $exData['day'] && $start == $exData['start'] && $finish == $exData['finish']) {
            helper::flashData("stats", "Güncelleme işlemi başarıyla gerçekleştirildi.");
            helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
            exit;
        }

        if ((strtotime($finish) - strtotime($start)) < 0) {
            helper::flashData("stats", "Ders bitiş saati başlangıcından önce olamaz.");
            helper::redirect(SITE_URL . "/manager/exams/create");
            exit;
        }

        $timetableData = $this->model("manager", "timetableModels")->sameTimeControl($id, $class_id, $day);

        foreach ($timetableData as $key => $value) {
            if (strtotime($start) >= strtotime($value['start']) && strtotime($start) <= strtotime($value['finish'])) {
                helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
                exit;
            }
            if (strtotime($finish) >= strtotime($value['start']) && strtotime($finish) <= strtotime($value['finish'])) {
                helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
                exit;
            }
            if (strtotime($finish) >= strtotime($value['finish']) && strtotime($start) <= strtotime($value['start'])) {
                helper::flashData("stats", "Seçtiğiniz saat aralığında başka bir ders bulunmaktadır.");
                helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
                exit;
            }
        }

        $update = $this->model("manager", "timetableModels")->update($day, $start, $finish, $id);

        if ($update == false) {
            helper::flashData("stats", "Güncelleme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
            exit;
        }

        helper::flashData("stats", "Güncelleme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/timetable/edit/" . $id);
        exit;

    }

    public function deleteByID($id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager", "timetableModels")->controlByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        if ($control['timetableControl'] == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        $class_id = $this->model("manager", "timetableModels")->getDataByID(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        $delete = $this->model("manager", "timetableModels")->delete(helper::cleaner($id), $_SESSION['manager']['corporation_id']);
        if ($delete == false) {
            helper::flashData("stats", "Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/timetable/view/" . $class_id['class_id']);
            exit;
        }
        helper::flashData("stats", "Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/timetable/view/" . $class_id['class_id']);
        exit;
    }
    public function deleteAll($class_id)
    {
        $this->sessionManager->managerLogged();
        $control = $this->model("manager", "timetableModels")->controlByClassID(helper::cleaner($class_id));

        if ($control['control'] == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $delete = $this->model("manager", "timetableModels")->delete(helper::cleaner($class_id));

        if ($delete == false) {
            helper::flashData("stats", "Silme işlemi gerçekleştirilemedi.");
            helper::redirect(SITE_URL . "/manager/timetable");
            exit;
        }

        helper::flashData("stats", "Silme işlemi başarıyla gerçekleştirildi.");
        helper::redirect(SITE_URL . "/manager/timetable");
        exit;
    }

    public function listTeachers()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST)) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        if ($_POST['class_id'] == 0) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }
        $class_id = $_POST['class_id'];
        $classData = $this->model("manager", "classesModels")->getData($class_id);
        $teachers_id = explode(",", $classData['teachers_id']);
        echo "<option value='0'>Lütfen öğretmen seçimi yapınız.</option>";
        foreach ($teachers_id as $key => $value) {
            $teachersData = $this->model("manager", "teacherModels")->getData($value);
            echo "<option value='$value'>" . $teachersData['name'] . "</option>";
        }
    }

    public function listTimetable()
    {
        $this->sessionManager->managerLogged();
        if (!isset($_POST['day_id']) || !isset($_POST['class_id'])) {
            helper::redirect(SITE_URL . "/manager");
            exit;
        }

        $data = $this->model("manager", "timetableModels")->getTimetableByDay(
            $_POST['class_id'],
            $_POST['day_id'],
            $_SESSION['manager']['corporation_id']
        );

        foreach ($data as $key => $value) {
            $studiesData = $this->model("manager", "studiesModels")->getData($value['studies_id']);
            $teacherData = $this->model("manager", "teacherModels")->getData($value['teacher_id']);
            echo "<tr>" .
                "<td>" . $teacherData['name'] . "</td>" .
                "<td>" . $studiesData['name'] . "</td>" .
                "<td>" . $value['start'] . "-" . $value['finish'] . "</td>" .
                "<td><a href='" . SITE_URL . "/manager/timetable/edit/" . $value['id'] . "'><button class='btn btn-primary' type='button'>Düzenle</button></a></td>" .
                "<td><a href='" . SITE_URL . "/manager/timetable/deleteByID/" . $value['id'] . "'><button class='btn btn-danger' type='button'>Sil</button></a></td>" .
                "</tr>";
        }
    }
}