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
            'message' => "Read the problem statement above.\nWhat is the cost of a path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The highest elevation on it', 'next' => 's2'],
                ['label' => 'The sum of elevations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You wait until the water covers the tallest cell, then swim instantly.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With a heap, what key goes with a neighbor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'current key + neighbor elevation', 'next' => 'wrong_b'],
                ['label' => 'max(current key, neighbor elevation)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The path cost is a maximum, not a sum.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When can you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the bottom-right cell is popped', 'next' => 'success'],
                ['label' => 'When it is first pushed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A smaller key for it may still be waiting in the heap.\nStep back to when you stopped on push.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log n). [[0,2],[1,3]] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
