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
            'message' => "Read the problem statement above.\nA flip at j changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e[j − 1] and e[j]', 'next' => 's2'],
                ['label' => 'Only e[j]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [0, 1] instead of [0, 2].\nStep back to when you updated one pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query [l, r] sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e[l … r]', 'next' => 'wrong_b'],
                ['label' => 'e[l … r − 1]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): s = \"AAA\", query [2, 0, 1] → 2 instead of 1.\nStep back to when you included e[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [0, 2], [1, 0], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
