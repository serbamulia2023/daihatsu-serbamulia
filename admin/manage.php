
<?php

require dirname(__DIR__) . '/config/config.php';
require_admin();

$type = (string) ($_GET['type'] ?? 'cars');

$schemas = [
    'cars' => [
        'label' => 'Mobil',
        'table' => 'cars',
        'fields' => [
            'name'        => ['Nama mobil', 'text', true],
            'category'    => ['Kategori', 'text', true],
            'description' => ['Deskripsi', 'textarea', false],
            'image_url'   => ['URL gambar', 'url', false],
            'contact_url' => ['URL kontak', 'url', false],
            'sort_order'  => ['Urutan', 'number', true],
            'is_active'   => ['Aktif ditampilkan', 'checkbox', false],
        ],
    ],
    'branches' => [
        'label' => 'Cabang',
        'table' => 'branches',
        'fields' => [
            'name'        => ['Nama cabang', 'text', true],
            'slug'        => ['Slug URL (contoh: samarinda)', 'text', true],
            'region'      => ['Wilayah', 'text', true],
            'address'     => ['Alamat', 'textarea', false],
            'image_url'   => ['URL foto dealer (tautan gambar langsung)', 'url', false],
            'description' => ['Deskripsi', 'textarea', false],
            'whatsapp'    => ['Nomor WhatsApp (format internasional)', 'text', false],
            'facebook_url'  => ['URL Facebook cabang', 'url', false],
            'instagram_url' => ['URL Instagram cabang', 'url', false],
            'tiktok_url'    => ['URL TikTok cabang', 'url', false],
            'maps_url'    => ['URL Google Maps', 'url', false],
            'hours'       => ['Jam operasional', 'textarea', false],
            'sort_order'  => ['Urutan', 'number', true],
            'is_active'   => ['Aktif ditampilkan', 'checkbox', false],
        ],
    ],
    'promos' => [
        'label' => 'Promo',
        'table' => 'promos',
        'fields' => [
            'title'     => ['Judul promo', 'text', true],
            'summary'   => ['Deskripsi promo', 'textarea', true],
            'image_url' => ['URL gambar promo (tautan gambar langsung)', 'url', false],
            'branch_id' => ['ID cabang (kosongkan untuk semua cabang)', 'number', false],
            'contact_whatsapp' => ['Nomor WhatsApp khusus promo (opsional, format internasional)', 'text', false],
            'end_date'  => ['Tanggal berakhir', 'date', false],
            'is_active' => ['Aktif ditampilkan', 'checkbox', false],
        ],
    ],
    'articles' => [
        'label' => 'Artikel',
        'table' => 'articles',
        'fields' => [
            'title'        => ['Judul artikel', 'text', true],
            'slug'         => ['Slug URL', 'text', true],
            'content'      => ['Konten artikel', 'textarea', true],
            'image_url'    => ['URL gambar', 'url', false],
            'is_published' => ['Publikasikan', 'checkbox', false],
        ],
    ],
];

if (!isset($schemas[$type])) {
    http_response_code(400);
    exit('Jenis konten tidak valid.');
}

$schema = $schemas[$type];
$table = $schema['table'];
$fields = $schema['fields'];

$error = '';
$success = '';

/**
 * Normalisasi slug untuk URL.
 */
function normalize_slug(string $value): string
{
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';

    return trim($value, '-');
}

/**
 * Validasi URL opsional.
 */
function validate_optional_url(?string $value, string $label): void
{
    if ($value !== null && filter_var($value, FILTER_VALIDATE_URL) === false) {
        throw new RuntimeException($label . ' harus berupa URL yang valid.');
    }
}

