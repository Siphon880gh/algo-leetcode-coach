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
            'message' => "Read the problem statement above.\nSearch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greedy, one word per run', 'next' => 's2'],
                ['label' => 'Try every subsequence', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n reaches 100, so that is up to 2^100 subsequences.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep word i when its group differs from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'groups[0]', 'next' => 'wrong_b'],
                ['label' => 'groups[i − 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → [a, b] instead of [a, b, c].\nStep back to when you compared with the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [e, b], [a, b, c].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
