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
            'message' => "Read the problem statement above.\nPick the longest clips first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: extend the covered prefix as far as possible', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A long clip can miss the gap that matters.\nStep back to when you sorted by length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you take another clip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every start time', 'next' => 'wrong_b'],
                ['label' => 'When t reaches the end of the current coverage', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts too many clips.\nStep back to when you took one at every start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "At that point the furthest reach is not beyond t. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'Skip ahead', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There is a gap nobody covers.\nStep back to when you skipped ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + time). [[0,2],[4,6],[8,10],[1,9],[1,5],[5,9]], time = 10 → 3. [[0,1],[1,2]], time = 5 → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
