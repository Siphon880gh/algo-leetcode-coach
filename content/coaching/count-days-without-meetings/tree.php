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
            'message' => "Read the problem statement above.\nOverlapping meetings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merge them', 'next' => 's2'],
                ['label' => 'Add every length', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Overlaps count twice: example 2 → −1 instead of 1.\nStep back to when you added lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Free days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gaps between merged blocks', 'next' => 'wrong_b'],
                ['label' => 'days − covered', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That misses days after the last block: example 2 → 0 instead of 1.\nStep back to when you counted gaps only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
