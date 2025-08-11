<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
            /* jika kamu ingin mencegah scroll sama sekali */
        }

        #navv {
            /* margin-left: 240px; */
            background: #153E76;
            color: wheat;
            width: 100%;
            padding: 10px 20px;
            transition: margin-left 0.3s ease;
        }



        #isinavbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #side-left {
            margin-top: 12px;
            display: flex;
            color: white;
            justify-content: space-between;
            padding: 12px 16px;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-right {
            display: flex;
            flex-direction: row;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            padding-right: 20px;
            gap: 10px;
        }

        .nav-title {
            margin: 0;
            color: wheat;
        }

        #hamburgerBtn {
            font-size: 24px;
            background: none;
            border: none;
            color: wheat;
        }

        #sidebar {
            width: 240px;
            background: #31373e;
            font-size: 14px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
        }



        #menusidebar {
            margin-top: 4px;
            padding: 16px 18px 16px 16px;
            font-size: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .menu-item {
            display: block;
            /* biar a bisa lebar penuh */
            padding: 10px 16px;
            color: white;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.2s ease;
            border-radius: 10px;
            text-decoration: none;
        }

        .menu-item:hover {
            background-color: #ebecec;
            color: black;
            transition: 0.2s ease-in-out;
        }

        .menu-label {
            padding: 10px 16px;
            font-weight: bold;
            color: #ccc;
            /* atau warna lain agar terlihat bukan tombol */
            cursor: default;
        }

        #menu-surat>div:not(:first-child) {
            padding-left: 16px;
        }

        #menu-logistik>div:not(:first-child) {
            padding-left: 16px;
        }

        #isinavbar>h3 {
            margin-left: 32px;
            margin-top: 8px;
        }

        #main-content {
            margin-left: 240px;
            transition: margin-left 0.3s ease;
        }

        .dashboard-menu {
            background: #153E76;
            width: 100%;
            height: 100vh;
        }

        #dashmenu-item {
            background: #153E76;
            display: flex;
            flex-direction: row;
            padding: 20px 30px;
            flex-wrap: wrap;
            /* agar baris baru otomatis jika sempit */
            gap: 20px;
        }

        .dash-list {
            background: #00529c;
            color: white;
            border-radius: 12px;
            padding: 10px 10px 12px 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            flex: 1;
            /* biar semua elemen berbagi ruang sama rata */
            min-width: 220px;
            /* agar tidak terlalu kecil saat layar sempit */
            height: 180px;
            /* atur sesuai seberapa "memanjang" yang kamu mau */

        }

        .dash-list-inmail {
            background: rgba(255, 255, 255, 0.8);
            /* Warna putih transparan */
            backdrop-filter: blur(2000px);
            /* Efek blur di belakang */
            -webkit-backdrop-filter: blur(1000px);
            /* Untuk Safari */
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(163, 157, 157, 0.74));
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.98);
            /* Opsional, biar lebih pop */
            color: black;
            border-radius: 12px;
            padding: 10px 10px 12px 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 8px;
            flex: 1;
            /* biar semua elemen berbagi ruang sama rata */
            min-width: 220px;
            /* agar tidak terlalu kecil saat layar sempit */
            height: 180px;
            /* atur sesuai seberapa "memanjang" yang kamu mau */

        }

        .dash-list-outmail {
            background: rgba(255, 255, 255, 0.8);
            /* Warna putih transparan */
            backdrop-filter: blur(2000px);
            /* Efek blur di belakang */
            -webkit-backdrop-filter: blur(1000px);
            /* Untuk Safari */
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(163, 157, 157, 0.74));
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.98);
            /* Opsional, biar lebih pop */
            color: black;
            border-radius: 12px;
            padding: 10px 10px 12px 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 8px;
            flex: 1;
            /* biar semua elemen berbagi ruang sama rata */
            min-width: 220px;
            /* agar tidak terlalu kecil saat layar sempit */
            height: 180px;
            /* atur sesuai seberapa "memanjang" yang kamu mau */

        }

        .dash-list-inlogistic {
            background: rgba(255, 255, 255, 0.8);
            /* Warna putih transparan */
            backdrop-filter: blur(2000px);
            /* Efek blur di belakang */
            -webkit-backdrop-filter: blur(1000px);
            /* Untuk Safari */
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(163, 157, 157, 0.74));
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.98);
            /* Opsional, biar lebih pop */
            color: black;
            border-radius: 12px;
            padding: 10px 10px 12px 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 8px;
            flex: 1;
            /* biar semua elemen berbagi ruang sama rata */
            min-width: 220px;
            /* agar tidak terlalu kecil saat layar sempit */
            height: 180px;
        }


        .dash-list-outlogistic {
            background: rgba(255, 255, 255, 0.8);
            /* Warna putih transparan */
            backdrop-filter: blur(2000px);
            /* Efek blur di belakang */
            -webkit-backdrop-filter: blur(1000px);
            /* Untuk Safari */
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.8), rgba(163, 157, 157, 0.74));
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.98);
            /* Opsional, biar lebih pop */
            color: black;
            border-radius: 12px;
            padding: 10px 10px 12px 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 8px;
            flex: 1;
            /* biar semua elemen berbagi ruang sama rata */
            min-width: 220px;
            /* agar tidak terlalu kecil saat layar sempit */
            height: 180px;
            /* atur sesuai seberapa "memanjang" yang kamu mau */
        }


        /* Dropdown  */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: #31373e;
            /* background: rgba(255, 255, 255, 1); */
            min-width: 140px;
            font-size: 16px;
            /* box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); */
            z-index: 99;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 8px;
        }

        .dropdown-content a {
            color: #e5e6e8ff;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .dropdown-content a:hover {
            /* background: #31373e; */
            color: #00529c;
            border-radius: 10px;
            transition: 0.2s ease-in-out;
        }

        #dropdownMenuButton {
            /* background: orange; */
            color: black;
        }

        .button-dropdown {
            padding: 8px 22px;
            border: 5px solid #31373e;
            background: none;
            color: #f1f1f1;
            font-weight: 800;
            border-radius: 20px;
        }

        .button-dropdown.dropdown-toggle:hover {
            color: white !important;
        }

        /* Batas Dropdown */


        /*CSS BUTTON */
        .button-list {
            border: none;
            border: #31373e;
            background-color: #31373e;
            color: #ffffffd2;
            padding: 6px 10px 6px 60px;
            border-radius: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: none;
        }

        .button-lihat {
            padding: 6px;
            border-radius: 6px;
            background: #00529c;
            color: white;
            text-decoration: none;
        }

        .button-lihat:hover {
            background: #1ac447;
            color: white;
            transition: 0.2s ease-in-out;
        }

        .button-list:hover {
            color: white;
            background: #153E76;
            transition: 0.3s ease-in-out;
        }

        .button-trash {
            background: none;
            border: none;
            font-size: 16px;
            color: red;
            padding: 6px 10px 6px 10px;
            border-radius: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: none;
        }

        .button-save {
            background: none;
            border: none;
            font-size: 16px;
            color: black;
            padding: 6px 10px 6px 10px;
            border-radius: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: none;
        }

        .button-save:hover {
            background: green;
            color: white;
            transition: 0.2s ease-in-out;
        }

        .button-trash:hover {
            background: red;
            color: white;
            transition: 0.2s ease-in-out;
        }

        .button-delete {
            background-color: #ebecec;
            font-size: 28px;
            color: red;
            padding: 6px 10px 6px 60px;
            border-radius: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-decoration: none;
        }

        .dashboard-button {
            border-bottom: 2px solid black;
            padding: 12px 12px 2px 12px;
            display: flex;
            flex-direction: row;
            gap: 16px;
        }

        .dashboard-button button {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            cursor: pointer;
        }

        .dashboard-button #button-list {
            color: black;
            font-size: 28px;
        }


        .button-send {
            width: 100%;
            border-radius: 10px;
            background: #1ac447;
            color: white;
        }

        .button-send:hover {
            color: white;
            background: green;
            transition: 0.2s ease-in-out;
        }

        .button-ryc {
            background: #00529c;
            text-decoration: none;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-size: 12px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .button-ryc:hover {
            color: white;
            background: red;
            transition: 0.3s ease-in-out;
        }

        #signinbutton {
            font-size: 16px;
            border: none;
            padding: 4px 16px 4px 16px;
            border: #31373e;
            background-color: #00529c;
            color: white;
            border-radius: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        }

        #signinbutton:hover {
            background-color: #00529c;
            border: #31373e;
            border: 2px;
            color: black;
            transition: 0.2s ease-in-out;
        }

        /*-----BATAS CSS BUTTON ----- */

        .dashboard-mailin {
            padding: 10px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .sub-menu {
            padding-bottom: 10px;
        }

        .table-container {
            border: 2px solid #00529c;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            max-height: 350px;
            overflow-x: auto;
            overflow-y: auto;
        }

        /* Sticky header agar tetap terlihat saat scroll */
        .table-container thead th {
            position: sticky;
            top: 0;
            background-color: #00529c;
            color: white;
            z-index: 2;
            padding: 12px;
            box-sizing: border-box;

        }

        .table-container table th,
        .table-container table td {
            padding: 12px;
            border: 1px solid #ddd;
            overflow: auto;
            text-overflow: ellipsis;
            white-space: nowrap;
            vertical-align: middle;
        }


        .inmail {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .outmail {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .stocks {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .list-mailinvent {
            margin-top: 14px;
        }

        .mail-count {
            border: 10px solid #00529c;
            padding: 12px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .form-input {
            border: 6px solid #00529c;
            padding: 12px;
            /* max-height: 550px; */
            overflow-y: auto;
            border-radius: 8px;
        }

        .input-mail {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .list-input {
            padding: 8px 12px;
            border-radius: 10px;
            /* background-color: #00529c; */
            color: black;
            border: 2px solid black;
            cursor: pointer;
        }

        .list-input:focus {
            outline: none;
            border: none;
            box-shadow: 0 0 0 2px #3399ff;
        }


        @media (max-width: 992px) {
            .dash-list {
                flex: 1 1 45%;
                /* 2 per baris */
            }
        }

        @media (max-width: 600px) {
            .dash-list {
                flex: 1 1 100%;
                /* 1 per baris */
            }
        }
    </style>
</head>

<body>