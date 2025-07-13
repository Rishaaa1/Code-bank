    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
  footer {
            width: 100%;
            background-color: #11468F;
            color: white;
            padding-top: 10px; 
        }

        footer a {
            color: white;
        }

        .footer {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px 10px;
        }

        .footer-column {
            flex: 1 1 200px;
            padding: 10px 78px;
            box-sizing: border-box;
            border-right: 1px solid rgba(255, 255, 255, 0.3);
        }

        .footer-column:last-child {
            border-right: none;
        }

        .footer-column h4 {
            text-transform: uppercase;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .footer-column p {
            font-weight: 600;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
        }

        .footer-divider {
            height: 1px;
            width: 85%;
            background-color: white;
            margin: 0 auto; /* Center the divider */
        }

        .copyright {
            background-color: #041562;
            color: white;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 80%;
            text-align: center;
            font-size: 12px;
            padding: 12px; 
        }

        .space {
            padding-top: 15px;
            padding-bottom: 3px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .footer {
                flex-direction: column;
                align-items: center;
            }

            .footer-column {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                text-align: center;
                padding: 20px; 
            }

            .footer-column:last-child {
                border-bottom: none;
            }

            .copyright {
                flex-direction: column; 
                gap: 10px; 
                padding: 15px;
            }
        }
        </style>
    </head>
    <body>
         <footer>
        <div class="footer">
            <div class="footer-column">
                <h4>KANTOR PUSAT</h4>
                <p>Gedung Grinatha Lt. 1-7, Jalan Pemuda<br>No. 142 Semarang</p>
                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    <a href="https://www.bing.com/ck/a?!&&p=48d430baedad25aa6c3ed0f10032cdc19ef9d64c2d9806c34c9eccb7b3c2cdf1JmltdHM9MTc1MDIwNDgwMA&ptn=3&ver=2&hsh=4&fclid=202b01d1-cc97-6977-126f-1524cd966895&u=a1L21hcHM_Jm1lcGk9MTA3fkxvY2FsflRvcE9mUGFnZX5FbnRpdHlfVmVydGljYWxfTGlzdF9DYXJkJnR5PTE3JnE9bGluayUyMGxva2FzaSUyMGJhbmslMjBqYXRlbmcmc2VnbWVudD1Mb2NhbCZwcG9pcz0tNy41NDIwMTMxNjgzMzQ5NjFfMTEwLjgyMDE4MjgwMDI5Mjk3X0JhbmslMjBKYXRlbmclMjBLQ1AlMjBOdXN1a2FuJTIwU3VyYWthcnRhX1lONzk5OXgzNzY3NjEwMzczNzUxNTU0NTkxfi03LjU2ODk1MzUxNDA5OTEyMV8xMTAuODE4MDkyMzQ2MTkxNF9iYW5rJTIwSmF0ZW5nJTIwU3lhcmlhaF9ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOH4tNy41NzEyMDgwMDAxODMxMDU1XzExMC44MjYzMzk3MjE2Nzk2OV9CYW5rJTIwSmF0ZW5nJTIwQ2FiYW5nJTIwU3VyYWthcnRhX1lONzk5OXgxMDMwNzI5OTg4OTkyNDQzNzIwMn4tNy41NTMxNjkyNTA0ODgyODFfMTEwLjgyMjMwMzc3MTk3MjY2X0JhbmslMjBKYXRlbmclMjBTeXJpYWglMjBLQ1AlMjBVTVNfWU43OTk5eDU0MDkyMTk4MjE5Nzk2OTYyNzdafi03LjU2NjIzNjk3MjgwODgzOF8xMTAuODA5ODIyMDgyNTE5NTNfQmFuayUyMEphdGVuZyUyMFN5YXJpYWhfWU43OTk5eDEwMzEyMjMwNjI0ODU4NjE5NzkwfiZzZWk9MCZjcD0tNy41Njg5NTR-MTEwLjgxODA5MiZjaGlsZD0lMjZ0eSUzRDE4JTI2cSUzRGJhbmslMjUyMEphdGVuZyUyNTIwU3lhcmlhaCUyNnNzJTNEeXBpZC5ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOCUyNnNlZ21lbnQlM0RMb2NhbCUyNnBwb2lzJTNELTcuNTY4OTUzNTE0MDk5MTIxXzExMC44MTgwOTIzNDYxOTE0X2JhbmslMjUyMEphdGVuZyUyNTIwU3lhcmlhaF9ZTjc5OTl4MTc3MDM5NzQ5MjU3NTQxNjAwOH4lMjZjcCUzRC03LjU2ODk1NH4xMTAuODE4MDkyJTI2RW5hYmxlTWFwVmlld0NoYW5nZSUzRHRydWUmRk9STT1NUFNSUEw&ntb=1"
                        class="text-white text-decoration-underline" target="_blank">Lokasi Bank Jateng Lainnya</a>
                </p>
            </div>
            <div class="footer-column">
                <h4>HUB KAMI</h4>
                <p><i class="bi bi-telephone"></i> Call Center & Pengaduan 14066</p>
                <p><i class="bi bi-envelope"></i> callcenter14066@bankjateng.co.id</p>
                <p><i class="bi bi-telephone-fill"></i> Kantor Pusat 024-3547541</p>
                <p><i class="bi bi-envelope-at"></i> sekretaris.perusahaan@bankjateng.co.id</p>
            </div>

            <div class="footer-column">
                <h4>MEDIA SOCIAL</h4>
                <p><i class="bi bi-twitter"></i> @bank_jateng</p>
                <p><i class="bi bi-facebook"></i> Bank Jateng</p>
                <p><i class="bi bi-youtube"></i> @bankjateng</p>
                <p><i class="bi bi-instagram"></i> @bank_jateng</p>
            </div>

            <div class="footer-column">
                <h4>TAUTAN</h4>
                <p><a href="#" class="text-white text-decoration-underline">PPID Bank Jateng</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Kalender Digital</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Majalah Zinergi</a></p>
                <p><a href="#" class="text-white text-decoration-underline">FAQ</a></p>
                <p><a href="#" class="text-white text-decoration-underline">Waspada Penipuan</a></p>
            </div>
        </div>

        <div class="footer-divider"></div>
        <div class="copyright">
            <p class="mb-0">Bank Jateng berizin dan diawasi oleh Otoritas Jasa Keuangan. &nbsp;|&nbsp; Bank Jateng
                merupakan
                peserta penjaminan LPS. &nbsp;|&nbsp;
                <a href="#" class="text-white text-decoration-underline">SDBK</a> |
                <a href="#" class="text-white text-decoration-underline">Kebijakan Privasi</a> |
                <a href="#" class="text-white text-decoration-underline">Syarat dan Ketentuan</a>
            </p>
        </div>
    </footer>
    </body>
    </html>
   