## Order rows, order columns

1. Kahn’s algorithm on `rowConditions` gives `R`; on `colConditions` gives `C`. If either has fewer than k numbers, return [].
2. `M[pos_R(v)][pos_C(v)] = v` for each v; every other cell is 0.

Example 1 → a valid matrix such as [[0,0,1],[3,0,0],[0,2,0]] (any valid answer is accepted); Example 2 → []. Checked on 300 random cases: every matrix built meets all conditions, and when none is built, no pair of orders exists.

Each number gets its own row and its own column, so the k numbers fill a permutation pattern. Duplicate conditions just add duplicate edges, which Kahn’s algorithm counts correctly.

Time: O(k² + n + m)  
Space: O(k² + n + m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
