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
            'message' => "Read the problem statement above.\nWhich items first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest values', 'next' => 's2'],
                ['label' => 'One item per label', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values decide; labels only cap.\nStep back to when you went label by label.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The next item's label is capped. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Skip it and keep going', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Smaller items with other labels may still fit.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After numWanted items or when items run out', 'next' => 'success'],
                ['label' => 'Exactly at numWanted, failing otherwise', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Fewer items are allowed.\nStep back to when you required numWanted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [5,4,3,2,1], [1,1,2,2,3], 3, 1 → 9. [5,4,3,2,1], [1,3,3,3,2], 3, 2 → 12. [9,8,8,7,6], [0,0,0,1,1], 3, 1 → 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
