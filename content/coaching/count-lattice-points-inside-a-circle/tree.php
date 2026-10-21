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
            'message' => "Read the problem statement above.\nOverlapping circles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each point once if any circle holds it', 'next' => 's2'],
                ['label' => 'Count each circle’s points and add', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Shared points count twice; Example 2 → 18 instead of 16.\nStep back to when you added per circle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On the circle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Excluded: d² < r²', 'next' => 'wrong_b'],
                ['label' => 'Counts: d² ≤ r²', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 5.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Scan range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … 200 in each axis', 'next' => 'success'],
                ['label' => '0 … 100 in each axis', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x + r can reach 200; circle [100,100,100] → 7955 instead of 31417.\nStep back to when you stopped at 100.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(201² · circles). Examples → 5, 16.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
