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
            'message' => "Read the problem statement above.\nRow k uses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k balls of one colour', 'next' => 's2'],
                ['label' => 'One ball', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 3.\nStep back to when you used one ball per row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Starting colour?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always red', 'next' => 'wrong_b'],
                ['label' => 'Try both', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you always started with red.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√(red + blue)). Examples → 3, 2, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
