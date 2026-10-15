
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Portfolios | PortfolioCraft</title>

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
            background: #ffffff;
            padding: 22px 7%;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        header h1 {
            margin: 0;
            color: #2563eb;
        }

        .button {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .heading {
            margin-bottom: 28px;
        }

        .heading h2 {
            margin: 0 0 10px;
            font-size: 30px;
        }

        .heading p {
            color: #64748b;
            line-height: 1.6;
        }

        .count {
            display: inline-block;
            margin-top: 8px;
            padding: 7px 12px;
            border-radius: 20px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 14px;
            font-weight: bold;
        }

        .portfolio-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 22px;
        }

        .portfolio-card {
            min-width: 0;
            padding: 22px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
        }

        .card-top {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 68px;
            height: 68px;
            flex-shrink: 0;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
        }

        .placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #64748b;
        }

        .portfolio-card h3 {
            margin: 0 0 7px;
            overflow-wrap: anywhere;
        }

        .email {
            margin: 0;
            color: #64748b;
            overflow-wrap: anywhere;
        }

        .details {
            margin: 20px 0;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.9;
        }

        .template {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #334155;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
        }

        .actions form {
            margin: 0;
        }

        .view-button,
        .edit-button,
        .delete-button {
            display: inline-block;
            padding: 10px 13px;
            border: none;
            border-radius: 7px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .view-button {
            background: #2563eb;
        }

        .view-button:hover {
            background: #1d4ed8;
        }

        .edit-button {
            background: #0f766e;
        }

        .edit-button:hover {
            background: #115e59;
        }

        .delete-button {
            background: #dc2626;
        }

        .delete-button:hover {
            background: #b91c1c;
        }

        .empty {
            padding: 45px 20px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            text-align: center;
        }

        .empty p {
            color: #64748b;
            line-height: 1.6;
        }

        @media (max-width: 720px) {
            .portfolio-list {
                grid-template-columns: 1fr;
            }

            .heading h2 {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>PortfolioCraft</h1>

    <a href="/" class="button">
        Back to Home
    </a>
</header>

<main class="container">

    <section class="heading">
        <h2>Manage Portfolios</h2>

        <p>
            View, edit, or delete saved portfolio records.
        </p>

        <span class="count">
            {{ $portfolios->count() }}
            {{ $portfolios->count() === 1 ? 'Portfolio' : 'Portfolios' }}
            Saved
        </span>

        <p>
            <a href="/portfolio/create" class="button">
                + Create New Portfolio
            </a>
        </p>
    </section>

    @if ($portfolios->isEmpty())

        <section class="empty">
            <h3>No portfolios yet</h3>

            <p>
                Create your first portfolio and it will appear here.
            </p>

            <a href="/portfolio/create" class="button">
                Create Portfolio
            </a>
        </section>

    @else

        <section class="portfolio-list">

            @foreach ($portfolios as $portfolio)

                <article class="portfolio-card">

                    <div class="card-top">

                        @if ($portfolio->photo_url)
                            <img
                                src="{{ $portfolio->photo_url }}"
                                alt="Profile picture of {{ $portfolio->full_name }}"
                                class="avatar"
                            >
                        @else
                            <div class="avatar placeholder">
                                &#128100;
                            </div>
                        @endif

                        <div>
                            <h3>{{ $portfolio->full_name }}</h3>

                            <p class="email">
                                {{ $portfolio->email }}
                            </p>
                        </div>

                    </div>

                    <div class="details">

                        <div>
                            <strong>Portfolio ID:</strong>
                            {{ $portfolio->id }}
                        </div>

                        <div>
                            <strong>Template:</strong>

                            <span class="template">
                                {{ $portfolio->template }}
                            </span>
                        </div>

                        <div>
                            <strong>Created:</strong>
                            {{ $portfolio->created_at?->format('M d, Y') ?? 'Unknown' }}
                        </div>

                    </div>

                    <div class="actions">

                        <a
                            href="/portfolio/{{ $portfolio->id }}"
                            class="view-button"
                        >
                            View
                        </a>

                        <a
                            href="/portfolio/{{ $portfolio->id }}/edit"
                            class="edit-button"
                        >
                            Edit
                        </a>

                        <form
                            action="/portfolio/{{ $portfolio->id }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this portfolio? This action cannot be undone.');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="delete-button"
                            >
                                Delete
                            </button>
                        </form>

                    </div>

                </article>

            @endforeach

        </section>

    @endif

</main>

</body>
</html>
