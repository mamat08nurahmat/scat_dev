<?php
//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
switch($_GET['page'])
{
case "1" :
include_once "home.php";
break;

case "1a" :
include_once "maintenance.php";
break;

case "1b" :
include_once "home_bfp.php";
break;

case "2";
include "print.php";
break;

case "3";
include "management_penyelia.php";
break;

case "3a";
include "management_sco_resign.php";
break;

case "4";
include "tampil_form_realisasi.php";
break;

case "5";
include "tampil_form_performance.php";
break;

case "6";
include "upload-pencapaian.php";
break;

case "6x";
include "upload-pencapaian-koreksi.php";
break;

case "7";
include "upload_data_booking.php";
break;

case "8";
include "data_developer_admin.php";
break;

case "8a";
include "data_developer_sales.php";
break;

case "8b";
include "data_developer_update.php";
break;

case "8c";
include "data_developer_view.php";
break;

case "8d";
include "data-developer.php";
break;

case "8e";
include "report_developer.php";
break;

case "9";
include "laporan-realisasi.php";
break;

case "9a";
include "sales-aktif.php";
break;

case "10";
include "tabel-npp.php";
break;

case "10a";
include "management-sales.php";
break;

case "10b";
include "sales_hiring.php";
break;

case "10c";
include "sales_hiring_form.php";
break;

case "10d";
include "sales_hiring_form_edit.php";
break;

case "10e";
include "data_approve_sgv.php";
break;

case "10f";
include "sales_approve_sgv_form.php";
break;

case "10g";
include "sales_hiring_cari.php";
break;

case "10i";
include "sales_hiring_view.php";
break;

case "10j";
include "sales_approve_view.php";
break;

case "10k";
include "data_approve_sco.php";
break;

case "10l";
include "sales_approve_sco_form.php";
break;

case "10m";
include "data_approve_penyelia.php";
break;

case "10n";
include "sales_approve_penyelia_form.php";
break;

case "11";
include "input_target.php";
break;

case "12";
include "aset-tabel/user/user_form_insert.php";
break;

case "13";
include "aset-tabel/user/user_act_delete.php";
break;

case "14";
include "aset-tabel/user/user_act_update.php";
break;

case "15";
include "aset-tabel/user/user_form_update.php";
break;

case "16";
include "pipeline_input.php";
break;

case "16a";
include "management_pipeline_tl.php";
break;

case "16b";
include "pipeline_update_tl.php";
break;

case "16c";
include "report_data_booking.php";
break;

case "16d";
include "pipeline_update_data.php";
break;

case "16e";
include "pipeline_view.php";
break;

case "19";
include "logout.php";
break;

case "20";
include "generate_performance.php";
break;

case "21";
include "update-type-sales.php";
break;

case "22";
include "management-sales-approve.php";
break;

case "23";
include "management_validasi.php";
break;

case "24";
include "management_vendor.php";
break;

case "25";
include "tampil-leads.php";
break;

case "26";
include "berita.php";
break;

case "27";
include "lihatBerita.php";
break;

case "28";
include "input_pipeline.php";
break;

case "29";
include "upload_leads.php";
break;

case "29a";
include "leads_baru.php";
break;

case "29b";
include "leads_update.php";
break;

case "29c";
include "leads_input_sales.php";
break;

case "29d";
include "leads_store_view.php";
break;

case "29e";
include "leads_cart_view.php";
break;

case "29f";
include "leads_followup_view.php";
break;

case "29g";
include "leads_closing_view.php";
break;

case "29h";
include "leads_expired_view.php";
break;



case "30";
include "fronting_agent_admin.php";
break;

case "30a";
include "fronting_agent_admin_view.php";
break;

case "30b";
include "fronting_agent_admin_edit.php";
break;

case "30c";
include "fronting_agent_tl.php";
break;

case "30d";
include "fronting_agent_tl_view.php";
break;

case "30e";
include "fronting_agent_report.php";
break;


case "31a";
include "upload_tim_leader.php";
break;

case "32";
include "management_tim_leader.php";
break;

case "32a";
include "data_tim_leader_form.php";
break;

case "32b";
include "data_tim_leader_report.php";
break;

case "32c";
include "data_tim_leader_update.php";
break;

case "33";
include "report_tl_baru.php";
break;

case "34";
include "update_grade.php";
break;


case "bucket";
include "demo.php";
break;

case "libur";
include "tanggal_libur.php";
break;

case "35";
include "fronting_agent.php";
break;

default :
include_once "index.php";
break;

}

?>