
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio | PortfolioCraft</title>

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
            background: white;
            padding: 22px 7%;
            border-bottom: 1px solid #e2e8f0;
        }

        header h1 {
            margin: 0;
            color: #2563eb;
        }

        .container {
            max-width: 800px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
        }

        h2 {
            margin-top: 0;
        }

        .description {
            color: #64748b;
            line-height: 1.6;
        }

        .field {
            margin-bottom: 19px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font: inherit;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: 2px solid #93c5fd;
            border-color: #2563eb;
        }

        .current-photo {
            width: 110px;
            height: 110px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin-bottom: 12px;
            background: #e2e8f0;
        }

        .error-list {
            background: #fef2f2;
            color: #b91c1c;
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .cancel {
            background: #e2e8f0;
            color: #334155;
        }

        .cancel:hover {
            background: #cbd5e1;
        }

        .hint {
            color: #64748b;
            font-size: 13px;
            margin-top: 7px;
        }

        @media (max-width: 600px) {
            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>PortfolioCraft</h1>
</header>

<main class="container">
    <section class="form-card">
        <h2>Edit Your Portfolio</h2>

        <p class="description">
            Update your information below. Your changes will be saved
            to the online database.
        </p>

        @if ($errors->any())
            <div class="error-list">
                <strong>Please check the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="/portfolio/{{ $portfolio->id }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="field">
                <label for="full_name">Full Name *</label>
                <input
                    type="text"
                    id="full_name"
                    name="full_name"
                    value="{{ old('full_name', $portfolio->full_name) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div class="field">
                <label for="email">Email Address *</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $portfolio->email) }}"
                    maxlength="255"
                    required
                >
            </div>

            <div class="field">
                <label for="contact_number">Contact Number</label>
                <input
                    type="text"
                    id="contact_number"
                    name="contact_number"
                    value="{{ old('contact_number', $portfolio->contact_number) }}"
                    maxlength="30"
                >
            </div>

            <div class="field">
                <label for="address">Address</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address', $portfolio->address) }}"
                    maxlength="255"
                >
            </div>

            <div class="field">
                <label for="about_me">About Me *</label>
                <textarea
                    id="about_me"
                    name="about_me"
                    maxlength="5000"
                    required
                >{{ old('about_me', $portfolio->about_me) }}</textarea>
            </div>

            <div class="field">
                <label for="education">Educational Background</label>
                <textarea
                    id="education"
                    name="education"
                    maxlength="5000"
                >{{ old('education', $portfolio->education) }}</textarea>
            </div>

            <div class="field">
                <label for="skills">Skills</label>
                <textarea
                    id="skills"
                    name="skills"
                    maxlength="5000"
                >{{ old('skills', $portfolio->skills) }}</textarea>
            </div>

            <div class="field">
                <label for="projects">Projects</label>
                <textarea
                    id="projects"
                    name="projects"
                    maxlength="5000"
                >{{ old('projects', $portfolio->projects) }}</textarea>
            </div>

            <div class="field">
                <label for="work_experience">Work Experience</label>
                <textarea
                    id="work_experience"
                    name="work_experience"
                    maxlength="5000"
                >{{ old('work_experience', $portfolio->work_experience) }}</textarea>
            </div>

            <div class="field">
                <label for="social_links">Social Media / Website Links</label>
                <textarea
                    id="social_links"
                    name="social_links"
                    maxlength="5000"
                >{{ old('social_links', $portfolio->social_links) }}</textarea>
            </div>

            <div class="field">
                <label>Current Profile Picture</label>

                @if ($portfolio->photo_url)
                    <img
                        src="{{ $portfolio->photo_url }}"
                        alt="Current profile picture"
                        class="current-photo"
                    >
                @else
                    <p class="description">No profile picture uploaded.</p>
                @endif

                <label for="photo">Choose a New Picture</label>
                <input
                    type="file"
                    id="photo"
                    name="photo"
                    accept="image/jpeg,image/png,image/webp"
                >

                <p class="hint">
                    Optional. JPEG, PNG, or WebP; maximum size 2 MB.
                    Leave blank to keep the current picture.
                </p>
            </div>

            <div class="actions">
                <button type="submit" class="button">
                    Save Changes
                </button>

                <a
                    href="/portfolio/{{ $portfolio->id }}"
                    class="button cancel"
                >
                    Cancel
                </a>
            </div>
        </form>
    </section>
</main>

</body>
</html>
