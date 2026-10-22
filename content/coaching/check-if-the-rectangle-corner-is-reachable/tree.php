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
            'message' => "Read the problem statement above.\nSides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Segments of the rectangle', 'next' => 's2'],
                ['label' => 'Infinite lines', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 4 → false instead of true.\nStep back to when you used lines.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Union two circles when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They overlap anywhere', 'next' => 'wrong_b'],
                ['label' => 'They overlap inside the rectangle', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. xCorner = 5, yCorner = 4, circles [[4, 8, 4], [9, 2, 4]] meet outside → false instead of true.\nStep back to when you ignored where they meet.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(c² α(c)). Examples → true, false, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
