<?php
declare(strict_types=1);

require_once __DIR__ . '/content.php';

/**
 * @param array{title?: string, description?: string, active?: string} $opts
 */
function layout_start(array $opts = []): void
{
    $title = $opts['title'] ?? 'Algo Learning IDE with UI';
    $description = $opts['description'] ?? 'Interactive Cursor harness extension for system design, data structures, algorithms, and LeetCode.';
    $active = $opts['active'] ?? '';
    $pageTitle = $title === 'Algo Learning IDE with UI'
        ? $title
        : $title . ' · Algo Learning IDE with UI';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($description) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(url('assets/css/app.css')) ?>?v=<?= (int) @filemtime(dirname(__DIR__) . '/assets/css/app.css') ?>">
</head>
<body>
    <a class="skip-link" href="#main">Skip to content</a>
    <header class="site-header">
        <div class="site-header__inner">
            <a class="brand" href="<?= e(url('index.php')) ?>">
                <span class="brand__mark">AL</span>
                <span class="brand__text">Algo Learning IDE with UI</span>
            </a>
            <nav class="nav" aria-label="Primary">
                <a class="nav__link<?= $active === 'guides-cursor' ? ' is-active' : '' ?>" href="<?= e(guide_list_url('cursor')) ?>">Cursor AI</a>
                <span class="nav__divider" aria-hidden="true"></span>
                <a class="nav__link<?= $active === 'games' ? ' is-active' : '' ?>" href="<?= e(url('games/index.php')) ?>">Mini games</a>
                <a class="nav__link<?= $active === 'guides-algo' ? ' is-active' : '' ?>" href="<?= e(guide_list_url('algo')) ?>">Algo Guides</a>
                <a class="nav__link<?= $active === 'coaching' ? ' is-active' : '' ?>" href="<?= e(url('coaching/index.php')) ?>">Step-by-step</a>
                <a class="nav__link<?= $active === 'lists' ? ' is-active' : '' ?>" href="<?= e(url('lists/index.php')) ?>">Lists</a>
                <span class="nav__divider" aria-hidden="true"></span>
                <div class="recent-split" data-recent-split>
                    <button type="button" class="recent-open" id="recent-open" aria-expanded="false" aria-controls="recent-panel">Recent <span class="recent-open__n" data-recent-count hidden></span></button>
                    <span class="recent-split-sep" aria-hidden="true"></span>
                    <button type="button" class="recent-menu-toggle" id="recent-menu-toggle" aria-expanded="false" aria-haspopup="menu" aria-controls="recent-menu" aria-label="Recent actions"><span aria-hidden="true">▾</span></button>
                    <div id="recent-menu" class="recent-menu" role="menu" hidden>
                        <button type="button" class="recent-menu-item" id="recent-clear" role="menuitem">Clear recent</button>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main id="main" class="main">
    <?php
}

