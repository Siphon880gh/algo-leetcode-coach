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
            'message' => "Read the problem statement above.\nSearch permutations for a valid one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build it by divide and conquer', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n is up to 1000.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why put all odds before all evens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It sorts the array', 'next' => 'wrong_b'],
                ['label' => 'An odd plus an even is odd, so it is never 2 · nums[k]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The point is that pairs across the halves can never be averaged.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do maps x → 2x − 1 and x → 2x keep a half beautiful?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: they keep the averaging relations', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If 2b ≠ a + c, then 2(2b) ≠ 2a + 2c, and the same holds for 2x − 1.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). n = 4 → [1,3,2,4]. n = 5 → [1,5,3,2,4]. (Any valid answer is accepted.)\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
