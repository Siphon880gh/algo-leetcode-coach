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
            'message' => "Read the problem statement above.\nPlain DFS with memo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: cycles make it unreliable', 'next' => 's2'],
                ['label' => 'Yes, it terminates fine', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Positions repeat, so a memoised DFS can lock in wrong results.\nStep back to when you used DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does a parent state get a result?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After any single child resolves', 'next' => 'wrong_b'],
                ['label' => 'Mover finds one winning move, or all moves lose', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A loss for the mover needs every move to lose; track remaining moves.\nStep back to when you resolved early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "States never resolved?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cat wins (the turn limit)', 'next' => 'success'],
                ['label' => 'Mouse wins', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If the mouse cannot force food, the 1000-turn rule gives the cat the game.\nStep back to when you gave them to the mouse.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((rows · cols)² · (rows + cols)). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
