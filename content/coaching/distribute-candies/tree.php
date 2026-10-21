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
            'message' => "Read the problem statement above.\nWhat limits how many types she can eat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two caps: n / 2 candies, and the number of distinct types', 'next' => 's2'],
                ['label' => 'Only the number of distinct types', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. She may only eat n / 2 candies: [1,2,3,4] has 4 types but the answer is 2.\nStep back to when you used one cap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can she always reach the smaller cap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when every type has at least 2 candies', 'next' => 'wrong_b'],
                ['label' => 'Yes: one candy of each type first, then fill up with anything', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One candy per type is enough to see that type, and the rest can be anything.\nStep back to when you required two of a type.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you need to compute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A set of the types', 'next' => 'success'],
                ['label' => 'A count per type, sorted by count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. How many candies each type has does not matter, only how many types there are.\nStep back to when you counted per type.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. min(len(set(candyType)), n / 2): O(n) time and space.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
