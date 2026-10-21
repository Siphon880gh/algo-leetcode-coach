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
            'message' => "Read the problem statement above.\nHow do you simulate the rounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two queues of indexes, one per party', 'next' => 's2'],
                ['label' => 'Delete banned senators from the string each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Deleting from a string is O(n) each time, so the whole thing is O(n²).\nStep back to when you edited the string.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare the two queue fronts. Who acts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Radiant always acts first', 'next' => 'wrong_b'],
                ['label' => 'The smaller index bans the other', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Turn order follows the positions in the string.\nStep back to when you favored a party.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does the winner go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Back into its queue at index + n, for the next round', 'next' => 'success'],
                ['label' => 'Back at its old index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Its old index would make it act again before senators who are still waiting this round.\nStep back to when you reused the index.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two queues, the smaller index bans and rejoins at index + n: O(n). \"RDD\" → \"Dire\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
