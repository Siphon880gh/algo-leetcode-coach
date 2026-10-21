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
            'message' => "Read the problem statement above.\nCheck every triple?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort, then fix the largest side', 'next' => 's2'],
                ['label' => 'Yes: three nested loops', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. O(n³) is 10⁹ steps at n = 1000.\nStep back to when you tried every triple.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sorted a ≤ b ≤ c. Which inequality decides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + c > b', 'next' => 'wrong_b'],
                ['label' => 'a + b > c', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With c the largest, a + c > b always holds; the binding test is a + b > c.\nStep back to when you checked the easy one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "c is fixed, and nums[i] + nums[j] > c. How many triangles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add j − i, then move j left', 'next' => 'success'],
                ['label' => 'Add 1, then move i right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every index from i to j − 1 also works with j, because those values are at least nums[i].\nStep back to when you added one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sort, fix c, two pointers with bulk counts: O(n²) time. [2,2,3,4] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
