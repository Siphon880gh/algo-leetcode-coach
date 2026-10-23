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
            'message' => "Problem: You get a list of requests, each a [userId, time] pair, plus integers k and window. Remove as few requests as possible so that no user has more than k kept requests inside any time window of length window. Return how many requests you can keep. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWindow per?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each user', 'next' => 's2'],
                ['label' => 'All requests together', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [[1, 1], [1, 2], [2, 2], [2, 3]], k = 2, window = 1 → 3 instead of 4.\nStep back to when you pooled users.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop the front when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't − front ≥ window', 'next' => 'wrong_b'],
                ['label' => 't − front > window', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [[1, 1], [1, 2], [1, 3], [2, 5]], k = 2, window = 2 → 4 instead of 3.\nStep back to when you made it ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Constructed checks → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
