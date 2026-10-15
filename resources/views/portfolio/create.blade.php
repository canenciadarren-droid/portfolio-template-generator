<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Portfolio | PortfolioCraft</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f7f8fc;
            color: #20243a;
            padding: 30px 16px;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        a {
            color: #5b4bdb;
            text-decoration: none;
        }

        .back-link {
            display: inline-block;
            margin-bottom: 20px;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(20, 25, 60, 0.06);
        }

        h1 {
            margin-bottom: 10px;
        }

        .description {
            color: #73788a;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .field {
            margin-bottom: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dfe1eb;
            border-radius: 8px;
            font: inherit;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .hint {
            color: #73788a;
            font-size: 13px;
            margin-top: 6px;
        }

        button {
            border: none;
            background: #5b4bdb;
            color: white;
            padding: 14px 22px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #4838c4;
        }

        @media (max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/">Back to Home</a>

        <div class="form-card">
            <h1>Create Your Portfolio</h1>
            <p class="description">
                Fill in your details to start building your personal portfolio.
                You can customize the design after entering your information.
            </p>

            <form action="/portfolio" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-grid">
                    <div class="field">
                        <label for="full_name">Full Name *</label>
                        <input id="full_name" name="full_name" type="text"
                               placeholder="e.g. Juan Dela Cruz" required>
                    </div>

                    <div class="field">
                        <label for="email">Email Address *</label>
                        <input id="email" name="email" type="email"
                               placeholder="you@example.com" required>
                    </div>

                    <div class="field">
                        <label for="contact_number">Contact Number</label>
                        <input id="contact_number" name="contact_number" type="tel"
                               placeholder="Your phone number">
                    </div>

                    <div class="field">
                        <label for="address">Address</label>
                        <input id="address" name="address" type="text"
                               placeholder="City, province">
                    </div>

                    <div class="field full-width">
                        <label for="photo_url">Profile Photo URL</label>
                        <input
                             type="file" id="photo" name="photo"
                                accept="image/jpeg,image/png,image/webp">
                        <p class="hint">For now, use a publicly accessible image URL.</p>
                    </div>

                    <div class="field full-width">
                        <label for="about_me">About Me *</label>
                        <textarea id="about_me" name="about_me"
                                  placeholder="Introduce yourself..." required></textarea>
                    </div>

                    <div class="field full-width">
                        <label for="education">Education</label>
                        <textarea id="education" name="education"
                                  placeholder="School, course, year level, achievements..."></textarea>
                    </div>

                    <div class="field full-width">
                        <label for="skills">Skills</label>
                        <textarea id="skills" name="skills"
                                  placeholder="HTML, CSS, Java, communication..."></textarea>
                        <p class="hint">Separate each skill with a comma.</p>
                    </div>

                    <div class="field full-width">
                        <label for="projects">Projects</label>
                        <textarea id="projects" name="projects"
                                  placeholder="Project name and a short description..."></textarea>
                    </div>

                    <div class="field full-width">
                        <label for="work_experience">Work Experience</label>
                        <textarea id="work_experience" name="work_experience"
                                  placeholder="Job title, organization, responsibilities..."></textarea>
                    </div>

                    <div class="field full-width">
                        <label for="social_links">Social Links / Website</label>
                        <textarea id="social_links" name="social_links"
                                  placeholder="GitHub, LinkedIn, Facebook, personal website..."></textarea>
                    </div>
                    <div class="field full-width">
                        <button type="submit">
                             Submit Portfolio
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