/**
 * Proses form.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();

    $action = (string) ($_POST['action'] ?? '');

    try {
        if ($action === 'delete') {
            $id = filter_var(
                $_POST['id'] ?? null,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 1]]
            );

            if ($id === false || $id === null) {
                throw new RuntimeException('ID data tidak valid.');
            }

            $stmt = db()->prepare(
                "DELETE FROM `$table` WHERE id = ?"
            );
            $stmt->execute([$id]);

            $success = $stmt->rowCount() > 0
                ? 'Data berhasil dihapus.'
                : 'Data tidak ditemukan.';

        } elseif ($action === 'save') {
            $id = filter_var(
                $_POST['id'] ?? 0,
                FILTER_VALIDATE_INT,
                ['options' => ['min_range' => 0]]
            );

            if ($id === false || $id === null) {
                throw new RuntimeException('ID data tidak valid.');
            }

            $id = (int) $id;
            $values = [];

            foreach ($fields as $key => $meta) {
                [$label, $inputType, $required] = $meta;

                if ($inputType === 'checkbox') {
                    $values[$key] = isset($_POST[$key]) ? 1 : 0;
                    continue;
                }

                $rawValue = trim((string) ($_POST[$key] ?? ''));

                if ($required && $rawValue === '') {
                    throw new RuntimeException(
                        $label . ' wajib diisi.'
                    );
                }

                if ($key === 'slug' && $rawValue !== '') {
                    $rawValue = normalize_slug($rawValue);

                    if ($rawValue === '') {
                        throw new RuntimeException(
                            'Slug tidak valid.'
                        );
                    }
                }

                if ($inputType === 'number' && $rawValue !== '') {
                    $number = filter_var(
                        $rawValue,
                        FILTER_VALIDATE_INT
                    );

                    if ($number === false || $number < 0) {
                        throw new RuntimeException(
                            $label . ' harus berupa bilangan bulat nonnegatif.'
                        );
                    }

                    $values[$key] = $number;
                    continue;
                }

                if ($inputType === 'url' && $rawValue !== '') {
                    validate_optional_url($rawValue, $label);
                }

                if ($inputType === 'date' && $rawValue !== '') {
                    $date = DateTime::createFromFormat(
                        '!Y-m-d',
                        $rawValue
                    );

                    if (!$date || $date->format('Y-m-d') !== $rawValue) {
                        throw new RuntimeException(
                            $label . ' tidak valid.'
                        );
                    }
                }

                $values[$key] = $rawValue === ''
                    ? null
                    : $rawValue;
            }

            // Promo tanpa cabang berlaku untuk semua cabang.
            if ($type === 'promos' && empty($values['branch_id'])) {
                $values['branch_id'] = null;
            }

            // Validasi slug unik sebelum menyimpan.
            if (in_array($type, ['branches', 'articles'], true)) {
                $slugCheck = db()->prepare(
                    "SELECT id FROM `$table`
                     WHERE slug = ? AND id <> ?
                     LIMIT 1"
                );
                $slugCheck->execute([
                    $values['slug'],
                    $id,
                ]);

                if ($slugCheck->fetch()) {
                    throw new RuntimeException(
                        'Slug sudah digunakan. Silakan gunakan slug lain.'
                    );
                }
            }

            // Atur published_at untuk artikel.
            if ($type === 'articles') {
                if (!empty($values['is_published'])) {
                    if ($id > 0) {
                        $check = db()->prepare(
                            'SELECT published_at FROM articles WHERE id = ?'
                        );
                        $check->execute([$id]);
                        $old = $check->fetch(PDO::FETCH_ASSOC);

                        $values['published_at'] =
                            !empty($old['published_at'])
                                ? $old['published_at']
                                : date('Y-m-d H:i:s');
                    } else {
                        $values['published_at'] = date('Y-m-d H:i:s');
                    }
                } else {
                    $values['published_at'] = null;
                }
            }

            if ($id > 0) {
                // Pastikan data yang akan diedit benar-benar ada.
                $exists = db()->prepare(
                    "SELECT id FROM `$table` WHERE id = ?"
                );
                $exists->execute([$id]);

                if (!$exists->fetch()) {
                    throw new RuntimeException(
                        'Data yang akan diedit tidak ditemukan.'
                    );
                }

                $sets = [];

                foreach (array_keys($values) as $key) {
                    $sets[] = "`$key` = ?";
                }

                $sql = "UPDATE `$table` SET "
                    . implode(', ', $sets)
                    . ' WHERE id = ?';

                $stmt = db()->prepare($sql);
                $stmt->execute([
                    ...array_values($values),
                    $id,
                ]);
            } else {
                $columns = array_keys($values);
                $quotedColumns = array_map(
                    static fn ($key) => "`$key`",
                    $columns
                );
                $placeholders = array_fill(
                    0,
                    count($columns),
                    '?'
                );

                $sql = "INSERT INTO `$table` ("
                    . implode(', ', $quotedColumns)
                    . ') VALUES ('
                    . implode(', ', $placeholders)
                    . ')';

                $stmt = db()->prepare($sql);
                $stmt->execute(array_values($values));
            }

            $success = 'Data berhasil disimpan.';

        } else {
            throw new RuntimeException('Aksi tidak valid.');
        }

    } catch (Throwable $ex) {
        $error = $ex instanceof RuntimeException
            ? $ex->getMessage()
            : 'Gagal memproses data. Periksa data yang dimasukkan dan struktur database.';

        // Catat detail kesalahan di log server, bukan di halaman admin.
        if (!($ex instanceof RuntimeException)) {
            error_log(
                '[Admin manage.php] ' . $ex->getMessage()
            );
        }
    }
}

/**
 * Ambil data yang akan diedit.
 */
