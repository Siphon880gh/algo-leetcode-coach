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
            'message' => "Read the problem statement above.\nTie on the highest amount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger userId wins', 'next' => 's2'],
                ['label' => 'Smaller userId wins', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): users 1 and 2 both bid 5 on one item → 1 instead of 2.\nStep back to when you broke ties toward the smaller id.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap top before answering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it as is', 'next' => 'wrong_b'],
                ['label' => 'Pop it while it disagrees with the map', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): user 1 bids 5, updates to 3, user 2 bids 4 → 1 instead of 2.\nStep back to when you trusted a stale top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log N) amortized per call. Example → [2, 1, 1, −1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
