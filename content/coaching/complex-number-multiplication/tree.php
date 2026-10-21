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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split on the first +, strip the trailing i, parse signed ints', 'next' => 's2'],
                ['label' => 'Split on both + and −', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The minus belongs to the number. Splitting on − breaks \"1+-1i\" and negative real parts.\nStep back to when you split on −.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a, b, c, d parsed.\nReal part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ac + bd', 'next' => 'wrong_b'],
                ['label' => 'ac − bd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. i × i = −1, so the bd term is subtracted.\nStep back to when you added bd.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Imaginary part: ad + bc. Output f\"{re}+{im}i\". O(1).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parse signed parts, (ac − bd) + (ad + bc)i, "re+imi" format', 'next' => 'success'],
                ['label' => 'Print "re-|im|i" for a negative imaginary part', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The format always has + and then the signed value: \"0+-2i\", not \"0-2i\".\nStep back to when you printed a bare minus.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Parse, multiply with i² = −1, format with \"+\". → \"0+-2i\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
