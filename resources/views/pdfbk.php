<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    @page {
        margin: 0;
      }
    
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      font-size: 12pt;
    }

    .header img {
      width: 100%;
      height: auto;
    }

    .sub-header {
      width: 100%;
      margin-top: 20px;
      padding: 20px 0;
      border-bottom: 1px solid #eee;
    }

    .sub-header-table {
      width: 100%;
    }

    .sub-header-table td {
      vertical-align: top;
    }

    .divider {
      border-left: 2px dotted #333;
      height: 80px;
      width: 1px;
    }

    .content {
      margin-top: 40px;
      padding: 0 20px;
    }

    .custom-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 40px;
    }

    .custom-table thead tr {
      border-top: 2px solid #000;
    }

    .custom-table th,
    .custom-table td {
      padding: 10px;
      text-align: left;
      border-left: none;
      border-right: none;
    }

    .custom-table tr:not(:last-child) {
      border-bottom: 1px dashed #aaa;
    }

    .custom-table th {
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>

  <div class="header">
    <img src="<?=public_path();?>/images/logo-pdf.png" alt="Header Image" />
  </div>

  <div class="sub-header">
    <table class="sub-header-table">
      <tr>
        <td width="45%">
          <h1>QUOTATION</h1>
          <div>No. 000-008<br>January 11, 2025</div>
        </td>
        <td width="10%" align="center">
          <div class="divider"></div>
        </td>
        <td width="45%" align="right">
          <div style="text-transform: uppercase; color: #666; font-size: 0.85em;">Client Information</div>
          <h2>THEVAN</h2>
          <div style="font-size: 0.9em; color: #333;">+6016-5673476<br>23rd Nov 2025<br>8am–1pm</div>
        </td>
      </tr>
    </table>
  </div>

  <div class="content">

    <table class="custom-table">
      <thead>
        <tr>
          <th>Description</th>
          <th>Quantity</th>
          <th>Unit Price</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Item A</td>
          <td>2</td>
          <td>$50</td>
          <td>$100</td>
        </tr>
        <tr>
          <td>Item B</td>
          <td>1</td>
          <td>$75</td>
          <td>$75</td>
        </tr>
        <tr>
          <td>Item C</td>
          <td>3</td>
          <td>$20</td>
          <td>$60</td>
        </tr>
        
        <tr>
          <td>Item A</td>
          <td>2</td>
          <td>$50</td>
          <td>$100</td>
        </tr>
        <tr>
          <td>Item B</td>
          <td>1</td>
          <td>$75</td>
          <td>$75</td>
        </tr>
        <tr>
          <td>Item C</td>
          <td>3</td>
          <td>$20</td>
          <td>$60</td>
        </tr>
        
        
        <tr>
          <td>Item A</td>
          <td>2</td>
          <td>$50</td>
          <td>$100</td>
        </tr>
        <tr>
          <td>Item B</td>
          <td>1</td>
          <td>$75</td>
          <td>$75</td>
        </tr>
        <tr>
          <td>Item C</td>
          <td>3</td>
          <td>$20</td>
          <td>$60</td>
        </tr>
        
        
        <tr>
          <td>Item A</td>
          <td>2</td>
          <td>$50</td>
          <td>$100</td>
        </tr>
        <tr>
          <td>Item B</td>
          <td>1</td>
          <td>$75</td>
          <td>$75</td>
        </tr>
        <tr>
          <td>Item C</td>
          <td>3</td>
          <td>$20</td>
          <td>$60</td>
        </tr>
        
        
        
      </tbody>
    </table>
  </div>

</body>
</html>
