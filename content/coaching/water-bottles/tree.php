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
            'message' => "Read the problem statement above.\nAfter a trade, empties become?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'empty % e + new', 'next' => 's2'],
                ['label' => 'new', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Leftover empties still count.\nStep back to when you dropped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Closed form?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n + n // e', 'next' => 'wrong_b'],
                ['label' => 'n + (n − 1) // (e − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. New bottles also become empties.\nStep back to when you traded once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Stop when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'empties < e', 'next' => 'success'],
                ['label' => 'empties == 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You cannot trade fewer than e.\nStep back to when you waited for 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). (9, 3) → 13. (15, 4) → 19.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
