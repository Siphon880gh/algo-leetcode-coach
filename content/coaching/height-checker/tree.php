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
            'message' => "Read the problem statement above.\nWhat are you counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positions where heights differ from the sorted order', 'next' => 's2'],
                ['label' => 'Swaps needed to sort', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The question asks for mismatched positions.\nStep back to when you counted swaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort heights in place first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: compare against a sorted copy', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The original order is what you check.\nStep back to when you sorted in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Heights are at most 100. Faster sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counting sort', 'next' => 'success'],
                ['label' => 'None is possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Bounded values allow linear sorting.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 100). [1,1,4,2,1,3] → 3. [5,1,2,3,4] → 5. [1,2,3,4,5] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
