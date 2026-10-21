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
                ['label' => 'Search states: BFS on (board after collapse, sorted hand)', 'next' => 's2'],
                ['label' => 'Greedily complete the longest run each turn', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Clearing the longest run first can block a cascade that needs those balls later. No greedy rule is known to be safe.\nStep back to when you picked greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inserting at every gap with every color is a lot.\nWhich insert spots do you keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every position with every ball, no pruning', 'next' => 'wrong_b'],
                ['label' => 'Next to the same color, or between two equal balls of another color', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inserting a color between two different-color neighbors that differ from it never helps.\nStep back to when you kept every spot.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Collapse with a loop until no run of 3 remains. Sort the hand so equal states share a key, and keep a visited set. The first empty board in BFS gives the answer.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS, pruned inserts, full cascade collapse', 'next' => 'success'],
                ['label' => 'Remove one run of 3 and stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Removing only once misses chains: \"WWRRW\" + R → after RRR goes, WWW must vanish too.\nStep back to when you removed one run.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Small state search with pruning and full cascades. \"WWRRBBWW\", \"WRBRW\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
