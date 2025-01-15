<?php

namespace App\Models;

use CodeIgniter\Model;

class DBigraciasModel extends Model
{


	 function __construct()
    {
        parent::__construct();
        $this->dbi = \Config\Database::connect('DBIGRACIAS');

 
        $this->tb = $this->db->table('NEW_SCHEDULES_LECTURER');
    }
    public function GetScheduleDumy()
    {
        
        $query = $this->dbi->query("SELECT *  FROM ACADEMIC.NEW_SCHEDULES_LECTURER_TUJ nsl 
        WHERE nsl.INDONESIADAYNAME = 'SENIN' and nsl.BUILDINGNAME like '%KAMPUS A%' 
        and TO_DATE('07:30:00', 'HH24:MI:SS') >= TO_DATE(NSL.STARTHOUR, 'HH24:MI:SS') 
        and TO_DATE('07:30:00', 'HH24:MI:SS') < TO_DATE(NSL.ENDHOUR, 'HH24:MI:SS') and ROOMNAME = 'RKA.KJ.01.001' AND SCHOOLYEAR ='2324'");
        return $query->getResultArray();
    }   
   
    public function getSchedule($schoolyear, $semester){
        $sql ="SELECT * FROM ACADEMIC.NEW_SCHEDULES_LECTURER_TUJ nsl WHERE SCHOOLYEAR = ? and SEMESTER=? ";
        $query = $this->dbi->query($sql, array($schoolyear,$semester));
        return $query->getResult();
    }

    public function getSemesterActive(){
        $sql ="SELECT * FROM ACADEMIC.SETTINGSEMESTER nsl WHERE APPLICATIONID='13'";
        $query = $this->dbi->query($sql);
        return $query->getRowArray();
    }

    public function getLeader($s) {
            $sql ="SELECT * FROM MASTERDATA.STUDENT s JOIN MASTERDATA.STUDYPROGRAM s2 ON s.STUDYPROGRAMID =s2.STUDYPROGRAMID 
            WHERE s2.STUDYPROGRAMNAME LIKE '%Jakarta%' AND s.STUDENTTYPEID NOT IN (2,6,5,3,10) and (s.FULLNAME like '%$s%' or s.STUDENTID like '%$s%') AND ROWNUM <= 15  order by s.FULLNAME";

        $query = $this->dbi->query($sql);

        return $query->getResult();
    }

    public function getAllDataMhw($schoolYear) {
        $sql ="SELECT s.STUDENTID AS numberid, s.FULLNAME as fullname, s.STUDENTSCHOOLYEAR AS schoolyear, s.CLASS AS studentclass 
                FROM MASTERDATA.STUDENT s JOIN MASTERDATA.STUDYPROGRAM s2 ON s.STUDYPROGRAMID =s2.STUDYPROGRAMID 
                WHERE s2.STUDYPROGRAMNAME LIKE '%Jakarta%' AND s.STUDENTTYPEID IN (1,9,8,12,13) AND s.STUDENTSCHOOLYEAR = ?
                order by s.FULLNAME";

    $query = $this->dbi->query($sql, array($schoolYear));

    return $query->getResult();
    }

    public function getNip($s) {
        $sql ="SELECT * FROM MASTERDATA.EMPLOYEEMASTER e JOIN MASTERDATA.ORGANIZATIONSTRUCTURE o ON e.WORKLOCATION =o.ORGSTRUCTUREID 
        WHERE o.ORGSTRUCTURENAME LIKE '%JAKARTA%' AND e.ACTIVESTATUS ='Y' and (e.FULLNAME like '%$s%' or e.EMPLOYEEID like '%$s%')  AND ROWNUM <= 15 order by e.FULLNAME";

        $query = $this->dbi->query($sql);

        return $query->getResult();
    }

    public function getStudentbyId($id) {
        $sql ="SELECT * FROM MASTERDATA.STUDENT s WHERE s.STUDENTID =?";
    
        $query = $this->dbi->query($sql, array($id));

        return $query->getRowArray();
    }

    public function getEmpByNip($id) {
        $sql ="SELECT * FROM MASTERDATA.EMPLOYEEMASTER s WHERE s.EMPLOYEEID like ? and s.ACTIVESTATUS='Y'";
    
        $query = $this->dbi->query($sql, array("%".$id."%"));

        return $query->getRowArray();
    }

    public function getClassRoom(){
        $sql ="SELECT r.ROOMID , r.ROOMNAME, r.CAPACITY, r.INFORMATION, r.BUILDINGNAME FROM MASTERDATA.ROOMS r 
WHERE (r.ROOMNAME LIKE '%RKA.KJ%' OR r.ROOMNAME LIKE '%RUC.KJ%' OR r.ROOMNAME LIKE '%RKB.KJ%' OR r.ROOMNAME LIKE '%RKC.KJ%' OR r.ROOMNAME LIKE 'STUDENT CENTER') AND ACTIVESTATUS = 'YA' AND r.ROOMNAME NOT LIKE '%RKA.KJ.SI%'";

    $query = $this->dbi->query($sql);

    return $query->getResult();
    }

}