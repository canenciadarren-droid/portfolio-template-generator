
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PortfolioCraft | Build Your Portfolio</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f8fc;
            color: #20243a;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px;
            background: linear-gradient(135deg, #efedff, #ffffff);
        }

        .logo {
            color: #5b4bdb;
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
            margin-bottom: 35px;
        }

        .hero h1 {
            max-width: 850px;
            margin: 0 auto 22px;
            font-size: clamp(36px, 6vw, 60px);
            line-height: 1.15;
        }

        .hero h1 span {
            color: #5b4bdb;
        }

        .hero p {
            max-width: 620px;
            margin: 0 auto 35px;
            color: #62677b;
            font-size: 18px;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .button {
            display: inline-block;
            min-width: 190px;
            padding: 15px 24px;
            border: 2px solid #5b4bdb;
            border-radius: 9px;
            background: #5b4bdb;
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            transition: background 0.2s, transform 0.2s;
        }

        .button:hover {
            background: #4536bd;
            border-color: #4536bd;
            transform: translateY(-2px);
        }

        .button-secondary {
            background: #ffffff;
            color: #5b4bdb;
        }

        .button-secondary:hover {
            background: #f0eeff;
            color: #4536bd;
            border-color: #4536bd;
        }

        footer {
            text-align: center;
            padding: 22px 15px;
            color: #73788a;
            background: #ffffff;
            border-top: 1px solid #e7e8f0;
            font-size: 14px;
        }

        @media (max-width: 500px) {
            .hero {
                padding: 60px 22px;
            }

            .hero-actions {
                width: 100%;
                max-width: 320px;
                flex-direction: column;
            }

            .button {
                width: 100%;
            }

            .hero p {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <main class="hero">
        <div class="logo">PORTFOLIOCRAFT</div>

        <h1>
            Your Story. Your Skills.
            <span>Your Portfolio.</span>
        </h1>

        <p>
            Create a professional personal portfolio in minutes.
            Add your information, choose from three unique templates,
            and showcase your skills, projects, and experience.
        </p>

        <div class="hero-actions">
            <a href="/portfolio/create" class="button">
                Create My Portfolio
            </a>

            <a href="/portfolios" class="button button-secondary">
                Manage Portfolios
            </a>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} PortfolioCraft. Built to showcase your potential.
    </footer>

</body>
</html>
