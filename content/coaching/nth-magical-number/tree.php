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
            'message' => "Read the problem statement above.\nMerge the multiples of a and b one by one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n can be 10⁹, so binary search on the value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n).\nStep back to when you merged.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many magical numbers are ≤ x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x // a + x // b', 'next' => 'wrong_b'],
                ['label' => 'x // a + x // b − x // lcm(a, b)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Common multiples are counted twice.\nStep back to when you skipped the overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you take mod 10⁹ + 7?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on the final answer', 'next' => 'success'],
                ['label' => 'Inside the search', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The comparisons need the real values.\nStep back to when you took the mod early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log(n · min(a, b))). n = 1, a = 2, b = 3 → 2. n = 4, a = 2, b = 3 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
