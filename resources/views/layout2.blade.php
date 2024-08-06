<!DOCTYPE html>
<html lang="en">

<head>
    <title> vCard {{ $page->member_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/static-page.5af519ebdf.css') }}">
    <script src="{{ asset('js/runtime.7d5326c57b.js') }}" defer></script>
    <script src="{{ asset('js/6708.892c9ff7e0.js') }}" defer></script>
    <script src="{{ asset('js/1001.4e6edec0dc.js') }}" defer></script>
    <script src="{{ asset('js/6468.56f7d32591.js') }}" defer></script>
    <script src="{{ asset('js/231.bd9bee1dc7.js') }}" defer></script>
    <script src="{{ asset('js/9041.334273334d.js') }}" defer></script>
    <script src="{{ asset('js/static-page.b33f6b5ba3.js') }}" defer></script>
    <link rel="icon" type="image/png" href="/favicon.ico">
    <link rel="alternate" type="application/rss+xml" href="https://me-qr.com/feed.rss">
    <meta name="description"
        content="virtual card PT Angkasa pura Suport">
    <meta name="keywords"
        content="aps, apsupports, vcard aps, vcard dirut">
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="https://me-qr.com/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <meta property="og:type" content="website" />
    <meta property="og:locale:alternate" content="es" />
    <meta property="og:locale:alternate" content="pt" />
    <meta property="og:locale:alternate" content="ru" />
    <meta property="og:title" content="VCard" APS />
    <meta property="og:locale" content="en/">
    <meta property="og:description" content="vCard PT. Angkasa Pura Suport" />
    <meta property="og:image" content="images/logo-aps.png">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="canonical" href="https://businesscard.apsupports.com/vcard/public/profile2/{{ $page->slug }}" />
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
    </style>
</head>

<body class="landing-page sidebar-collapse">
    <style type="text/css">
        body {
            padding: 0;
            margin: 0;
            color: #d1d3d4 !important;
            background-color: #d1d3d4 !important;
        }
    </style>
    <div class="container mt-3">
        <div class="col-12 col-lg-8 m-auto">
            <div class="bg-white rounded">
                <div class="d-flex align-items-center p-3 overflow-hidden text-break rounded"
                    style="background: #04b0c0">
                    <div class="col-9">
                        <div id="vcardName" class="fw-bold fs-8">
                            {{ $page->member_name }}
                        </div>
                        <div id="description" class="fs-7 mt-1">
                            {{ $page->member_title }} @if($page->member_second_title) <hr style="margin:0px !important;"> {{ $page->member_second_title }} @endif
                        </div>
                        <div id="description" class="fs-7 mt-1">
                            PT Angkasa Pura Suport
                        </div>
                    </div>
                    <div class="col-3" style="text-align: right;">
                        <div class=" fs-7">
                            <a class="btn btn-outline-info btn-sm" href="{{ url($page->ig_account) }}" target="_blank"><i class="fa fa-instagram vcard"></i></a>
                            {{-- <a class="btn btn-outline-info btn-sm" href="{{ url($page->linkedin_account) }}" target="_blank"> <i class="fa fa-linkedin vcard"></i></a> --}}
                        </div>
                    </div>
                </div>
                <div class="overflow-hidden p-3 text-break">
                    <a href="javascript:void(0)" onclick="generateVCF()" class="fw-bold w-100 text-white btn" style="background: #1D2250">Download vCard</a>

                    <div class="text-gray fs-7 mt-3">
                        <img src="{{ asset('svg/telephone.svg') }}" width="12" height="12" class="me-2 mb-1" />
                        Phone
                    </div>
                    <div class="mb-1"><a class="text-decoration-none" href="tel:{{ $page->member_phone }}" style="color: #1D2250">{{ $page->member_phone }}</a></div>
                    <div class="text-gray fs-7 mt-3">
                        <img src="{{ asset('svg/envelope.svg') }}" width="12" height="12" class="me-2 mb-1" />
                        Email
                    </div>
                    <div class="mb-1"><a class="text-decoration-none"
                            href="mailto:{{ $page->member_email }}" style="color: #1D2250">{{ $page->member_email }}</a></div>
                    <div class="text-gray fs-7 mt-3">
                        <img src="{{ asset('svg/geo-alt.svg') }}" width="12" height="12" class="me-2 mb-1" />
                        Address
                    </div>
                    <div style="color: #1D2250">{{ $page->address }}</div>
                    <a role="button"
                        href="https://maps.google.com/?q=sainath tower"
                        target="_blank" class="text-white btn mt-2" style="background: #1D2250">View on map</a>
                    <div class="text-gray fs-7 mt-3" style="color: #1D2250">
                        <img src="{{ asset('svg/globe.svg') }}" width="12" height="12" class="me-2 mb-1" />
                        Website
                    </div>
                    <div class="mb-1">
                        <a class="text-decoration-none"
                            href="{{ $page->website }}" style="color: #1D2250">{{ $page->website }}</a>
                    </div>
                    <div class="text-gray fs-7 mt-3" style="color: #1D2250">
                        <img src="{{ asset('svg/globe.svg') }}" width="12" height="12" class="me-2 mb-1" />
                        Company Profile
                    </div>
                    <div class="mb-1">
                        <a class="text-decoration-none"
                            href="{{ $page->compro }}" target="_blank" style="color: #1D2250">Click to Download</a>
                    </div>
            </div>
        </div>
    </div>
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
            @if($page->member_second_title == null)
            vcfContent += 'TITLE;CHARSET=utf-8:{{ $page->member_title }}\n';
            @else
            vcfContent += 'TITLE;CHARSET=utf-8:{{ $page->member_title }} / {{ $page->member_second_title }}\n';
            @endif
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

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-LNNBBTRGEJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-LNNBBTRGEJ');
    </script>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Material+Icons&display=swap" />




    <script defer src="js/lazy.js?v=2"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vef91dfe02fce4ee0ad053f6de4f175db1715022073587"
        integrity="sha512-sDIX0kl85v1Cl5tu4WGLZCpH/dV9OHbA4YlKCuCiMmOQIk4buzoYDZSFj+TvC71mOBLh8CDC/REgE0GX0xcbjA=="
        data-cf-beacon='{"rayId":"890688b68c5618ca","r":1,"version":"2024.4.1","token":"ba9386ef69374dbc9ca25bc62eb77e0a"}'
        crossorigin="anonymous"></script>
</body>

</html>
