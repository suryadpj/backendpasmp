<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>vCard - {{ $page->member_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
        @import url('https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700');

        body {
            font-family: 'Open Sans', sans-serif;
        }

        *:hover {
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
        }

        section {
            float: left;
            width: 100%;
            background: #fff;
            /* fallback for old browsers */
            padding: 30px 0;
        }
        .vcard {
            display: inline-block;
            font-size: 16px;
            color: #006da0;
            text-align: center;
            border: 1px solid #006da0;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .vcard i:hover {
            background-color: #006da0;
            color: #fff;
        }

        h1 {
            float: left;
            width: 100%;
            color: #232323;
            margin-bottom: 30px;
            font-size: 14px;
        }

        h1 span {
            font-family: 'Libre Baskerville', serif;
            display: block;
            font-size: 45px;
            text-transform: none;
            margin-bottom: 20px;
            margin-top: 30px;
            font-weight: 700
        }

        h1 a {
            color: #131313;
            font-weight: bold;
        }

        /*Profile Card 1*/
        .profile-card-1 {
            font-family: 'Open Sans', Arial, sans-serif;
            position: relative;
            float: left;
            overflow: hidden;
            width: 100%;
            color: #ffffff;
            text-align: center;
            height: 368px;
            border: none;
            padding: 38px 10px;
        }

        .profile-card-1 .background {
            width: 100%;
            vertical-align: top;
            opacity: 0.9;
            -webkit-filter: blur(5px);
            filter: blur(5px);
            -webkit-transform: scale(1.3);
            transform: scale(2.8);
        }

        .profile-card-1 .card-content {
            width: 100%;
            padding: 15px 25px;
            position: absolute;
            left: 0;
            top: 50%;
        }

        .profile-card-1 .profile {
            border-radius: 50%;
            position: absolute;
            bottom: 50%;
            left: 50%;
            max-width: 100px;
            opacity: 1;
            box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(255, 255, 255, 1);
            -webkit-transform: translate(-50%, 0%);
            transform: translate(-50%, 0%);
        }

        .profile-card-1 h2 {
            margin: 0 0 5px;
            font-weight: 600;
            font-size: 25px;
        }

        .profile-card-1 h2 small {
            display: block;
            font-size: 15px;
            margin-top: 10px;
        }

        .profile-card-1 i {
            display: inline-block;
            font-size: 16px;
            color: #ffffff;
            text-align: center;
            border: 1px solid #fff;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .profile-card-1 .icon-block {
            float: left;
            width: 100%;
            margin-top: 5px;
        }

        .profile-card-1 .icon-block a {
            text-decoration: none;
        }

        .profile-card-1 i:hover {
            background-color: #fff;
            color: #2E3434;
            text-decoration: none;
        }

        /*Profile card 2*/
        .profile-card-2 .card-img-block {
            float: left;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }

        .profile-card-2 .card-body {
            position: relative;
        }

        .profile-card-2 .profile {
            border-radius: 50%;
            position: absolute;
            top: -50px; /*-42px;*/
            left: 15%;
            max-width: 75px;
            border: 3px solid rgba(255, 255, 255, 1);
            -webkit-transform: translate(-50%, 0%);
            transform: translate(-50%, 0%);
        }

        .profile-card-2 h5 {
            font-weight: 600;
            color: #006da0;
        }

        .profile-card-2 .card-text {
            font-weight: 300;
            font-size: 15px;
        }

        .profile-card-2 .icon-block {
            float: left;
            width: 100%;
        }

        .profile-card-2 .icon-block a {
            text-decoration: none;
        }


        /*Profile Card 3*/
        .profile-card-3 {
            font-family: 'Open Sans', Arial, sans-serif;
            position: relative;
            float: left;
            overflow: hidden;
            width: 100%;
            text-align: center;
            height: 368px;
            border: none;
        }

        .profile-card-3 .background-block {
            float: left;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        .profile-card-3 .background-block .background {
            width: 100%;
            vertical-align: top;
            opacity: 0.9;
            -webkit-filter: blur(0.5px);
            filter: blur(0.5px);
            -webkit-transform: scale(1.8);
            transform: scale(2.8);
        }

        .profile-card-3 .card-content {
            width: 100%;
            padding: 15px 25px;
            color: #232323;
            float: left;
            background: #efefef;
            height: 50%;
            border-radius: 0 0 5px 5px;
            position: relative;
            z-index: 9999;
        }

        .profile-card-3 .card-content::before {
            content: '';
            background: #efefef;
            width: 120%;
            height: 100%;
            left: 11px;
            bottom: 51px;
            position: absolute;
            z-index: -1;
            transform: rotate(-13deg);
        }

        .profile-card-3 .profile {
            border-radius: 50%;
            position: absolute;
            bottom: 50%;
            left: 50%;
            max-width: 100px;
            opacity: 1;
            box-shadow: 3px 3px 20px rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(255, 255, 255, 1);
            -webkit-transform: translate(-50%, 0%);
            transform: translate(-50%, 0%);
            z-index: 99999;
        }

        .profile-card-3 h2 {
            margin: 0 0 5px;
            font-weight: 600;
            font-size: 25px;
        }

        .profile-card-3 h2 small {
            display: block;
            font-size: 15px;
            margin-top: 10px;
        }

        .profile-card-3 i {
            display: inline-block;
            font-size: 16px;
            color: #232323;
            text-align: center;
            border: 1px solid #232323;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .profile-card-3 .icon-block {
            float: left;
            width: 100%;
            margin-top: 15px;
        }

        .profile-card-3 .icon-block a {
            text-decoration: none;
        }

        .profile-card-3 i:hover {
            background-color: #232323;
            color: #fff;
            text-decoration: none;
        }


        /*Profile card 4*/
        .profile-card-4 .card-img-block {
            float: left;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }

        .profile-card-4 .card-body {
            position: relative;
        }

        .profile-card-4 .profile {
            border-radius: 50%;
            position: absolute;
            top: -62px;
            left: 50%;
            width: 100px;
            border: 3px solid rgba(255, 255, 255, 1);
            margin-left: -50px;
        }

        .profile-card-4 .card-img-block {
            position: relative;
        }

        .profile-card-4 .card-img-block>.info-box {
            position: absolute;
            background: rgba(217, 11, 225, 0.6);
            width: 100%;
            height: 100%;
            color: #fff;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            -webkit-transition: 1s ease;
            transition: 1s ease;
            opacity: 0;
        }

        .profile-card-4 .card-img-block:hover>.info-box {
            opacity: 1;
            -webkit-transition: all 1s ease;
            transition: all 1s ease;
        }

        .profile-card-4 h5 {
            font-weight: 600;
            color: #d90be1;
        }

        .profile-card-4 .card-text {
            font-weight: 300;
            font-size: 15px;
        }

        .profile-card-4 .icon-block {
            float: left;
            width: 100%;
        }

        .profile-card-4 .icon-block a {
            text-decoration: none;
        }

        .profile-card-4 i {
            display: inline-block;
            font-size: 16px;
            color: #d90be1;
            text-align: center;
            border: 1px solid #d90be1;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .profile-card-4 i:hover {
            background-color: #d90be1;
            color: #fff;
        }

        /*Profile Card 5*/
        .profile-card-5 {
            margin-top: 20px;
        }

        .profile-card-5 .btn {
            border-radius: 2px;
            text-transform: uppercase;
            font-size: 12px;
            padding: 7px 20px;
        }

        .profile-card-5 .card-img-block {
            width: 91%;
            margin: 0 auto;
            position: relative;
            top: -20px;

        }

        .profile-card-5 .card-img-block img {
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.63);
        }

        .profile-card-5 h5 {
            color: #4E5E30;
            font-weight: 600;
        }

        .profile-card-5 p {
            font-size: 14px;
            font-weight: 300;
        }

        .profile-card-5 .btn-primary {
            background-color: #4E5E30;
            border-color: #4E5E30;
        }

        .text-gray {
            --bs-text-opacity: 1;
            --bs-gray-rgb: 143, 150, 158;
            color: rgba(var(--bs-gray-rgb),var(--bs-text-opacity)) !important;
        }

        .fs-7 {
            font-size: 14px !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
</head>

<body>

    <section>
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-4">
                    <div class="card profile-card-1">
                        <img src="https://images.unsplash.com/photo-1422393462206-207b0fbd8d6b?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1000&q=80"
                            alt="profile-sample1" class="background" />
                        <img src="https://media.licdn.com/dms/image/C4E03AQERYdtGdu1Tqw/profile-displayphoto-shrink_200_200/0/1616079371066?e=1719446400&v=beta&t=WrUlKk6tNLWIVII3GDPfyXHrMYkjfyR5O2w6D4Nr-0s"
                            alt="profile-image" class="profile" />
                        <div class="card-content">
                            <h2>Bekir BAYAR<small>Engineer</small></h3>
                                <div class="icon-block"><a href="#"><i class="fa fa-facebook"></i></a><a
                                        href="#"> <i class="fa fa-twitter"></i></a><a href="#"> <i
                                            class="fa fa-google-plus"></i></a>
                                </div>
                        </div>
                    </div>
                    <p class="mt-3 w-100 float-left text-center"><strong>Basic Profile Card</strong></p>
                </div> --}}

                <div class="col-md-8 mx-auto">
                    <div class="card profile-card-2">
                        <div class="card-img-block">
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1536532184021-da5392b55da1?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1000&q=80"
                                alt="Card image">
                        </div>
                        <div class="card-body pt-5">
                            <img src="{{ asset('storage/images/'.$page->member_photo) }}" alt="profile-image"
                                class="profile" />
                            <h5 class="card-title">{{ $page->member_name }}</h5>
                            <div id="description" class="fs-10 mt-1">
                                {{ $page->member_title }} - PT. Angkasa Pura Suport
                            </div>
                            <div class="bg-white rounded">
                                <div class="overflow-hidden p-3 text-break">

                                    <div class="text-gray fs-7 mt-3">
                                        <img src="{{ asset('svg/telephone.svg') }}" width="12" height="12" class="me-2 mb-1" />
                                        Phone
                                    </div>
                                    <div class="mb-1"><a class="text-decoration-none" href="tel:{{ $page->member_phone }}"
                                            style="color: #1D2250">{{ $page->member_phone }}</a></div>
                                    <div class="text-gray fs-7 mt-3">
                                        <img src="{{ asset('svg/envelope.svg') }}" width="12" height="12" class="me-2 mb-1" />
                                        Email
                                    </div>
                                    <div class="mb-1"><a class="text-decoration-none"
                                            href="mailto:{{ $page->member_email }}"
                                            style="color: #1D2250">{{ $page->member_email }}</a></div>
                                    <div class="text-gray fs-7 mt-3">
                                        <img src="{{ asset('svg/geo-alt.svg') }}" width="12" height="12" class="me-2 mb-1" />
                                        Address
                                    </div>
                                    <div class="row">
                                        <div style="color: #1D2250" class="col-md-8">{{ $page->address }}</div>
                                        <div style="color: #1D2250" class="col-md-12">
                                            <a role="button" href="https://maps.google.com/?q=sainath tower" target="_blank"
                                            class="btn btn-outline-primary mt-2 col-4">View on map</a>
                                        </div>
                                    </div>
                                    <div class="text-gray fs-7 mt-3" style="color: #1D2250">
                                        <img src="{{ asset('svg/globe.svg') }}" width="12" height="12" class="me-2 mb-1" />
                                        Website
                                    </div>
                                    <div class="mb-1">
                                        <a class="text-decoration-none" href="{{ $page->website }}"
                                            style="color: #1D2250">{{ $page->website }}</a>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="mr-auto p-2">
                                        <a href="{{ url($page->ig_account) }}" target="_blank"><i class="fa fa-instagram vcard mb-2"></i></a>
                                        {{-- <a href="{{ url($page->linkedin_account) }}" target="_blank"> <i class="fa fa-linkedin vcard mb-2"></i></a> --}}
                                    </div>
                                    <div>
                                        {{-- <span style="display: none;" id="vcardName">{{ $page->member_name }}</span>                             --}}
                                        <a role="button" href="javascript:void(0)" onclick="generateVCF()"
                                            class="btn btn-outline-primary mb-2"><i class="fa fa-vcard"></i> vCard</a>
                                            <a role="button" href="{{ $page->compro }}" target="_blank"
                                                class="btn btn-outline-primary mb-2"><i class="fa fa-vcard"></i> Company Profile</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Profile Card 3-->
                    {{-- <div class="col-md-4">
                    <div class="card profile-card-3">
                        <div class="background-block">
                            <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940"
                                alt="profile-sample1" class="background" />
                        </div>
                        <div class="profile-thumb-block">
                            <img src="https://randomuser.me/api/portraits/men/78.jpg" alt="profile-image"
                                class="profile" />
                        </div>
                        <div class="card-content">
                            <h2>Justin Tim<small>Designer</small></h3>
                                <div class="icon-block"><a href="#"><i class="fa fa-facebook"></i></a><a
                                        href="#"> <i class="fa fa-twitter"></i></a><a href="#"> <i
                                            class="fa fa-google-plus"></i></a>
                                </div>
                        </div>
                    </div>
                    <p class="mt-3 w-100 float-left text-center"><strong>Modren Profile Card</strong></p>
                </div> --}}

                    <!--Profile Card 4-->
                    {{-- <div class="col-md-4 mt-4">
                    <div class="card profile-card-4">
                        <div class="card-img-block">
                            <div class="info-box">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod
                                tempor incididunt ut labore et dolore magna aliqua.</div>
                            <img class="img-fluid"
                                src="https://images.unsplash.com/photo-1458668383970-8ddd3927deed?dpr=1&auto=format&crop=entropy&fit=crop&w=1500&h=1004&q=80"
                                alt="Card image cap">
                        </div>
                        <div class="card-body pt-5">
                            <img src="https://randomuser.me/api/portraits/women/84.jpg" alt="profile-image"
                                class="profile" />
                            <h5 class="card-title text-center">Hannah McCall</h5>
                            <p class="card-text text-center">Some quick example text to build on the card title and make
                                up
                                the bulk of the card's content.</p>
                            <div class="icon-block text-center"><a href="#"><i class="fa fa-facebook"></i></a><a
                                    href="#">
                                    <i class="fa fa-twitter"></i></a><a href="#"> <i
                                        class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 w-100 float-left text-center"><strong>Info block with hover</strong></p>
                </div>

                <!--Profile Card 5-->
                <div class="col-md-4 mt-4">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img class="card-img-top" src="https://images.unsplash.com/photo-1517832207067-4db24a2ae47c"
                                alt="Card image cap">
                        </div>
                        <div class="card-body pt-0">
                            <h5 class="card-title">Florence Pink</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the card's content.</p>
                        </div>
                    </div>
                    <p class="mt-3 w-100 float-left text-center"><strong>Card with Floting Picture</strong></p>
                </div> --}}

                </div>
            </div>
    </section>

    <script>
        function getLightOrBlackColor(lightColor, darkColor) {
            const color = "#151856"
            const hex = color.replace("#", "");
            const c_r = parseInt(hex.substr(0, 2), 16);
            const c_g = parseInt(hex.substr(2, 2), 16);
            const c_b = parseInt(hex.substr(4, 2), 16);
            const brightness = (c_r * 299 + c_g * 587 + c_b * 114) / 1000;
            return brightness > 155 ? darkColor : lightColor;
        }
        const vcardName = document.querySelector("#vcardName");
        const descriptions = document.querySelectorAll("#description");
        vcardName.style.color = getLightOrBlackColor("#FFFFFF", "#3E4957");
        descriptions.forEach(item => item.style.color = getLightOrBlackColor("#FFFFFF", "#8B929A"));

        function generateVCF() {

            var vcfContent = 'BEGIN:VCARD\n';
            vcfContent += 'VERSION:3.0\n';
            vcfContent += 'REV:2023-09-18T07:56:50Z\n';
            vcfContent += 'N;CHARSET=utf-8:{{ $page->member_name }};;;;\n';
            vcfContent += 'FN;CHARSET=utf-8:{{ $page->member_name }}\n';
            vcfContent += 'TEL;PREF:{{ $page->member_phone }}\n';
            vcfContent += 'EMAIL;INTERNET:{{ $page->member_email }}\n';
            vcfContent += 'TITLE;CHARSET=utf-8:{{ $page->member_title }}\n';
            vcfContent += 'ORG;CHARSET=utf-8:PT Angkasa Pura Suport\n';
            vcfContent += 'ADR;WORK;POSTAL;CHARSET=utf-8:;{{ $page->address }};;;;;\n';
            vcfContent += 'URL:{{ $page->website }}\n';
            vcfContent += 'END:VCARD';

            // Create a Blob containing the VCF content
            var blob = new Blob([vcfContent], {
                // type: 'text/plain'
                type: 'text/vcard'
            });

            // Create a temporary link element to trigger the download
            var link = document.createElement('a');
            link.download = ' {{ $page->member_name }}.vcf';
            link.href = URL.createObjectURL(blob);
            link.click();
        }
    </script>
</body>

</html>
