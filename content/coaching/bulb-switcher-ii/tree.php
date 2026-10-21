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
            'message' => "Read the problem statement above.\nSimulate every press sequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the state space is tiny', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. presses can be 1000, which is 4¹⁰⁰⁰ sequences.\nStep back to when you simulated sequences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many bulbs matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All n', 'next' => 'wrong_b'],
                ['label' => 'min(n, 3): the patterns repeat and bulbs 4–6 follow from 1–3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every button's effect is periodic, so the first three decide the rest.\nStep back to when you kept all n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about pressing a button twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It cancels, so only each button\'s parity matters', 'next' => 'success'],
                ['label' => 'It flips the bulbs twice as much', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two flips return to the start.\nStep back to when you counted every press.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Case table or 16 parity choices: O(1). n = 1, presses = 1 → 2. n = 2, presses = 1 → 3. n = 3, presses = 1 → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
