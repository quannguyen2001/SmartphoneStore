 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- plugins:css -->
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
 <!-- endinject -->
 <!-- Plugin css for this page -->
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/jvectormap/jquery-jvectormap.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
 <!-- End plugin css for this page -->
 <!-- inject:css -->
 <!-- endinject -->
 <!-- Layout styles -->
 <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
 <!-- End layout styles -->
 <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.png') }}" />

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <style type="text/css">
    .h2_font {
       font-size: 40px;
    }

    .menu-select {
       visibility: hidden;
       height: 0;
    }

    .div_center {
       text-align: center;
       padding-top: 10px;
       margin-left: 240px;
    }

    .div_center_product_detail {
       padding-top: 10px;
       margin-left: 240px;
    }

    .div_info {
       text-align: left;
       padding-top: 20px;
       padding-left: 100px;
    }

    .background_info {
       margin-right: 100px;
       padding: 10px;
       background-color: whitesmoke;
       font-size: 30px;
       display: flex;
       gap: 200px;
    }

    .background_info p {
       font-size: 18px !important;
    }

    .center {
       margin: auto;
       max-width: 2000px;
       text-align: center;
       margin-top: 5px;
       overflow-x: auto;

    }

    .center tr:not(:first-child):hover {
       background-color: lightblue;
       /* Màu khi hover */
    }

    .font_size {
       text-align: center;
       font-size: 40px;
       padding-top: 20px;
    }

    .img_size {
       width: 350px;
       height: 120px;
    }

    label {
       display: inline-block;
       width: 200px;
       text-align: left;
    }

    .div_design {
       padding-bottom: 15px;
    }

    input {
       width: 300px;
    }

    select {
       width: 300px;
       height: 53px;
    }

    .th_color {
       background: skyblue;
       color: black;
    }

    .th_deg {
       padding: 20px;
    }

    table {
       background-color: white;
       border: 1px solid black;
    }

    th,
    td {
       border: 1px solid black;
       padding: 8px;
       text-align: center;
    }

    tr:hover:not(:first-child) {
       background-color: lightblue;
       color: blue;
       /* Màu khi hover */
    }

    tr:nth-child(odd) {
       background-color: lightgreen;
       /* Màu cho hàng lẻ */
    }

    tr:nth-child(even) {
       background-color: white;
       /* Màu cho hàng chẵn */
    }

    .img_size {
       width: 100px;
       height: 30px;
    }

    .breadcrumb {
       display: block;
       overflow: hidden;
       padding-left: 20px;
       margin-left: 240px;
       background: #fff;
       line-height: 32px;
       margin-top: 10px;
       margin-bottom: 10px;
       background-color: white;
       font-family: Arial, Helvetica, sans-serif;
    }

    .button {
       padding-bottom: 5px;
    }

    .notification {
       position: fixed;
       top: 80px;
       right: 20px;
       background-color: #4CAF50;
       color: white;
       padding: 15px;
       border-radius: 5px;
       z-index: 9999;
    }

    .alert {
       padding: 20px;
       background-color: #4CAF50;
       color: white;
       position: fixed;
       top: 35px;
       right: 35px;
       width: 250px;
       z-index: 500000;
    }

    .closebtn {
       margin-left: 15px;
       color: white;
       font-weight: bold;
       float: right;
       font-size: 22px;
       line-height: 20px;
       cursor: pointer;
       transition: 0.3s;
    }

    .closebtn:hover {
       color: black;
    }

    .column_content {
       display: flex;
       gap: 150px;
       padding: 10px;
       background-color: lightgreen;
    }

    .content {
       padding: 10px;
       background-color: lightgreen;
    }


    /* Paginate */
    /* .pagination {
       display: flex;
       justify-content: center;
       align-items: center;
       list-style: none;
       margin: 10px 0;
    } */

    /* .active {
       font-size: 25px;

    } */

    /* .pagination .page-item {
       margin: 0 5px;
    }

    .pagination .page-item .page-link {
       padding: 5px 10px;
       border: 2px solid black;
       text-decoration: none;
       color: #333;
       font-weight: bold;
       background-color: lightcyan;
       border-radius: 5px;
    }

    .pagination .page-item .page-link:hover {
       background-color: lightblue;
    } */

    /* Pagination Search*/
    .pagination {
       display: flex;
       justify-content: center;
       align-items: center;
       list-style: none;
       margin: 10px 0;
       background-color: white;
    }
    

    .pagination a {
       display: inline-block;
       margin: 10px 0;
       padding: 10px 15px;
       border-radius: 5px;
       color: #555;

    }

    .pagination a:hover:not(.current) {
       background-color: #ccc;
    }

    .pagination .current {
       color: white;
       background: #0950E8;
    }

    .pagination .page-item .page-link .active{
       padding: 5px 10px;
       border: 2px solid black;
       text-decoration: none;
       color: #333;
       font-weight: bold;
       background-color: lightcyan;
       border-radius: 5px;
    }

    .pagination .active {
       color: white;
       background: #0950E8;
    }

    /* Modal Styles */
    .modal {
       display: none;
       /* Hidden by default */
       position: fixed;
       /* Stay in place */
       z-index: 1;
       /* Sit on top */
       left: 0;
       top: 0;
       width: 100%;
       /* Full width */
       height: 100%;
       /* Full height */
       overflow: auto;
       /* Enable scroll if needed */
       background-color: rgba(0, 0, 0, 0.4);
       /* Black background with opacity */
    }

    .modal-content {
       background-color: #fefefe;
       margin: 15% auto;
       /* 15% from the top and centered */
       padding: 20px;
       border: 1px solid #888;
       width: 40%;
       /* Could be more or less, depending on screen size */
       box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .close {
       color: #aaa;
       float: right;
       font-size: 28px;
       font-weight: bold;
       position: absolute;
       top: 0;
       right: 0;
       margin-top: 5px;
       margin-right: 10px;
    }

    .close:hover,
    .close:focus {
       color: black;
       text-decoration: none;
       cursor: pointer;
    }

    .div_modal_center {
       text-align: center;

    }

    .hidden {
       display: none;
    }

    .div_button_center {
       text-align: center;
       padding-top: 10px;
       margin-left: 240px;
    }

    @media (max-width: 991px) {
       .breadcrumb {
          display: block;
          overflow: hidden;
          padding-left: 20px;
          margin-left: 0;
          background: #fff;
          line-height: 32px;
          margin-bottom: 10px;
          background-color: white;
          font-family: Arial, Helvetica, sans-serif;
       }

       .div_center {
          text-align: center;
          padding-top: 10px;
          margin-left: 0;
       }

       .div_center_product_detail {
          padding-top: 10px;
          margin-left: 0;
       }

       .div_info {
          text-align: left;
          padding-top: 20px;
          padding-left: 10px;
       }

       .background_info {
          margin-right: 10px;
          padding: 10px;
          background-color: whitesmoke;
          font-size: 30px;
          display: flex;
          flex-direction: column;
          gap: 0;
       }

       .menu-select {
          visibility: visible;
          display: flex;
          gap: 5px;
          height: 75px;
          align-items: center;
          font-size: 15px;
       }

       .menu-select-item {
          font-family: Arial, Helvetica, sans-serif;
          border: 1px solid black;
          border-radius: 5px;
          height: 75px;
          padding: 5px;
          text-align: center;
          font-weight: bold;
          color: black;
          background-color: #fff;
       }

       .menu-select-item:hover {
          background-color: lightblue;
          cursor: pointer;
       }
    }

    @media (max-width: 705px){
      .menu-select {
          visibility: visible;
          display: flex;
          gap: 5px;
          height: 95px;
          align-items: center;
          font-size: 15px;
       }

       .menu-select-item {
          font-family: Arial, Helvetica, sans-serif;
          border: 1px solid black;
          border-radius: 5px;
          height: 95px;
          padding: 5px;
          text-align: center;
          font-weight: bold;
          color: black;
          background-color: #fff;
       }
    }

    @media (max-width: 655px) {
       .menu-select {
          visibility: visible;
          display: flex;
          gap: 5px;
          height: 115px;
          align-items: center;
          font-size: 15px;
          margin-bottom: 15px;
          overflow: hidden;
          overflow-x: scroll;

       }

       .menu-select-item {
          height: 115px;
          width: 120px;
       }
    }

    @media (max-width: 460px) {
       .btn-outline-primary {
          margin-top: 5px;
       }
    }

    @media (max-width: 420px) {
       .menu-select {
          visibility: visible;
          display: flex;
          gap: 5px;
          height: 105px;
          align-items: center;
          font-size: 15px;
          margin-bottom: 15px;
          overflow: hidden;
          overflow-x: scroll;
       }

       .menu-select-item {
          height: 105px;

       }


    }
 </style>