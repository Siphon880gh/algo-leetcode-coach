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
            'message' => "Read the problem statement above.\nDeletions inside the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(p[r] − p[l]) − (r − l)', 'next' => 's2'],
                ['label' => 'p[r] − p[l]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts kept elements as deletions; example 1 → 2 instead of 3.\nStep back to when you used the span.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer for the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[r] − p[l] + 1', 'next' => 'wrong_b'],
                ['label' => 'r − l + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the width in nums; example 1 → 5 instead of 3.\nStep back to when you used the width.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
