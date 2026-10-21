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
            'message' => "Read the problem statement above.\nDP over (eggs, floors) with a min over every drop floor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Too slow; flip it to floors covered by m moves', 'next' => 's2'],
                ['label' => 'Yes, that is the way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(k · n²) for n up to 10⁴.\nStep back to when you tried every drop floor.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f(m, k) = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · f(m − 1, k)', 'next' => 'wrong_b'],
                ['label' => 'f(m − 1, k − 1) + f(m − 1, k) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A break loses an egg, so the floors below get k − 1 eggs.\nStep back to when you kept the egg.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "With one egg, what is the best strategy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go floor by floor from the bottom: n moves', 'next' => 'success'],
                ['label' => 'Binary search', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If the egg breaks halfway, you have no egg left for the floors below.\nStep back to when you binary searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · m). k = 1, n = 2 → 2. k = 2, n = 6 → 3. k = 3, n = 14 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
