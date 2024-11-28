<?php
include 'functions/addArtwork.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Art Auction Gallery - Browse and bid on exclusive artworks">
    <title>Art Auction Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        --primary-color: rgba(169, 89, 232, 1);
        --secondary-color: rgba(232, 202, 251, 1);
        --text-color: rgba(0, 0, 0, 1);
        --status-ongoing: rgba(255, 0, 0, 1);
        --border-radius: 43px;
        --transition-speed: 0.3s;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    body {
        font-family: 'Roboto', -apple-system, BlinkMacSystemFont, 'Segoe UI', Oxygen, Ubuntu, Cantarell, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
        line-height: 1.5;
        color: var(--text-color);
    }

    .auctionpage {
        max-width: 1916px;
        margin: 0 auto;
        padding: 20px;
        min-height: 100vh;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background-color: #fff;
        box-shadow: var(--box-shadow);
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .logo {
        height: 50px;
        width: auto;
    }

    .search-container {
        flex: 1;
        max-width: 1075px;
        margin: 2rem auto;
        position: relative;
    }

    .search-artwork {
        width: 100%;
        padding: 1rem 2rem;
        border-radius: 20px;
        border: 4px solid var(--primary-color);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        background-color: #fff;
        transition: box-shadow var(--transition-speed) ease;
    }

    .search-artwork:focus {
        outline: none;
        box-shadow: 0 0 0 2px var(--primary-color);
    }

    .artwork-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2.5rem;
        padding: 1.25rem;
    }

    .artwork-item {
        background-color: var(--secondary-color);
        border-radius: var(--border-radius);
        padding: 1.25rem;
        transition: transform var(--transition-speed) ease;
        position: relative;
        overflow: hidden;
    }

    .artwork-item:focus-within {
        outline: 3px solid var(--primary-color);
    }

    .artwork-item.highlight {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(169, 89, 232, 0.5);
    }

    .artwork-image {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
        border-radius: calc(var(--border-radius) - 10px);
    }

    .artwork-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition-speed) ease;
    }

    .artwork-info {
        padding: 1.25rem 0;
    }

    .artwork-title {
        font-size: 1.625rem;
        font-weight: 700;
        margin: 0 0 0.625rem 0;
        color: var(--text-color);
    }

    .artist-name {
        font-size: 1.625rem;
        margin: 0;
        color: var(--text-color);
    }

    .status {
        font-size: 2rem;
        font-weight: 700;
        margin-top: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .status.ongoing {
        color: var(--status-ongoing);
    }

    .status.ended {
        color: var(--status-ongoing);
    }

    .status-icon {
        width: 24px;
        height: 24px;
    }

    @media (max-width: 991px) {
        .auctionpage {
            padding: 0.625rem;
        }
        
        .artwork-grid {
            grid-template-columns: 1fr;
        }
        
        .search-artwork {
            padding: 0.9375rem 1.875rem;
        }
        
        .artwork-title,
        .artist-name {
            font-size: 1.375rem;
        }
        
        .status {
            font-size: 1.75rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        * {
            transition: none !important;
        }
    }

    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }

    .skip-link {
        position: absolute;
        top: -40px;
        left: 0;
        background: var(--primary-color);
        color: white;
        padding: 8px;
        z-index: 100;
    }

    .skip-link:focus {
        top: 0;
    }

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
    }

    .artwork-modal .modal-content {
        border-radius: var(--border-radius);
        background-color: var(--secondary-color);
    }

    .artwork-modal .modal-header {
        border-bottom: none;
    }

    .artwork-modal .modal-footer {
        border-top: none;
    }
    </style>
