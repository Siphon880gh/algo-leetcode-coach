## Enumerate

1. For a = 1, 2, … while 2a³ ≤ n: for b = a, a + 1, … while a³ + b³ ≤ n: cnt[a³ + b³] += 1.
2. Return the sorted sums with cnt ≥ 2.

Examples → [1729, 4104], []. Checked against testing every x up to 30,000. n = 10^9 gives 1,554 values in about half a second in Python.

Counting ordered pairs (a, b) and (b, a) separately: example 2 → [9, 28, 35, …] instead of [].

Time: O(n^(2/3) log n)  
Space: O(n^(2/3))

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
