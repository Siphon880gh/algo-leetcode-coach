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
            'message' => "Read the problem statement above.\nCondition on what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts outside the window', 'next' => 's2'],
                ['label' => 'Counts inside the window', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The window can be rewritten freely; the rest must already fit.\nStep back to when you looked inside.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Outside counts all ≤ q. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grow further', 'next' => 'wrong_b'],
                ['label' => 'Record the length and shrink from the left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You want the shortest window.\nStep back to when you grew.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Already balanced?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0 first', 'next' => 'success'],
                ['label' => 'Let the loop find it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The loop records lengths of at least 1.\nStep back to when you relied on the loop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"QWER\" → 0. \"QQWE\" → 1. \"QQQW\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
