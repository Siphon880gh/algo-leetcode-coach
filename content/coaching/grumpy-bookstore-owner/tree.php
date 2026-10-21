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
            'message' => "Read the problem statement above.\nWhich customers are always satisfied?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Those in minutes where grumpy is 0', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Those minutes do not depend on the technique.\nStep back to when you said none.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does the window maximize?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All customers inside it', 'next' => 'wrong_b'],
                ['label' => 'Customers in grumpy minutes inside it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Non-grumpy customers are already counted.\nStep back to when you counted all customers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you move the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add the entering minute, remove the leaving one', 'next' => 'success'],
                ['label' => 'Recompute the window sum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n · minutes).\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). customers [1,0,1,2,1,1,7,5], grumpy [0,1,0,1,0,1,0,1], minutes = 3 → 16. [1], [0], 1 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
