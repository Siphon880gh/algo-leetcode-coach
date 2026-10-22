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
            'message' => "Read the problem statement above.\nDouble turn i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Turn i − 1 or i − 2 hit 10', 'next' => 's2'],
                ['label' => 'Only turn i − 1 hit 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The bonus lasts two turns; player1 = [10,0,5] → 15 instead of 20.\nStep back to when you looked back one turn.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Whose 10 triggers it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current turn’s', 'next' => 'wrong_b'],
                ['label' => 'An earlier turn’s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A strike boosts the following turns; Example 4 → 0 instead of 2.\nStep back to when you checked the current turn.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
