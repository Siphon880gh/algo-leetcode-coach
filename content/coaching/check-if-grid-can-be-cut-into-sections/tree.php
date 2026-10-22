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
            'message' => "Read the problem statement above.\nA gap starts when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start ≥ largest end so far', 'next' => 's2'],
                ['label' => 'Start ≥ previous interval’s end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 6, [[0, 1, 6, 2], [1, 2, 2, 6], [2, 5, 3, 6], [4, 4, 6, 6]] → true instead of false.\nStep back to when you used the previous end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Axes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Horizontal cuts only', 'next' => 'wrong_b'],
                ['label' => 'Try both', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → false instead of true.\nStep back to when you skipped vertical cuts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