</head>
<body>
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <div class="auctionpage">
        <header class="header" role="banner">
            <div class="logo-container">
                <img src="images/CAMBA.jpg" alt="Art Auction Gallery Logo" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="/" aria-current="page">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/auctions">Auctions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/artists">Artists</a>
                                </li>
                                </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <main id="main-content">
            <div class="search-container">
                <label for="searchArtwork" class="visually-hidden">Search artworks</label>
                <input 
                    type="search" 
                    id="searchArtwork" 
                    class="search-artwork form-control" 
                    placeholder="Search artwork..." 
                    aria-label="Search artwork"
                >
            </div>

            <div class="artwork-grid" role="list">
                <article class="artwork-item" data-artist="Xanne" data-title="Arouse A Rose" role="listitem">
                    <div class="artwork-image">
                        <img src="assets/images/arouse-a-rose.jpg" alt="Arouse A Rose by Xanne" loading="lazy">
                    </div>
                    <div class="artwork-info">
                        <h2 class="artwork-title">Arouse A Rose</h2>
                        <p class="artist-name">Xanne</p>
                        <div class="status ongoing" aria-label="Auction status: ongoing">
                            ON GOING
                            <i class="fas fa-circle status-icon"></i>
                        </div>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#artworkModal-1">
                            View Details
                        </button>
                    </div>
                </article>

                <article class="artwork-item" data-artist="Xanne" data-title="Resting in Peace" role="listitem">
                    <div class="artwork-image">
                        <img src="assets/images/resting-in-peace.jpg" alt="Resting in Peace by Xanne" loading="lazy">
                    </div>
                    <div class="artwork-info">
                        <h2 class="artwork-title">Resting in Peace</h2>
                        <p class="artist-name">Xanne</p>
                        <div class="status ended" aria-label="Auction status: ended">
                            ENDED
                            <i class="far fa-circle status-icon"></i>
                        </div>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#artworkModal-2">
                            View Details
                        </button>
                    </div>
                </article>

                <article class="artwork-item" data-artist="Xanne" data-title="Prayer of Faith" role="listitem">
                    <div class="artwork-image">
                        <img src="assets/images/prayer-of-faith.jpg" alt="Prayer of Faith by Xanne" loading="lazy">
                    </div>
                    <div class="artwork-info">
                        <h2 class="artwork-title">Prayer of Faith</h2>
                        <p class="artist-name">Xanne</p>
                        <div class="status ended" aria-label="Auction status: ended">
                            ENDED
                            <i class="far fa-circle status-icon"></i>
                        </div>
                        <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#artworkModal-4">
                            View Details
                        </button>
                    </div>
                </article>
            </div>
        </main>

        <div class="toast-container"></div>
    </div>

    <div class="modal fade artwork-modal" id="artworkModal-1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Arouse A Rose</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="assets/images/arouse-a-rose.jpg" alt="Arouse A Rose by Xanne" class="img-fluid">
                    <div class="mt-3">
                        <h6>Artist: Xanne</h6>
                        <p>Current Bid: $5,000</p>
                        <p>Auction Ends: December 31, 2023</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Place Bid</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        const searchInput = $('#searchArtwork');
        const artworkItems = $('.artwork-item');
        let searchTimeout;

        function showToast(message) {
            const toast = $(`
                <div class="toast" role="alert" aria-live="polite">
                    <div class="toast-header">
                        <strong class="me-auto">Search Results</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">${message}</div>
                </div>
            `);

            $('.toast-container').append(toast);
            const bsToast = new bootstrap.Toast(toast[0]);
            bsToast.show();

            toast.on('hidden.bs.toast', function() {
                toast.remove();
            });
        }

        function performSearch() {
            const searchTerm = searchInput.val().toLowerCase().trim();
            let matchCount = 0;

            artworkItems.each(function() {
                const $item = $(this);
                const artist = $item.data('artist').toLowerCase();
                const title = $item.data('title').toLowerCase();
                const matches = artist.includes(searchTerm) || title.includes(searchTerm);

                $item.toggle(matches);
                $item.toggleClass('highlight', matches && searchTerm.length > 0);

                if (matches) {
                    matchCount++;
                    $item.attr('aria-hidden', 'false');
                } else {
                    $item.attr('aria-hidden', 'true');
                }
            });

            if (searchTerm.length > 0) {
                const message = `Found ${matchCount} artwork${matchCount !== 1 ? 's' : ''} matching "${searchTerm}"`;
                showToast(message);
            }

            $('#searchResults').remove();
            $('<div>', {
                id: 'searchResults',
                class: 'visually-hidden',
                'aria-live': 'polite',
                text: `${matchCount} artwork${matchCount !== 1 ? 's' : ''} found`
            }).appendTo('.search-container');
        }

        searchInput.on('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 300);
        });

        searchInput.on('keydown', function(e) {
            if (e.key === 'Escape') {
                $(this).val('').trigger('input');
                $(this).blur();
            }
        });

        $(document).on('click', '.artwork-item button', function() {
            const artworkItem = $(this).closest('.artwork-item');
            const title = artworkItem.find('.artwork-title').text();
            const artist = artworkItem.find('.artist-name').text();
            gtag('event', 'view_artwork', {
                'artwork_title': title,
                'artist_name': artist
            });
        });
    });
    </script>
</body>
</html>
