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
            'message' => "Read the problem statement above.\nGenerate every pair distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search on the answer instead', 'next' => 's2'],
                ['label' => 'Yes, then sort them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n = 10⁴ gives about 5 · 10⁷ pairs.\nStep back to when you generated all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After sorting, how do you count pairs with distance ≤ d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check every pair', 'next' => 'wrong_b'],
                ['label' => 'A window: for each right, advance left while the gap is > d, then add right − left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. left only moves forward, so the count is O(n).\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "count(mid) ≥ k. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'hi = mid', 'next' => 'success'],
                ['label' => 'lo = mid + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. mid might be the answer; keep it in range.\nStep back to when you discarded mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n log W). [1,3,1], k = 1 → 0. [1,6,1], k = 3 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
