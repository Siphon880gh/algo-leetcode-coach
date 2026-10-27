Given item weights and the capacities w1 and w2 of two bags, place each item in at most one bag without going over either capacity, and return the largest total weight packed. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two capacities

1. ok[0][0] = true.
2. For each weight w, for a from w1 down to 0 and b from w2 down to 0: ok[a][b] |= ok[a − w][b] or ok[a][b − w].
3. Answer the largest a + b with ok[a][b].

Constructed checks (run in code): [2, 3, 4], w1 = 5, w2 = 4 → 9; [5, 5, 6], w1 = 6, w2 = 9 → 11; [7, 8], w1 = 3, w2 = 5 → 0. Checked against every assignment on 400 random cases. This assumes the capacities are small enough for a w1 × w2 table.

Filling bag 1 as fully as possible first, then bag 2: [4, 4, 6], w1 = 8, w2 = 4 → 8 instead of 10.

Time: O(n · w1 · w2)  
Space: O(w1 · w2)

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
