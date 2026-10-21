<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Design addScore(playerId, score), top(K) (sum of the K highest scores), and reset(playerId). For instance, after adding 73, 56, and 39 for players 1, 2, and 3, top(1) is 73; after reset(1), top(2) is 95. (Restated from memory; limits and examples may differ slightly.)\nRe-sort all scores on every addScore?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: select the top K when asked', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Updates would cost O(n log n).\nStep back to when you re-sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "top(K) how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort and take the first K', 'next' => 'wrong_b'],
                ['label' => 'heapq.nlargest(K, values)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong for speed. Full sorting is O(n log n); a heap is O(n log K).\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "addScore for a new player?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start from 0', 'next' => 'success'],
                ['label' => 'Ignore it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Players are created on first score.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) updates, O(n log K) top. Example: top(1) → 73, then top(2) → 95.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
