<?php
require_once('TCPDF/tcpdf.php');

if (isset($_GET['data'])) {
    $applicationContactInformationData = json_decode($_GET['data'], true);

    //Create a new TCPDF object(Damodaran,2013)
    $pdf = new TCPDF('L');

    //Remove the default header and footer(Damodaran,2013)
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    //Initialize the PDF content(Damodaran,2013)
    $pdfContent = '';

    //Define the table headers(Damodaran,2013)
    $pdfContent .= '<h1 style="text-align: center"></h1>';
    $pdfContent .= '<p style="text-align: center;"><img src="Images/DaycareLogo.jpg" alt="Logo" style="width: 400px;"></p>';
    $pdfContent .= '<br><br><br><br><br><br><br><br><br><br><br><br><h1 style="text-align: center">Parent Contacts Report</h1>';
    $pdfContent .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black;">';
    $pdfContent .= '<tr>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Child Name</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian One Name</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian One(Home)</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian One(Work)</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian One(Cell)</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian Two Name</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian Two(Home)</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian Two(Work)</th>';
    $pdfContent .= '<th style="width: 11.20%; border: 1px solid black; font-weight: bold;">Guardian Two(Cell)</th>';
    $pdfContent .= '</tr>';

    //Loop through the application contact information array and generate a table for each entry(Damodaran,2013)
    foreach ($applicationContactInformationData as $contactInfo) {
        $pdfContent .= '<tr>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['child_name'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_one_name'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_one_home_tel'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_one_work_tel'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_one_cellphone'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_two_name'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_two_home_tel'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_two_work_tel'] . '</td>';
        $pdfContent .= '<td style="border: 1px solid black;">' . $contactInfo['guardian_two_cellphone'] . '</td>';
        $pdfContent .= '</tr>';
    }

    $pdfContent .= '</table>';

    //Add a new page for each set of contact details(Damodaran,2013)
    $pdf->AddPage();
    $pdf->writeHTML($pdfContent, true, false, true);

    //Output the PDF as a download
    $pdf->Output('Parent_contacts_report.pdf', 'D');
}
?>
