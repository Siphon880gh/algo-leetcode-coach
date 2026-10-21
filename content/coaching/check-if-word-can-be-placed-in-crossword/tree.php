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
            'message' => "Read the problem statement above.\nWhere can the word go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A whole slot between # cells or edges', 'next' => 's2'],
                ['label' => 'Any run of matching cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Empty or lettered cells beside the word are forbidden, so it must fill the whole slot.\nStep back to when you allowed partial slots.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Directions to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left to right and top to bottom only', 'next' => 'wrong_b'],
                ['label' => 'Forward and backward in rows and columns', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 needs ca read right to left.\nStep back to when you used two directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A slot cell already holds a letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It must equal the word\'s letter there', 'next' => 'success'],
                ['label' => 'It can be overwritten', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Letters from solved words stay.\nStep back to when you overwrote it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
