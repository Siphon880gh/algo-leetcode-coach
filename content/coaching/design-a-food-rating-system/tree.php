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
            'message' => "Read the problem statement above.\nEqual ratings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lexicographically smaller name', 'next' => 's2'],
                ['label' => 'Larger name', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The Example’s last call → sushi instead of ramen.\nStep back to when you preferred the larger name.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Top’s rating differs from the food’s current rating?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it', 'next' => 'wrong_b'],
                ['label' => 'Pop it and look again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Foods a, b in one cuisine rated 5 and 3; change a to 1 → a instead of b.\nStep back to when you returned the stale top.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many heaps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One per cuisine', 'next' => 'success'],
                ['label' => 'One for all foods', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The Example’s first highestRated(korean) → moussaka, which is Greek, instead of kimchi.\nStep back to when you shared one heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) amortised per call. Example → null, kimchi, ramen, null, sushi, null, ramen.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
