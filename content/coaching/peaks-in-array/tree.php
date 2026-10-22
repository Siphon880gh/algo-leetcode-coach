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
            'message' => "Read the problem statement above.\nCount on [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flags on l + 1 … r − 1', 'next' => 's2'],
                ['label' => 'Flags on l … r', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Subarray ends cannot be peaks: example 2 → [1, 1] instead of [0, 1].\nStep back to when you included the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update i rechecks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i', 'next' => 'wrong_b'],
                ['label' => 'i − 1, i and i + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Index 2 stops being a peak: example 1 → [1] instead of [0].\nStep back to when you rechecked only i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [0], [0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
