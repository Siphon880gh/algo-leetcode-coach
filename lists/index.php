<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/layout.php';
require_once dirname(__DIR__) . '/includes/curated_lists.php';

$data = curated_lists_data();
$lists = $data['lists'];
$listId = isset($_GET['list']) ? (string) $_GET['list'] : '';
$list = curated_list_find($listId);
if ($list === null && $lists !== []) {
    $list = $lists[0];
    $listId = (string) $list['id'];
}
$pattern = isset($_GET['pattern']) ? trim((string) $_GET['pattern']) : '';

layout_start([
    'title' => $list !== null ? (string) $list['name'] : 'Curated lists',
    'description' => 'Blind 75 and NeetCode 150, pattern by pattern, linked to Algo Guides, mini games, and Step-by-step sessions.',
    'active' => 'lists',
]);

if ($list === null) {
    echo '<p class="empty-state">No curated lists found. Run <code>python3 context-leetcode-lists/build.py</code>.</p>';
    layout_end();
    return;
}

$problems = $list['problems'];
$lcSlugs = [];
foreach ($problems as $p) {
    $lcSlugs[(int) $p['n']] = (string) $p['slug'];
}
$index = curated_content_index($lcSlugs);
$hrefs = curated_content_hrefs();
$typeLabels = ['guide' => 'Algo Guide', 'session' => 'Step-by-step', 'game' => 'Mini game'];

/** @var array<string, list<array{n: int, slug: string, title: string, difficulty: string, pattern: string}>> $groups */
$groups = [];
foreach ($data['patterns'] as $name) {
    $groups[$name] = [];
}
foreach ($problems as $p) {
    $groups[(string) $p['pattern']][] = $p;
}
$groups = array_filter($groups, static function (array $rows): bool {
    return $rows !== [];
});
$patternValid = $pattern !== '' && isset($groups[$pattern]);
$visibleGroups = $patternValid ? [$pattern => $groups[$pattern]] : $groups;

$withContent = 0;
foreach ($problems as $p) {
    if (!empty($index[(int) $p['n']])) {
        $withContent++;
    }
}
$total = count($problems);
$allHref = content_list_href('lists/index.php', ['list' => $listId]);
?>

<div class="page-head">
    <h1>Curated lists</h1>
    <p>
        Work through the core coding patterns (two pointers, sliding window, trees, and more) instead of grinding raw problem counts.
        Each problem links to this app's Algo Guide, Step-by-step session, or mini game when one exists.
    </p>
</div>

<nav class="clist-tabs" aria-label="Curated lists">
    <?php foreach ($lists as $l): ?>
        <a
            class="clist-tab<?= $l['id'] === $listId ? ' is-current' : '' ?>"
            href="<?= e(content_list_href('lists/index.php', ['list' => (string) $l['id']])) ?>"
            <?= $l['id'] === $listId ? 'aria-current="page"' : '' ?>
        ><?= e((string) $l['name']) ?> <span class="resource-n">(<?= count($l['problems']) ?>)</span></a>
    <?php endforeach; ?>
</nav>

