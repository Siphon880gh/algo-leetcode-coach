## Greedy

1. d_i = #{j ≠ i : factor_i divides factor_j}, by counting multiples of each factor.
2. pmin = min price. For items sorted by price with price ≤ 2 · pmin: take min(d_i, left // price) doubles.
3. Return 2 · doubles + left // pmin.

Examples → 5, 7. Checked against trying every purchase on 1,500 random cases.

Taking doubles that cost more than 2 · pmin: constructed check (run in code) items = [[4, 9], [3, 2], [4, 7]], budget = 18 → 5 instead of 9.

Time: O(n log n)  
Space: O(n)

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
