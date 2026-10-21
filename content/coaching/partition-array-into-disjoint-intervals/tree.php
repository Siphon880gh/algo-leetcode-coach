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
            'message' => "Read the problem statement above.\nnums[i] < leftMax. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It must join the left part: move the cut to i', 'next' => 's2'],
                ['label' => 'Ignore it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every left element must be ≤ every right element.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After moving the cut, leftMax = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[i]', 'next' => 'wrong_b'],
                ['label' => 'The max seen so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The left part now holds everything up to i.\nStep back to when you used nums[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "nums[i] == leftMax. Move the cut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: equal values may stay on the right', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The condition is ≤, so ties are fine on the right, and the left part should stay smallest.\nStep back to when you moved it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [5,0,3,8,6] → 3. [1,1,1,0,6,12] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
