<?php
require_once('TCPDF/tcpdf.php');

if (isset($_GET['data'])) {
    $applicationChildrenInformationData = json_decode($_GET['data'], true);

    //Create a new TCPDF object(Damodaran,2013)
    $pdf = new TCPDF();

    //Remove the default header and footer(Damodaran,2013)
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    //Initialize the PDF content(Damodaran,2013)
    $childrenContent = '';

    //Define the table headers(Damodaran,2013)
    $childrenContent .= '<h1 style="text-align: center"></h1>';
    $childrenContent .= '<p style="text-align: center;"><img src="Images/DaycareLogo.jpg" alt="Logo" style="width: 400px;"></p>';
    $childrenContent .= '<br><br><br><br><br><br><br><br><br><br><br><br><h1 style="text-align: center">Children Report</h1>';
    $childrenContent .= '<table style="width: 100%; border-collapse: collapse; border: 1px solid black;">';
    $childrenContent .= '<tr>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Care Type</th>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Child ID</th>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Child DOB</th>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Child Age</th>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Home Language</th>';
    $childrenContent .= '<th style="width: 16.66%; border: 1px solid black; font-weight: bold;">Religion</th>';
    $childrenContent .= '</tr>';

    //Loop through the application children information array and generate a table for each entry(Damodaran,2013)
    foreach ($applicationChildrenInformationData as $childrenInfo) {
        $childrenContent .= '<tr>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['care_type'] . '</td>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['child_id'] . '</td>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['child_dob'] . '</td>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['child_age'] . '</td>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['home_language'] . '</td>';
        $childrenContent .= '<td style="border: 1px solid black;">' . $childrenInfo['religion'] . '</td>';
        $childrenContent .= '</tr>';
    }

    $childrenContent .= '</table>';

    //Add a new page for each set of children details(Damodaran,2013)
    $pdf->AddPage();
    $pdf->writeHTML($childrenContent, true, false, true);

    //Output the PDF as a download(Damodaran,2013)
    $pdf->Output('Children_report.pdf', 'D');
}
?>
