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
            'message' => "Read the problem statement above.\nSimulate swaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: BIT tracks shifts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n up to 3·10^4 and k up to 10^9 make that too slow.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost to bring index i forward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i', 'next' => 'wrong_b'],
                ['label' => 'i − (removed before i)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier picks shifted it left.\nStep back to when you used i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which occurrence of a digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its leftmost remaining', 'next' => 'success'],
                ['label' => 'Any', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The leftmost is cheapest.\nStep back to when you picked any.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10 · n log n). \"4321\", 4 → \"1342\". \"100\", 1 → \"010\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
