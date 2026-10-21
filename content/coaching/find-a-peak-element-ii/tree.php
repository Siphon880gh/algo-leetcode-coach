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
            'message' => "Read the problem statement above.\nCell to inspect in the middle row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its maximum', 'next' => 's2'],
                ['label' => 'Its middle cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The middle cell may lose to its left or right neighbour.\nStep back to when you took the middle cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cell below is larger?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the upper half', 'next' => 'wrong_b'],
                ['label' => 'Search the lower half', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Climb toward the larger neighbour.\nStep back to when you went up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Time target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log m)', 'next' => 'success'],
                ['label' => 'O(m · n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement requires a logarithmic factor.\nStep back to when you scanned everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log m). Examples → [0,1], [1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
