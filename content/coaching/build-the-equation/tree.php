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
            'message' => "Problem: A terms table lists a power and a factor for each term of a polynomial (one row per power). Build the equation as a single string: the terms in descending order of power, each written as a sign, the absolute factor, and X with its power in the format the statement gives (special forms for powers 1 and 0), followed by =0. For instance, with a sample format, powers 2, 1, 0 with factors 1, −4, 2 → +1X^2-4X+2=0, and powers 4, 2, 1 with factors −4, 1, −1 → -4X^4+1X^2-1X=0. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nOrder of the terms?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Power descending', 'next' => 's2'],
                ['label' => 'The table\'s row order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rows have no guaranteed order; the equation needs powers from high to low.\nStep back to when you used row order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sign of the first term?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Omitted when positive', 'next' => 'wrong_b'],
                ['label' => 'Written like every other term', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every term carries its sign; the sample gives +1X^2-4X+2=0.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Powers 1 and 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their special forms', 'next' => 'success'],
                ['label' => 'X^1 and X^0 like the rest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The format writes these powers differently; the sample shows -4X and +2.\nStep back to when you used X^p for every power.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → +1X^2-4X+2=0 and -4X^4+1X^2-1X=0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
