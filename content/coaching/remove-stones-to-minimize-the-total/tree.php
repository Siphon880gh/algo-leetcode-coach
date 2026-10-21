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
            'message' => "Read the problem statement above.\nWhich pile each time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current largest', 'next' => 's2'],
                ['label' => 'Each pile in turn', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The largest pile loses the most.\nStep back to when you rotated piles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pile after the operation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x // 2', 'next' => 'wrong_b'],
                ['label' => 'x − x // 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You remove floor(x / 2); ceil(x / 2) remains.\nStep back to when you kept the floor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Heap kind in Python?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Min-heap of negatives', 'next' => 'success'],
                ['label' => 'Plain min-heap of values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You would halve the smallest pile.\nStep back to when you used positives.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log n). Examples → 12, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
