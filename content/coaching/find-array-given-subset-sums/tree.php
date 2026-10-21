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
            'message' => "Read the problem statement above.\nFirst step on the sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort them', 'next' => 's2'],
                ['label' => 'Use them in the given order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. d comes from the two smallest sums, so they must be sorted.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "d = s[1] − s[0] is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest element', 'next' => 'wrong_b'],
                ['label' => 'The absolute value of some element', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The element may be negative; only |element| = d is known.\nStep back to when you assumed it is positive.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which half do you continue with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The half that contains 0', 'next' => 'success'],
                ['label' => 'Always the smaller sums A', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If 0 is only in A + d, the element is −d and A + d is the rest.\nStep back to when you always kept A.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 2^n). Examples → [1,2,-3], [0,0], [0,-1,4,5] (any order).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