$edit = null;

if (isset($_GET['edit'])) {
    $editId = filter_var(
        $_GET['edit'],
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );

    if ($editId === false || $editId === null) {
        $error = 'ID data yang akan diedit tidak valid.';
    } else {
        $stmt = db()->prepare(
            "SELECT * FROM `$table` WHERE id = ?"
        );
        $stmt->execute([$editId]);
        $edit = $stmt->fetch(PDO::FETCH_ASSOC) ?: null;

        if (!$edit && $error === '') {
            $error = 'Data yang akan diedit tidak ditemukan.';
        }
    }
}

/**
 * Urutan daftar data.
 */
switch ($type) {
    case 'cars':
    case 'branches':
        $order = 'sort_order ASC, id ASC';
        break;

    case 'articles':
        $order = 'id DESC';
        break;

    case 'promos':
        $order = 'created_at DESC';
        break;

    default:
        $order = 'id DESC';
}

$rows = db()
    ->query("SELECT * FROM `$table` ORDER BY $order")
    ->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Kelola ' . $schema['label'] . ' | Admin';

require dirname(__DIR__) . '/includes/header.php';
?>

<main class="page-content">
    <div class="container">

        <div class="admin-top">
            <div>
                <div class="eyebrow">Dashboard Admin</div>
                <h1 class="page-title">
                    Kelola <?= e($schema['label']) ?>
                </h1>
            </div>

            <a class="btn btn-outline"
               href="<?= e(url('admin/index.php')) ?>">
                &larr; Dashboard
            </a>
        </div>

        <?php if ($success !== ''): ?>
            <p class="notice success"><?= e($success) ?></p>
        <?php endif; ?>

        <?php if ($error !== ''): ?>
            <p class="notice error"><?= e($error) ?></p>
        <?php endif; ?>

        <section class="admin-editor">
            <h2><?= $edit ? 'Edit data' : 'Tambah data' ?></h2>

            <form method="post" class="admin-form">
                <input type="hidden"
                       name="csrf_token"
                       value="<?= e(csrf_token()) ?>">

                <input type="hidden" name="action" value="save">

                <input type="hidden"
                       name="id"
                       value="<?= (int) ($edit['id'] ?? 0) ?>">

                <div class="form-grid">
                    <?php foreach ($fields as $key => $meta): ?>
                        <?php
                        $value = $edit[$key]
                            ?? ($key === 'sort_order' ? 0 : '');

                        $isTextarea = $meta[1] === 'textarea';
                        $isCheckbox = $meta[1] === 'checkbox';

                        $labelClass = $isTextarea
                            ? 'full'
                            : '';

                        if ($isCheckbox) {
                            $labelClass .= ' checkbox-label';
                        }

                        $checked = $isCheckbox && (
                            (int) $value === 1
                            || (
                                !$edit
                                && in_array(
                                    $key,
                                    ['is_active', 'is_published'],
                                    true
                                )
                            )
                        );
                        ?>

                        <label class="<?= e(trim($labelClass)) ?>">
                            <?= e($meta[0]) ?>

                            <?php if ($isTextarea): ?>
                                <textarea
                                    name="<?= e($key) ?>"
                                    rows="4"
                                    <?= $meta[2] ? 'required' : '' ?>
                                ><?= e((string) $value) ?></textarea>

                            <?php elseif ($isCheckbox): ?>
                                <input
                                    type="checkbox"
                                    name="<?= e($key) ?>"
                                    value="1"
                                    <?= $checked ? 'checked' : '' ?>
                                >

                            <?php else: ?>
                                <input
                                    type="<?= e($meta[1]) ?>"
                                    name="<?= e($key) ?>"
                                    value="<?= e((string) $value) ?>"
                                    <?= $meta[2] ? 'required' : '' ?>
                                    <?= $meta[1] === 'number'
                                        ? 'step="1" min="0"'
                                        : '' ?>
                                >
                            <?php endif; ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="form-actions">
                    <button class="btn btn-red" type="submit">
                        Simpan
                    </button>

                    <?php if ($edit): ?>
                        <a class="btn btn-outline"
                           href="<?= e(url('admin/manage.php?type=' . $type)) ?>">
                            Batal edit
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </section>

        <h2 class="list-heading">
            Data tersimpan (<?= count($rows) ?>)
        </h2>

        <div class="table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama / Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($rows as $row): ?>
                        <?php
                        $name = $row['name']
                            ?? $row['title']
                            ?? '(Tanpa nama)';

                        if ($type === 'promos') {
                            $active = (int) ($row['is_active'] ?? 0);
                        } elseif ($type === 'articles') {
                            $active = (int) ($row['is_published'] ?? 0);
                        } else {
                            $active = (int) ($row['is_active'] ?? 0);
                        }
                        ?>

                        <tr>
                            <td><?= (int) $row['id'] ?></td>

                            <td>
                                <strong><?= e((string) $name) ?></strong>

                                <small>
                                    <?php if (isset($row['slug'])): ?>
                                        <?= e((string) $row['slug']) ?>
                                    <?php elseif (isset($row['category'])): ?>
                                        <?= e((string) $row['category']) ?>
                                    <?php elseif (isset($row['branch_id'])): ?>
                                        <?= empty($row['branch_id'])
                                            ? 'Semua cabang'
                                            : 'Cabang ID: ' . (int) $row['branch_id'] ?>
                                    <?php endif; ?>
                                </small>
                            </td>

                            <td>
                                <span class="status <?= $active
                                    ? 'status-on'
                                    : 'status-off' ?>">
                                    <?= $active ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </td>

                            <td class="actions">
                                <a class="text-link"
                                   href="<?= e(url(
                                       'admin/manage.php?type='
                                       . $type
                                       . '&edit='
                                       . (int) $row['id']
                                   )) ?>">
                                    Edit
                                </a>

                                <form method="post"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                    <input type="hidden"
                                           name="csrf_token"
                                           value="<?= e(csrf_token()) ?>">

                                    <input type="hidden"
                                           name="action"
                                           value="delete">

                                    <input type="hidden"
                                           name="id"
                                           value="<?= (int) $row['id'] ?>">

                                    <button class="link-danger" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (!$rows): ?>
                        <tr>
                            <td colspan="4">Belum ada data.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
