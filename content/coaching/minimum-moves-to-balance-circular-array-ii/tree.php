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
            'message' => "Problem: You get a circular array balance, where balance[i] is person i's net balance (negative means a shortfall). In one move a person hands exactly 1 unit to the neighbour on either side, and the first and last people are neighbours. Return the fewest moves that leave every balance at least 0, or −1 if that is impossible. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nDirection of passing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both ways around the circle', 'next' => 's2'],
                ['label' => 'One direction only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [3, −1, −1, −1] → 6 instead of 4.\nStep back to when you passed one way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Possible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every deficit has a surplus neighbour', 'next' => 'wrong_b'],
                ['label' => 'Total balance ≥ 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [−2, 0, 5, −2, −1] → −1 instead of 8.\nStep back to when you checked only neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) in practice. Constructed checks → 4, 8, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
