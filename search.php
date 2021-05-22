<!DOCTYPE html>
<html lang="en">

<head>
  <title>Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->

</head>

<body>
  <!-- สร้างช่อง search -->
  <div style="margin-left: 20px; margin-right: 20px;">
    <div><br></div>
    <input type="text" class="form-control" id="search" style="width:1100px;" placeholder="Search">
    <!-- <table class="table table-hover"> -->

    <div>
      <br>
    </div>
    <!-- สร้างหัวตาราง -->
    <table width="1200" border=1>
      <thead>
        <tr>
          <th width="50">
            <div align="center"> invoice_id </div>
          </th>
          <th width="50">
            <div align="center"> company_id </div>
          </th>
          <th width="70">
            <div align="center"> company_format </div>
          </th>
          <th width="120">
            <div align="center"> invoice_number </div>
          </th>
          <th width="150">
            <div align="center"> name </div>
          </th>
          <th width="200">
            <div align="center"> organization </div>
          </th>
          <th width="200">
            <div align="center"> address </div>
          </th>
          <th width="150">
            <div align="center"> email </div>
          </th>
          <th width="150">
            <div align="center"> create_dt </div>
          </th>
          <th width="50">
            <div align="center"> more </div>
        </tr>
      </thead>
      <div>
        <tbody id="output"></tbody>
        </tbody>
      </div>
      
    </table>
<div>
        <br>
        <tbody id="more-table">
        </tbody>
      </div>


    <!-- ทำปุ่มกดหน้า -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- เมื่อเริ่มหา -->
  <script>
    function myFunction1(invoiceId) {
      // alert("Hello! I am an alert box!");
      let obj = {
        //customer_id: customerId,
        id: invoiceId,
        type: "more-button"
      }
      // แปลงเป็นstring
      var json = JSON.stringify(obj);
      $.ajax({
        type: 'POST',
        url: 'searchd1.php',
        dataType: 'json',
        data: {
          "json": json
          // name: $("#search").val(),
        },
        success: function(data) {
          console.log(data);
          var textHtml1 = ""
          textHtml1 = "<table>"
          textHtml1 += "<tr><td> invoice_id </td><td> name </td><td> item_id </td><td> company_id </td><td> description </td><td> price </td><td> total </td></tr>"
          data.forEach((item1) => {

            textHtml1 += "<tr>"

            textHtml1 += "<td>" + item1.invoice_id + "</td><td>" + item1.name + "</td><td>" + item1.item_id + "</td><td>" + item1.company_id + "</td><td>" + item1.description + "</td><td>" + item1.price + "</td><td>" + item1.total + "</td>"

            textHtml1 += "</tr>"

          });

          textHtml1 += "</table>"
          document.getElementById("more-table").innerHTML = textHtml1
        }
      });
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#search").keypress(function() {

        // let number = $('#number').val()
        let name = $("#search").val()

        // เตรียมข้อมูลไว้แปลงเป็นJSON
        let obj = {
          //customer_id: customerId,
          name: name,
          type: "search-input"
        }
        // แปลงเป็นstring
        var json = JSON.stringify(obj);
        $.ajax({
          type: 'POST',
          url: 'searchd1.php',
          dataType: 'json',
          data: {
            "json": json
            // name: $("#search").val(),
          },
          success: function(data) {
            // alert(data);
            // console.log(data);
            var textHtml = ""
            data.forEach((item, index) => {

              textHtml += "<tr>"

              textHtml += "<td>" + item.invoice_id + "</td><td>" + item.company_id + "</td><td>" + item.company_format + "</td><td>" + item.invoice_number + "</td><td>" + item.name + "</td><td>" + item.organization + "</td><td>" + item.address + "</td><td>" + item.email + "</td><td>" + item.create_dt + "</td> <td><button id='btn' name='btn' onclick=myFunction1(" + item.invoice_id + ")> + </button></td>"

              textHtml += "</tr>"

            });
            document.getElementById("output").innerHTML = textHtml
          }
        });
      })
    });
  </script>

</body>

</html>