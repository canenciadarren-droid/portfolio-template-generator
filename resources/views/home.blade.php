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
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 8%;
            background: white;
        }

        .logo {
            font-size: 23px;
            font-weight: bold;
            color: #5b4bdb;
        }

        nav a {
            color: #20243a;
            text-decoration: none;
            font-weight: bold;
        }

        .hero {
            text-align: center;
            padding: 90px 20px 75px;
            background: linear-gradient(135deg, #efedff, #ffffff);
        }

        .hero h1 {
            max-width: 800px;
            margin: 0 auto 20px;
            font-size: clamp(36px, 6vw, 58px);
            line-height: 1.15;
        }

        .hero h1 span {
            color: #5b4bdb;
        }

        .hero p {
            max-width: 620px;
            margin: 0 auto 30px;
            color: #62677b;
            font-size: 18px;
        }

        .button {
            display: inline-block;
            background: #5b4bdb;
            color: white;
            padding: 14px 25px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
        }

        .templates {
            padding: 65px 8%;
            text-align: center;
        }

        .templates h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .section-description {
            color: #73788a;
            margin-bottom: 35px;
        }

        .template-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
            text-align: left;
        }

        .template-card {
            background: white;
            border: 1px solid #e7e8f0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(20, 25, 60, 0.05);
        }

        .preview {
            height: 180px;
            padding: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .simple-preview {
            background: #f0f1f4;
        }

        .modern-preview {
            background: #20243a;
            color: white;
        }

        .creative-preview {
            background: #ffe5c8;
            color: #783d22;
        }

        .mock-profile {
            width: 100%;
            max-width: 240px;
            padding: 20px;
            background: white;
            color: #20243a;
            border-radius: 8px;
            text-align: center;
        }

        .modern-preview .mock-profile {
            background: #303650;
            color: white;
        }

        .mock-line {
            height: 7px;
            width: 75%;
            margin: 10px auto 0;
            border-radius: 10px;
            background: #d9d9e5;
        }

        .template-info {
            padding: 22px;
        }

        .template-info h3 {
            margin-bottom: 7px;
        }

        .template-info p {
            color: #73788a;
            font-size: 14px;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #73788a;
            background: white;
        }

        @media (max-width: 760px) {
            .template-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding-top: 65px;
            }
        }
    </style>
</head>
<body>

    <nav>
        <div class="logo">PortfolioCraft</div>
        <a href="#templates">Explore Templates</a>
    </nav>

    <main>
        <section class="hero">
            <h1>Your Story. Your Skills. <span>Your Portfolio.</span></h1>

            <p>
                Create a professional personal portfolio in minutes.
                Add your information, choose a design, and showcase your work.
            </p>

            <a href="/portfolio/create" class="button">Create My Portfolio</a>
        </section>

        <section class="templates" id="templates">
            <h2>Choose Your Style</h2>

            <p class="section-description">
                Three unique designs. One portfolio that's all about you.
            </p>

            <div class="template-grid">
                <article class="template-card">
                    <div class="preview simple-preview">
                        <div class="mock-profile">
                            <strong>Your Name</strong>
                            <div class="mock-line"></div>
                            <div class="mock-line"></div>
                        </div>
                    </div>

                    <div class="template-info">
                        <h3>01. Simple</h3>
                        <p>A clean, minimal layout for a professional first impression.</p>
                    </div>
                </article>

                <article class="template-card">
                    <div class="preview modern-preview">
                        <div class="mock-profile">
                            <strong>Your Name</strong>
                            <div class="mock-line"></div>
                            <div class="mock-line"></div>
                        </div>
                    </div>

                    <div class="template-info">
                        <h3>02. Modern</h3>
                        <p>A contemporary style for developers and technology professionals.</p>
                    </div>
                </article>

                <article class="template-card">
                    <div class="preview creative-preview">
                        <div class="mock-profile">
                            <strong>Your Name ✦</strong>
                            <div class="mock-line"></div>
                            <div class="mock-line"></div>
                        </div>
                    </div>

                    <div class="template-info">
                        <h3>03. Creative</h3>
                        <p>A bold and expressive layout for showcasing your personality.</p>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <footer>
        © {{ date('Y') }} PortfolioCraft. Built to showcase your potential.
    </footer>

</body>
</html>
