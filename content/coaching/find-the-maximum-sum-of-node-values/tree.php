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
            'message' => "Read the problem statement above.\nOdd number improved?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Give back the smallest |gain|', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Flips come in pairs; [1, 1, 1], k = 2 → 9 instead of 7.\nStep back to when you ignored parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Smallest |gain| over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Improved nodes only', 'next' => 'wrong_b'],
                ['label' => 'All nodes', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping one more node can cost less: [0, 6], k = 5 → 6 instead of 8.\nStep back to when you looked only at improved nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 9, 42.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
