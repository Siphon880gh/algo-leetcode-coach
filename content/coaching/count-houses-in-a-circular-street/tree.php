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
            'message' => "Problem: You stand at a house on a circular street and get an interactive street object plus an upper bound k on the number of houses. You can check whether the current house’s door is open, open or close it, and move to the next house in either direction. Doors start in an unknown state. Return the number of houses. The method names and exact limits are in the official statement. For instance, on a street of 5 houses with k = 10, the answer is 5 whatever the doors start as. (Restated from memory; limits and examples may differ slightly.)\nBefore counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk k steps, closing every door', 'next' => 's2'],
                ['label' => 'Just open the current door', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A door open from the start can stop the walk early; doors closed, open, closed, open, open → 1 instead of 5.\nStep back to when you skipped closing.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Close doors for how many steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Half of k', 'next' => 'wrong_b'],
                ['label' => 'k, the given bound', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Half the bound can miss houses; 5 open doors with k = 6 → 1 instead of 5.\nStep back to when you closed only half.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k). The 5-house example → 5 whatever the doors start as.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
