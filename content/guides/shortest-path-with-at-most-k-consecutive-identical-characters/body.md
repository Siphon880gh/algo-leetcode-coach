## Dijkstra

1. Start at (0, 1) with distance 0.
2. Edge u → v: run' = run + 1 if labels match, else 1; skip if run' > k.
3. Return the first distance popped at node n − 1, else −1.

Examples → 3, 2, −1. Checked against searching every walk of up to 9 edges on 600 random graphs.

Plain Dijkstra ignoring k: example 1 → 2 instead of 3.

Time: O(k · (n + m) log(k · n))  
Space: O(k · n)

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
