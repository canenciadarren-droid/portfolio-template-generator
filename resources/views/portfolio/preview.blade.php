
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio['full_name'] }} | PortfolioCraft</title>

    @php
        $template = in_array(
            $portfolio['template'] ?? 'modern',
            ['simple', 'modern', 'creative'],
            true
        ) ? $portfolio['template'] : 'modern';

        $skills = preg_split(
            '/[,;\r\n]+/',
            $portfolio['skills'] ?? '',
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        $socialLinks = preg_split(
            '/[\r\n,;]+/',
            $portfolio['social_links'] ?? '',
            -1,
            PREG_SPLIT_NO_EMPTY
        );
    @endphp

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

        /* Original portfolio size */
        .portfolio {
            max-width: 950px;
            margin: 40px auto;
            padding: 45px;
            background: white;
            border-radius: 18px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);
            overflow-wrap: anywhere;
        }

        /* Back and Go to Form buttons */
        .preview-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            width: 100%;
            margin-bottom: 20px;
        }

        .preview-nav-button {
            display: inline-block;
            padding: 8px 0;
            border-radius: 8px;
            text-decoration: none;
            font-size: 15px;
            font-weight: normal;
            transition: background 0.2s, color 0.2s;
        }

        .preview-back-button {
            color: #2563eb;
            background: transparent;
        }

        .preview-back-button:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }

        .preview-form-button {
            padding: 10px 18px;
            color: #ffffff;
            background: #2563eb;
            border: 1px solid #2563eb;
        }

        .preview-form-button:hover {
            background: #1d4ed8;
        }

        /* Profile */
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
            flex-shrink: 0;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
        }

        h1 {
            margin: 0;
            font-size: 36px;
            line-height: 1.2;
            overflow-wrap: anywhere;
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
            min-width: 0;
            margin-top: 28px;
            overflow-wrap: anywhere;
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

        /* Skills */
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

        /* Social media and website link buttons */
        .social-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 0;
            margin: 14px 0 0;
            list-style: none;
        }

        .social-links li {
            max-width: 100%;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            max-width: 100%;
            padding: 10px 16px;
            border: 1px solid #bfdbfe;
            border-radius: 30px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            overflow-wrap: anywhere;
            word-break: break-word;
            transition:
                background 0.2s,
                color 0.2s,
                transform 0.2s,
                box-shadow 0.2s;
        }

        .social-link::before {
            content: "↗";
            flex-shrink: 0;
            font-size: 17px;
        }

        .social-link:hover {
            background: #2563eb;
            border-color: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .social-link:focus-visible {
            outline: 3px solid #93c5fd;
            outline-offset: 3px;
        }

        /* Modern: two-column cards */
        .portfolio.modern {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 24px;
            border-top: 7px solid #2563eb;
        }

        .portfolio.modern > .preview-actions,
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

        .portfolio.modern .social-link {
            background: #eff6ff;
        }

        .portfolio.modern .social-link:hover {
            background: #2563eb;
            color: white;
        }

        /* Creative: artistic layout */
        .portfolio.creative {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
            padding: 44px;
            background: #fbf7ff;
            border-top: 7px solid #a855f7;
            border-radius: 30px 8px 30px 8px;
        }

        .portfolio.creative > .preview-actions,
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

        .portfolio.creative .skill {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .portfolio.creative .social-link {
            background: #f3e8ff;
            border-color: #e9d5ff;
            color: #7e22ce;
        }

        .portfolio.creative .social-link:hover {
            background: #9333ea;
            border-color: #9333ea;
            color: white;
        }

        /* Mobile layout */
        @media (max-width: 600px) {
            .portfolio {
                margin: 12px;
                padding: 22px;
                max-width: none;
            }

            .preview-actions {
                gap: 10px;
            }

            .preview-nav-button {
                font-size: 14px;
            }

            .preview-form-button {
                padding: 9px 12px;
            }

            .top {
                align-items: flex-start;
                flex-direction: column;
            }

            h1 {
                font-size: 28px;
            }

            .portfolio.modern {
                grid-template-columns: 1fr;
            }

            .portfolio.modern > .preview-actions,
            .portfolio.modern > .top {
                grid-column: 1;
            }

            .portfolio.creative {
                grid-template-columns: 1fr;
                padding: 22px;
            }

            .portfolio.creative > .preview-actions,
            .portfolio.creative > .top,
            .portfolio.creative > section:first-of-type {
                grid-column: 1;
            }

            .social-links {
                gap: 9px;
            }

            .social-link {
                padding: 9px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <main class="portfolio {{ $template }}">

        <!-- Navigation -->
        <div class="preview-actions">
            <a
                class="preview-nav-button preview-back-button"
                href="/portfolios"
            >
                &larr; Back
            </a>

            <a
                class="preview-nav-button preview-form-button"
                href="/portfolio/create"
            >
                Go to Form &rarr;
            </a>
        </div>

        <!-- Profile header -->
        <header class="top">
            @if (!empty($portfolio['photo_url']))
                <img
                    class="photo"
                    src="{{ $portfolio['photo_url'] }}"
                    alt="Profile photo of {{ $portfolio['full_name'] }}"
                >
            @else
                <div class="photo"></div>
            @endif

            <div>
                <h1>{{ $portfolio['full_name'] }}</h1>

                <div class="contact">
                    {{ $portfolio['email'] }}

                    @if (!empty($portfolio['contact_number']))
                        &middot; {{ $portfolio['contact_number'] }}
                    @endif

                    @if (!empty($portfolio['address']))
                        <br>{{ $portfolio['address'] }}
                    @endif
                </div>

                <span class="template">
                    {{ $template }} template
                </span>
            </div>
        </header>

        <!-- About Me -->
        <section>
            <h2>About Me</h2>
            <p>{{ $portfolio['about_me'] }}</p>
        </section>

        <!-- Education -->
        @if (!empty($portfolio['education']))
            <section>
                <h2>Education</h2>
                <p>{{ $portfolio['education'] }}</p>
            </section>
        @endif

        <!-- Skills -->
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

        <!-- Projects -->
        @if (!empty($portfolio['projects']))
            <section>
                <h2>Projects</h2>
                <p>{{ $portfolio['projects'] }}</p>
            </section>
        @endif

        <!-- Work experience -->
        @if (!empty($portfolio['work_experience']))
            <section>
                <h2>Work Experience</h2>
                <p>{{ $portfolio['work_experience'] }}</p>
            </section>
        @endif

        <!-- Social media and website links -->
        @if (!empty($socialLinks))
            <section>
                <h2>Links &amp; Social Media</h2>

                <ul class="social-links">
                    @foreach ($socialLinks as $socialEntry)
                        @php
                            $socialEntry = trim($socialEntry);
                            $parts = explode('|', $socialEntry, 2);

                            if (count($parts) === 2) {
                                $linkLabel = trim($parts[0]);
                                $rawUrl = trim($parts[1]);
                            } else {
                                $rawUrl = $socialEntry;
                                $linkLabel = 'My Website Link';
                            }

                            $linkUrl = preg_match(
                                '/^https?:\/\//i',
                                $rawUrl
                            )
                                ? $rawUrl
                                : 'https://' . $rawUrl;

                            $host = strtolower(
                                parse_url($linkUrl, PHP_URL_HOST) ?? ''
                            );

                            $host = preg_replace('/^www\./', '', $host);

                            if (count($parts) === 1) {
                                $linkLabel = match (true) {
                                    str_contains($host, 'facebook.com'),
                                    $host === 'fb.com' =>
                                        'My Facebook Link',

                                    str_contains($host, 'instagram.com') =>
                                        'My Instagram',

                                    str_contains($host, 'linkedin.com') =>
                                        'My LinkedIn',

                                    str_contains($host, 'github.com') =>
                                        'My GitHub',

                                    str_contains($host, 'tiktok.com') =>
                                        'My TikTok',

                                    str_contains($host, 'youtube.com'),
                                    $host === 'youtu.be' =>
                                        'My YouTube',

                                    $host === 'x.com',
                                    str_contains($host, 'twitter.com') =>
                                        'My X / Twitter',

                                    default => 'My Website Link',
                                };
                            }

                            $scheme = strtolower(
                                parse_url($linkUrl, PHP_URL_SCHEME) ?? ''
                            );
                        @endphp

                        @if (
                            in_array($scheme, ['http', 'https'], true)
                            && $host !== ''
                            && $linkLabel !== ''
                        )
                            <li>
                                <a
                                    class="social-link"
                                    href="{{ $linkUrl }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    {{ $linkLabel }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </section>
        @endif

    </main>
</body>
</html>
