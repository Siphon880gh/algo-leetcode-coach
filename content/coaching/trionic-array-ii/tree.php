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
            'message' => "Read the problem statement above.\nFirst rise length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least 2 elements', 'next' => 's2'],
                ['label' => 'A single element is fine', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → −2 instead of −4.\nStep back to when you allowed one element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal neighbours?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them as rising', 'next' => 'wrong_b'],
                ['label' => 'Break every phase', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [−3, −2, −4, 1, 1] → −7 instead of −8.\nStep back to when you let equal values rise.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → −4, 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
