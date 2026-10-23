## Grow windows

1. For each i: start with every value outside; T = its top k, O = the rest. U = T (the candidates), A = top L of U (L = 0).
2. Move nums[j] inside. If it was in T, pull the largest of O into T and add that to U; otherwise add nums[j] to U.
3. L += 1: move U's best remaining value into A and swap while U still holds something bigger than A's smallest. Record sum(A).
4. Return the best sum.

Examples → 3, 13, −1. Checked against breadth-first search over swaps on 600 random arrays.

Taking the best subarray first and swapping into it: constructed check (run in code) [1, −2, 2, 5, 4], k = 2 → 11 instead of 12.

Time: O(n² log n)  
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
