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
            'message' => "Read the problem statement above.\nCost update per step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost += balls seen so far', 'next' => 's2'],
                ['label' => 'cost += 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every ball seen moves one step further.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order inside the loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the ball first', 'next' => 'wrong_b'],
                ['label' => 'Record cost, then add box i\'s ball', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A ball in box i costs 0 to box i itself.\nStep back to when you added it first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Brute force O(n²)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Works for 2000, but two sweeps are O(n)', 'next' => 'success'],
                ['label' => 'Too slow', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 4 · 10^6 is fine; the sweeps are just better.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,1,3], [11,8,5,4,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
