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
            'message' => "Read the problem statement above.\nSubtract which count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(lower − 1)', 'next' => 's2'],
                ['label' => 'count(lower)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That removes pairs whose sum is exactly lower; Example 2 → 0 instead of 1.\nStep back to when you used count(lower).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs added for index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − i + 1', 'next' => 'wrong_b'],
                ['label' => 'j − i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts i paired with itself; Example 1 → 7 instead of 6.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 6, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
