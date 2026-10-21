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
            'message' => "Read the problem statement above.\nWhich elements can trade places?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any two in the same connected component', 'next' => 's2'],
                ['label' => 'Only pairs with gcd > 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Swaps chain; in [7,21,3], 7 and 3 trade through 21.\nStep back to when you allowed direct pairs only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build the components how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union every pair with gcd > 1', 'next' => 'wrong_b'],
                ['label' => 'Union each value with its prime factors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is about 4.5 · 10^8 gcd calls for 3 · 10^4 values.\nStep back to when you compared all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'find(nums[i]) == find(sorted[i]) for every i', 'next' => 'success'],
                ['label' => 'Each component is already sorted', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A component can be rearranged freely; the question is whether each position gets a value from its own component.\nStep back to when you required sorted components.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
