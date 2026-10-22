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
            'message' => "Problem: A hidden integer is fixed. You can ask questions through an API: you pass a number, it answers how many bit positions agree between the hidden number and yours, and each question may also change the hidden number in the way the statement describes. Recover the original hidden number. The API name, the bit width, the call limit and the exact effect of a question are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRead bit i from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ask(2^i) against ask(0)', 'next' => 's2'],
                ['label' => 'Whether ask(2^i) equals 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The answer counts every agreeing bit: under the assumptions, hidden 5 with 30 bits answers 29 to ask(1).\nStep back to when you compared with 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After ask(2^i)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move on', 'next' => 'wrong_b'],
                ['label' => 'Ask 2^i again to undo it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under the assumed effect the flips pile up: in a simulated check, 3 of 4 hidden numbers come out wrong.\nStep back to when you moved on.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two questions per bit plus one. The simulated check recovers every hidden number.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
