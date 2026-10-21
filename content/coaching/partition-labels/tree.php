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
            'message' => "Read the problem statement above.\nWhat must one part contain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every copy of each letter it holds', 'next' => 's2'],
                ['label' => 'Only distinct letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A letter cannot appear in two parts.\nStep back to when you ignored later copies.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How far must the current part extend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To the last index of its first letter', 'next' => 'wrong_b'],
                ['label' => 'To the max last index of every letter seen so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Letters inside the part can push the end farther.\nStep back to when you used only the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you cut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the scan index equals that end', 'next' => 'success'],
                ['label' => 'Whenever a new letter appears', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cutting early would split a letter's copies.\nStep back to when you cut on new letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"ababcbacadefegdehijhklij\" → [9,7,8]. \"eccbbbbdec\" → [10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
