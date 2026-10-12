<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio['full_name'] }} | PortfolioCraft</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            line-height: 1.7;
        }

        .portfolio {
            max-width: 950px;
            margin: 40px auto;
            padding: 45px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0,0,0,.08);
        }

        .top {
            display: flex;
            align-items: center;
            gap: 28px;
            padding-bottom: 30px;
            border-bottom: 1px solid #e2e8f0;
        }

        .photo {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            line-height: 1.2;
        }

        .template {
            display: inline-block;
            margin-top: 10px;
            padding: 4px 12px;
            border-radius: 20px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 12px;
            text-transform: uppercase;
        }

        section {
            margin-top: 28px;
        }

        h2 {
            padding-bottom: 8px;
            border-bottom: 2px solid #2563eb;
            color: #1d4ed8;
            font-size: 19px;
        }

        .contact {
            color: #64748b;
            overflow-wrap: anywhere;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .simple {
            border-top: 7px solid #64748b;
        }

        .modern {
            border-top: 7px solid #2563eb;
        }

        .creative {
            border-top: 7px solid #a855f7;
            background: #fdfaff;
        }

        /* Modern template: two-column card layout */
        .portfolio.modern {
            display: grid;
              grid-template-columns: repeat(2, minmax(0, 1fr));
              gap: 24px;
        }

        .portfolio.modern > .back,
        .portfolio.modern > .top {
            grid-column: 1 / -1;
        }

.portfolio.modern > section {
    margin-top: 0;
    padding: 20px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
}

.portfolio.modern > section h2 {
    margin-top: 0;
}

/* Keep the Modern template usable on phones */
@media (max-width: 600px) {
    .portfolio.modern {
        grid-template-columns: 1fr;
    }

    .portfolio.modern > .back,
    .portfolio.modern > .top {
        grid-column: auto;
    }
}

/* Creative template: bold, artistic layout */
.portfolio.creative {
    display: grid;
    grid-template-columns: 1.2fr 0.8fr;
    gap: 24px;
    padding: 44px;
    background: #fbf7ff;
    border-top: none;
    border-radius: 30px 8px 30px 8px;
}

.portfolio.creative > .back,
.portfolio.creative > .top {
    grid-column: 1 / -1;
}

.portfolio.creative > .top {
    padding-bottom: 32px;
    border-bottom: 3px dashed #d8b4fe;
}

.portfolio.creative h1 {
    font-size: clamp(32px, 5vw, 56px);
    letter-spacing: -1.5px;
}

.portfolio.creative > section {
    margin-top: 0;
    padding: 24px;
    background: white;
    border-left: 5px solid #c084fc;
    border-radius: 8px 24px 8px 24px;
    box-shadow: 8px 8px 0 #f3e8ff;
}

.portfolio.creative > section:first-of-type {
    grid-column: 1 / -1;
    background: #f3e8ff;
}

.portfolio.creative > section h2 {
    font-size: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-bottom: none;
}

/* Responsive layout for smaller screens */
@media (max-width: 600px) {
    .portfolio.creative {
        grid-template-columns: 1fr;
        padding: 22px;
    }

    .portfolio.creative > .back,
    .portfolio.creative > .top,
    .portfolio.creative > section:first-of-type {
        grid-column: 1;
    }
}

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .skill {
            padding: 5px 12px;
            border-radius: 20px;
            background: #e2e8f0;
            font-size: 14px;
        }

        .creative .skill {
            background: #f3e8ff;
            color: #7e22ce;
        }

        @media (max-width: 600px) {
            .portfolio {
                margin: 12px;
                padding: 22px;
            }

            .top {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>
    @php
        $template = $portfolio['template'] ?? 'modern';
        $skills = preg_split('/[,;\n]+/', $portfolio['skills'] ?? '', -1, PREG_SPLIT_NO_EMPTY);
    @endphp

    <main class="portfolio {{ $portfolio['template'] }}">
        <a class="back" href="/portfolio/create">← Back to form</a>

        <header class="top">
            @if (!empty($portfolio['photo_url']))
                <img class="photo"
                     src="{{ $portfolio['photo_url'] }}"
                     alt="Profile photo">
            @else
                <div class="photo"></div>
            @endif

            <div>
                <h1>{{ $portfolio['full_name'] }}</h1>

                <div class="contact">
                    {{ $portfolio['email'] }}

                    @if (!empty($portfolio['contact_number']))
                        · {{ $portfolio['contact_number'] }}
                    @endif

                    @if (!empty($portfolio['address']))
                        <br>{{ $portfolio['address'] }}
                    @endif
                </div>

                <span class="template">{{ $template }} template</span>
            </div>
        </header>

        <section>
            <h2>About Me</h2>
            <p>{{ $portfolio['about_me'] }}</p>
        </section>

        @if (!empty($portfolio['education']))
            <section>
                <h2>Education</h2>
                <p>{{ $portfolio['education'] }}</p>
            </section>
        @endif

        @if (!empty($skills))
            <section>
                <h2>Skills</h2>
                <div class="skills">
                    @foreach ($skills as $skill)
                        <span class="skill">{{ trim($skill) }}</span>
                    @endforeach
                </div>
            </section>
        @endif

        @if (!empty($portfolio['projects']))
            <section>
                <h2>Projects</h2>
                <p>{{ $portfolio['projects'] }}</p>
            </section>
        @endif

        @if (!empty($portfolio['work_experience']))
            <section>
                <h2>Work Experience</h2>
                <p>{{ $portfolio['work_experience'] }}</p>
            </section>
        @endif

        @if (!empty($portfolio['social_links']))
            <section>
                <h2>Links & Social Media</h2>
                <p>{{ $portfolio['social_links'] }}</p>
            </section>
        @endif
    </main>
</body>
</html>

