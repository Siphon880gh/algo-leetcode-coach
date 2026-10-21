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
            'message' => "Read the problem statement above.\nWhich batch to eat from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one that rots soonest', 'next' => 's2'],
                ['label' => 'The largest batch', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Large fresh batches can wait.\nStep back to when you picked the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rotten batch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Expiry < today: drop it', 'next' => 'wrong_b'],
                ['label' => 'Expiry ≤ today: drop it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Apples rot on day i + days[i] and cannot be eaten then.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After day n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep eating from the heap', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stored apples can still be eaten.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 7, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
