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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Think about what one move does to the differences between elements', 'next' => 's2'],
                ['label' => 'Simulate: raise every element except the largest until all match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer can be about 2e9 moves, so simulating them is far too slow.\nStep back to when you simulated moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Raising n − 1 elements by 1 leaves all differences the same as lowering the one left out by 1.\nSo where do all elements end up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the mean or the median', 'next' => 'wrong_b'],
                ['label' => 'At the minimum: moves = Σ (x − min)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lowering never helps a value go below the minimum, and the mean or median ignores how the move works.\nStep back to when you picked the target.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Moves = sum(nums) − min × n. Use 64 bits for the sum. O(n) time, O(1) space. 462 moves one element by ±1, so its target is the median.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum − min × n, in 64 bits. Not 462', 'next' => 'success'],
                ['label' => 'Sort and sum distances to the median', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is 462's rule. Here a move changes n − 1 elements, so the median does not apply.\nStep back to when you used 462's answer.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One move lowers one element relative to the rest, so all fall to the min. [1,2,3] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
