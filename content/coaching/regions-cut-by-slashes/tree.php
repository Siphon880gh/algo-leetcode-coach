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
            'message' => "Read the problem statement above.\nCount cells as regions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a slash splits one cell between two regions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A cell can belong to two regions.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"/\" joins which triangles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top with right, bottom with left', 'next' => 'wrong_b'],
                ['label' => 'Top with left, right with bottom', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the backslash.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do neighboring cells connect?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bottom with the top of the cell below, right with the left of the cell to the right', 'next' => 'success'],
                ['label' => 'All four triangles with all neighbors', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only triangles on a shared edge touch.\nStep back to when you joined everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² α(n)). [\" /\",\"/ \"] → 2. [\" /\",\"  \"] → 1. [\"/\\\\\",\"\\\\/\"] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
