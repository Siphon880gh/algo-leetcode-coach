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
            'message' => "Problem: A variables table gives values; an expressions table holds left operand, comparison operator, and right operand (variable names). Report each expression with its result as the statement specifies. For instance, x = 66 and y = 77 make x < y true and x = y false. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHow many joins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two: left and right operand', 'next' => 's2'],
                ['label' => 'One', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each operand needs its own value.\nStep back to when you joined once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Names', 'next' => 'wrong_b'],
                ['label' => 'Values', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Names are just keys.\nStep back to when you compared names.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output format?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As the statement specifies', 'next' => 'success'],
                ['label' => 'Raw 0/1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Map the comparison to the required strings.\nStep back to when you printed 0/1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each expression evaluated with one CASE over its two joined values.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
