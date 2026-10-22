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
            'message' => "Read the problem statement above.\nset returns true when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The key exists and has not expired', 'next' => 's2'],
                ['label' => 'The key exists at all', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Expired keys do not count; set(1, 42, 50) at t = 0, then set(1, 7, 50) at t = 60 → true instead of false.\nStep back to when you ignored expiry.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Overwriting a key that has a delete timer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it running', 'next' => 'wrong_b'],
                ['label' => 'Clear the old timer', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old timer deletes the new value early; Example 2 → get at t = 120 gives −1 instead of 50.\nStep back to when you kept the old timer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) for set and get. Examples → [null,false,42,1,−1], [null,false,true,50,50,−1,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
