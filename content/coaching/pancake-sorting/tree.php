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
            'message' => "Read the problem statement above.\nDo you need the fewest flips?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any answer within 10 · n flips is accepted', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Minimizing flips is a much harder problem.\nStep back to when you minimized.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The largest unsorted value is at index i. First flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip the first i', 'next' => 'wrong_b'],
                ['label' => 'Flip the first i + 1, bringing it to the top', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Flipping k reverses the first k elements; it must include index i.\nStep back to when you flipped i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip the first size elements to send it to position size − 1', 'next' => 'success'],
                ['label' => 'Flip the whole array', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That would disturb the pancakes already in place.\nStep back to when you flipped everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [3,2,4,1] → [3,4,2,3,2] (any valid list is accepted). [1,2,3] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
