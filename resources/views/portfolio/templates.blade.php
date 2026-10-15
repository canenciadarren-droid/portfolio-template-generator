
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose a Template | PortfolioCraft</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            padding: 24px 8%;
            background: white;
            border-bottom: 1px solid #e2e8f0;
        }

        header h1 {
            margin: 0;
            color: #2563eb;
        }

        .container {
            max-width: 1100px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .intro {
            text-align: center;
            margin-bottom: 35px;
        }

        .intro h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .intro p {
            color: #64748b;
        }

        .templates {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.06);
        }

        .sample {
            height: 180px;
            padding: 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .sample h3 {
            margin: 8px 0;
        }

        .sample p {
            font-size: 12px;
        }

        .sample.simple {
            background: white;
            border: 1px solid #cbd5e1;
            border-top: 7px solid #64748b;
        }

        .sample.modern {
            background: #eff6ff;
            border-left: 7px solid #2563eb;
        }

        .sample.modern .mini-card {
            display: inline-block;
            background: white;
            width: 43%;
            height: 45px;
            margin: 3px;
            border-radius: 5px;
        }

        .sample.creative {
            background: #f3e8ff;
            border-radius: 30px 6px 30px 6px;
            border-left: 7px solid #9333ea;
        }

        .card h3 {
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            line-height: 1.6;
            min-height: 48px;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .creative-button {
            background: #9333ea;
        }

        .creative-button:hover {
            background: #7e22ce;
        }

        .back {
            display: inline-block;
            margin-top: 28px;
            color: #2563eb;
            text-decoration: none;
        }

        @media (max-width: 800px) {
            .templates {
                grid-template-columns: 1fr;
            }

            .intro h2 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>PortfolioCraft</h1>
</header>

<main class="container">
    <div class="intro">
        <h2>Choose Your Portfolio Template</h2>
        <p>
            Hi, {{ $portfolio->full_name }}!
            Choose one of our three designs for your portfolio.
        </p>
    </div>

    <div class="templates">

        <!-- Template 1: Simple -->
        <article class="card">
            <div class="sample simple">
                <small>MY PORTFOLIO</small>
                <h3>Your Name</h3>
                <p>About Me</p>
                <hr>
                <p>Education · Skills · Projects</p>
            </div>

            <h3>1. Simple</h3>
            <p class="description">
                A clean, minimal, and professional design.
            </p>

            <form action="/portfolio/{{ $portfolio->id }}/template"
                  method="POST">
                @csrf
                <input type="hidden" name="template" value="simple">
                <button type="submit">Choose Simple</button>
            </form>
        </article>

        <!-- Template 2: Modern -->
        <article class="card">
            <div class="sample modern">
                <small>MY PORTFOLIO</small>
                <h3>Your Name</h3>
                <div class="mini-card"></div>
                <div class="mini-card"></div>
                <p>Projects and Skills</p>
            </div>

            <h3>2. Modern</h3>
            <p class="description">
                A contemporary layout with cards and visual sections.
            </p>

            <form action="/portfolio/{{ $portfolio->id }}/template"
                  method="POST">
                @csrf
                <input type="hidden" name="template" value="modern">
                <button type="submit">Choose Modern</button>
            </form>
        </article>

        <!-- Template 3: Creative -->
        <article class="card">
            <div class="sample creative">
                <small>MY CREATIVE SPACE</small>
                <h3>Your Name!</h3>
                <p>Ideas. Projects. Creativity.</p>
            </div>

            <h3>3. Creative</h3>
            <p class="description">
                An expressive design with distinctive shapes and styling.
            </p>

            <form action="/portfolio/{{ $portfolio->id }}/template"
                  method="POST">
                @csrf
                <input type="hidden" name="template" value="creative">
                <button type="submit" class="creative-button">
                    Choose Creative
                </button>
            </form>
        </article>

    </div>

    <a class="back" href="/portfolio/create">
        ← Back to Portfolio Form
    </a>
</main>

</body>
</html>
