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
            'message' => "Read the problem statement above.\nGenerate the numbers in order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search on the value', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁹.\nStep back to when you generated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "count(m) = m//a + m//b + m//c, then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Done', 'next' => 'wrong_b'],
                ['label' => 'Subtract pairwise LCM terms, add the triple LCM term', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Numbers divisible by two of them are counted twice.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "count(mid) ≥ n. Move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'success'],
                ['label' => 'lo = mid + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid may be the answer.\nStep back to when you moved lo.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log 2 · 10⁹). n = 3, a = 2, b = 3, c = 5 → 4. n = 4, a = 2, b = 3, c = 4 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
