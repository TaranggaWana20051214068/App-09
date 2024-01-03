<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur</title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="./plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: "Roboto", sans-serif !important;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: left;
            background-color: #F3F3F9;
        }

        .div {
            border: 1px solid #000;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px 16px;
        }

        .div-2 {
            color: #000;
            text-align: center;
            white-space: nowrap;
            justify-content: center;
            border: 1px solid #000;
            background-color: #fff;
            padding: 5px 16px;
        }

        @media (max-width: 991px) {
            .div-2 {
                white-space: initial;
            }
        }

        .div-3 {
            align-self: stretch;
            display: flex;
            margin-top: 19px;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 0 2px;
        }

        @media (max-width: 991px) {
            .div-3 {
                max-width: 100%;
                flex-wrap: wrap;
            }
        }

        .div-4 {
            align-items: center;
            display: flex;
            gap: 2px;
            margin: auto 0;
        }

        .img {
            aspect-ratio: 1.21;
            object-fit: contain;
            object-position: center;
            width: 80px;
            overflow: hidden;
            max-width: 100%;
            margin: auto 0;
        }

        .div-5 {
            justify-content: center;
            align-self: stretch;
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-6 {
            color: #000;
            text-align: center;
        }

        .div-7 {
            color: #000;
            text-align: center;
            white-space: nowrap;
        }

        @media (max-width: 991px) {
            .div-7 {
                white-space: initial;
            }
        }

        .div-8 {
            color: #000;
            text-align: center;
            white-space: nowrap;
        }

        @media (max-width: 991px) {
            .div-8 {
                white-space: initial;
            }
        }

        .div-9 {
            color: #000;
            text-align: center;

        }

        .div-10 {
            align-self: stretch;
            display: flex;
            justify-content: space-between;
            gap: 2px;
        }

        .div-11 {
            justify-content: center;
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-12 {
            justify-content: space-between;
            display: flex;
            gap: 20px;
        }

        .div-13 {
            color: #000;
            text-align: center;

        }

        .div-14 {
            color: #000;
            text-align: center;

        }

        .div-15 {
            justify-content: space-between;
            display: flex;
            margin-top: 5px;
            gap: 20px;
        }

        .div-16 {
            color: #000;
            text-align: center;

        }

        .div-17 {
            color: #000;
            text-align: center;

        }

        .div-18 {
            justify-content: space-between;
            display: flex;
            margin-top: 5px;
            gap: 15px;
        }

        .div-19 {
            color: #000;
            text-align: center;

        }

        .div-20 {
            color: #000;
            text-align: center;

        }

        .div-21 {
            justify-content: space-between;
            display: flex;
            margin-top: 5px;
            gap: 20px;
        }

        .div-22 {
            color: #000;
            text-align: center;

        }

        .div-23 {
            color: #000;
            text-align: center;

        }

        .div-24 {
            align-self: start;
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-25 {
            color: #000;
            text-align: center;

        }

        .div-26 {
            color: #000;
            text-align: center;
            margin-top: 11px;

        }

        .div-27 {
            color: #000;
            text-align: center;
            margin-top: 11px;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-27 {
                white-space: initial;
            }
        }

        .div-28 {
            color: #000;
            text-align: center;
            margin-top: 9px;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-28 {
                white-space: initial;
            }
        }

        .div-29 {
            border: 1px solid #000;
            background-color: #fff;
            align-self: stretch;
            display: flex;
            margin-top: 38px;
            flex-direction: column;
            padding: 10px 0;
        }

        @media (max-width: 991px) {
            .div-29 {
                max-width: 100%;
            }
        }

        .div-30 {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        @media (max-width: 991px) {
            .div-30 {
                max-width: 100%;
                flex-wrap: wrap;
            }
        }

        .div-31 {
            display: flex;
            justify-content: space-between;
            gap: 14px;
        }

        .div-32 {
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-33 {
            display: flex;
            justify-content: space-between;
            gap: 19px;
        }

        .div-34 {
            color: #000;
            text-align: center;

        }

        .div-35 {
            color: #000;
            text-align: center;

        }

        .div-36 {
            color: #000;
            text-align: center;
            margin-top: 16px;

        }

        .div-37 {
            color: #000;
            text-align: center;
            margin-top: 20px;

        }

        .div-38 {
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
            align-items: end;
        }

        .div-39 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-39 {
                white-space: initial;
            }
        }

        .div-40 {
            color: #000;
            text-align: center;
            align-self: stretch;
            margin-top: 16px;

        }

        .div-41 {
            color: #000;
            text-align: center;
            align-self: stretch;
            margin-top: 18px;

        }

        .div-42 {
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-43 {
            display: flex;
            padding-right: 17px;
            justify-content: space-between;
            gap: 20px;
        }

        .div-44 {
            display: flex;
            flex-direction: column;
        }

        .div-45 {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .div-46 {
            color: #000;
            text-align: center;

        }

        .div-47 {
            color: #000;
            text-align: center;
            align-self: start;

        }

        .div-48 {
            display: flex;
            margin-top: 15px;
            justify-content: space-between;
            gap: 20px;
        }

        .div-49 {
            color: #000;
            text-align: center;

        }

        .div-50 {
            color: #000;
            text-align: center;

        }

        .div-51 {
            display: flex;
            flex-direction: column;
        }

        .div-52 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-52 {
                white-space: initial;
            }
        }

        .div-53 {
            color: #000;
            text-align: center;
            margin-top: 16px;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-53 {
                white-space: initial;
            }
        }

        .div-54 {
            display: flex;
            margin-top: 20px;
            width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        .div-55 {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .div-56 {
            color: #000;
            text-align: center;

        }

        .div-57 {
            color: #000;
            text-align: center;
            align-self: center;
            margin: auto 0;

        }

        .div-58 {
            color: #000;
            text-align: center;
            align-self: center;
            margin: auto 0;

        }

        .div-59 {
            background-color: #000;
            margin-top: 58px;
            height: 2px;
        }

        @media (max-width: 991px) {
            .div-59 {
                max-width: 100%;
                margin-top: 40px;
            }
        }

        .div-60 {
            display: flex;
            margin-top: 8px;
            padding-right: 9px;
            align-items: start;
            justify-content: space-between;
            gap: 20px;
        }

        @media (max-width: 991px) {
            .div-60 {
                max-width: 100%;
                flex-wrap: wrap;
            }
        }

        .div-61 {
            display: flex;
            flex-direction: column;
        }

        .div-62 {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        .div-63 {
            color: #000;
            text-align: center;

        }

        .div-64 {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 4px;
        }

        .div-65 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-65 {
                white-space: initial;
            }
        }

        .div-66 {
            color: #000;
            text-align: center;
            align-self: stretch;
            flex-grow: 1;
            white-space: nowrap;
            font: 700 12px Inter, sans-serif;
        }

        @media (max-width: 991px) {
            .div-66 {
                white-space: initial;
            }
        }

        .div-67 {
            display: flex;
            margin-top: 7px;
            justify-content: space-between;
            gap: 20px;
        }

        .div-68 {
            color: #000;
            text-align: center;

        }

        .div-69 {
            color: #000;
            text-align: center;
            align-self: start;

        }

        .div-70 {
            align-self: stretch;
            display: flex;
            flex-direction: column;
            align-items: start;
        }

        .div-71 {
            align-self: stretch;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .div-72 {
            color: #000;
            text-align: center;
            flex: 1;

        }

        .div-73 {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 5px;
        }

        .div-74 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-74 {
                white-space: initial;
            }
        }

        .div-75 {
            color: #000;
            text-align: center;

        }

        .div-76 {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin: 11px 0 0 36px;
        }

        @media (max-width: 991px) {
            .div-76 {
                margin-left: 10px;
            }
        }

        .div-77 {
            color: #000;
            text-align: center;

        }

        .div-78 {
            color: #000;
            text-align: center;
            align-self: start;

        }

        .div-79 {
            align-self: stretch;
            display: flex;
            margin-top: 7px;
            padding-right: 28px;
            justify-content: space-between;
            gap: 20px;
        }

        @media (max-width: 991px) {
            .div-79 {
                padding-right: 20px;
            }
        }

        .div-80 {
            color: #000;
            text-align: center;
            align-self: center;
            margin: auto 0;

        }

        .div-81 {
            color: #000;
            text-align: center;
            align-self: center;
            margin: auto 0;

        }

        .div-82 {
            display: flex;
            flex-grow: 1;
            flex-basis: 0%;
            flex-direction: column;
        }

        .div-83 {
            background-color: #000;
            height: 1px;
        }

        .div-84 {
            color: #000;
            text-align: center;
            align-self: center;
            margin-top: 7px;
            white-space: nowrap;
            font: 700 12px Inter, sans-serif;
        }

        @media (max-width: 991px) {
            .div-84 {
                white-space: initial;
            }
        }

        .div-85 {
            color: #000;
            border: 1px solid #000;
            background-color: #fff;
            align-self: stretch;
            justify-content: center;
            padding: 14px 0;
            font: 400 10px Inter, sans-serif;
        }

        @media (max-width: 991px) {
            .div-85 {
                max-width: 100%;
            }
        }

        .div-86 {
            display: flex;
            margin-top: 14px;
            width: 261px;
            max-width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        .div-87 {
            display: flex;
            flex-direction: column;
        }

        .div-88 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-88 {
                white-space: initial;
            }
        }

        .div-89 {
            color: #000;
            text-align: center;
            margin-top: 43px;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-89 {
                margin-top: 40px;
                white-space: initial;
            }
        }

        .div-90 {
            align-self: start;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .div-91 {
            color: #000;
            text-align: center;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-91 {
                white-space: initial;
            }
        }

        .div-92 {
            color: #000;
            text-align: center;
            align-self: stretch;
            margin-top: 40px;
            white-space: nowrap;

        }

        @media (max-width: 991px) {
            .div-92 {
                white-space: initial;
            }
        }

        .table {
            color: #000;

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="div">
                            <div class="div-2">FAKTUR</div>
                            <div class="div-3">
                                <div class="div-4">
                                    <img loading="lazy" srcset="/images/logo-pb.png" class="img" />
                                    <div class="div-5">
                                        <div class="div-6">PUTRA BAROKAH</div>
                                        <div class="div-7">Jl. Karang Klumprik Utara A/2</div>
                                        <div class="div-8">Wiyung, Surabaya 60223</div>
                                        <div class="div-9">Telp. 08121661972</div>
                                    </div>
                                </div>
                                <div class="div-10">
                                    <div class="div-11">
                                        <div class="div-12">
                                            <div class="div-13">Nomor</div>
                                            <div class="div-14">:</div>
                                        </div>
                                        <div class="div-15">
                                            <div class="div-16">Tanggal</div>
                                            <div class="div-17">:</div>
                                        </div>
                                        <div class="div-18">
                                            <div class="div-19">Pelanggan</div>
                                            <div class="div-20">:</div>
                                        </div>
                                        <div class="div-21">
                                            <div class="div-22">Alamat</div>
                                            <div class="div-23">:</div>
                                        </div>
                                    </div>
                                    <div class="div-24">
                                        <div class="div-25">001</div>
                                        <div class="div-26">22 Nov 2023</div>
                                        <div class="div-27">SMA Katolik St Louis 2 Sby</div>
                                        <div class="div-28">JL. Tidar No 119 Surabaya</div>
                                    </div>
                                </div>
                            </div>
                            <div class="div-29">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>QTY</th>
                                                <th>Harga Sat</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>1</th>
                                                <td>Kolor Tea Shirt For Man</td>
                                                <td><span class="badge badge-primary px-2">Sale</span>
                                                </td>
                                                <td>January 22</td>
                                                <td class="color-primary">$21.56</td>
                                                <td class="color-primary">$21.56</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="div-59"></div>
                                <div class="div-60">
                                    <div class="div-61">
                                        <div class="div-62">
                                            <div class="div-63">TERBILANG</div>
                                            <div class="div-64">
                                                <div class="div-65">:</div>
                                                <div class="div-66">TIGA PULUH JUTA RUPIAH</div>
                                            </div>
                                        </div>
                                        <div class="div-67">
                                            <div class="div-68">KETERANGAN</div>
                                            <div class="div-69">:</div>
                                            <div class="div-69"> Maksud anda apa</div>
                                        </div>
                                    </div>
                                    <div class="div-70">
                                        <div class="div-71">
                                            <div class="div-72">SUB TOTAL</div>
                                            <div class="div-73">
                                                <div class="div-74">:</div>
                                                <div class="div-75">30.000.000</div>
                                            </div>
                                        </div>
                                        <div class="div-76">
                                            <div class="div-77">PPN</div>
                                            <div class="div-78">:</div>
                                        </div>
                                        <div class="div-79">
                                            <div class="div-80">TOTAL</div>
                                            <div class="div-81">:</div>
                                            <div class="div-82">
                                                <div class="div-83"></div>
                                                <div class="div-84">Rp. 30.000.000</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="div-85">
                                <ul>
                                    <li>Barang titipan untuk dijual</li>
                                    <li>pembayaran ditransfer ke</li>
                                </ul>
                                (selain ke rek tsb, pembayaran dianggap
                                <span style="font-weight: 700">TIDAK SAH</span>
                                )
                                <ul>
                                    <li>bukti pembayaran yang sah & faktur adalah asli (putih)</li>
                                </ul>
                            </div>
                            <div class="div-86">
                                <div class="div-87">
                                    <div class="div-88">HORMAT KAMI</div>
                                    <div class="div-89">( )</div>
                                </div>
                                <div class="div-90">
                                    <div class="div-91">PENERIMA</div>
                                    <div class="div-92">( )</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
    <script src="./plugins/moment/moment.js"></script>
</body>

</html>