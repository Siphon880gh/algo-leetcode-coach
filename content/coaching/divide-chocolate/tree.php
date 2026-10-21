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
            'message' => "Problem: A bar has chunks with sweetness values. Cut it into k + 1 pieces of consecutive chunks, give k away, and keep the least sweet piece. Return the most sweetness you can guarantee. For instance, [1,2,3,4,5] with k = 1 gives 6, and [5,5,5] with k = 2 gives 5. (Restated from memory; limits and examples may differ slightly.)\nTry every set of cuts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: binary search the answer', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The number of cut sets explodes.\nStep back to when you tried them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Feasible if pieces?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '== k + 1', 'next' => 'wrong_b'],
                ['label' => '≥ k + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra pieces can merge into the last one.\nStep back to when you required exactly k + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Searching for the largest feasible m. Midpoint?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(lo + hi + 1) // 2 with lo = mid', 'next' => 'success'],
                ['label' => '(lo + hi) // 2 with lo = mid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The loop can stall when hi = lo + 1.\nStep back to when you used the lower midpoint.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log sum). [1,2,3,4,5], k = 1 → 6. [5,5,5], k = 2 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
