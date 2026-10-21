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
            'message' => "Read the problem statement above.\nWhich numbers may a window contain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly 1 to 9, each once', 'next' => 's2'],
                ['label' => 'Any numbers whose lines have equal sums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A magic square here must use the distinct numbers 1 to 9.\nStep back to when you allowed any numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A fast reject?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A corner must be 5', 'next' => 'wrong_b'],
                ['label' => 'The center must be 5', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The four lines through the center sum to 60 = 45 + 3 · center, which forces the center to 5.\nStep back to when you checked a corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 3 rows, 3 columns and both diagonals sum to 15', 'next' => 'success'],
                ['label' => 'Only the rows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows alone allow layouts that are not magic.\nStep back to when you checked only rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(r · c). [[4,3,8,4],[9,5,1,9],[2,7,6,2]] → 1. [[8]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