<div class="clist" data-clist data-clist-total="<?= (int) $total ?>">
    <p class="clist__summary"><?= curated_list_summary_html($list) ?></p>
    <div class="clist__stats">
        <span class="clist-stat"><strong><?= (int) $withContent ?>/<?= (int) $total ?></strong> have content in this app</span>
        <span class="clist-stat" data-clist-progress hidden></span>
    </div>

    <div class="browse__toolbar">
        <h2 class="browse__heading"><?= e($patternValid ? $pattern : 'All patterns') ?> <span class="resource-n">(<?= $patternValid ? count($groups[$pattern]) : $total ?>)</span></h2>
        <div class="browse__actions">
            <div class="filter-ctrl">
                <div class="pop" data-pop>
                    <button
                        type="button"
                        class="pop__btn<?= $patternValid ? ' is-active has-filter' : '' ?>"
                        data-pop-btn
                        aria-expanded="false"
                        aria-controls="clist-filter"
                        aria-haspopup="dialog"
                        aria-label="<?= $patternValid ? 'Filter, ' . e($pattern) : 'Filter' ?>"
                    >Filter</button>
                    <div id="clist-filter" class="pop__panel" data-pop-panel hidden role="dialog" aria-label="Filter">
                        <p class="pop__title">Patterns</p>
                        <ul class="pop__list pop__list--topics">
                            <li>
                                <a class="pop__opt<?= !$patternValid ? ' is-current' : '' ?>" href="<?= e($allHref) ?>">All patterns <span class="resource-n">(<?= (int) $total ?>)</span></a>
                            </li>
                            <?php foreach ($groups as $name => $rows): ?>
                                <li>
                                    <a
                                        class="pop__opt pop__opt--cat<?= $patternValid && $pattern === $name ? ' is-current' : '' ?>"
                                        href="<?= e(content_list_href('lists/index.php', ['list' => $listId, 'pattern' => $name])) ?>"
                                    ><?= e($name) ?> <span class="resource-n">(<?= count($rows) ?>)</span></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <a class="filter-clear" href="<?= e($allHref) ?>" aria-label="Clear filters" <?= $patternValid ? '' : 'hidden' ?>>×</a>
            </div>
        </div>
    </div>

    <?php foreach ($visibleGroups as $name => $rows): ?>
        <section class="clist-group" data-clist-group>
            <h3 class="clist-group__title">
                <?= e($name) ?>
                <span class="resource-n">(<?= count($rows) ?>)</span>
                <span class="clist-group__progress" data-clist-group-progress hidden></span>
            </h3>
            <ol class="clist-items">
                <?php foreach ($rows as $p): ?>
                    <?php
                    $n = (int) $p['n'];
                    $found = $index[$n] ?? [];
                    $diff = content_leetcode_normalize_difficulty($p['difficulty']) ?? '';
                    ?>
                    <li class="clist-item<?= $found === [] ? ' is-missing' : '' ?>" data-leetcode="<?= $n ?>">
                        <span class="clist-item__check" data-clist-check title="Not visited yet" aria-hidden="true"></span>
                        <span class="clist-item__main">
                            <span class="clist-item__title"><?= e((string) $p['title']) ?></span>
                            <span class="clist-item__meta">
                                <?= content_leetcode_label_html($n) ?>
                                <?php if ($diff !== ''): ?>
                                    <span class="leetcode-diff leetcode-diff--<?= e(content_leetcode_difficulty_class($diff)) ?>"><?= e($diff) ?></span>
                                <?php endif; ?>
                                <?php if ($n > 0 && trim((string) $p['title']) !== ''): ?>
                                    <?= content_youtube_link_html($n, (string) $p['title']) ?>
                                <?php endif; ?>
                            </span>
                        </span>
                        <span class="clist-item__links">
                            <?php if ($found === []): ?>
                                <span class="clist-missing" title="This app has no guide, game, or Step-by-step for this problem yet. Prompt Cursor with .agents/skills/harness to create one.">Not in app yet</span>
                            <?php else: ?>
                                <?php foreach (['guide', 'session', 'game'] as $type): ?>
                                    <?php if (isset($found[$type])): ?>
                                        <a class="clist-link clist-link--<?= e($type) ?>" href="<?= e(url($hrefs[$type] . rawurlencode($found[$type]))) ?>" target="_blank" rel="noopener"><?= e($typeLabels[$type]) ?></a>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>
    <?php endforeach; ?>

    <p class="clist__source">
        Source: <a href="<?= e((string) $list['sourceUrl']) ?>" target="_blank" rel="noopener noreferrer"><?= e((string) $list['source']) ?></a>.
        Visited checkmarks come from your Recent list on this browser.
    </p>
</div>

<?php
layout_end();
