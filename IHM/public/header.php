<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion École - <?php echo isset($page_title) ? $page_title : 'Accueil'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="IHM/public/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Header principal -->
            <header class="col-12 bg-primary text-white py-3">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="mb-0">
                                <i class="fas fa-graduation-cap me-2"></i>
                                Gestion École
                            </h1>
                        </div>
                        <div class="col-md-6 text-end">
                            <?php
                            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                                echo '<span class="badge bg-success me-2">';
                                echo '<i class="fas fa-user me-1"></i>';
                                echo 'Connecté en tant que: ' . htmlspecialchars($_SESSION['username']);
                                echo ' (' . ucfirst($_SESSION['role']) . ')';
                                echo '</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