function layout_end(): void
{
    ?>
    </main>
    <footer class="site-footer">
        <div class="site-footer__inner">
            <p>For students of system design, data structures, algorithms, and LeetCode.</p>
            <p class="site-footer__muted">Interactive extension of the Cursor harness — prompt Cursor with <code>.agents/skills/harness</code> to create new guides, games, or step-by-step sessions.</p>
            <details class="site-credits">
                <summary class="site-credits__toggle">Credits</summary>
                <div class="site-credits__body">
                    <p class="site-credits__by">By Weng (Weng Fei Fung)</p>
                    <p class="site-credits__badges">
                        <img src="https://img.shields.io/github/last-commit/Siphon880gh/leetcode-coach/main" alt="Last Commit" height="20">
                        <a target="_blank" href="https://github.com/Siphon880gh" rel="noopener noreferrer">
                            <img src="https://img.shields.io/badge/GitHub--blue?style=social&amp;logo=GitHub" alt="GitHub" height="20">
                        </a>
                        <a target="_blank" href="https://www.linkedin.com/in/weng-fung/" rel="noopener noreferrer">
                            <img src="https://img.shields.io/badge/LinkedIn-blue?style=flat&amp;logo=linkedin&amp;labelColor=blue" alt="LinkedIn" height="20">
                        </a>
                        <a target="_blank" href="https://www.youtube.com/@WayneTeachesCode/" rel="noopener noreferrer">
                            <img src="https://img.shields.io/badge/Youtube-red?style=flat&amp;logo=youtube&amp;labelColor=red" alt="YouTube" height="20">
                        </a>
                    </p>
                </div>
            </details>
        </div>
    </footer>
    <?= premium_key_html() ?>
    <div id="recent-root" class="recent-root" aria-hidden="true">
        <button type="button" class="recent-backdrop" id="recent-backdrop" aria-label="Close recent" tabindex="-1"></button>
        <aside id="recent-panel" class="recent-panel" role="dialog" aria-modal="true" aria-labelledby="recent-title">
            <div class="recent-header">
                <h2 id="recent-title" class="recent-title">Recently visited</h2>
                <button type="button" class="recent-close" id="recent-close" aria-label="Close recent"><span aria-hidden="true">×</span></button>
            </div>
            <div class="recent-filters">
                <label class="recent-filter">
                    <span class="recent-filter__label">Category</span>
                    <select id="recent-filter-cat" class="recent-filter__select"></select>
                </label>
                <label class="recent-filter">
                    <span class="recent-filter__label">Resource Type</span>
                    <select id="recent-filter-type" class="recent-filter__select"></select>
                </label>
            </div>
            <details class="recent-cats" id="recent-cats">
                <summary class="recent-cats__summary">Count per category</summary>
                <div class="recent-count-wrap">
                    <table class="recent-count-table" id="recent-cat-table">
                        <thead>
                            <tr>
                                <th scope="col" aria-sort="none"><button type="button" class="recent-sort" data-sort="name">Category <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                                <th scope="col" class="recent-count__num" aria-sort="none"><button type="button" class="recent-sort" data-sort="count">Count <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                                <th scope="col" class="recent-count__num" aria-sort="none"><button type="button" class="recent-sort" data-sort="time">Time <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                            </tr>
                        </thead>
                        <tbody id="recent-cat-counts"></tbody>
                    </table>
                </div>
            </details>
            <details class="recent-cats" id="recent-types">
                <summary class="recent-cats__summary">Count per resource type</summary>
                <div class="recent-count-wrap">
                    <table class="recent-count-table" id="recent-type-table">
                        <thead>
                            <tr>
                                <th scope="col" aria-sort="none"><button type="button" class="recent-sort" data-sort="name">Resource type <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                                <th scope="col" class="recent-count__num" aria-sort="none"><button type="button" class="recent-sort" data-sort="count">Count <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                                <th scope="col" class="recent-count__num" aria-sort="none"><button type="button" class="recent-sort" data-sort="time">Time <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                            </tr>
                        </thead>
                        <tbody id="recent-type-counts"></tbody>
                    </table>
                </div>
            </details>
            <p class="recent-summary" id="recent-summary" aria-live="polite"></p>
            <div class="recent-body">
                <p id="recent-empty" class="recent-empty" hidden>Nothing visited yet. Open an Algo Guide, mini game, or Step-by-step session.</p>
                <table id="recent-table" class="recent-table">
                    <thead>
                        <tr>
                            <th scope="col" aria-sort="none"><button type="button" class="recent-sort" data-sort="name">Name <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                            <th scope="col" aria-sort="none"><button type="button" class="recent-sort" data-sort="date">Last visited <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                            <th scope="col" aria-sort="none"><button type="button" class="recent-sort" data-sort="time">Time <span class="recent-sort__icon" aria-hidden="true">↕</span></button></th>
                            <th scope="col" class="recent-delete-col"><span class="recent-sr">Delete</span></th>
                        </tr>
                    </thead>
                    <tbody id="recent-rows"></tbody>
                </table>
            </div>
            <div class="recent-footer" id="recent-footer">
                <button type="button" class="recent-clear-all" id="recent-clear-all">Clear all</button>
                <label class="recent-advanced">
                    <input type="checkbox" id="recent-advanced">
                    <span class="recent-advanced-track" aria-hidden="true"></span>
                    <span class="recent-advanced-label">Advanced</span>
                </label>
            </div>
        </aside>
    </div>
    <script src="<?= e(url('assets/js/app.js')) ?>?v=<?= (int) @filemtime(dirname(__DIR__) . '/assets/js/app.js') ?>" defer></script>
</body>
</html>
    <?php
}
