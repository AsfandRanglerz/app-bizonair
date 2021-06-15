<meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
    <Style>
        /*404 page*/
        .error-404-pg .content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #12253d;
        }

        .error-404-pg .error-img-bg {
            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 335px;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
        }

        .error-404-pg .main-heading {
            font-size: 80px;
            margin: 0;
        }

        .error-404-pg .heading {
            font-size: 30px;
            margin: 0;
        }

        .error-404-pg .paragraph {
            font-size: 24px;
        }

        .error-404-pg .red-btn {
            display: inline-block;
            transition: background-color 0.5s ease;
            background: #A52C3E;
            color: #FFF;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 500;
            font-size: 24px;
            border: none;
        }

        .error-404-pg .red-btn:hover,
        .error-404-pg .red-btn:focus {
            background: #12253D;
        }
        /*404 page*/

        @media only screen and (max-width: 991px) {
            /*404 page*/
            .error-404-pg .main-heading {
                font-size: 50px;
            }

            .error-404-pg .error-img-bg {
                height: 300px;
            }

            .error-404-pg .heading {
                font-size: 24px;
            }

            .error-404-pg .paragraph {
                font-size: 21px;
            }

            .error-404-pg .red-btn {
                padding: 8px 15px;
                font-size: 21px;
            }
            /*404 page*/
        }
    </Style>
    <main class="error-404-pg">
        <div class="content">
            <h1 class="main-heading">404</h1>
            <div class="error-img-bg"></div>
            <div align="center">
                <h3 class="heading">Look like you're lost</h3>
                <p class="paragraph">the page you are looking for not available!</p>
                <a href="{{URL::to('/')}}" class="red-btn">Go to Home</a>
            </div>
        </div>
    </main>
</body>
