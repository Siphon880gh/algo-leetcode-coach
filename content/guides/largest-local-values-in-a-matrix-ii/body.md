## Count bigger cells

1. For each distinct non-zero x: P = 2D prefix sums of [cell > x].
2. For each cell equal to x, count bigger cells in rows r − x + 1 … r + x − 1 × columns c − x … c + x, plus rows r − x … r + x × columns c − x + 1 … c + x − 1, minus their overlap.
3. Count the cells with zero.

Examples → 1, 1, 5, 4. Checked against scanning every square on 400 random matrices.

Including the four corners: constructed check (run in code) [[2, 3, 0], [0, 2, 0], [2, 0, 1]] → 1 instead of 2.

Time: O(V · n · m), V ≤ 200 distinct values  
Space: O(n · m)

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
