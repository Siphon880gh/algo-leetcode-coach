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
            'message' => "Read the problem statement above.\nWhich rule is checked first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exact match', 'next' => 's2'],
                ['label' => 'Case-insensitive match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An exact match must return the query itself.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two words share a lowercase form. Store which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last one', 'next' => 'wrong_b'],
                ['label' => 'The first one in the list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The rules ask for the first match.\nStep back to when you overwrote it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you match ignoring vowels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowercase, then replace each of a, e, i, o, u with a placeholder', 'next' => 'success'],
                ['label' => 'Delete the vowels', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deleting changes positions, so \"kite\" and \"kt\" would match.\nStep back to when you deleted vowels.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). wordlist = [\"KiTe\",\"kite\",\"hare\",\"Hare\"], queries = [\"kite\",\"Kite\",\"KiTe\",\"Hare\",\"HARE\",\"Hear\",\"hear\",\"keti\",\"keet\",\"keto\"] → [\"kite\",\"KiTe\",\"KiTe\",\"Hare\",\"hare\",\"\",\"\",\"KiTe\",\"\",\"KiTe\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
