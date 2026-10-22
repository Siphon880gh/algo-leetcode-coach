<?php
/**
 * Curated pattern lists (Blind 75, NeetCode 150) from context-leetcode-lists/lists.json,
 * mapped onto this app's Algo Guides, mini games, and Step-by-step sessions by LeetCode number.
 */

declare(strict_types=1);

require_once __DIR__ . '/content.php';

/**
 * @return array{patterns: list<string>, lists: list<array{id: string, name: string, summary: string, source: string, sourceUrl: string, problems: list<array{n: int, slug: string, title: string, difficulty: string, pattern: string}>}>}
 */
function curated_lists_data(): array
{
    static $data = null;
    if ($data !== null) {
        return $data;
    }

    $path = dirname(__DIR__) . '/context-leetcode-lists/lists.json';
    $raw = is_file($path) ? file_get_contents($path) : false;
    $decoded = is_string($raw) ? json_decode($raw, true) : null;
    $data = [
        'patterns' => is_array($decoded['patterns'] ?? null) ? array_values($decoded['patterns']) : [],
        'lists' => is_array($decoded['lists'] ?? null) ? array_values($decoded['lists']) : [],
    ];

    return $data;
}

/**
 * @return array{id: string, name: string, summary: string, source: string, sourceUrl: string, problems: list<array{n: int, slug: string, title: string, difficulty: string, pattern: string}>}|null
 */
function curated_list_find(string $id): ?array
{
    foreach (curated_lists_data()['lists'] as $list) {
        if (($list['id'] ?? '') === $id) {
            return $list;
        }
    }

    return null;
}

/**
 * LeetCode number → app content slugs per type (guide = Algo Guide, session = Step-by-step, game = mini game).
 * Prefers the item whose slug matches the LeetCode slug when several share a number.
 *
 * @param array<int, string> $lcSlugs LeetCode number → LeetCode slug
 * @return array<int, array{guide?: string, session?: string, game?: string}>
 */
function curated_content_index(array $lcSlugs): array
{
    $sources = [
        'guide' => list_guides('algo'),
        'session' => list_content('coaching'),
        'game' => list_content('games'),
    ];
    $index = [];
    foreach ($sources as $type => $items) {
        foreach ($items as $item) {
            $n = content_leetcode_number($item['meta']);
            if ($n === null || !isset($lcSlugs[$n])) {
                continue;
            }
            $exact = $item['slug'] === $lcSlugs[$n];
            if (!isset($index[$n][$type]) || $exact) {
                $index[$n][$type] = $item['slug'];
            }
        }
    }

    return $index;
}

/**
 * @return array{guide: string, session: string, game: string}
 */
function curated_content_hrefs(): array
{
    return [
        'guide' => 'guides/view.php?id=',
        'session' => 'coaching/session.php?id=',
        'game' => 'games/play.php?id=',
    ];
}
