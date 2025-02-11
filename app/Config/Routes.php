<?php

use CodeIgniter\Router\RouteCollection;


$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/Siak', 'Home::index_old');
$routes->post('/getDataSetting', 'Home::getDataSetting');
$routes->post('/changeMaksDateReq', 'Home::UpMakDateReq');

$routes->post('/AdminSignin', 'Admin::index');
$routes->post('/Signin', 'Admin::pgwSignin');
$routes->post('/StudentSignin', 'Admin::studentSignin');
$routes->get('/StudentSignin', 'Admin::studentSignin');
$routes->get('/AdminSignin', 'Admin::index');
$routes->get('/Signin', 'Admin::pgwSignin');
$routes->get('/Siak/redirect', 'Admin::redirect');
$routes->get('/Logout', 'Admin::Logout');
$routes->get('/User', 'User::index');
// $routes->get('/Siak/User', 'User::index');
$routes->post('/updateSchedulefromDBI', 'User::updateSchedulefromDBI');

$routes->post('UserDelete', 'User::deleteUser');

$routes->get('/SchUpdate', 'User::updateSchedulefromDBI');

$routes->post('/changeUnit', 'Myasset::UpUnit');

$routes->get('/MyAsset', 'Myasset::index');
$routes->post('/callDataJson', 'Myasset::dataJson');
$routes->post('/addAsset', 'Myasset::insertAsset');
$routes->post('/AssetDelete', 'Myasset::deleteAsset');
$routes->post('/modalEditAsset', 'Myasset::modalEdit');
$routes->post('/assetEdit', 'Myasset::editAsset');
$routes->post('/showAsset', 'Myasset::show_asset');
$routes->post('/showAssetStatus', 'Myasset::show_asset_status');



$routes->get('/DataLoan', 'Loan::index');
$routes->get('/loanHistory', 'Loan::history');
$routes->post('/dataJsonLoan', 'Loan::dataJson');
$routes->post('/checkSchedule', 'Loan::ScheduleCheck');
$routes->post('/addLoan', 'Loan::addLoan');
$routes->post('/loanDelete', 'Loan::deleteLoan');
$routes->post('/statusLoanUp', 'Loan::updateStatusLoan');
$routes->post('/detailLoan', 'Myasset::loan_detail');
$routes->post('/getNip', 'Loan::getPgw');
$routes->post('/historyAssetLoan', 'Loan::dataJsonhistory');
$routes->post('/historyClassroomLoan', 'Loan::dataJsonhistoryClassroom');

$routes->post('/getNipId', 'Loan::getPgwId');

$routes->get('/MyLoan', 'MyLoan::index');
$routes->post('/dataJsonMyLoan', 'MyLoan::dataJson');


$routes->get('/DataEmployee', 'Employee::index');

$routes->post('callDataEmpJson', 'Employee::dataJson');
$routes->post('getPicClassLoan', 'Employee::getPicClassLoan');


$routes->post('/dataScheduleClass', 'ScheduleClass::dataJson');
$routes->post('/getRoom', 'ScheduleClass::getRoom');
$routes->post('/getOrg', 'ScheduleClass::getOrg');
$routes->post('/addReqLoan', 'ScheduleClass::addClassLoan');
$routes->post('/activatedBetweenSem', 'ScheduleClass::beetweenSemester');

$routes->get('/MyClassLoan', 'MyClassLoan::index');
$routes->post('/dataJsonMyClassLoan', 'MyClassLoan::dataJson');
$routes->post('/CLassloanDelete', 'MyClassLoan::deleteClassLoan');
$routes->post('/reqEndLoan', 'MyClassLoan::reqEndLoan');
$routes->get('/HistoryClassLoan', 'MyClassLoan::history');
$routes->post('/dataJsonHistoriClassLoan', 'MyClassLoan::dataJsonHistory');

$routes->get('/Classroomloan', 'ClassLoan::index');
$routes->post('/dataJsonClassroomLoan', 'ClassLoan::dataJson');
$routes->post('/dataJsonClassroomLoanRep', 'ClassLoan::dataJsonAcadmic');
$routes->post('/statusClassLoanUp', 'ClassLoan::updateStatusClassLoan');
$routes->post('/EndCLassLoan', 'ClassLoan::EndCLassLoan');
$routes->post('/sendNotesLoan', 'ClassLoan::sendNotesLoan');
$routes->post('/exportExcel', 'ClassLoan::exportExcel');

$routes->get('/Organization', 'Organization::index');
$routes->post('/callDataJsonOrg', 'Organization::dataJson');
$routes->post('/getLeader', 'Organization::getLeader');

$routes->post('/getNipEmp', 'Organization::getPgwId');
$routes->post('/addOrg', 'Organization::insertOrg');
$routes->post('/OrgDelete', 'Organization::deleteOrg');
$routes->post('/modalEditOrg', 'Organization::modalEdit');
$routes->post('/orgEdit', 'Organization::editOrg');

$routes->post('/OrgPerUp', 'Organization::upPerOrg');

$routes->post('Siak/ApiUpdateSchedule', 'Api::createBatch');

$routes->get('/Student', 'Student::index');
$routes->post('/callDataJsonStudent', 'Student::dataJson');
$routes->post('/upPerStuent', 'Student::upPerStuent');





