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
            'message' => "Read the problem statement above.\nCondition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · (a + c) = b', 'next' => 's2'],
                ['label' => 'a + c = b // 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 5, 1] → 1 instead of 0 (half of 5 is 2.5).\nStep back to when you used floor division.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Also wrap around the end', 'next' => 'wrong_b'],
                ['label' => 'i = 0 … n − 3', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 4] → 1 instead of 0.\nStep back to when you wrapped around.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
