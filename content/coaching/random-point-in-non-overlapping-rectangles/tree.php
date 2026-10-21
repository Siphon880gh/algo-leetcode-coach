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
                ['label' => 'Pick a rectangle with probability proportional to its points', 'next' => 's2'],
                ['label' => 'Pick a rectangle uniformly, then a point inside it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A tiny rectangle would be picked as often as a huge one, so its points are oversampled.\nStep back to when you picked a rectangle uniformly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Weight for [a, b, x, y]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(x − a) × (y − b), the area', 'next' => 'wrong_b'],
                ['label' => '(x − a + 1) × (y − b + 1) integer points', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Area (x − a)(y − b) misses one edge row and column; a 1-wide rectangle gets weight 0.\nStep back to when you used area.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prefix sums of weights; draw v in 1..total; binary search the first prefix ≥ v; then u in [a, x], w in [b, y] uniformly. O(n) setup, O(log n) per pick.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Point-count weights, prefix sums, binary search, uniform inside', 'next' => 'success'],
                ['label' => 'Precompute a list of all points and sample from it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Listing every integer point can mean 100 × 2001² ≈ 4e8 points. Too much memory.\nStep back to when you listed every point.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Weight by integer points, binary search the prefix, sample inside. Same as 528.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
