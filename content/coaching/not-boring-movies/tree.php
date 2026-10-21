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
            'message' => "Read the problem statement above.\nHow do you keep odd ids?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'id % 2 = 1', 'next' => 's2'],
                ['label' => 'id % 2 = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. id % 2 = 0 keeps the even ids.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you drop the boring movies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'description NOT LIKE \'%boring%\'', 'next' => 'wrong_b'],
                ['label' => 'description != \'boring\'', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A description like 'not boring' would be dropped too; only the exact value boring is excluded.\nStep back to when you used LIKE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How is the result ordered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rating DESC', 'next' => 'success'],
                ['label' => 'id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the highest rating first.\nStep back to when you sorted by id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. id % 2 = 1 AND description != 'boring' ORDER BY rating DESC: O(n log n).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
