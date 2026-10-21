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
            'message' => "Read the problem statement above.\nWhich code goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most frequent one', 'next' => 's2'],
                ['label' => 'The smallest one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A frequent code placed late can land next to itself.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do the copies go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consecutive indices', 'next' => 'wrong_b'],
                ['label' => 'Indices 0, 2, 4, …, then 1, 3, 5, …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Copies of one code would be adjacent.\nStep back to when you filled consecutively.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can equal codes still touch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: an answer is guaranteed, so the top code fits in the even slots', 'next' => 'success'],
                ['label' => 'Yes, so you must check and repair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The fill order already keeps them apart.\nStep back to when you added a repair step.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,1,1,2,2,2] → [1,2,1,2,1,2] (any valid order). [1,1,1,1,2,2,3,3] → [1,3,1,3,1,2,1,2] (any valid order).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
