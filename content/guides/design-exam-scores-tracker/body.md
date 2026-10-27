## Two lists

1. record(t, x): append t to times and P[-1] + x to P (P starts as [0]).
2. totalScore(a, b): i = first index with times[i] ≥ a; j = first index with times[j] > b. Return P[j] − P[i].

Example → [null, null, 98, null, 98, 197, 0, 99]. Checked against summing directly on 500 random sequences.

Using "first time > a" for the left end: totalScore(1, 1) → 0 instead of 98.

Time: O(1) per record, O(log n) per query  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
