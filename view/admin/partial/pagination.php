<?php
// $pagination object (Core\Pagination) được truyền từ controller
// Can be $pagination or $tabPagination depending on context
$paginationObj = $tabPagination ?? $pagination ?? null;
if (!$paginationObj || !$paginationObj->hasPages())
    return;

$current = $paginationObj->getCurrentPage();
$total = $paginationObj->getTotalPages();
$baseUrl = strtok($_SERVER['REQUEST_URI'], '?'); // remove existing query string

// Preserve search and tab parameters
$search = isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '';
$tab = isset($_GET['tab']) ? '&tab=' . urlencode($_GET['tab']) : '';
$queryParams = $tab . $search;
?>

<div class="card-footer d-flex align-items-center m-2">
    <p class="m-0 text-muted">Hiển thị <span><?php echo (($current - 1) * 10 + 1); ?></span> đến
        <span><?php echo min($current * 10, $pagination->getTotal()); ?></span> trong tổng số
        <span><?php echo $pagination->getTotal(); ?></span> kết quả
    </p>
    <ul class="inline-flex items-center space-x-1">
        <?php if ($current > 1): ?>
            <li class="page-item"><a class="page-link"
                    href="<?php echo $baseUrl; ?>?page=<?php echo ($current - 1); ?>">Trước</a></li>
        <?php endif; ?>

        <?php for ($i = max(1, $current - 2); $i <= min($total, $current + 2); $i++): ?>
            <li class="page-item <?php echo ($i === $current) ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $baseUrl; ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($current < $total): ?>
            <li class="page-item"><a class="page-link"
                    href="<?php echo $baseUrl; ?>?page=<?php echo ($current + 1); ?>">Sau</a></li>
        <?php endif; ?>
    </ul>
</div>