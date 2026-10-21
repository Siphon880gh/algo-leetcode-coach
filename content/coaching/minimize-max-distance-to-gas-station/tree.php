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
            'message' => "Problem: Problem: Given sorted station positions and an integer k, add k stations anywhere to minimize the largest gap between neighbors. Return that minimum, within 10⁻⁶. (Restated from memory; limits and examples may differ slightly.)\nRepeatedly put a station in the middle of the largest gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: halving is not optimal, and k can be 10⁶', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A gap of 3 with 2 stations is best split into thirds.\nStep back to when you halved gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For a candidate D, how many stations does gap g need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'g / D', 'next' => 'wrong_b'],
                ['label' => 'ceil(g / D) − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Splitting into ceil(g / D) pieces takes one fewer station.\nStep back to when you used g / D.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How does the search end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When hi − lo < 1e-6, or after a fixed number of iterations', 'next' => 'success'],
                ['label' => 'When lo == hi', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Real-valued bounds may never become exactly equal.\nStep back to when you waited for equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · log(range / 1e-6)). stations [1..10], k = 9 → 0.5. [23,24,36,39,46,56,57,65,84,98], k = 1 → 14.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
