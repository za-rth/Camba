<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artwork Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    <style>
        .artwork-container {
            background-color: #fff;
            max-width: 1440px;
            margin: 0 auto;
            padding: 3px 0 30px;
        }

        .header {
            background-color: #fff;
            box-shadow: 0 4px 4px rgba(0,0,0,0.25);
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 157px;
            height: auto;
        }

        .home-link {
            font: 400 24px 'Open Sans', sans-serif;
            color: #000;
            text-decoration: none;
        }

        .search-bar {
            background-color: #D9D9D9;
            border-radius: 20px;
            padding: 16px 61px;
            font: 300 20px 'Open Sans', sans-serif;
            width: 100%;
            border: none;
            margin: 51px 0;
        }

        .section-title {
            font: 400 36px 'Inter', sans-serif;
            color: #000;
            margin-bottom: 22px;
        }

        .add-artwork-btn {
            background-color: #fff;
            border: 1px solid #636363;
            border-radius: 10px;
            color: #636363;
            font: 400 32px 'Inter', sans-serif;
            padding: 17px 70px;
            text-align: center;
            width: 100%;
            margin-bottom: 22px;
            transition: all 0.3s ease;
        }

        .add-artwork-btn:hover {
            background-color: #636363;
            color: #fff;
        }

        .artwork-card {
            background-color: #E8CAFB;
            padding: 25px;
            margin-bottom: 22px;
            border-radius: 8px;
            display: flex;
            gap: 20px;
            position: relative;
        }
        
        .artwork-image {
            width: 36%;
            aspect-ratio: 1.17;
            object-fit: cover;
        }

        .artwork-details {
            width: 64%;
            font: 400 24px 'Inter', sans-serif;
            color: #000;
        }

        .artwork-title {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .artwork-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 10px;
        }

        .btn-edit,
        .btn-delete {
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-edit {
            background-color: #ffc107;
            border: none;
            color: #000;
        }

        .btn-delete {
            background-color: #dc3545;
            border: none;
            color: #fff;
        }
        .btn-edit:hover {
            background-color: #ffca2c;
        }

        .btn-delete:hover {
            background-color: #bb2d3b;
        }

        .modal-dialog {
            max-width: 800px;
        }

        .modal-content {
            padding: 20px;
            border-radius: 12px;
        }

        @media (max-width: 991px) {
            .artwork-card {
                flex-direction: column;
            }

            .artwork-image,
            .artwork-details {
                width: 100%;
            }

            .add-artwork-btn {
                padding: 15px 30px;
                font-size: 24px;
            }

            .artwork-actions {
                position: relative;
                margin-top: 15px;
                justify-content: flex-end;
            }

        }
    </style>
</head>
<body>
    <div class="artwork-container">
        <header class="header">
            <img src="images/CAMBA.png" alt="Logo" class="logo">
            <a href="#" class="home-link">Home</a>
        </header>

        <main class="container">
            <input type="search" class="search-bar" placeholder="Search here..." aria-label="Search artworks">
            
            <h1 class="section-title">Manage Your Artworks</h1>
            
            <button type="button" class="add-artwork-btn" data-bs-toggle="modal" data-bs-target="#addArtworkModal">
                Add New Artwork +
            </button>

            <h2 class="section-title">Your Existing Artworks</h2>

            <div class="artwork-card">
                <img src="images/a2.jpg" alt="Resting in Peace Artwork" class="artwork-image">
                <div class="artwork-details">
                    <div class="artwork-title">Title: "Resting in Peace"</div>
                    <div>Description: Mixed Media: Recycled Plastic Bags & Oil Paint</div>
                    <div>Size: 25" x 30"</div>
                    <div>Year: 2023</div>
                </div>
                <div class="artwork-actions">
                    <button class="btn btn-edit" onclick="editArtwork(1)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-delete" onclick="deleteArtwork(1)">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>

            <div class="artwork-card">
                <img src="images/a2.jpg" alt="Resting in Peace Artwork" class="artwork-image">
                <div class="artwork-details">
                    <div class="artwork-title">Title: "Resting in Peace"</div>
                    <div>Description: Mixed Media: Recycled Plastic Bags & Oil Paint</div>
                    <div>Size: 25" x 30"</div>
                    <div>Year: 2023</div>
                </div>
                <div class="artwork-actions">
                    <button class="btn btn-edit" onclick="editArtwork(2)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-delete" onclick="deleteArtwork(2)">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>


            <div class="artwork-card">
                <img src="images/a2.jpg" alt="Resting in Peace Artwork" class="artwork-image">
                <div class="artwork-details">
                    <div class="artwork-title">Title: "Resting in Peace"</div>
                    <div>Description: Mixed Media: Recycled Plastic Bags & Oil Paint</div>
                    <div>Size: 25" x 30"</div>
                    <div>Year: 2023</div>
                </div>
                <div class="artwork-actions">
                    <button class="btn btn-edit" onclick="editArtwork(4)">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-delete" onclick="deleteArtwork(4)">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
        </main>
    </div>

    <div class="modal fade" id="addArtworkModal" tabindex="-1" aria-labelledby="addArtworkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addArtworkModalLabel">Add New Artwork</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="artworkForm">
                        <div class="mb-3">
                            <label for="artworkTitle" class="form-label">Artwork Title</label>
                            <input type="text" class="form-control" id="artworkTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="artworkDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="artworkDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="artworkSize" class="form-label">Size</label>
                            <input type="text" class="form-control" id="artworkSize" required>
                        </div>
                        <div class="mb-3">
                            <label for="artworkYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="artworkYear" required>
                        </div>
                        <div class="mb-3">
                            <label for="artworkImage" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" id="artworkImage" accept="image/*" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="artworkForm" class="btn btn-primary">Save Artwork</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editArtworkModal" tabindex="-1" aria-labelledby="editArtworkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editArtworkModalLabel">Edit Artwork</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editArtworkForm">
                        <input type="hidden" id="editArtworkId">
                        <div class="mb-3">
                            <label for="editArtworkTitle" class="form-label">Artwork Title</label>
                            <input type="text" class="form-control" id="editArtworkTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editArtworkDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editArtworkDescription" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editArtworkSize" class="form-label">Size</label>
                            <input type="text" class="form-control" id="editArtworkSize" required>
                        </div>
                        <div class="mb-3">
                            <label for="editArtworkYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="editArtworkYear" required>
                        </div>
                        <div class="mb-3">
                            <label for="editArtworkImage" class="form-label">Upload New Image (Optional)</label>
                            <input type="file" class="form-control" id="editArtworkImage" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="editArtworkForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this artwork? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentArtworkId = null;

        document.getElementById('artworkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            saveArtwork(formData);
        });

        document.getElementById('editArtworkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            updateArtwork(formData);
        });

        function saveArtwork(formData) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('addArtworkModal'));
            modal.hide();
            document.getElementById('artworkForm').reset();
        }

        function editArtwork(artworkId) {
            currentArtworkId = artworkId;
            const editModal = new bootstrap.Modal(document.getElementById('editArtworkModal'));
            editModal.show();
        }

        function updateArtwork(formData) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('editArtworkModal'));
            modal.hide();
            document.getElementById('editArtworkForm').reset();
        }

        function deleteArtwork(artworkId) {
            currentArtworkId = artworkId;
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            deleteModal.show();
        }

        function confirmDelete() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
            modal.hide();
            currentArtworkId = null;
        }
    </script>
</body>
</html>
