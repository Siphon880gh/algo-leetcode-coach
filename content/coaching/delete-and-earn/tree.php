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
            'message' => "Read the problem statement above.\nTake a value v. Take its other copies too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: v − 1 and v + 1 are already gone, so the copies are free', 'next' => 's2'],
                ['label' => 'No, one at a time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Once v is chosen, its copies conflict with nothing new.\nStep back to when you took one copy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you compute per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count(v)', 'next' => 'wrong_b'],
                ['label' => 'points[v] = v · count(v)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You earn v for each copy.\nStep back to when you used the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which values conflict?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent values v and v + 1, as in House Robber', 'next' => 'success'],
                ['label' => 'Equal values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Taking v deletes v − 1 and v + 1.\nStep back to when you used equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + max). [3,4,2] → 6. [2,2,3,3,3,4] → 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
