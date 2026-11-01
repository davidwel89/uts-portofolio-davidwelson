<?php
$errors = [];
$sukses = false;
$dataBersih = [
    'nama'   => '',
    'email'  => '',
    'subjek' => '',
    'pesan'  => ''
];

$berkasJson = 'storage/pesan_kontak.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $email  = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subjek = isset($_POST['subjek']) ? trim($_POST['subjek']) : '';
    $pesan  = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';

    $dataBersih = [
        'nama'   => $nama,
        'email'  => $email,
        'subjek' => $subjek,
        'pesan'  => $pesan
    ];

    if (empty($nama)) {
        $errors[] = 'Please enter your full name.';
    }
    if (empty($email)) {
        $errors[] = 'Please provide your email address.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (empty($subjek)) {
        $errors[] = 'Please specify a subject.';
    }
    if (empty($pesan)) {
        $errors[] = 'Please write your message.';
    }

    if (empty($errors)) {
        $sukses = true;

        if (!is_dir('storage')) {
            mkdir('storage', 0777, true);
        }

        $riwayatPesan = [];
        if (file_exists($berkasJson)) {
            $isiLama = file_get_contents($berkasJson);
            $decoded = json_decode($isiLama, true);
            if (is_array($decoded)) {
                $riwayatPesan = $decoded;
            }
        }

        $riwayatPesan[] = [
            'waktu'  => date('Y-m-d H:i:s'),
            'nama'   => $nama,
            'email'  => $email,
            'subjek' => $subjek,
            'pesan'  => $pesan
        ];

        file_put_contents($berkasJson, json_encode($riwayatPesan, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

$judulHalaman = 'Get In Touch — David Welson';
require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="flex-grow-1" style="padding-top: 100px;">
    <div id="content" class="container py-5">
        <article class="mx-auto" style="max-width: 780px;">
            <p class="alva-eyebrow mb-2">CONTACT</p>
            <h1 class="alva-section-title">Get In Touch</h1>
            <div class="alva-double-bar mb-4">
                <span class="bar-main"></span>
                <span class="bar-sub"></span>
            </div>
            <p class="alva-lead mb-4">
                Have a question, project proposal, or collaboration idea? Drop a message below and I will get back to you soon.
            </p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger rounded-4 p-4 mb-4 border-0 shadow-sm" role="alert">
                    <h2 class="h6 fw-bold mb-2">Please check your input:</h2>
                    <ul class="mb-0 small">
                        <?php foreach ($errors as $err): ?>
                            <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($sukses): ?>
                <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm mb-5">
                    <span class="badge text-bg-dark mb-2">Message Received</span>
                    <h2 class="h4 fw-bold text-dark mb-2">Thank you for reaching out!</h2>
                    <p class="small text-contrast-muted mb-4">Here is a summary of your message:</p>

                    <div class="d-flex flex-column gap-3 p-3 rounded-3 bg-light border small mb-4">
                        <div class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-contrast-muted">Name</span>
                            <strong class="text-dark"><?php echo htmlspecialchars($dataBersih['nama'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-contrast-muted">Email</span>
                            <strong class="text-dark"><?php echo htmlspecialchars($dataBersih['email'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-2">
                            <span class="text-contrast-muted">Subject</span>
                            <strong class="text-dark"><?php echo htmlspecialchars($dataBersih['subjek'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        </div>
                        <div>
                            <span class="text-contrast-muted d-block mb-1">Message</span>
                            <div class="fw-semibold text-dark"><?php echo nl2br(htmlspecialchars($dataBersih['pesan'], ENT_QUOTES, 'UTF-8')); ?></div>
                        </div>
                    </div>

                    <a href="index.html" class="btn-alva-primary py-2 px-4">&larr; Back to Portfolio</a>
                </div>
            <?php endif; ?>

            <div class="p-4 p-md-5 rounded-4 bg-white border shadow-sm">
                <h2 class="h4 fw-bold text-dark mb-1">Send a Direct Message</h2>
                <p class="small text-contrast-muted mb-4">All fields are required.</p>

                <form action="kontak.php" method="POST" class="d-flex flex-column gap-3" novalidate>
                    <div>
                        <label for="nama" class="form-label small fw-bold text-dark">Your Name</label>
                        <input type="text" class="form-control alva-input" id="nama" name="nama"
                            value="<?php echo !$sukses ? htmlspecialchars($dataBersih['nama'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                            placeholder="John Doe" required>
                    </div>

                    <div>
                        <label for="email" class="form-label small fw-bold text-dark">Email Address</label>
                        <input type="email" class="form-control alva-input" id="email" name="email"
                            value="<?php echo !$sukses ? htmlspecialchars($dataBersih['email'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                            placeholder="john@example.com" required>
                    </div>

                    <div>
                        <label for="subjek" class="form-label small fw-bold text-dark">Subject</label>
                        <input type="text" class="form-control alva-input" id="subjek" name="subjek"
                            value="<?php echo !$sukses ? htmlspecialchars($dataBersih['subjek'], ENT_QUOTES, 'UTF-8') : ''; ?>"
                            placeholder="Project Inquiry" required>
                    </div>

                    <div>
                        <label for="pesan" class="form-label small fw-bold text-dark">Message</label>
                        <textarea class="form-control alva-input" id="pesan" name="pesan" rows="4"
                            placeholder="Write your message here..." required><?php echo !$sukses ? htmlspecialchars($dataBersih['pesan'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-2">
                        <button type="submit" class="btn-alva-primary px-4 py-3">Send Message &rarr;</button>
                        <a href="index.html" class="btn-alva-outline px-4 py-3">Back to Home</a>
                    </div>
                </form>
            </div>
        </article>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>