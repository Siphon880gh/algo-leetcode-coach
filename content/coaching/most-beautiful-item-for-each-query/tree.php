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
            'message' => "Read the problem statement above.\nWhich items qualify for query q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Price at most q', 'next' => 's2'],
                ['label' => 'Price exactly q', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any item whose price is ≤ q counts.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Best beauty among them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Beauty of the most expensive affordable item', 'next' => 'wrong_b'],
                ['label' => 'Prefix maximum over items sorted by price', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A cheaper item can be more beautiful; items [[1,5],[2,1]] with query 2 → 5, not 1.\nStep back to when you took the last item.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Find the last affordable item?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_right on prices', 'next' => 'success'],
                ['label' => 'bisect_left on prices', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. bisect_left skips items priced exactly q; Example 1 query 3 would give 4 instead of 5.\nStep back to when you used bisect_left.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [2,4,5,5,6,6], [4], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
